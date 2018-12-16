<?php
include('./header.php');

// traigo todos los estados de estado_mora y ordeno los creditos con cada uno
$estado_mora = R::findAll("estado_mora");
$total_credito = R::count("credito_instancia");
$arr_informe = array();
$total_capital_original = 0;
$total_monto_pago = 0;
$total_monto_vencido = 0;
$total_monto_no_vencido = 0;
foreach($estado_mora as $e){
    $sub = array();
    $cred = R::findAll("credito_instancia","estado_mora LIKE ?",[$e["id"]]);
    $casos = R::count("credito_instancia","estado_mora LIKE ?",[$e["id"]]);
    $capital_original = 0;
    $monto_pago = 0;
    $monto_vencido = 0;
    $monto_no_vencido = 0;
    foreach($cred as $c){
        $capital_original += $c["monto"];
        $total_capital_original += $c["monto"];
        // de cada uno traigo sus cuotas
        $cuo = R::findAll("cuotas","id_credito LIKE ?",[$c["id"]]);
        $hoy = date("Ymd");
        foreach($cuo as $x){
            $m = 0;
            $m += $x["cuota_original"] + $c["punitorios"];
            if($x["vencimiento"] < $hoy) { $monto_vencido += $m; $total_monto_vencido += $m; }
            else { $monto_no_vencido += $m; $total_monto_no_vencido += $m; }
            // si lo pago, ya esta abonado
            if($x["abonado"]) { $monto_pago += $m; $total_monto_pago += $m; }
        }
        // QUE ES MONTO PAGO? LO QUE PAGO LITT O LO QUE YA PAGARON LOS CLIENTES
    }
    $sub["modulo"] = $e["designacion"];
    $sub["casos"] = $casos;
    $sub["porcentaje"] = ($casos / $total_credito) * 100;
    $sub["capital_original"] = $capital_original;
    $sub["monto_pago"] = $monto_pago;
    $sub["monto_vencido"] = $monto_vencido;
    $sub["monto_no_vencido"] = $monto_no_vencido;
    $arr_informe[] = $sub;
}

?>
<style type="text/css" media="screen">
    td, th {
        text-align: center !important;
        vertical-align: middle !important;
    }
</style>
<div class="container"> 
    <div class="panel-a col-md-8 col-md-offset-2 col-sm-12 col-sm-offset-0 col-xs-10 col-xs-offset-1">

        <div class="row panel-title">
            <div class="col-sm-3 "></div>
            <div class="col-sm-6" style="border-bottom: 2px solid #769FCD;margin-bottom:20px"><h2 align="center">Informe de Mora</h2></div>
            <div class="col-sm-3"></div>
        </div>

        <!-- <div class="col-sm-5">

            <div class="col-sm-6">
                <div class="margin-n10">
                    <input class="form-control" type="text" name=""  placeholder="Código Comercio">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="margin-n10">
                    <input class="form-control" type="text" name=""  placeholder="Nombre Comercio">
                </div>
            </div>
        </div>
        <div class="col-sm-7">
            <div class="col-sm-4">
                <div class="margin-n10">
                    <select class="form-control">
                        <option disabled selected hidden>Categoría/s</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="margin-n10">
                    <select class="form-control">
                        <option disabled selected hidden>Estado</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="margin-n10">
                    <select class="form-control">
                        <option disabled selected hidden>Localidad</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="t-centered margin-v10">
                <button class="btn btn-primary btn-md" style="font-size:18px; padding: 5px 35px"> Buscar </button>
            </div>
        </div> -->
        <div class="" style="overflow-x: auto;">
            <table class="table" style="width: 100%">
                <tr style="font-weight: 600; background:#ccc;">
                    <td>Modulo</td><td>Casos</td>
                    <td>%</td>
                    <td>Capital Orig</td>
                    <td>Monto Pago</td>
                    <td>Monto Vencido</td>
                    <td>Monto No Vencido</td>
                </tr> 
                <?php
                $A_datos = Array();
                foreach($arr_informe as $f){
                    $A_datos[] = $f["modulo"]."/".$f["casos"]."/".$f["porcentaje"]."/".$f["capital_original"]."/".$f["monto_pago"]."/".$f["monto_vencido"]."/".$f["monto_no_vencido"];
                ?>
                <tr>
                    <td><?php echo $f["modulo"]; ?> </td>
                    <td><?php echo $f["casos"]; ?> </td>
                    <td><?php echo number_format ($f["porcentaje"],2,",","."); ?> </td>
                    <td><?php echo round($f["capital_original"]); ?> </td>
                    <td><?php echo round($f["monto_pago"]); ?> </td>
                    <td><?php echo round($f["monto_vencido"]); ?> </td>
                    <td><?php echo round($f["monto_no_vencido"]); ?> </td>
                </tr>
                <?php } ?>
                <!-- <tr>
                    <td>Cancelado</td>
                    <td>27</td>
                    <td>49%</td>
                    <td>$21.925</td>
                    <td>$26.676</td>
                    <td>$-</td>
                    <td>$-</td>
                </tr>
                <tr>
                    <td>Normal</td>
                    <td>19</td>
                    <td>35%</td>
                    <td>$16.620</td>
                    <td>$7.609</td>
                    <td>$-</td>
                    <td>$13.118</td>
                </tr>
                <tr>
                    <td>Pre Mora</td>
                    <td>6</td>
                    <td>11%</td>
                    <td>$6.585</td>
                    <td>$3.677</td>
                    <td>$2.087</td>
                    <td>$2.693</td>
                </tr>
                <tr>
                    <td>Mora</td>
                    <td>1</td>
                    <td>2%</td>
                    <td>$690</td>
                    <td>$647</td>
                    <td>$329</td>
                    <td>$-</td>
                </tr>
                <tr>
                    <td>Extrajudicial</td>
                    <td>1</td>
                    <td>2%</td>
                    <td>$540</td>
                    <td>$-</td>
                    <td>$800</td>
                    <td>$-</td>
                </tr>
                <tr>
                    <td>Incobrable</td>
                    <td>1</td>
                    <td>2%</td>
                    <td>$830</td>
                    <td>$769</td>
                    <td>$347</td>
                    <td>$-</td>
                </tr> -->
                <tr style="font-weight: 600; background:#ccc;">
                    <td>Total</td>
                    <td><?php echo $total_credito; ?></td>
                    <td><?php echo "100%"; // obviamente ?></td>
                    <td><?php echo round($total_capital_original); ?></td>
                    <td><?php echo round($total_monto_pago); ?></td>
                    <td><?php echo round($total_monto_vencido); ?></td>
                    <td><?php echo round($total_monto_no_vencido); ?></td>
                </tr>  
            </table>
        </div>

        <div class="t-centered">
            <button class="btn btn-success btn-lg" onclick="imprimir();"><img src="img/xls-w.png" width="50px"><br>Exportar</button>
        </div><br>
        <div class="t-centered">
            <a onclick="javascript:preguntarSalida();">
                <button class="btn btn-primary btn-lg">Salir</button>
            </a>
        </div>

    </div>
</div>
<script>
    function imprimir() {
        var datos = <?php echo json_encode($A_datos); ?>;
        var page = "ajax/informe_mora.php?datos="+(serialize(datos));
        descargar(page);
    }
    function descargar(url) {
        window.onfocus = finalizada;
        document.location = url;
    }

    function finalizada() {
        window.onfocus = vacia;
        // Modificar a partir de aquí
    }
    function vacia(){}
    function serialize(arr) {
        var res = 'a:'+arr.length+':{';
        for(i=0; i<arr.length; i++)
        {
        res += 'i:'+i+';s:'+arr[i].length+':"'+arr[i]+'";';
        }
        res += '}';
         
        return res;
    }
    </script>
</body>
</html>
