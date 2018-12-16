<?php
$ARR_CSS = array();
$ARR_CSS[] = "/litt/ui/financiera/css/select2.min.css";
$ARR_CSS[] = "/litt/ui/financiera/css/dataTables.jqueryui.css";
$ARR_CSS[] = "/litt/ui/financiera/css/buttons.dataTables.min.css";
$ARR_JS = array();
$ARR_JS[] = "/litt/ui/financiera/js/select2.js";
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

function fecha($f) {
    $a = substr($f, 0,4);
    $m = substr($f, 4,2);
    $d = substr($f, 6,2);
    $h = substr($f, 8,2);
    $i = substr($f, 10,2);

    return $d."/".$m."/".$a." ".$h.":".$i;
}
?>
<style type="text/css" media="screen">
	#tabla td,
	#tabla th {
		vertical-align: middle !important;
	}
</style>

<div class="container"> 
    <div class="panel-a col-md-8 col-md-offset-2 col-sm-12 col-sm-offset-0 col-xs-10 col-xs-offset-1">

        <div class="row panel-title">
                <div class="col-sm-6 col-sm-offset-3" style="border-bottom: 2px solid #769FCD;margin-bottom:20px"><h2 align="center">Operaciones</h2></div>
                <div class="col-sm-3"></div>
        </div>

        <div class="row">
        	<div class="col-sm-12">
				<table class="table table-striped table-hover" style="width: 100%" id="tabla">
					<thead>
						<tr style="font-weight: 600; background:#ccc;">
							<th class="text-center">Nombre Completo</th>
							<th class="text-center">DNI</th>
							<th class="text-center">Fecha Alta</th>
							<th class="text-center">Nro Op</th>
							<th class="text-center">Comercio</th>
							<th class="text-center">Monto</th>
							<th class="text-center">Plazo</th>
							<th class="text-center">Liquidación</th>
							<th class="text-center">Documentos</th>
							<!--<th>Imprimir Form</th>-->
						</tr>
					</thead>
					<tbody>
						<?php 
						if(isset($_POST)) {
							if(count($_POST) > 0) {
							foreach ($_POST as $p) {
								$cliente = R::findOne("clientes","id LIKE ?",Array($p));
								$creditos = R::find("credito_instancia","dni_cliente = ?",array($cliente["dni"]));
								foreach ($creditos as $c) {
									# code...
						?>
								<tr>
			                        <td><?php echo strtoupper($cliente['nombre'] . ', ' . $cliente['apellido']); ?></td>
			                        <td><?php echo $cliente['dni']; ?></td>
									<td><?php echo fecha($c['fecha_creacion']); ?></td>
									<td><?php echo $c['id']; ?></td>
									<td><?php echo strtoupper(R::findOne("comercios","id LIKE ?",Array($c["id_comercio"]))["nombre"]); ?></td>
									<td><?php echo $c['monto']; ?></td>
									<td><?php echo $c['cuotas']; ?></td>
									<!-- <td><?php echo $c['id']; ?></td>-->
									<td><?php  if($c['liquidado_litt'] == 1) echo "liquidado"; else echo "pendiente"; ?></td>
			                        <td><a href="legajo.php?id=<?php echo $c['id']; ?>" class="btn btn-default" target="_blank"><i class="fa fa-file-text-o" style="font-family: Fontawesome"></i></a>
                            		<a href="descargarPDF.php?id=<?php echo $c["id"] ?>" target="_blank" class="btn btn-default" title="Formularios"><i class="fa fa-print"></i></td>
									<!--<td>
			                            <a href="descargarPDF.php?id=<?php echo $c["id"] ?>" target="_blank" class="btn btn-default"><i class="fa fa-print"></i></a>                 
			                        </td>-->
								</tr>
						<?php
									}
								}
							}
						} else
						header ("Location: clientes.php");
						?>
					</tbody>
				</table>
        	</div>
		</div>
		<div class="bottom-btns botom-btns3">
                <a href='/litt/ui/financiera/clientes.php' class="btn btn-primary btn-lg">Volver</a>
                <!-- <button class="btn btn-primary btn-lg">Impresora</button> -->
        </div>
    </div>
</div>

<script>
	$(document).ready(function() {
		$('#tabla').DataTable({
	    	"ordering": false,
	    	"searching": false,
            dom: 'Bfrtip',
            "scrollX":true,
            lengthMenu: [
                [ 10, 25, 50, -1 ],
                [ '10', '25', '50', 'Todos' ],
            ],
            buttons: [
                {
                    extend: "pageLength",
                    text:   '10 Filas'
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
				"zeroRecords":    "No se encontraron Operaciones",
				"paginate": {
					"next":       "Siguiente",
					"previous":   "Anterior"
				},					
			}
	    });
	})
</script>

</body>
</html>