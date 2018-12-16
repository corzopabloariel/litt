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
include('./header.php');

function fecha($f) {
    $a = substr($f, 0,4);
    $m = substr($f, 4,2);
    $d = substr($f, 6,2);

    return $d."/".$m."/".$a;
}
//if(isset($_SESSION['id'])){
$user = R::getRow( 'SELECT c.razon_social,c.cuit,c.nombre_titular,c.dni_titular,c.mail,c.fecha_alta,CONCAT(c.domicilio_comercio_calle," ",c.domicilio_comercio_altura) AS "domicilio_comercial",CONCAT(c.domicilio_legal_calle," ",c.domicilio_legal_altura) AS "domicilio_legal",CONCAT(c.domicilio_real_calle," ",c.domicilio_real_altura) AS "domicilio_real",c.domicilio_comercio_localidad,c.domicilio_legal_localidad,c.domicilio_real_localidad,c.domicilio_comercio_provincia,c.domicilio_legal_provincia,c.domicilio_real_provincia,c.rubro,c.nombre FROM user AS u JOIN comercios AS c ON (u.id_comercio = c.id) WHERE u.id = :id', array(':id'=>$_SESSION["id"]) );
//}
$Arubros = Array(2 => "Animales y Mascotas","Arte y Cultura","Bebés","Belleza y Cuidado Personal","Automóviles","Hardware y Software Informático","Descargas","Moda y Complementos","Flores, Regalos y Artesanía","Alimentación y Bebidas","HiFi, Foto y Video","Hogar y Jardìn","Electrodomésticos","Joyería","Lencería y Adultos","mòviles y Telefonía","Servicios","Calzado y Complementos","Deporte y Ocio","Viajes y Turismo");

?>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="http://malsup.github.com/jquery.form.js"></script>
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
<style type="text/css" media="screen">
	header { z-index: 9 !important; }
	.select2-container--open .select2-dropdown--below { z-index: 99999999 !important; }
	.note-toolbar-wrapper.panel-default {
		height: auto !important;
	}
</style>
		<div class="container"> 
			<div class="panel-b col-md-8 col-md-offset-2 col-sm-12 col-sm-offset-0 col-xs-12">
				<div class="row panel-title">
                        <div class="col-sm-6 col-sm-offset-3" style="border-bottom: 2px solid #769FCD;margin-bottom:20px">
                         	<h2 align="center"><?php echo $user['razon_social']; ?></h2>
                        </div>
					<div class="col-sm-3"><img src="img/c-data.png"></div>
				</div>
				<div class="row u-data-panel" style="overflow-x: hidden;">
					<div class="row col-espacio-t">
						<div class="col-xs-12"><h3 align="center" style="float:none;"><?php echo $user["nombre"] ?></h3></div>
					</div>
					<div class="row col-espacio-t">
						<div class="col-xs-12 col-sm-6 text-center"><strong>CUIT</strong> </div><div class="col-xs-12 col-sm-6 text-center"><?php echo $user["cuit"] ?></div>
					</div>
					<div class="row col-espacio-t">
						<div class="col-xs-12 col-sm-6 text-center"><strong>Titular</strong> </div><div class="col-xs-12 col-sm-6 text-center"><?php echo $user["nombre_titular"] ?></div>
					</div>
					<div class="row col-espacio-t">
						<div class="col-xs-12 col-sm-6 text-center"><strong>DNI</strong> </div><div class="col-xs-12 col-sm-6 text-center"><?php echo $user["dni_titular"] ?></div>
					</div>
					<div class="row col-espacio-t">
						<div class="col-xs-12 col-sm-6 text-center"><strong>Mail</strong></div><div class="col-xs-12 col-sm-6 text-center"><?php echo $user["mail"] ?></div>
					</div>
					<div class="row col-espacio-t">
						<?php $l = R::findOne("localidades","id LIKE ?",array($user["domicilio_comercio_localidad"])) ?>
						<div class="col-xs-12 col-sm-6 text-center"><strong>Domicilio Comercial</strong></div><div class="col-xs-12 col-sm-6 text-center"><?php echo $user["domicilio_comercial"]." - ".$l["nombre"] ?></div>
					</div>
					<div class="row col-espacio-t">
						<?php $l = R::findOne("localidades","id LIKE ?",array($user["domicilio_legal_localidad"])) ?>
						<div class="col-xs-12 col-sm-6 text-center"><strong>Domicilio Legal</strong></div><div class="col-xs-12 col-sm-6 text-center"><?php echo $user["domicilio_legal"]." - ".$l["nombre"] ?></div>
					</div>
					<div class="row col-espacio-t">
						<?php $l = R::findOne("localidades","id LIKE ?",array($user["domicilio_real_localidad"])) ?>
						<div class="col-xs-12 col-sm-6 text-center"><strong>Domicilio Real</strong></div><div class="col-xs-12 col-sm-6 text-center"><?php echo $user["domicilio_real"]." - ".$l["nombre"] ?></div>
					</div>
					<div class="row col-espacio-t">
						<?php $p = R::findOne("provincias","id LIKE ?",array($user["domicilio_comercio_provincia"])) ?>
						<div class="col-xs-12 col-sm-6 text-center"><strong>Provincia</strong></div><div class="col-xs-12 col-sm-6 text-center"><?php echo $p["nombre"] ?></div>
					</div>
					<div class="row col-espacio-t">
						<?php $rubro = (isset($Arubros[$user["rubro"]]) ? $Arubros[$user["rubro"]] : '-'); ?>
						<div class="col-xs-12 col-sm-6 text-center"><strong>Rubro</strong> </div><div class="col-xs-12 col-sm-6 text-center"><?php echo $rubro ?></div>
					</div>
					<div class="row col-espacio-t">
						<div class="col-xs-12 col-sm-6 text-center"><strong>Fecha Alta</strong></div><div class="col-xs-12 col-sm-6 text-center"><?php echo fecha($user["fecha_alta"]) ?></div>
					</div>
				</div>
				<div class="bottom-btns">
					<div class="btn-group">
	                    <a href="<?php echo config::$ui_main_comercio; ?>" style="color: #FFFFFF;" class="btn btn-primary btn-lg">MENU</a>
						<button style="margin: 0" class="btn btn-warning btn-lg u-data-edit" data-toggle="modal" data-target="#modal-mail">EDITAR</button>
					</div>
				</div>
			</div>
		</div>
<div class="modal" id="modal-mail" tabindex="-1" role="dialog" aria-labelledby="modal-mail">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modificación de datos</h4>
      </div>
      <form action='ajax/cliente.php' method="post" enctype="multipart/form-data" id="form-enviar">
      <div class="modal-body">
      		<input type="hidden" name="accion" value="mail">
      		<input type="hidden" name="id_comercio" value="<?php echo $_SESSION["id_comercio"] ?>">
      	<div class="form-group">
		    <label for="datos">Datos</label>
		    <?php $Aelementos = Array("Nombre de Fantasía","Razón Social","CUIT","Nombre Titular","DNI", "Mail","Domicilio Comercial","Domicilio Legal","Domicilio Real","Provincia","Rubro") ?>
		    <select id="select_datos" name="datos_select[]" class="form-control" style="width: 100%" multiple required="true">
		    	<option value=""></option>
		    	<?php 
		    	foreach ($Aelementos as $e) {
		    		echo "<option>{$e}</option>";
		    	}
		    	?>
		    </select>
		    <script>
		    	$('#select_datos').select2({width: 'resolve',placeholder: 'Datos'});
		    </script>
		  </div>
	      <div class="form-group">
		    <label for="archivo">Adjunto</label>
	      	<input class="form-control" type="file" name="archivo" id="archivo" onchange="javascript:cambio();" />
	      </div>
      	<div class="form-group">
		    <label for="mensaje">Mensaje</label>
		    <textarea rows="10" name="mensaje" id="mensaje" class="form-control" placeholder="Mensaje" required="true"></textarea>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Enviar</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
	var formData;
	$("#form-enviar").ajaxForm({
		data: { data: formData }, 
		beforeSubmit: function() {
			$("#form-enviar *").attr("disabled",true);
			if(!validar()){
				$("#form-enviar *").removeAttr("disabled");
                return false;
		    }
	    },
	    success: function(msg) {
	    	//console.log(msg);
	    	//var done = JSON.parse(msg);

	    	Lobibox.notify('success', {
                size: 'mini',
                msg: 'El mensaje fue enviado con exito',
                showClass: 'fadeInDown',
                hideClass: 'fadeUpDown',
                delay: 10000,
                sound: false
            });
            $("#form-enviar *").removeAttr("disabled");
	    	$("#modal-mail").modal('hide');
	    	$('body').removeClass('modal-open');
			$('.modal-backdrop').remove();
			
	    },
		complete: function(xhr) {
			console.log(xhr)
			// some logic script goes here 
		}
	});
	/*$("#form-enviar").submit(function(e) {
		e.preventDefault();
		var datos = $("#select_datos").val();
		var formData = new FormData(this);
		console.log(datos[0]);
		for (var i = 0; i < datos.length; i++) {
		    formData.append('datos_select[]', datos[i]);
		}
		if(validar()) {
			$.ajax({
				url: 'ajax/cliente.php',
				data: formData,
				processData: false,
              	contentType: false,
              	type: 'POST',
              	dataType:'json',
		        success: function(result) {
		            console.log(result);
		        },
			}).done(function(data){
				console.log(data);
				//var done = JSON.parse(data);
			});
		}
		return false;
	});*/
	$(document).on("ready",function() {
		$('#mensaje').summernote({
			tabsize: 2,
			height:200,
        	toolbar: [
			    // [groupName, [list of button]]
			    ['style', ['bold', 'italic', 'underline', 'clear']],
			    ['font', ['strikethrough', 'superscript', 'subscript']],
			    ['fontsize', ['fontsize']],
			    ['color', ['color']],
			    ['para', ['ul', 'ol', 'paragraph']],
			    ['height', ['height']]
			]
		});

		$('#modal-mail').on('hidden.bs.modal', function (e) {
			$("#modal-mail").find("textarea").val("");
			$('#select_datos').val('').trigger('change');
			$("#archivo").val("");
		});
	});

	function cambio(){
	    var input = $("*[name='archivo']");
	    var type = input[0].files[0].type;
	    var size = input[0].files[0].size;
	    console.log(type)
	    if(type == "image/jpeg" || type == "image/jpg" || type == "text/plain") {
	        if(size < 2048000) {//2mb
	            
	        } else {
	            $("*[name='archivo']").val("");
	            Lobibox.notify('error', {
	                size: 'mini',
	                title: 'Error',
	                msg: 'El archivo supera el límite permitido',
	                showClass: 'fadeInDown',
	                hideClass: 'fadeUpDown',
	                delay: 10000,
	                sound: false
	            });
	        }
	    } else {
	        $("*[name='archivo']").val("");
	        Lobibox.notify('error', {
	            size: 'mini',
	            title: 'Error',
	            msg: 'Solo imágenes JPG o archivos TXT',
	            showClass: 'fadeInDown',
	            hideClass: 'fadeUpDown',
	            delay: 10000,
	            sound: false
	        });
	    }
	}

	function validar() {
        var flag = 1;
        $('*[required="true"]').each(function(){
            if($(this).is(":visible")) {
                if($(this).is(":invalid")) {
                    flag = 0;
                    $(this).parent().addClass("has-error");
                }
            }
        });
        return flag;
    }
</script>
</body>
</html>