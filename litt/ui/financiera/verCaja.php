<?php
$ARR_CSS = array();
$ARR_CSS[] = "/litt/ui/financiera/css/select2.min.css";
$ARR_JS = array();
$ARR_JS[] = "/litt/ui/financiera/js/select2.js";
include('./header.php');

// cargo el comercio por id

if(!isset($_GET['id'])) exit();

$id = $_GET['id'];

$r = R::findOne("registro_pago","id = ?",[$id]);

?>


	<div class="container1"> 
		<div class="panel-b">

			<div class="row panel-title">
				<div class="col-sm-3"></div>
				<div class="col-sm-6" style="border-bottom: 2px solid #769FCD;margin-bottom:20px"><h2 align="center"><?php echo ($r["ingreso_egreso"] == 0 ? "Egreso" : "Ingreso") ?></h2></div>
				<div class="col-sm-3"></div>
			</div>
			
			<div class="u-data-panel" id="imprimible" style="display: block">
	            <div class="row">
	                <div class="col-xs-6"> Fecha: </div><div class="col-xs-6 text-left">
	                	<script type="text/javascript">
                            document.write(retFormatDMYBar('<?php echo $r["fecha_hora"]; ?>'));
                        </script>
	                </div>
	            </div>

	            <div class="row">
	                <div class="col-xs-6"> Tipo de Movimiento: </div>
	                <div class="col-xs-6">
	                	<?php 
	                	$tipo_movimiento = R::findOne("tipo_movimiento","id LIKE ?",[$r["id_movimiento"]])["nombre"];
	                	?>
	                    <input value="<?php echo $tipo_movimiento; ?>" disabled>
	                </div>
	            </div>

	            <div class="row">
	                <div class="col-xs-6"> Entidad: </div>
	                <div class="col-xs-6">
	                	<?php 
	                	$entidad = "";
	                	if(strtoupper($tipo_movimiento) == "RENDICION") $entidad = R::findOne("comercios","id LIKE ?",Array($r["id_entidad"]))["nombre"];
                        else
                        $entidad = R::findOne("entidades","id LIKE ?",[$r["id_entidad"]])["denominacion"];
	                	?>
	                    <input value="<?php echo $entidad; ?>" disabled>
	                </div>
	            </div>

	            <div class="row">
	                <div class="col-xs-6"> Tipo de Comprobante: </div>
	                <div class="col-xs-6">
	                	<input value="<?php echo R::findOne("tipo_comprobante","id LIKE ?",Array($r["id_tipo_comprobante"]))["nombre"] ?>" disabled>
	                </div>
	            </div>
	            <div class="row">
	                <div class="col-xs-6"> Número Comprobante: </div><div class="col-xs-6"><input value="<?php echo $r["numero_comprobante"]; ?>" id="numero_comprobante" disabled></div>
	            </div>
	            <div class="row">
	                <div class="col-xs-6"> Fecha Comprobante: </div><div class="col-xs-6 text-left">
	                	
	                	<script type="text/javascript">
                            document.write(retFormatDMYBar('<?php echo $r["fecha_comprobante"]; ?>'));
                        </script>
	                </div>
	            </div>
	            <div class="row">
	                <div class="col-xs-6"> Monto: </div><div class="col-xs-6"><input value="<?php echo $r["monto"]; ?>" id="monto" disabled></div>
	            </div>
	            <div class="row">
	                <div class="col-xs-6"> IVA: </div><div class="col-xs-6"><input value="<?php echo $r["iva"]; ?>" id="iva" disabled></div>
	            </div>
	        </div>
			
			<div class="bottom-btns">
				<a onclick="window.close();">
                    <button class="btn btn-primary btn-lg">Cancelar</button>
                </a>
			</div>	
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
	        $('.js-example-basic-single').select2({width: 'resolve'});
	    });
	</script>