<?php
$ARR_CSS[] = "/litt/ui/financiera/css/select2.min.css";
$ARR_JS = array();
$ARR_JS[] = "/litt/ui/financiera/js/select2.js";
include('./header.php');

error_reporting(E_ALL);
ini_set('display_errors', '1');
// para categorizar cada comercio 

// traigo todos los comercios
?>
<style type="text/css">
    .select2-container--default .select2-selection--single {
        padding: 5px 8px !important;
        height: auto !important;
        border: 2px solid #41719c;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        top: 8px !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered,
    input[type="text"],textarea, select {
        text-transform: uppercase;
    }
    .row {
        margin:0;
    }
</style>
<div class="container"> 
    <div class="panel-a col-md-8 col-md-offset-2 col-sm-12 col-sm-offset-0 col-xs-10 col-xs-offset-1">

        <div class="row panel-title">
            <div class="col-sm-6 col-sm-offset-3" style="border-bottom: 2px solid #769FCD;margin-bottom:20px"><h2 align="center">Informe de Comercios</h2></div>
        </div>
        <form method="post">
        <div class="row">
            <div class="col-sm-6">
                <?php
                $comercios = R::findAll("comercios");
                ?>
                <select class="form-control" name="comercio" style="width: 100%">
                    <option></option>
                    <?php 
                    foreach ($comercios as $c) {
                        if(isset($_POST["comercio"]))
                            echo "<option " . ($_POST["comercio"] == $c["id"] ? 'selected' : '') . " value='{$c["id"]}'>({$c["id"]}) {$c["nombre"]}</option>";
                        else
                            echo "<option value='{$c["id"]}'>({$c["id"]}) {$c["nombre"]}</option>";
                    }
                    ?>
                </select>
                <script>
                    $('select[name="comercio"]').select2({
                        width: 'resolve',
                        placeholder: 'Ingrese Nro o Nombre de Comercio',
                        allowClear: true,
                    });
                </script>
            </div>
            <div class="col-sm-6">
                <?php 
                $localidades = R::findAll("localidades");
                ?>
                <select class="form-control" name="localidad" style="width: 100%">
                    <option></option>
                    <?php 
                    foreach ($localidades as $l) {
                        if(isset($_POST["localidad"]))
                            echo "<option " . ($_POST["localidad"] == $l["id"] ? 'selected' : '') . " value='{$l["id"]}'>{$l["nombre"]}</option>";
                        else
                            echo "<option value='{$l["id"]}'>{$l["nombre"]}</option>";
                    }
                    ?>
                </select>
                <script>
                    $('select[name="localidad"]').select2({
                        width: 'resolve',
                        placeholder: 'Localidad',
                        allowClear: true,
                    });
                </script>
            </div>
        </div>
        <?php 
$com = R::findAll("comercios");
$total_com = R::count("comercios");
// tengo que obtener cada uno de las categorias de comercios, sobre su total de 
// creditos, ver el poorcentaje de incobrables (computacionalmente muy pesado y
// estrambolico) SOLUCIONADO CON EL CRON JOB, Cada comercio tiene cateoria


$categorias = R::findAll("categoria_comercio");
$arr_informe = array();
foreach($categorias as $cat){
    $sub = array();
    $beans = R::getAll("SELECT * FROM comercios WHERE id_categoria = ? " . ((isset($_POST["localidad"]) && !empty($_POST["localidad"])) ? " AND domicilio_comercio_localidad = " .$_POST["localidad"] : "")." " . ((isset($_POST["comercio"]) && !empty($_POST["comercio"])) ? "AND id = ".$_POST["comercio"] : ""),Array($cat["id"]) );
    
    $cantidad_comercios = count($beans);
    $cantidad_creditos = 0;
    $monto_invertido = 0;
    $monto_adeudado = 0;
    $montos_cobrados = 0; 
    $montos_acobrar = 0; 
    foreach($beans as $e){
        // traigo cada credito de este comercio
        $cantidad_creditos += R::count("credito_instancia","id_comercio LIKE ?",[$e["id"]]);
        $creditos = R::findAll("credito_instancia","id_comercio LIKE ?",[$e["id"]]);
        foreach($creditos as $c){
            if($c["rendida"] == 1) $monto_invertido += $c["monto"];
            elseif($c["liquidado_litt"] == 1) $monto_adeudado += $c["monto"];
            // de cada credito obtego las cuotas que fueron abonadas
            $cuotas = R::findAll("cuotas","id_credito LIKE ?",[$c["id"]]);
            foreach($cuotas as $cuo){
                if($cuo["abonado"] == 1) $montos_cobrados += $cuo["cuota_original"] + $cuo["punitorios"];
                else $montos_acobrar += $cuo["cuota_original"] + $cuo["punitorios"];
            }
        }
    }
    $sub["info"] = $cat["descripcion"];
    $sub["categoria"] = $cat["designacion"];
    $sub["cantidad_comercios"] = $cantidad_comercios;
    $sub["cantidad_creditos"] = $cantidad_creditos;
    $sub["monto_invertido"] = $monto_invertido;
    $sub["monto_cobrado"] = $montos_cobrados;
    $sub["monto_adeudado"] = $monto_adeudado;
    $sub["monto_acobrar"] = $montos_acobrar;
    $arr_informe[] = $sub;
}

        ?>
        <!--
        <div class="col-sm-5">
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
            <div class="col-sm-6">
                <div class="margin-n10">
                    <select class="form-control">
                        <option disabled selected hidden>Estado</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="margin-n10">
                    <select class="form-control">
                        <option disabled selected hidden>Localidad</option>
                    </select>
                </div>
            </div>
        </div>-->
        <div class="row">
            <div class="col-xs-12">
                <div class="t-centered margin-v10">
                    <button class="btn btn-primary btn-md" style="font-size:18px; padding: 5px 35px">Consultar</button>
                </div>
            </div>
        </div>
    </form>
        <div class="row">
            <div class="col-xs-12" style="overflow-x: auto; padding:0">
                <table class="table" style="width: 100%">
                    <tr style="font-weight: 600; background:#ccc;">
                        <td>Categoria</td><td>Cantidad Comercios</td>
                        <td>Creditos</td>
                        <td>Monto Invertido</td>
                        <td>Montos Cobrados</td>
                        <td>Montos Adeudados</td>
                        <td> Monto a Cobrar</td>
                    </tr>
                    <?php
                    $Atotales = Array();
                    $Atotales["cantidad_comercios"] = 0;
                    $Atotales["cantidad_creditos"] = 0;
                    $Atotales["monto_invertido"] = 0;
                    $Atotales["monto_cobrado"] = 0;
                    $Atotales["monto_adeudado"] = 0;
                    $Atotales["monto_acobrar"] = 0;
                    $A_datos = Array();
                    foreach($arr_informe as $f){
                        $A_datos[] = $f["categoria"]."/".$f["cantidad_comercios"]."/".$f["cantidad_creditos"]."/".$f["monto_invertido"]."/".$f["monto_cobrado"]."/".$f["monto_adeudado"]."/".$f["monto_acobrar"];
                    ?>
                    <tr>
                        <td><?php echo $f["categoria"]; ?> <img src='img/signquestion.png' width="20" title="<?php echo $f["info"]; ?>"></td>
                        <td><?php echo $f["cantidad_comercios"]; $Atotales["cantidad_comercios"] += $f["cantidad_comercios"]; ?> </td>
                        <td><?php echo $f["cantidad_creditos"]; $Atotales["cantidad_creditos"] += $f["cantidad_creditos"]; ?> </td>
                        <td><?php echo round($f["monto_invertido"]); $Atotales["monto_invertido"] += round($f["monto_invertido"]); ?> </td>
                        <td><?php echo round($f["monto_cobrado"]); $Atotales["monto_cobrado"] += round($f["monto_cobrado"]); ?> </td>
                        <td><?php echo round($f["monto_adeudado"]); $Atotales["monto_adeudado"] += round($f["monto_adeudado"]); ?> </td>
                        <td><?php echo round($f["monto_acobrar"]); $Atotales["monto_acobrar"] += round($f["monto_acobrar"]); ?> </td>
                    </tr>
                    <?php } ?>
                    <!-- <tr>
                        <td>Excelentes</td><td>uno </td>
                    </tr>
                    <tr>
                        <td>Buenos</td>
                    </tr>
                    <tr>
                        <td>Normales</td>
                    </tr>
                    <tr>
                        <td>Malos</td>
                    </tr>
                    <tr>
                        <td>Muy Malos</td>
                    </tr>
                    <tr style="color:#ff0000;">
                        <td>Alerta Fraude</td>
                    </tr> -->
                    <tr>
                        <td><h4 style="font-weight: 600;">TOTAL</h4></td>
                        <td><h4 style="font-weight: 600;"><?php echo $Atotales["cantidad_comercios"]; ?></h4></td>
                        <td><h4 style="font-weight: 600;"><?php echo $Atotales["cantidad_creditos"]; ?></h4></td>
                        <td><h4 style="font-weight: 600;"><?php echo $Atotales["monto_invertido"]; ?></h4></td>
                        <td><h4 style="font-weight: 600;"><?php echo $Atotales["monto_cobrado"]; ?></h4></td>
                        <td><h4 style="font-weight: 600;"><?php echo $Atotales["monto_adeudado"]; ?></h4></td>
                        <td><h4 style="font-weight: 600;"><?php echo $Atotales["monto_acobrar"]; ?></h4></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="bottom-btns text-center">
            <a href="rankingComercios.php" class="btn btn-success btn-lg">Ranking<br>Comercios</a>
            <a href="rankingLocalidades.php" class="btn btn-success btn-lg">Ranking<br>Localidades</a>
            <a class="btn btn-success btn-lg" onclick="imprimir()"><img src="img/xls-w.png" width="21px"><br>Exportar</a>
        </div>
        <div class="text-center col-espacio-t">
            <a href="/litt/ui/financiera/menuPalLitt.php" class="btn btn-primary btn-lg">Salir</a>
        </div>


    </div>
</div>

<script type="text/javascript">
    
    function imprimir() {
        var datos = <?php echo json_encode($A_datos); ?>;
        var totales = <?php echo json_encode($Atotales); ?>;
        var page = "ajax/informe_comercio.php?datos="+(serialize(datos))+"&totales="+(serialize(totales));
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
