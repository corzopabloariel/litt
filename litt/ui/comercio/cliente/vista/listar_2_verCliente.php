<?php
$ARR_CSS = array();
$ARR_CSS[] = "/litt/ui/financiera/css/select2.min.css";
$ARR_CSS[] = "/litt/ui/financiera/css/jquery-ui.css";
$ARR_CSS[] = "/litt/ui/financiera/css/messagebox.css";
$ARR_JS = array();
$ARR_JS[] = "/litt/ui/financiera/js/select2.js";
$ARR_JS[] = "/litt/ui/financiera/js/jquery-ui.js";
$ARR_JS[] = "/litt/ui/financiera/js/messagebox.js";
$ARR_JS[] = "/litt/ui/financiera/js/lobibox.js";
include($_SERVER['DOCUMENT_ROOT'] . '/litt/ui/comercio/header.php'); ?>

<style type="text/css" media="screen">
	.select2-container { margin-top: 10px !important; margin-bottom: 10px !important; }
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
    .none {
    	display: none !important
    }
</style>
<div class="container"> 
		<div class="panel-a col-md-8 col-md-offset-2 col-sm-12 col-sm-offset-0 col-xs-10 col-xs-offset-1">
			<div class="row panel-title">
				<div class="col-sm-6 col-sm-offset-3 col-xs-12" style="border-bottom: 2px solid #769FCD;margin-bottom:20px"><h2 align="center">Datos Cliente</h2></div>
			</div>
			<form action="../controlador/controller.php?guardarDatosModificados" novalidate="true" id="form" onsubmit="event.preventDefault(); validarForm();" method="POST">
			<div class="form-group">
				<div class="row">
				<div class="col-sm-6">
					<label>Nombre</label><input disabled class="form-control texto-letra" type="text" name="nombre" placeholder="Nombre" value="<?php echo $_POST['nombre']; ?>" required="true"></div>
				<div class="col-sm-6">
                   	<label>Apellido</label><input disabled class="form-control texto-letra" type="text" name="apellido" placeholder="Apellido" value="<?php echo $_POST['apellido']; ?>" required="true"></div>
                   </div>
			</div>
			<div class="form-group">
				<div class="row">
				<div class="col-sm-6">
					<label>DNI</label><input disabled class="form-control texto-numero" type="text" name="dni" placeholder="DNI" value="<?php echo $_POST['dni']; ?>" pattern=".{7,8}" maxlength="8" required="true"></div>
				<div class="col-sm-6">
                   	<label>F. Nacimiento</label><input disabled class="form-control fecha" type="text" name="fecha_nacimiento" placeholder="Fecha de Nacimiento" value="<?php echo $_POST['fecha_nacimiento']; ?>" required="true"></div>
                   </div>
			</div>
			<div class="form-group">
				<div class="row">
				<div class="col-sm-4">
					<label>Teléfono Fijo</label><input disabled class="form-control texto-numero" type="text" name="telefono_fijo" placeholder="Teléfono Fijo" value="<?php echo $_POST['telefono_fijo']; ?>"></div>
				<div class="col-sm-4">
                    <label>Teléfono Celular</label><input disabled class="form-control texto-numero" type="text" name="telefono_celular" placeholder="Teléfono Celular" value="<?php echo $_POST['telefono_celular']; ?>"></div>
				<div class="col-sm-4">
					<label>E-Mail</label><input disabled class="form-control texto-mail" type="text" name="mail" placeholder="E-Mail" value="<?php echo $_POST['mail']; ?>" required="true"></div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-xs-12">
					<h3 align="center">Domicilio Particular</h3>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
				<div class="col-sm-4">
					<label>Calle</label><input disabled class="form-control texto-alfanumerico" type="text" name="domicilio_calle" placeholder="Calle" value="<?php echo $_POST['domicilio_calle']; ?>" required="true"></div>
				<div class="col-sm-4">
					<label>Altura</label><input disabled class="form-control texto-numero" type="text" name="domicilio_altura" placeholder="Altura" value="<?php echo $_POST['domicilio_altura']; ?>" required="true"></div>
				<div class="col-sm-4">
					<label>Piso</label><input disabled class="form-control texto-numero" type="text" name="domicilio_piso" placeholder="Piso" value="<?php echo $_POST['domicilio_piso']; ?>" required="true"></div>
				<div class="col-sm-4">
					<label>Departamento</label><input disabled class="form-control texto-alfanumerico" type="text" name="domicilio_depto" placeholder="Departamento" value="<?php echo $_POST['domicilio_depto']; ?>" required="true"></div>
				<div class="col-sm-4">
					<label>Barrio</label><input disabled class="form-control texto-alfanumerico" type="text" name="domicilio_barrio" placeholder="Barrio" value="<?php echo $_POST['domicilio_barrio']; ?>" required="true"></div>
				<div class="col-sm-4">
					<label>Manzana</label><input disabled class="form-control texto-alfanumerico" type="text" name="domicilio_manzana" placeholder="Manzana" value="<?php echo $_POST['domicilio_manzana']; ?>" required="true"></div>
				<div class="col-sm-6">
					<label>Localidad</label>
					<select disabled class="form-control loc" name="domicilio_localidad" style="width: 100%" required="true">
						<option value=""></option>
						<?php 
						$localidades = R::findAll("localidades");
						foreach($localidades AS $l) {
							echo "<option " . (strtoupper($_POST['domicilio_localidad']) == strtoupper($l["nombre"]) ? 'selected="true"' : '') . " value='{$l["nombre"]}'>{$l["nombre"]}</option>";
						}
						?>
					</select>
					<script>
						
                        $("*[name='domicilio_localidad']").select2({
                            placeholder: 'LOCALIDAD',
                            allowClear: true,
                            width: 'resolve',
                        })
					</script>
				</div>
				<div class="col-sm-6">
					<label>Provincia</label>
					<select disabled class="form-control" name="domicilio_provincia" style="width: 100%" required="true">
						<option value=""></option>
						<?php 
						$provincias = R::findAll("provincias");
						foreach($provincias AS $l) {
							echo "<option " . (strtoupper($_POST['domicilio_provincia']) == strtoupper($l["nombre"]) ? 'selected="true"' : '') . " value='{$l["nombre"]}'>{$l["nombre"]}</option>";
						}
						?>
					</select>
					<script>
						
                        $("*[name='domicilio_provincia']").select2({
                            placeholder: 'PROVINCIA',
                            allowClear: true,
                            width: 'resolve',
                        })
					</script>
				</div>
				<div class="col-sm-4">
					<label>Código Postal</label><input disabled class="form-control texto-cp" type="text" name="domicilio_cpa" placeholder="Código Postal" value="<?php echo $_POST['domicilio_cpa']; ?>" required="true"></div>
				</div>
			</div>
			<div class="row">
				<h3 align="center">Domicilio Laboral</h3>
			</div>
			<div class="form-group">
				<div class="row">
				<div class="col-sm-4">
					<label>Calle</label><input disabled class="form-control texto-alfanumerico" type="text" name="empleo_calle" placeholder="Calle" value="<?php echo $_POST['empleo_calle']; ?>" required="true"></div>
				<div class="col-sm-4">
					<label>Altura</label><input disabled class="form-control texto-numero" type="text" name="empleo_altura" placeholder="Altura" value="<?php echo $_POST['empleo_altura']; ?>" required="true"></div>
				<div class="col-sm-4">
					<label>Piso</label><input disabled class="form-control texto-numero" type="text" name="empleo_piso" placeholder="Piso" value="<?php echo $_POST['empleo_piso']; ?>" required="true"></div>
				<div class="col-sm-4">
					<label>Departamento</label><input disabled class="form-control texto-alfanumerico" type="text" name="empleo_depto" placeholder="Departamento" value="<?php echo $_POST['empleo_depto']; ?>" required="true"></div>
				<div class="col-sm-4">
					<label>Barrio</label><input disabled class="form-control texto-alfanumerico" type="text" name="empleo_barrio" placeholder="Barrio" value="<?php echo $_POST['empleo_barrio']; ?>" required="true"></div>
				<div class="col-sm-4">
					<label>Manzana</label><input disabled class="form-control texto-alfanumerico" type="text" name="empleo_manzana" placeholder="Manzana" value="<?php echo $_POST['empleo_manzana']; ?>" required="true"></div>
				<div class="col-sm-6" required="true">
					<label>Localidad</label>
					<select disabled class="form-control loc" name="empleo_localidad" style="width: 100%" required="true">
						<option value=""></option>
						<?php 
						$localidades = R::findAll("localidades");
						foreach($localidades AS $l) {
							echo "<option " . (strtoupper($_POST['empleo_localidad']) == strtoupper($l["nombre"]) ? 'selected="true"' : '') . " value='{$l["nombre"]}'>{$l["nombre"]}</option>";
						}
						?>
					</select>
					<script>
						
                        $("*[name='empleo_localidad']").select2({
                            placeholder: 'LOCALIDAD',
                            allowClear: true,
                            width: 'resolve',
                        })
					</script>
				</div>
				<div class="col-sm-6">
					<label>Provincia</label>
					<select disabled class="form-control" name="empleo_provincia" style="width: 100%" required="true">
						<option value=""></option>
						<?php 
						$provincias = R::findAll("provincias");
						foreach($provincias AS $l) {
							echo "<option " . (strtoupper($_POST['empleo_provincia']) == strtoupper($l["nombre"]) ? 'selected="true"' : '') . " value='{$l["nombre"]}'>{$l["nombre"]}</option>";
						}
						?>
					</select>
					<script>
						
                        $("*[name='empleo_provincia']").select2({
                            placeholder: 'PROVINCIA',
                            allowClear: true,
                            width: 'resolve',
                        })
					</script>
				</div>
				<div class="col-sm-4">
					<label>Código Postal</label><input disabled class="form-control texto-cp" type="text" name="empleo_cpa" placeholder="Código Postal" value="<?php echo $_POST['empleo_cpa']; ?>"></div>
				</div>
			</div>
			<div class="row">
				<h3 align="center">Referido</h3>
			</div>
			<div class="form-group">
				<div class="row">
				<div class="col-sm-3">
					<label>Nombre Completo</label>
					<input disabled class="form-control texto-letra" type="text" name="referido_nombre" placeholder="Nombre Completo" value="<?php echo $_POST['referido_nombre']; ?>" required="true"></div>
				<div class="col-sm-3">
					<label>Teléfono Fijo</label>
					<input disabled class="form-control texto-numero" type="text" name="referido_telefono_fijo" placeholder="Teléfono Fijo" value="<?php echo $_POST['referido_telefono_fijo']; ?>"></div>
				<div class="col-sm-3">
					<label>Teléfono Celular</label>
					<input disabled class="form-control texto-numero" type="text" name="referido_telefono_celular" placeholder="Teléfono Celular" value="<?php echo $_POST['referido_telefono_celular']; ?>"></div>
				<div class="col-sm-3">
					<label>Parentesco</label>
					<input disabled class="form-control texto-letra" type="text" name="referido_parentesco" placeholder="Parentesco" value="<?php echo $_POST['referido_parentesco']; ?>" required="true">
				</div>
			</div>
			</div>

			<div class="row">
				<h3 align="center">Empleo</h3>
			</div>
			<div class="form-group">
				<div class="row">
				<div class="col-sm-4">
					<label>Empresa</label><input disabled class="form-control" type="text" name="empleo_empresa" placeholder="Empresa texto-alfanumerico" value="<?php echo $_POST['empleo_empresa']; ?>" required="true"></div>
				<div class="col-sm-4">
					<label>Teléfono Fijo</label><input disabled class="form-control texto-numero" type="text" name="empleo_telefono" placeholder="Teléfono Fijo" value="<?php echo $_POST['empleo_telefono']; ?>" required="true"></div>
				<div class="col-sm-4">
					<label>Sueldo Neto</label><input disabled class="form-control texto-numero" type="text" name="empleo_sueldo" placeholder="Sueldo Neto" value="<?php echo $_POST['empleo_sueldo']; ?>" required="true"></div>
				</div>
			</div>
			<div class="row bottom-btns bottom-btns-3">
                <div class="btn-group">
                    <a href="<?php echo config::$ui_listar_clientes; ?>" style="padding-right: 10px" class="btn btn-primary btn-lg">CLIENTES</a>
                    <button type="button" style="margin: 0; padding-left: 10px; padding-right: 10px;" class="btn btn-warning btn-lg" onclick="$('input').removeAttr('disabled'); $(this).attr('disabled',true); $('select.loc').removeAttr('disabled',true);$('button[type=submit]').removeAttr('disabled')">EDITAR</button>
                    <button type="submit" disabled="disabled" style="margin: 0; padding-left: 10px" class="btn btn-success btn-lg" id="btn-guardar">GUARDAR</button>
                </div>
			</div>
			</form>
		</div>
	</div>
	<script>
		$(document).ready(function() {
	        
	        //$("#p2,#p3,#p4,#p5,#p6,#p7,#p8,#p9").hide();
	        fecha_datepicker();
	        $("body").on("focus",".has-error *",function() {
	            $(this).parent().removeClass("has-error");
	        });
	    });
		$('#btn-guardar').on('click',function(){
			console.log("D")
	    	if(validar()) {
	    	}
		})
	    function fecha_datepicker(){
	        $("*[name='fecha_nacimiento']").datepicker({
	            dateFormat: 'dd/mm/yy',
	            //prevText: '',
	            //nextText: '',
	            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
	            monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
	            dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
	            dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
	            dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
	            changeMonth: true,
	            changeYear: true,
	            yearRange: "-100:+0"
	        });
	    }
		function validar() {
	        var flag = 1;
	        $('*[required="true"]').each(function(){
	            if($(this).is(":visible")) {
	                if($(this).is(":invalid")) {
	                    flag = 0;
	                    $("html, body").animate({ scrollTop: 0 }, "slow");
	                    $(this).parent().addClass("has-error");
	                }
	            }
	        });
	        return flag;
	    }

   		function validarForm(){
    		if(validar()){
		        envio = {};
		        envio['apellido'] = $("*[name='apellido']").val();
		        envio['dni'] = $("*[name='dni']").val();
		        envio['domicilio_calle_altura'] = $("*[name='domicilio_calle_altura']").val();
		        envio['domicilio_cpa'] = $("*[name='domicilio_cpa']").val();
		        envio['domicilio_localidad'] = $("*[name='domicilio_localidad']").val();
		        envio['domicilio_piso_depto'] = $("*[name='domicilio_piso_depto']").val();
		        envio['domicilio_provincia'] = $("*[name='domicilio_provincia']").val();
		        envio['empleo_calle_altura'] = $("*[name='empleo_calle_altura']").val();
		        envio['empleo_cpa'] = $("*[name='empleo_cpa']").val();
		        envio['empleo_empresa'] = $("*[name='empleo_empresa']").val();
		        envio['empleo_localidad'] = $("*[name='empleo_localidad']").val();
		        envio['empleo_piso_depto'] = $("*[name='empleo_piso_depto']").val();
		        envio['empleo_provincia'] = $("*[name='empleo_provincia	|']").val();
		        envio['empleo_sueldo'] = $("*[name='empleo_sueldo']").val();
		        envio['empleo_telefono'] = $("*[name='empleo_telefono']").val();
		        envio['fecha_nacimiento'] = $("*[name='fecha_nacimiento']").val();;
		        envio['id'] = "";
		        envio['mail'] = $("*[name='mail']").val();
		        envio['nombre'] = $("*[name='nombre']").val();
		        envio['referido_nombre'] = $("*[name='referido_nombre']").val();
		        envio['referido_parentesco'] = $("*[name='referido_parentesco']").val();
		        envio['referido_telefono_celular'] = $("*[name='referido_telefono_celular']").val();
		        envio['referido_telefono_fijo'] = $("*[name='referido_telefono_fijo']").val();
		        envio['telefono_celular'] = $("*[name='telefono_celular']").val();
		        envio['telefono_fijo'] = $("*[name='telefono_fijo']").val();
		        document.getElementById("form").submit();
		       /* $('#guardar').prop('disabled',true);
		        send("guardarComercio",envio,function(msg){
		            if(msg.data["exito"]){
		                alert("cambios guardados exitosamente");
		            } else alert("ocurrio algo, reintente");
		        },function(msg){
		            window.msg = msg;
		            alert("ocurrio algo, revise su conexion y reintente");
		        });*/
		    } else {
		    	Lobibox.notify("error", {
                    size: 'mini',
                    title: 'Error',
                    msg: 'Faltan datos necesarios del cliente',
                    showClass: 'fadeInDown',
                    hideClass: 'fadeUpDown',
                    delay: 10000,
                    sound: false
                });
		    }
		}
	</script>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/litt/ui/comercio/footer.php'); ?>