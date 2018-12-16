<?php
$ARR_CSS = array();
$ARR_CSS[] = "/litt/ui/financiera/css/select2.min.css";
$ARR_CSS[] = "/litt/ui/financiera/css/dataTables.jqueryui.css";
$ARR_JS = array();
$ARR_JS[] = "/litt/ui/financiera/js/select2.js";
$ARR_JS[] = "/litt/ui/financiera/js/jquery.dataTables.min.js";
include('./header.php');

// obtengo todos los comercios, los meto en un array, pero los ordeno y muestro
// segun lo que deberia ordenarlo
$comercios = R::findAll("comercios");
$com = array();
$i = 0;
foreach($comercios as $c){
    $com[$i]["nro_comercio"] = $c["id"];
    $com[$i]["nombre"] = $c["nombre"];
    $l = R::findOne("localidades","id LIKE ?",array($c["domicilio_comercio_localidad"]));
    $com[$i]["localidad"] = $l["nombre"];
    $p = R::findOne("provincias","id LIKE ?",array($c["domicilio_comercio_provincia"]));
    $com[$i]["provincia"] = $p["nombre"];
    $com[$i]["categoria"] = $c["id_categoria"];
    $com[$i]["estado"] = $c["estado"];
    // obtencion de todos los creditos y cuotas
    $cred = R::findAll("credito_instancia","id_comercio LIKE ?",[$c["id"]]);
    $com[$i]["creditos_totales"] = count($cred);
    $inicio_anio = date("Y") . "0101"; // 1 de enero del presente año
    $cred_current_anio = R::findAll("credito_instancia","id_comercio LIKE ? and fecha_creacion > ?",[$c["id"],$inicio_anio]);
    $cant_meses = diffISO8601($inicio_anio, date("Ymd"),"meses");
    // ahora divido la cantidad de creditos por el año
    $promedio_creditos = count($cred_current_anio) / $cant_meses;
    $com[$i]["promedio_mes"] = $promedio_creditos;
    $monto_invertido = 0;
    $monto_cobrado = 0;
    $monto_adeudado = 0;
    $monto_acobrar = 0;
    foreach($cred as $cr){
        if($cr["rendida"]) $monto_invertido += $cr["monto"]; // ya rendido
        else $monto_adeudado += $cr["monto"]; // no rendido, a cobrar
        $cuotas = R::findAll("cuotas","id_credito LIKE ?",[$cr["id"]]);
        foreach($cuotas as $cuo){
            $monto_tmp = $cuo["cuota_original"] + $cuo["punitorios"] + $cuo["compensatorios"] + $cuo["multa"];
            if($cuo["abonado"]) $monto_cobrado += $monto_tmp;
            else $monto_acobrar = $monto_tmp;
        }
    }
    $com[$i]["monto_invertido"] = $monto_invertido;
    $com[$i]["monto_cobrado"] = $monto_cobrado;
    $com[$i]["monto_adeudado"] = $monto_adeudado;
    $com[$i]["monto_acobrar"] = $monto_acobrar;
    ++$i;
}

// ordena de acuerdo al valor enviado
if(isset($_GET["sort_by"]) && isset($_GET["asc"])){
    $GLOBALS["asc"] = $_GET["asc"];
    $GLOBALS["sort_by"] = $_GET["sort_by"];
    usort($com,function ($a,$b){
        if($GLOBALS["asc"])
            return $a[$GLOBALS["sort_by"]] < $b[$GLOBALS["sort_by"]];
        else
            return $a[$GLOBALS["sort_by"]] > $b[$GLOBALS["sort_by"]];
    });
}

function inversedASC(){
    if(isset($_GET["asc"])){
        if($_GET["asc"])
            return 0;
        else
            return 1; 
    } else return 1;
}

?>
<style>
    td {
        vertical-align: middle !important;
    }
</style>
<div class="container"> 
	<div class="panel-a col-md-8 col-md-offset-2 col-sm-12 col-sm-offset-0 col-xs-10 col-xs-offset-1">
		<div class="row panel-title">
			<div class="col-sm-3 "></div>
			<div class="col-sm-6" style="border-bottom: 2px solid #769FCD;margin-bottom:20px"><h2 align="center">Ranking Comercios</h2></div>
			<div class="col-sm-3"></div>
		</div>
        <div class="row">
		<div class="col-sm-12" style="">
			<table class="table table-striped table-hover nowrap" style="width:100%;" id="tabla">
                <thead>
    				<tr style="font-weight: 600; background:#ccc;">
    					<th>Nro Comercio</th>
    					<th>Nombre</th>
    					<th>Localidad</th>
    					<th>Provincia</th>
    					<th>Categoria</th>
    					<th>Estado</th>
                        <th>Creditos totales</th>
                        <th>Promedios Mes</th>
                        <th>onto Invertido</th>
                        <th>Montos Cobrados</th>
                        <th>Montos Adeudados</th>
                        <th>Montos A Cobrar</th>
                        <!--<th><a href="?sort_by=creditos_totales&asc=<?php echo inversedASC(); ?>">Creditos totales</a></th>
    					<th><a href="?sort_by=promedio_mes&asc=<?php echo inversedASC(); ?>">Promedios Mes</th>
    					<th><a href="?sort_by=monto_invertido&asc=<?php echo inversedASC(); ?>">Monto Invertido</th>
    					<th><a href="?sort_by=monto_cobrado&asc=<?php echo inversedASC(); ?>">Montos Cobrados</th>
    					<th><a href="?sort_by=monto_adeudado&asc=<?php echo inversedASC(); ?>">Montos Adeudados</th>
                        <th><a href="?sort_by=monto_acobrar&asc=<?php echo inversedASC(); ?>">Montos A Cobrar</th>-->
    				</tr>
                </thead>
                                <?php
                                foreach($com as $c){
                                ?>
                                <tr>
                                    <td><?php echo $c["nro_comercio"]; ?></td>
                                    <td><?php echo $c["nombre"]; ?></td>
                                    <td><?php echo $c["localidad"]; ?></td>
                                    <td><?php echo $c["provincia"]; ?></td>
                                    <td><?php echo $c["categoria"]; ?></td>
                                    <td><?php echo $c["estado"]; ?></td>
                                    <td><?php echo $c["creditos_totales"]; ?></td>
                                    <td><?php echo round($c["promedio_mes"]); ?></td>
                                    <td><?php echo round($c["monto_invertido"]); ?></td>
                                    <td><?php echo round($c["monto_cobrado"]); ?></td>
                                    <td><?php echo round($c["monto_adeudado"]); ?></td>
                                    <td><?php echo round($c["monto_acobrar"]); ?></td>
                                </tr>
                                <?php 
                                }
                                ?>
		 </table>
		</div>
		<div class="bottom-btns text-center">
			<a class="btn btn-success btn-lg" disabled>Ranking<br>Comercios</a>
			<a href="rankingLocalidades.php" class="btn btn-success btn-lg">Ranking<br>Localidades</a>
			<!-- <button class="btn btn-success btn-lg"><img src="img/xls-w.png" width="21px"><br>Exportar</button> -->
		</div>
		<div class="t-centered">
			<a href="/litt/ui/financiera/informesComercio.php" class="btn btn-primary btn-lg">Salir</a>
		</div>
    </a>
	</div>
</div>
		
<script>
    
    $(document).ready( function () {
        $('#tabla').DataTable({
            "searching": false,
            "scrollX": true,
            "ordering": true,
            "aoColumnDefs": [
                { "bSortable": false, "aTargets": [ 0 ] }
                ], 
            "language":{
                "lengthMenu": "_MENU_ registros por página",
                "info": "Página _PAGE_ de _PAGES_ - _MAX_ registros",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtrada de _MAX_ registros)",
                "loadingRecords": "Cargando...",
                "processing":     "Procesando...",
                "search": "Buscar:",
                "zeroRecords":    "No se encontraron comercios",
                "paginate": {
                    "next":       "Siguiente",
                    "previous":   "Anterior"
                },                  
            }
        });
    } );
</script>
</body>
</html>
