<?php
$ARR_CSS = array();
$ARR_CSS[] = "/litt/ui/financiera/css/select2.min.css";
$ARR_CSS[] = "/litt/ui/financiera/css/jquery-ui.css";
$ARR_CSS[] = "/litt/ui/financiera/css/dataTables.jqueryui.css";
$ARR_CSS[] = "/litt/ui/financiera/css/buttons.dataTables.min.css";
$ARR_JS = array();
$ARR_JS[] = "/litt/ui/financiera/js/select2.js";
$ARR_JS[] = "/litt/ui/financiera/js/jquery-ui.js";
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
function fecha_inv($f) {
	$r = explode("/", $f);
	$fecha = "";
	for($i = count($r) - 1; $i >= 0; $i--)
		$fecha .= $r[$i];

	return $fecha;
}

?>
<script>
	$(document).ready(function() { fecha_datepicker(); })
    
    function fecha_datepicker(){
        $(".fecha").datepicker({
            dateFormat: 'dd/mm/yy',
            //prevText: '',
            //nextText: '',
            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
            dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
            dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
            changeMonth: true,
            changeYear: true
        });
    }
</script>

<style type="text/css">
    .select2-container--default .select2-selection--single,
    .select2-container--default.select2-container--focus .select2-selection--multiple,
    .select2-container--default .select2-selection--multiple {
        padding: 5px 8px !important;
        height: auto !important;
        border: 2px solid #41719c;
    }
    .select2-container--default input {
        height: auto !important
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        top: 8px !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered,
    input[type="text"],textarea, select {
        text-transform: uppercase;
    }
    #tabla td,
    #tabla th {
    	vertical-align: middle !important;
    }
    #tabla th {
    	text-align: center;
    }
</style>
<div class="container"> 
	<div class="panel-a col-md-8 col-md-offset-2 col-sm-12 col-sm-offset-0 col-xs-10 col-xs-offset-1">

		<div class="row panel-title">
			<div class="col-sm-6 col-sm-offset-3" style="border-bottom: 2px solid #769FCD;margin-bottom:20px"><h2 align="center">Operaciones</h2></div>
			<div class="col-sm-3"></div>
		</div>

		<form method="post" id="">
			<?php 
			$Adni = Array();
			if(isset($_POST["ubicacion"]) && !empty($_POST["ubicacion"])) {
				foreach ($_POST as $p => $k) {
					if($p != "ubicacion" && $p != "designacion" && $p != "desde" && $p != "hasta") {
						$Adni[] = $p;
						echo "<input type='hidden' name='{$p}' value='{$k}'/>";
					}
				}
				echo "<input type='hidden' name='ubicacion' value='operaciones'/>";
			 }
			?>
		<div class="col-sm-6">
			<div class="col-sm-12">
				<?php 
				$liquidaciones = R::findAll("estado_liquidacion");
				?>
				<select class="form-control" style="width: 100%" name="designacion">
					<option value=""></option>
					<?php 
					foreach ($liquidaciones as $l) {
						if(isset($_POST["designacion"]))
							echo "<option " . ($_POST["designacion"] == $l["id"] ? 'selected' : '') . " value='{$l["id"]}'>{$l["designacion"]}</option>";
						else
							echo "<option value='{$l["id"]}'>{$l["designacion"]}</option>";
					}
					?>
				</select>

                <script>
                    $("select[name='designacion']").select2({
                        placeholder: 'LIQUIDACION',
                        allowClear: true,
                        width: 'resolve',
                    })
                </script>
			</div>
		</div>
		<div class="col-sm-6">

			<div class="col-xs-3"><div class="row"><h4 style="text-align: right;">Fecha</h4></div></div>
			<div class="col-xs-9">
				<div class="row">
					<div class="col-xs-6"><input class="form-control fecha" type="text" name="desde" value="<?php if(isset($_POST["desde"])) echo $_POST["desde"] ?>"  placeholder="Desde" style="margin-top: 0"></div>
					<div class="col-xs-6"><input class="form-control fecha" type="text" name="hasta" value="<?php if(isset($_POST["hasta"])) echo $_POST["hasta"] ?>" placeholder="Hasta" style="margin-top: 0"></div>
					<?php
					if(isset($_POST["desde"]) && !empty($_POST["desde"]))
						$_POST["desde"] = fecha_inv($_POST["desde"])."0000";
					if(isset($_POST["hasta"]) && !empty($_POST["hasta"])) {
						$_POST["hasta"] = fecha_inv($_POST["hasta"])."2359";
					}
					?>
				</div>
			</div>
			</div>
			<div class="col-xs-12">
				<div class="t-centered margin-v10">
					<button type="submit" class="btn btn-primary btn-md" style="font-size:18px; padding: 5px 35px"> Buscar </button>
				</div>
			</div>
		</form>

			<div class="" style="">
				<table class="table t-centered" style="width:100%;" id="tabla">
					<thead>
						<tr style="font-weight: 600; background:#ccc;">
							<th>Nombre</th>
							<th>DNI</th>
	                        <th>Fecha Alta</th>
							<th>Nro Op</th>
							<th>Monto</th>
							<th>Plazo</th>
							<!-- <td>Atraso</td> -->
							<th>Liquidación</th>
							<th>Documentos</th>
						</tr>
					</thead>
					<tbody id="tbody">
                        <?php
                                        
                            // recibo todos los id desde POST
                        foreach ($Adni as $dni){
                        	if(isset($_POST["designacion"]) && $_POST["designacion"] != "") {
                        		if(!empty($_POST["desde"]) && !empty($_POST["hasta"]))
                        			$r = R::find("credito_instancia","dni_cliente = ? AND id_comercio = ? AND liquidado_litt = ? AND fecha_creacion BETWEEN ? AND ?",array($dni,$_SESSION["id_comercio"],$_POST["designacion"],$_POST["desde"],$_POST["hasta"]));
								elseif(!empty($_POST["desde"]) && empty($_POST["hasta"]))
                        			$r = R::find("credito_instancia","dni_cliente = ? AND id_comercio = ? AND liquidado_litt = ? AND fecha_creacion >= ?",array($dni,$_SESSION["id_comercio"],$_POST["designacion"],$_POST["desde"]));

								elseif(empty($_POST["desde"]) && !empty($_POST["hasta"]))
                        			$r = R::find("credito_instancia","dni_cliente = ? AND id_comercio = ? AND liquidado_litt = ? AND fecha_creacion <= ?",array($dni,$_SESSION["id_comercio"],$_POST["designacion"],$_POST["hasta"]));
								else
                        			$r = R::find("credito_instancia","dni_cliente = ? AND id_comercio = ? AND liquidado_litt = ?",array($dni,$_SESSION["id_comercio"],$_POST["designacion"]));
                        	} elseif(isset($_POST["designacion"])) {
                        		if(!empty($_POST["desde"]) && !empty($_POST["hasta"]))
                        			$r = R::find("credito_instancia","dni_cliente = ? AND id_comercio = ? AND fecha_creacion BETWEEN ? AND ?",array($dni,$_SESSION["id_comercio"],$_POST["desde"],$_POST["hasta"]));
								elseif(!empty($_POST["desde"]) && empty($_POST["hasta"]))
                        			$r = R::find("credito_instancia","dni_cliente = ? AND id_comercio = ? AND fecha_creacion >= ?",array($dni,$_SESSION["id_comercio"],$_POST["desde"]));

								elseif(empty($_POST["desde"]) && !empty($_POST["hasta"])) {
                        			$r = R::find("credito_instancia","dni_cliente = ? AND id_comercio = ? AND fecha_creacion <= ?",array($dni,$_SESSION["id_comercio"],$_POST["hasta"]));
								}
								else
                        			$r = R::find("credito_instancia","dni_cliente = ? AND id_comercio = ?",array($dni,$_SESSION["id_comercio"]));
                        	} else
                            	$r = R::find("credito_instancia","dni_cliente = ? AND id_comercio = ?",array($dni,$_SESSION["id_comercio"]));
                            foreach($r as $c){
                                //$k = R::findOne("clientes", "dni LIKE ?", array($c['dni_cliente']));
                            	$k = R::findOne("clientes","dni LIKE ?",Array($c["dni_cliente"]));
                        ?>
					<tr data-liquidacion="<?php echo $c['liquidado_litt'] ?>" data-fecha="<?php echo substr($c['fecha_creacion'],0,8) ?>">
                        <td data-column="0"><?php echo strtoupper($k['nombre'] . ' ' . $k['apellido']); ?></td>
                        <td data-column="1"><?php echo $k['dni']; ?></td>
						<td data-column="2"><?php echo fecha($c['fecha_creacion']); ?></td>
						<td data-column="3"><?php echo $c['id']; ?></td>
						<td data-column="4"><?php echo $c['monto']; ?></td>
						<td data-column="5"><?php echo $c['cuotas']; ?></td>
						<!-- <td><?php echo $c['id']; ?></td>-->
						<td data-column="6"><?php echo strtoupper(R::findOne("estado_liquidacion","id LIKE ?",Array($c["liquidado_litt"]))["designacion"]) ?></td>
                        <td data-column="7"><a target="_blank" href="subirDocu.php?id=<?php echo $c['id']; ?>" class="btn btn-default" title="Subir Documentos"><i class="fa fa-file-text-o" style="font-family: Fontawesome"></i></a><a href="descargarPDF.php?id=<?php echo $c["id"] ?>" target="_blank" class="btn btn-default" title="Formularios"><i class="fa fa-print"></i></a>      
                        </td>
					</tr>
                                    
                    <?php
                            }
                        }
                    
                    ?>
                    </tbody>
				</table>
			</div>
			<div class="bottom-btns">
                <div class="btn-group">
                    <a href="<?php echo config::$ui_main_comercio; ?>" class="btn btn-primary btn-lg">MENU</a>
                    <a href="<?php echo config::$ui_listar_clientes; ?>" class="btn btn-success btn-lg">CLIENTES</a>
                </div>
			</div>
	</div>
</div>
	
<script>
	$(document).ready(function() {
		var tabla = $('#tabla').DataTable({
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
			}, 
	    });
	    tabla.on( 'draw', function ( e, settings, details ) {
		    var $e = $("#tabla");
		    console.log($e)
		});

		$("#form").submit(function(e) {
			e.preventDefault();

			var desde = ($("input[name='desde']").val() == "" ? "" : fecha($("input[name='desde']").val()));
			var hasta = ($("input[name='hasta']").val() == "" ? "" : fecha($("input[name='hasta']").val()));
			var liquidacion = $("select[name='designacion']").val();
			console.log(liquidacion)
			$("#tbody").find("tr").hide();
			if(liquidacion != "" && desde == "" && hasta == "") {
				//filterColumn(6);
				$("#tbody").find("tr[data-liquidacion='"+liquidacion+"']").show();
			}
			else if(liquidacion != "" && desde != "" && hasta == "") {
				$("#tbody").find("tr[data-liquidacion='"+liquidacion+"']").each(function() {
					if($(this).data("fecha") >= desde)
						$(this).show();
				})
			} else if(liquidacion != "" && desde != "" && hasta != "") {
				$("#tbody").find("tr[data-liquidacion='"+liquidacion+"']").each(function() {
					console.log($(this).data("fecha"))
					if($(this).data("fecha") >= desde && $(this).data("fecha") <= hasta)
						$(this).show();
				})
			} else if(liquidacion != "" && desde == "" && hasta != "") {
				$("#tbody").find("tr[data-liquidacion='"+liquidacion+"']").each(function() {
					console.log($(this).data("fecha"))
					if($(this).data("fecha") <= hasta)
						$(this).show();
				})
			} else if(liquidacion == "" && desde != "" && hasta != "") {
				$("#tbody").find("tr").each(function() {
					console.log($(this).data("fecha"))
					if($(this).data("fecha") >= desde && $(this).data("fecha") <= hasta)
						$(this).show();
				})
			} else if(liquidacion == "" && desde != "" && hasta == "") {
				$("#tbody").find("tr").each(function() {
					console.log($(this).data("fecha"))
					if($(this).data("fecha") >= desde)
						$(this).show();
				})
			} else if(liquidacion == "" && desde == "" && hasta != "") {
				$("#tbody").find("tr").each(function() {
					console.log($(this).data("fecha"))
					if($(this).data("fecha") <= hasta)
						$(this).show();
				})
			} else {
				$("#tbody").find("tr").show();
			}

			return false;
		});
	})
	
	function fecha(f) {
		if(f.lenght < 10)
			var r = f.split("/");
		else {
			var e = f.substr(0, 10);
			var r = e.split("/");
		}

		return r[2]+r[1]+r[0];
	}
</script>	

</body>
</html>