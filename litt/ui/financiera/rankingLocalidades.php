<?php
$ARR_CSS = array();
$ARR_CSS[] = "/litt/ui/financiera/css/dataTables.jqueryui.css";
$ARR_CSS[] = "/litt/ui/financiera/css/autoFill.jqueryui.css";
$ARR_CSS[] = "/litt/ui/financiera/css/buttons.dataTables.min.css";
$ARR_JS = array();
$ARR_JS[] = "/litt/ui/financiera/js/jquery.dataTables.min.js";
$ARR_JS[] = "/litt/ui/financiera/js/dataTables.autoFill.min.js";
$ARR_JS[] = "/litt/ui/financiera/js/dataTables.buttons.min.js";
$ARR_JS[] = "/litt/ui/financiera/js/buttons.flash.min.js";
$ARR_JS[] = "/litt/ui/financiera/js/jszip.min.js";
$ARR_JS[] = "/litt/ui/financiera/js/pdfmake.min.js";
$ARR_JS[] = "/litt/ui/financiera/js/vfs_fonts.js";
$ARR_JS[] = "/litt/ui/financiera/js/buttons.html5.min.js";
$ARR_JS[] = "/litt/ui/financiera/js/buttons.print.min.js";
include('./header.php');
// tengo que traer todos los creditos, y dependiendo de la localidad del comercio, lo agrego a un id

$localidades = Array();
$comercios_adheridos = Array();
$monto_invertido = Array();
$monto_adeudado = Array();
$monto_cobrado = Array();
$monto_acobrar = Array();
$monto_cobrado = Array();

$com = R::findAll("comercios");
foreach($com as $c){
    // obtengo su localidad
    $id = array_search($c["domicilio_comercio_localidad"], $localidades);
    if(in_array($c["domicilio_comercio_localidad"], $localidades)){ // si lo encontro
        $comercios_adheridos[$id] += 1;
        // obtengo todos los creditos de este comercio
        $creditos = R::findAll("credito_instancia","id_comercio LIKE ?",[$c["id"]]);
        foreach($creditos as $cred){
            if($cred["rendida"]) $monto_invertido[$id] += $cred["monto"];
            else $monto_adeudado[$id] += $cred["monto"];
            // obtengo las cuotas
            $cuotas = R::findAll("cuotas","id_credito LIKE ?",[$cred["id"]]);
            foreach($cuotas as $cuo){
                $m = $cuo["cuota_original"] + $cuo["punitorios"] + $cuo["compensatorios"] + $cuo["multa"];
                if($cuo["abonado"]) $monto_cobrado[$id] += $m;
                else $monto_acobrar[$id] += $m;
            }
        }
    } else {
        $localidades[] = $c["domicilio_comercio_localidad"];
        $comercios_adheridos[] = 1;
        $monto_invertido[] = 0;
        $monto_adeudado[] = 0;
        $monto_cobrado[] = 0;
        $monto_acobrar[] = 0;
        $monto_cobrado[] = 0;

        // obtengo el id, el ultimo elemento
        $id = count($localidades) - 1;
        // obtengo todos los creditos de este comercio
        $creditos = R::findAll("credito_instancia","id_comercio LIKE ?",[$c["id"]]);
        foreach($creditos as $cred){
            if($cred["rendida"])
                $monto_invertido[$id] += $cred["monto"];
            else
                $monto_adeudado[$id] += $cred["monto"];
            // obtengo las cuotas
            $cuotas = R::findAll("cuotas","id_credito LIKE ?",[$cred["id"]]);
            foreach($cuotas as $cuo){
                $m = $cuo["cuota_original"] + $cuo["punitorios"] + $cuo["compensatorios"] + $cuo["multa"];
                if($cuo["abonado"]) $monto_cobrado[$id] += $m;
                else $monto_acobrar[$id] += $m;
            }
        }
    }
}
$Aelementos = Array();
for($i = 0; $i < count($localidades); $i++){
    $Aelementos[$i] = Array();
    $localidad = R::findOne("localidades","id LIKE ?",[$localidades[$i]]);
    $nombre_localidad = $localidad["nombre"];
    $nombre_provincia = R::findOne("provincias","id LIKE ?",[$localidad["id_provincia"]])["nombre"];

    $Aelementos[$i]["nombre_localidad"] = $nombre_localidad;
    $Aelementos[$i]["nombre_provincia"] = $nombre_provincia;
    $Aelementos[$i]["categoria_localidad"] = "No disponible";
    $Aelementos[$i]["comercios_adheridos"] = $comercios_adheridos[$i];
    $Aelementos[$i]["monto_invertido"] = ROUND($monto_invertido[$i]);
    $Aelementos[$i]["monto_cobrados"] = ROUND($monto_cobrado[$i]);
    $Aelementos[$i]["montos_adeudados"] = ROUND($monto_adeudado[$i]);
    $Aelementos[$i]["montos_a_cobrar"] = ROUND($monto_acobrar[$i]);
    $Aelementos[$i]["ver_detalle"] = "<a href='verLocalidad.php?id={$localidades[$i]}' class='btn btn-default btn-xs'><i class='fas fa-eye'></i></a>";
}

if(isset($_GET["sort_by"]) && isset($_GET["asc"])){
    $GLOBALS["asc"] = $_GET["asc"];
    $GLOBALS["sort_by"] = $_GET["sort_by"];
    usort($Aelementos,function ($a,$b){
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
			<div class="col-sm-6" style="border-bottom: 2px solid #769FCD;margin-bottom:20px"><h2 align="center">Ranking Localidades</h2></div>
			<div class="col-sm-3"></div>
		</div>
		<div class="" style="overflow-x: auto;">
			<table class="table table-striped table-hover nowrap" style="width:100%;" id="tabla">
                <thead>
    				<tr style="font-weight: 600; background:#ccc;">
    					<th class="text-center">Localidad</th>
    					<th class="text-center">Provincia</th>

                        <th class="text-center">Categoría Localidad</th>
                        <th class="text-center">Comercios Adheridos</th>
                        <th class="text-center">Monto Invertido</th>
                        <th class="text-center">Monto Cobrados</th>
                        <th class="text-center">Montos Adeudados</th>
                        <th class="text-center">Monto a Cobrar</th>
                        <!--<th class="text-center"><a href="?sort_by=categoria_localidad&asc=<?php echo inversedASC(); ?>">Categoría Localidad</a></th>
                        <th class="text-center"><a href="?sort_by=comercios_adheridos&asc=<?php echo inversedASC(); ?>">Comercios Adheridos</a></th>
    					<th class="text-center"><a href="?sort_by=monto_invertido&asc=<?php echo inversedASC(); ?>">Monto Invertido</a></th>
    					<th class="text-center"><a href="?sort_by=monto_cobrados&asc=<?php echo inversedASC(); ?>">Monto Cobrados</a></th>
    					<th class="text-center"><a href="?sort_by=montos_adeudados&asc=<?php echo inversedASC(); ?>">Montos Adeudados</a></th>
    					<th class="text-center"><a href="?sort_by=montos_a_cobrar&asc=<?php echo inversedASC(); ?>">Monto a Cobrar</a></th>-->
    					
    					<th class="text-center">Ver Detalle</th>
    				</tr> 
                </thead>
                <tbody id="t_body">
                    <?php for($i = 0; $i < count($Aelementos); $i++){ ?>
                    <tr>
                        <td><?php echo $Aelementos[$i]["nombre_localidad"]; ?></td>
                        <td><?php echo $Aelementos[$i]["nombre_provincia"]; ?></td>
                        <td><?php echo $Aelementos[$i]["categoria_localidad"]; ?></td>
                        <td><?php echo $Aelementos[$i]["comercios_adheridos"]; ?></td>
                        <td><?php echo $Aelementos[$i]["monto_invertido"]; ?></td>
                        <td><?php echo $Aelementos[$i]["monto_cobrados"]; ?></td>
                        <td><?php echo $Aelementos[$i]["montos_adeudados"]; ?></td>
                        <td><?php echo $Aelementos[$i]["montos_a_cobrar"]; ?></td>
                        <td><?php echo $Aelementos[$i]["ver_detalle"]; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
			</table>
		</div>
		<div class="t-centered col-espacio-t">
			<a href="/litt/ui/financiera/informesComercio.php" class="btn btn-primary btn-lg">Salir</a>
		</div>

	</div>
</div>
		
<script type="text/javascript">
    $(document).ready( function () {
        $('#tabla').DataTable({
            "ordering": true,
            "searching": false,
            "scrollX": true,
            dom: 'Bfrtip',
            lengthMenu: [
                [ 10, 25, 50, -1 ],
                [ '10', '25', '50', 'Todos' ],
            ],
            buttons: [
                {
                    extend: "pageLength",
                    text:   '10 Filas'
                },
                {
                    extend: 'csvHtml5',
                    text:      '<i class="fa fa-file-text-o"></i>',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                    },
                    titleAttr: 'CSV',
                    title: 'ranking_localidades'
                },
                {
                    extend: 'excelHtml5',
                    text:      '<i class="fa fa-file-excel-o"></i>',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                    },
                    titleAttr: 'Excel',
                    title: 'ranking_localidades'
                },
                {
                    extend: 'pdfHtml5',
                    text:      '<i class="fa fa-file-pdf-o"></i>',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                    },
                    download: 'open',
                    titleAttr: 'PDF',
                    title: 'ranking_localidades'
                },
            ],
            "language":{
                buttons: {
                    pageLength: {
                        _: "%d filas",
                        '-1': "Todo"
                    }
                },
                "lengthMenu": "_MENU_ registros por página",
                "info": "Página _PAGE_ de _PAGES_ - _MAX_ registros",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtrada de _MAX_ registros)",
                "loadingRecords": "Cargando...",
                "processing":     "Procesando...",
                "search": "Buscar:",
                "zeroRecords":    "No se encontraron registros",
                "paginate": {
                    "next":       "Siguiente",
                    "previous":   "Anterior"
                },
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },              
            }
        });
    } );
    function imprimir() {
        var datos = [];

        $("#t_body").find("tr").each(function() {
            var dato = "";
            $(this).find("td").each(function(){
                if($(this).index() != 8) {
                    if(dato != "")
                        dato += "/";
                    dato += $.trim($(this).text());
                }
            });
            datos.push(dato);
        });
        console.log(serialize(datos))
        var page = "ajax/ranking_localidades.php?datos="+(serialize(datos));
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
