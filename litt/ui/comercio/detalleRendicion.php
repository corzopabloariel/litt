<?php
include('./header.php');

if(!isset($_GET['id']))
    exit();

$id = $_GET['id'];

// obtengo la informacion de la rendicion
$r = R::findOne("rendiciones","id LIKE ?",[$id]);
$com = R::findOne("comercios","id LIKE ?",[$r["id_comercio"]]);

$creditos = R::findAll("credito_instancia","id_rendicion = ? AND id_comercio = ?",[$id,$r["id_comercio"]]);
$cuotas = R::findAll("cuotas","id_rendicion = ? AND id_comercio = ?",[$id,$r["id_comercio"]]);
$comision = R::findOne("convenios","id LIKE ?",[$com["convenio"]])["comision"];

?>
<div class="container"> 
    <div class="panel-a col-md-8 col-md-offset-2 col-sm-12 col-sm-offset-0 col-xs-10 col-xs-offset-1">
        <div class="row"><h4 align="center">Rendición # <span><?php echo $id; ?></span></h4></div>
        <span><h3 align="center">Créditos Cobrados</h3></span>
        <div style="overflow-x: auto">
        <table class="table" style="width: 100%">
            <tr style="font-weight: 600; background:#ccc;">
                <td>Fecha creacion</td>
                <td>Fecha liquidacion</td>
                <td>Nro Op</td>
                <td>Monto</td>
                <td>Desc</td>
                <td>Neto</td>
            </tr>
            <?php
            $total_acobrar = 0;
            foreach($creditos as $c){
                $total_acobrar += $c["monto"] - (($c["monto"] /100) * $comision);
                ?>
                <tr>
                    <td>
                        <script type="text/javascript">
                            document.write(retFormatDMYBar('<?php echo $c["fecha_creacion"]; ?>'));
                        </script></td>
                    <td>
                        <script type="text/javascript">
                            document.write(retFormatDMYBar('<?php echo $c["fecha_liquidacion"]; ?>'));
                        </script></td>
                    <td><?php echo $c["id"]; ?></td>
                    <td><?php echo $c["monto"]; ?></td>
                    <td><?php echo ROUND(($c["monto"] /100) * $comision); ?></td>
                    <td><?php echo ROUND($c["monto"] - (($c["monto"] /100) * $comision)); ?></td>
                </tr>
            <?php
            }
            ?>

            <!-- <tr><td>19/12/16</td><td>1046</td><td>$<span>1560</span></td><td>$<span>-78</span></td> <td>$<span>1428</span></td></tr>
            <tr><td>20/12/16</td><td>1047</td><td>$<span>560</span></td><td>$<span>-28</span></td> <td>$<span>532</span></td></tr>
            <tr><td>22/12/16</td><td>1048</td><td>$<span>430</span></td><td>$<span>-21</span></td><td>$<span>408.5</span></td></tr> -->
        </table>
    </div>
        <div><h3 align="center" style="color:#3b86ca;font-weight:600">Total $
                                            <span>
                                                <?php echo $total_acobrar; ?>
                                            </span></h3></div>


        <span> <h3 align="center">Cuotas Rendidas</h3></span> 
        <div style="overflow-x: auto;">
        <table class="table" style="width: 100%">
            <tr style="font-weight: 600; background:#ccc;" class="cuota">
                <td>Fecha de cobro</td>
                <td>Nro Op</td>
                <td>Cuota</td>
                <td>Monto</td>
            </tr>
            <?php
            $total_apagar = 0;
            foreach($cuotas as $c){
                $total_apagar += $c["cuota_original"] + $c["punitorios"];
                ?>
                <tr>
                    <td>
                        <script type="text/javascript">
                            document.write(retFormatDMYBar('<?php echo $c["fecha_depago"]; ?>'));
                        </script></td>
                    <td><?php echo $c["id"]; ?></td>
                    <td><?php echo ROUND($c["n_cuota"]); ?></td>
                    <td>$<span><?php echo ROUND($c["cuota_original"] + $c["punitorios"]); ?></span></td>
                </tr>
            <?php
            }
            ?>
            <!-- <tr><td>19/12/16</td><td>1021</td><td>3</td><td>$<span>220.52</span></td></tr>
            <tr><td>19/12/16</td><td>1029</td><td>3</td><td>$<span>262.67</span></td></tr>
            <tr><td>20/12/16</td><td>1034</td><td>2</td><td>$<span>266.18</span></td></tr>
            <tr><td>20/12/16</td><td>1035</td><td>2</td><td>$<span>162.64</span></td></tr>
            <tr><td>22/12/16</td><td>1042</td><td>1</td><td>$<span>505.34</span></td></tr> -->
        </table>
    </div>
        <div><h3 align="center" style="color:#3b86ca;font-weight:600">Total $
                                                <span>
                                                    <?php echo ROUND($total_apagar); ?>
                                                </span></h3></div>

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

        <br>
        <div class="bottom-btns text-center">
            <a class="btn btn-default btn-lg" href='<?php echo config::$ui_historial; ?>'>HISTORIAL</a>
        </div>

    </div>
</div>

<script type="text/javascript">
    // para que pregunte si quiere salir realmente
    // window.litt_consultar_abandonar = true;
</script>

</body>
</html>
