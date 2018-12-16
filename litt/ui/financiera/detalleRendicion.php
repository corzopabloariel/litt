<?php
include('./header.php');

if(!isset($_GET['id']))
    exit();

$id = $_GET['id'];

// obtengo la informacion de la rendicion
$r = R::findOne("rendiciones","id LIKE ?",[$id]);
$com = R::findOne("comercios","id LIKE ?",[$r["id_comercio"]]);

$creditos = R::findAll("credito_instancia","id_rendicion = ? AND id_comercio = ?",[$id,$r["id_comercio"]]);
$cuotas = R::findAll("cuotas","id_rendicion = ?",[$id]);

$comision = R::findOne("convenios","id LIKE ?",[$com["convenio"]])["comision"];

?>
<div class="container"> 
    <div class="panel-a col-md-8 col-md-offset-2 col-sm-12 col-sm-offset-0 col-xs-10 col-xs-offset-1">
        <div class="row panel-title">
            <div class="col-sm-3 "></div>
            <div class="col-sm-6" style="border-bottom: 2px solid #769FCD;margin-bottom:20px">
                <h2 align="center">
                    Detalle de la rendicion del comercio <?php echo $com["razon_social"] ; ?>
                </h2>
            </div>
            <div class="col-sm-3"></div>
        </div>
        <div class="row"><h4 align="center">Rendición # <span><?php echo $id; ?></span></h4></div>
        <span><h3 align="center">Créditos a Cobrar</h3></span>

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
            foreach($creditos as $c){
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
        <div><h3 align="center" style="color:#3b86ca;font-weight:600">Total $<span><?php echo ROUND($r["monto_credito"]); ?></span></h3></div>


        <span> <h3 align="center">Cuotas A Pagar</h3></span> 
        <div style="overflow-x: auto">
        <table class="table" style="width: 100%">
            <tr style="font-weight: 600; background:#ccc;" class="cuota">
                <td>Fecha de cobro</td>
                <td>Nro Op</td>
                <td>Cuota</td>
                <td>Monto</td>
            </tr>
            <?php
            foreach($cuotas as $c){
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
        <div><h3 align="center" style="color:#3b86ca;font-weight:600">Total $<span><?php echo ROUND($r["monto_cuota"]); ?></span></h3></div>

        <span>
                <?php
                if($r["monto_cuota"] > $r["monto_credito"])
                    echo "<h3 align='center' style='color:green;font-weight:600'>A COBRAR";
                else
                    echo "<h3 align='center' style='color:red;font-weight:600'>A PAGAR";
                ?> $<span>
                <?php
                if($r["monto_cuota"] > $r["monto_credito"])
                    echo ROUND($r["monto_cuota"] - $r["monto_credito"]);
                else
                    echo ROUND($r["monto_credito"] - $r["monto_cuota"]);
                ?>
                </span></h3></span>

        <br>
        <span>
            <h2 align="center" style="color:black;font-weight:600">
                Fecha de Calculo: 
                <script type="text/javascript">
                    document.write(retFormatDMYBar('<?php echo $r["fecha_limite_rendicion"]; ?>'));
                </script>
            </h2>
        </span>
        <br>
        <div class="bottom-btns">
            <a class="btn btn-primary btn-lg" href='/litt/ui/financiera/rendiciones.php'>Volver</a>
            <button class="btn btn-primary btn-lg print-btn" onclick="javascript:window.print();">Imprimir</button>
        </div>

    </div>
</div>

<script type="text/javascript">
    // para que pregunte si quiere salir realmente
    // window.litt_consultar_abandonar = true;
</script>

</body>
</html>
