<?php
$ARR_CSS = array();
$ARR_CSS[] = "/litt/ui/financiera/css/dataTables.jqueryui.css";
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
include($_SERVER['DOCUMENT_ROOT'] . '/litt/ui/comercio/header.php');

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

    #tabla td,
    #tabla th {
    	vertical-align: middle !important;
    }
    #tabla th {
    	text-align: center !important;
    }
</style>
    <div class="container"> 
		<div class="panel-a col-md-8 col-md-offset-2 col-sm-12 col-sm-offset-0 col-xs-10 col-xs-offset-1">
			<div class="row panel-title" style="padding-bottom: 10px">
				<div class="col-xs-12 col-sm-6 col-sm-offset-3" style="border-bottom: 2px solid #769FCD;margin-bottom:20px"><h2 align="center">Mis Clientes</h2></div>
				<div class="col-sm-3"><img src="/litt/ui/comercio/img/clientes.png"></div>
			</div>

            <form action="?busqueda" method="POST">
                <div class="row col-espacio-b"> 
				    <div class="col-sm-9 col-xs-12 col-espacio-b">
                        <select name="keyword" style="width: 100%">
        					<option value=""></option>
        					<?php
        					$arr = $_SESSION['clientes'];
        					foreach($arr as $c){
        						if(isset($_GET['busqueda'])) {
        							if($_POST["keyword"] == $c["id"])
        								echo "<option value='{$c["id"]}' selected>{$c["apellido"]}, {$c["nombre"]} ({$c["dni"]})</option>";
        							else
        								echo "<option value='{$c["id"]}'>{$c["apellido"]}, {$c["nombre"]} ({$c["dni"]})</option>";
        						} else
        							echo "<option value='{$c["id"]}'>{$c["apellido"]}, {$c["nombre"]} ({$c["dni"]})</option>";
        					}
        					?>
                        </select>
    					<script>
    						$('select[name="keyword"]').select2({
    							width: 'resolve',
    							placeholder: 'Ingrese DNI, Apellido o Nro de Cliente',
    							allowClear: true,
    						});
    					</script>
				    </div>
				    <div class="col-sm-3 col-xs-12">
                        <select name="keyword_estado" class="form-control" style="margin-top: 0px;">
                        <?php 
                            $r = R::find('estado_mora');
                            foreach($r as $ra) {
								if(isset($_GET['busqueda'])) {
									if($_POST["keyword_estado"] == $ra["id"])
										echo "<option value='{$ra['id']}' selected>{$ra['designacion']}</option>";
									else
										echo "<option value='{$ra['id']}'>{$ra['designacion']}</option>";
								} else
                                	echo "<option value='{$ra['id']}'>{$ra['designacion']}</option>";
                            }
                        ?>
                        <!-- <option disabled selected hidden>Modulo/s</option> -->
                        </select>
                    </div>
                </div>
    			<div class="row col-xs-espacio-t col-espacio-b">
                    <div class="text-center col-xs-12">
        				<button type="submit" class="btn btn-primary btn-md" style="font-size:18px; padding: 5px 35px">Buscar</button>
                    </div>
    			</div>
            </form>
            <form action="../../operaciones.php" method="POST" id="form" onsubmit="event.preventDefault(); validarForm();">
                <input type="hidden" name="ubicacion" value="lista">
                <div class="row">
        			<div class="col-xs-12" style="">
        				<table class="table table-striped table-hover" style="width: 100%" id="tabla">
        					<thead>
        						<tr style="font-weight: 600; background:#ccc;">
        							<th>Nro Cliente</th>
        	                        <th>DNI</th>
        	                        <th>Nombre</th>
        							<th>Créditos Cancelados</th>
        							<th>Créditos Vigentes</th>
        							<th>Estado Cliente</th>
        							<th>Max atraso</th>
        							<th style="width: 47px">Datos</th>
        						</tr>
                            </thead>
                            <tbody>
                                <?php
                                $arr = $_SESSION['clientes'];
                                //echo count($arr);
                                $busqueda = false;
                                if(isset($_GET['busqueda'])){
                                    $busqueda = true;
                                    $keyword = $_POST['keyword'];
                                    $estado = $_POST['keyword_estado'];
                                    //if($keyword == "")
                                      //  $busqueda = false;
                                }
                                foreach($arr as $c){
                                    $mostrar = false;
                                    if($busqueda) {
                                    	if($keyword != "") {
                                    		if($keyword == $c['id'] && $estado == $c['estado_mora']) $mostrar = true;
                                    	} else {
                                    		if($estado == $c['estado_mora']) $mostrar = true;
                                    	}
                                    }
                                    if((!$mostrar && !$busqueda) || ($mostrar && $busqueda)){
                                ?>
            					<tr>
            						<td><?php echo $c['id']; ?></td>
                                    <td><?php echo $c['dni']; ?></td>
            						<td><?php echo strtoupper($c['apellido'] . ', ' . $c['nombre']); ?></td>
            						<td>
            							<?php
                                        $total = 0;
                                        $cuotas_canceladas = R::getAll("SELECT MIN(cu.abonado) AS creditos_cancelados FROM credito_instancia AS ci JOIN cuotas AS cu ON (ci.id = cu.id_credito) WHERE ci.dni_cliente = ? AND ci.id_comercio = ? GROUP BY ci.dni_cliente,ci.id",Array($c["dni"],$_SESSION["id_comercio"]));

                                        foreach ($cuotas_canceladas as $cc) {
                                            $total += $cc["creditos_cancelados"];
                                        }
                                        echo $total;
                                        ?>
            						</td>
            						<td><?php echo $c['credito_vigente']; ?></td>
            						<td>
                                        <?php 
                                        $j = R::findOne('estado_mora','id LIKE ?', array($c['estado_mora']));
                                        echo strtoupper($j['designacion']);
                                        ?>
                                    </td>
            						<td>
                                        <?php
                                        $cuo = R::findAll("cuotas","abonado LIKE ? AND dni_cliente LIKE ?",[0,$c["dni"]]);
                                        $max_dif = 0;
                                            foreach($cuo as $cc){
                                                // reviso cada vencimiento y en base a eso determino el estado
                                                $t = strtotime($cc["vencimiento"]); // vencimiento mas viejo no abonado
                                                $n = time(); // hoy
                                                $dif = round(($n - $t) / (60*60*24)); // dias diferencia 

                                                if($max_dif < $dif) $max_dif = $dif;
                                            }
                                            echo $max_dif;
                                        ?>
                                    </td>
            						<td>
            							<a class="btn btn-default btn-xs" href="../controlador/controller.php?verCliente=<?php echo $c['dni']; ?> "><i class="fas fa-eye"></i></a>
                                        <label class="btn btn-link btn-xs">
                                            <input name="<?php echo $c['dni']; ?>" class="check_estado" value="<?php echo $c['dni']; ?>" type="checkbox">
                                            <span class="cr" style="margin:0;"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        </label>
            						</td>
            					</tr>
                                                    
                                <?php
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>

        			<div class="bottom-btns bottom-btns-3 text-center">
                        <div class="btn-group">
                            <a href="<?php echo config::$ui_main_comercio; ?>" class="btn btn-primary btn-lg">MENU</a>
            				<button type="submit" class="btn btn-success btn-lg" style="margin: 0">OPERACIONES</button>
                        </div>
        			</div>
                </div>
            </form>
		</div>
	</div>

<script>
    function validarForm() {
        var flag = false; 
        var inputElements = document.getElementsByClassName('check_estado');
        for(var i=0; inputElements[i]; ++i){
              if(inputElements[i].checked){
                   flag = true;
                   break;
              }
        }
        if(flag) {
            document.getElementById("form").submit();
        } else {
            Lobibox.notify("error", {
                size: 'mini',
                title: 'Error',
                msg: 'No se ha seleccionado ninguna operación',
                showClass: 'fadeInDown',
                hideClass: 'fadeUpDown',
                delay: 10000,
                sound: false
            });
        }
    }

	$(document).ready(function() {
		$('#tabla').DataTable({
	    	"ordering": false,
	    	"searching": false,
            dom: 'Bfrtip',
            "scrollX": true,
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
				"zeroRecords":    "No se encontraron Clientes",
				"paginate": {
					"next":       "Siguiente",
					"previous":   "Anterior"
				},					
			}
	    });
	})
</script>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/litt/ui/comercio/footer.php'); ?>