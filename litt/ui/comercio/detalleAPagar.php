<?php
include('./header.php');

function fecha($f) {

    $a = substr($f, 0,4);
    $m = substr($f, 4,2);
    $d = substr($f, 6,2);
    if(strlen($f) > 8) { 
        $h = substr($f, 8,2);
        $i = substr($f, 10,2);
        return $d."/".$m."/".$a." ".$h.":".$i;
    } else
        return $d."/".$m."/".$a;
    
}
$com = R::findOne("comercios","id LIKE ?",[$_SESSION["id_comercio"]]);
$comision = R::findOne("convenios","id LIKE ?",[$com["convenio"]])["comision"];
?>
		<div class="container"> 
		<div class="panel-a col-md-8 col-md-offset-2 col-sm-12 col-sm-offset-0 col-xs-10 col-xs-offset-1">
			<div class="row panel-title">
				<div class="col-sm-3 "></div>
				<div class="col-sm-6" style="border-bottom: 2px solid #769FCD;margin-bottom:20px"><h2 align="center">Detalle</h2></div>
				<div class="col-sm-3"></div>
			</div>
            <?php $r = R::findAll("rendiciones","id_comercio LIKE ?",array($_SESSION["id_comercio"])); $proxima = count($r); ?>
		<div class="row"><h4 align="center">Rendición # <span><?php echo $proxima ?></span></h4></div>
			<span><h3 align="center">Créditos Liquidados a cobrar</h3></span>

            <div style="overflow-x: auto">
			<table class="table" style="width: 100%">
					<tr style="font-weight: 600; background:#ccc;">
                                            <td>Fecha</td>
                                            <td>Nro Op</td>
                                            <td>Monto</td>
                                            <td>Desc</td>
                                            <td>Neto</td>
                                        </tr>

                        <?php
                            include_once($_SERVER['DOCUMENT_ROOT'] . '/litt/controller/basic.php');
                            include_once($_SERVER['DOCUMENT_ROOT'] . '/litt/model/database.php');
                            
                            $arr = R::find('credito_instancia','rendido = 0 AND liquidado_litt = 1 AND id_comercio = ?',array($_SESSION["id_comercio"]));
                            $total_acobrar = 0;
                            foreach($arr as $a){
                                $total_acobrar += $a["monto"] - (($a["monto"] /100) * $comision);
                        ?>

					<tr>
                                            <td><?php echo fecha($a["fecha_creacion"]); ?></td>
                                            <td><?php echo $a["id"]; ?></td>
                                            <td> $ <?php echo $a["monto"]; ?></td>
                                            <td><?php echo ROUND(($a["monto"] /100) * $comision); ?></td>
                                            <td> $ <?php echo ROUND($a["monto"] - (($a["monto"] /100) * $comision)) ; // es monto - el descuento en el plan ?></td>
                                        </tr>
                        <?php
                            }
                        ?>
					<!-- <tr><td>20/12/16</td><td>1047</td><td>$<span>560</span></td><td>$<span>-28</span></td> <td>$<span>532</span></td></tr>
					<tr><td>22/12/16</td><td>1048</td><td>$<span>430</span></td><td>$<span>-21</span></td><td>$<span>408.5</span></td></tr>-->
					</table>
                </div>
                                    <div><h3 align="center" style="color:#3b86ca;font-weight:600">Total $
                                            <span>
                                                <?php echo $total_acobrar; ?>
                                            </span></h3></div>


				<span> <h3 align="center">Cuotas Cobradas a Rendir</h3></span> 
                <div style="overflow-x: scroll">
				<table class="table" style="width: 100%">
					<tr style="font-weight: 600; background:#ccc;">
                                            <td>Fecha</td>
                                            <td>Nro Op</td>
                                            <td>Cuota</td>
                                            <td>Monto</td>
                                        </tr>

                                        <?php
                                            // cuotas ya abonadas que hay que pagar a LiTT no?
                                            $arr = R::find('cuotas','abonado = 1 AND rendida = 0 AND id_comercio = ?',array($_SESSION["id_comercio"]));
                                            $total_apagar = 0;
                                            foreach($arr as $a){
                                                $total_apagar += $a["cuota_original"] + $a["punitorios"];
                                        ?>
                                        
					<tr>
                                            <td><?php echo fecha($a["fecha_depago"]); ?></td>
                                            <td><?php echo $a["id_credito"]; // id de credito ?></td>
                                            <td><?php echo $a["n_cuota"]; ?></td>
                                            <td><?php echo ROUND($a["cuota_original"] + $a["punitorios"]); ?></td>
                                        </tr>
                                        
                                        <?php
                                            }
                                        ?>
					<!--<tr><td>19/12/16</td><td>1029</td><td>3</td><td>$<span>262.67</span></td></tr>
					<tr><td>20/12/16</td><td>1034</td><td>2</td><td>$<span>266.18</span></td></tr>
					<tr><td>20/12/16</td><td>1035</td><td>2</td><td>$<span>162.64</span></td></tr>
					<tr><td>22/12/16</td><td>1042</td><td>1</td><td>$<span>505.34</span></td></tr>-->
				</table>
            </div>
					<div><h3 align="center" style="color:#3b86ca;font-weight:600">Total $
                                                <span>
                                                    <?php echo ROUND($total_apagar); ?>
                                                </span></h3></div>

					<span>
                                                <span>
                                                    <?php
                                                        //$arr = R::find('cuotas','abonado LIKE 0');
                                                        if($total_acobrar > $total_apagar){
                                                            ?>
                                                            <h3 align="center" style="color:green;font-weight:600">
                                                            <?php echo "A COBRAR $ " . ROUND($total_acobrar - $total_apagar);
                                                        }
                                                        else {
                                                            ?>
                                                            <h3 align="center" style="color:blue;font-weight:600">
                                                            <?php echo "A PAGAR $ " . ROUND($total_apagar - $total_acobrar);
                                                        }
                                                    ?>
                                                </span></h3></span>

				<div class="bottom-btns">
					<a href="/litt/ui/comercio/rendiciones.php" style="color: #FFFFFF;"><button class="btn btn-success btn-lg">RENDICIONES</button></a>
							<!-- <button class="btn btn-primary btn-lg">Historial</button> -->
				</div>

</div>
</div>

</body>
</html>
