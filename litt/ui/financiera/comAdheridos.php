<?php
$ARR_CSS = array();
$ARR_CSS[] = "/litt/ui/financiera/css/select2.min.css";
$ARR_CSS[] = "/litt/ui/financiera/css/messagebox.css";
$ARR_JS = array();
$ARR_JS[] = "/litt/ui/financiera/js/select2.js";
$ARR_JS[] = "/litt/ui/financiera/js/messagebox.js";
$ARR_JS[] = "/litt/ui/financiera/js/lobibox.js";
include('./header.php');
?>
<style type="text/css" media="screen">
	header { z-index: 9 !important; }
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
    td {
        vertical-align: middle !important;
    }
    .note-toolbar-wrapper.panel-default {
		height: auto !important;
	}
	.messagebox_overlay { z-index: 9999 !important; }
</style>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="http://malsup.github.com/jquery.form.js"></script>

<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
<div class="container"> 
    <div class="panel-a col-md-8 col-md-offset-2 col-sm-12 col-sm-offset-0 col-xs-10 col-xs-offset-1">
        <div class="row">
            <div class="row panel-title">
                <div class="col-sm-6 col-sm-offset-3 col-xs-12" style="border-bottom: 2px solid #769FCD;margin-bottom:20px"><h2 align="center">Comercios Adheridos</h2></div>
                <div class="col-sm-3 col-xs-12"><img src="img/comercio.png"></div>
            </div>
            <form action="comAdheridos.php" method="POST">
                <div class="row" style="padding-top: 10px">
                    <div class="col-sm-8 col-xs-12 col-espacio-b">
                        <select name="keyword" style="width: 100%">
                            <option value=""></option>
                            <?php 
                            $c = R::find("comercios");
                            foreach ($c as $comercio) {
                                if (isset($_POST['keyword']))
                                    echo "<option value='{$comercio["id"]}' " . ($_POST['keyword'] == $comercio["id"] ? 'selected' : '') . ">({$comercio["id"]}) {$comercio["nombre"]}</option>";
                                else
                                    echo "<option value='{$comercio["id"]}'>({$comercio["id"]}) {$comercio["nombre"]}</option>";
                            }
                            ?>
                        </select>
                        <script>
                            $("select[name='keyword']").select2({
                                placeholder: 'NRO O NOMBRE DE COMERCIO',
                                allowClear: true,
                                width: 'resolve',
                            })
                        </script>
                    </div>
                    <!-- <div class="col-sm-12 col-md-2"> <select class="form-control"> <option selected hidden disabled>Categoria</option> </select></div> -->
                    <div class="col-sm-4 col-xs-12">
                        <?php $Aestados = Array("2" => "Activo/Inactivo","1" => "Activo","0" => "Inactivo") ?>
                        <select class="form-control" name="activo" style="margin-top: 0px;">
                            <!-- <option selected hidden disabled>Estado</option> -->
                            <?php
                                foreach ($Aestados as $k => $value) {
                                    if (isset($_POST['activo']))
                                        echo "<option value='{$k}' " . ($_POST['activo'] == $k ? 'selected' : '') . ">{$value}</option>";
                                    else
                                        echo "<option value='{$k}'>{$value}</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <!-- <div class="col-sm-12 col-md-2"> <select class="form-control"> <option selected hidden disabled>Localidad</option> </select></div> -->
                </div>
                <div class="col-xs-12">
                    <div class="t-centered margin-v10">
                        <button class="btn btn-primary btn-md" style="font-size:18px; padding: 5px 35px"> Buscar </button>
                    </div>
                </div>
            </form>

            <div class="row">
            <div class="col-xs-12" style="overflow-x: auto; padding: 0">
                <table class="table" style="width:100%;">			
                    <tr style="font-weight: 600; background:#ccc;">
                        <td>Sel</td>
                        <td>Nº</td>
                        <td>Nombre</td>
                        <td>Creditos</td>
                        <td>Categorìa</td>
                        <td>Estado</td>
                        <td>Datos</td>
                        <td>Habilitacion</td>
                    </tr> 
                    <?php
                    //traigo todos los comercios
                    if (isset($_POST['keyword'])) {
                        // tomo siempre el valor del activo o inactivo
                        $activo = $_POST['activo'];
                        if (empty($_POST['keyword'])) {
                            if ($activo != 2)
                                $c = R::find("comercios", "estado LIKE ?", [$activo]);
                            else
                                $c = R::find("comercios");
                        } else {
                            $n = $_POST['keyword'];
                            if ($activo != 2)
                                $c = R::find("comercios", "id = ? AND estado = ?", Array($n, $activo));
                            else
                                $c = R::find("comercios", "id = ?", [$n]);
                        }
                    } else {
                        $c = R::findAll("comercios");
                    }
                    if (count($c) == 0) {
                        echo '<p class="text-center">No se encontraron comercios</p>';
                    } else {
                        foreach ($c as $e) {
                            ?>

                            <tr <?php if(!$e["habilitado"]){ ?>style="background-color: sandybrown;"<?php } ?>>
                                <td><input class="check" type="checkbox" style="margin-top: 0px;" value="<?php echo $e['id']; ?>"></input></td>
                                <td><?php echo $e['id']; ?></td>
                                <td><?php echo $e['nombre']; ?></td>
                                <td><?php echo R::count("credito_instancia", "id_comercio LIKE ?", array($e["id"])); ?></td>
                                <td><?php
                                    $x = R::getRow( 'SELECT designacion FROM categoria_comercio WHERE id = :id_categoria', array(':id_categoria'=>$e['id_categoria']) );
                                    echo $x["designacion"];
                                ?></td>
                                <td><?php 
                                    $estado = $e["estado"];
                                    if($estado == 0) echo "no activa";
                                    if($estado == 3) echo "no activa hoy";
                                    if($estado == 2) echo "semiactiva";
                                    if($estado == 1) echo "activa";
                                    ?>
                                </td>
                                <td><a target="_blank" href="/litt/ui/financiera/altaComFinal.php?id=<?php echo $e['id']; ?>" class='btn btn-default btn-xs'><i class='fas fa-eye'></i></a></td>
                                <td>
                                    <?php 
                                    if($e["habilitado"]){ ?>
                                        <a href="#" onclick="javascript:inhabilitar(<?php echo $e["id"]; ?>);">Inhabilitar</a>
                                    <?php }else{ ?>
                                        <a href="#" onclick="javascript:habilitar(<?php echo $e["id"]; ?>);">Habilitar</a>
                                    <?php } ?>
                                </td>
                            </tr>

                            <?php
                        }
                    }
                    ?>
                                                        <!--<tr>
                                                            <td><input type="checkbox" style="margin-top: 0px;"></input></td>
                                                            <td>01</td>
                                                            <td>Nadia Bs As</td>
                                                            <td>48</td>
                                                            <td>Excelente</td>
                                                            <td>Activa</td>
                                                            <td><a href="#">Ver</a></td>
                                                        </tr>-->
                </table>
            </div>
        </div>

            <div class="row"> 	
                <div class="bottom-btns text-center">
                    <a href="/litt/ui/financiera/menuPalLitt.php" class="btn btn-primary btn-lg">Volver</a>
                    <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#modal-mails">Plantillas de mail</button>
                    <button class="btn btn-primary btn-lg" onclick="enviarMensaje()">Enviar Mail</button>
                </div>
            </div>
        </div>
    </div>
<div class="modal" id="modal-mail" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Enviar mail</h4>
			</div>
			<div class="row" style="padding-top: 20px;">
				<div class="col-xs-12">
					<p class="text-center" id="comercios_cantidad">Comercio/s seleccionado/s <span>0</span></p>
					<div class="form-group">
						<label for="tipo_mensaje">Plantilla de mensaje</label>
						<select id="tipo_mensaje" class="form-control" style="width: 100%"></select>
					</div>
				</div>
			</div>
			<form action='../comercio/ajax/cliente.php' method="post" enctype="multipart/form-data" id="form-enviar">
				<input type="hidden" id="form-enviar-input" name="form-enviar-input" value="">
				<div class="modal-body">
					<input type="hidden" name="accion" value="mail-masivo">
					<div class="form-group">
						<label for="asunto">Asunto</label>
						<textarea rows="1" name="asunto" id="asunto" class="form-control" placeholder="Asunto" required="true"></textarea>
					</div>
					<div class="form-group">
						<label for="archivo">Adjunto</label>
						<input class="form-control" type="file" name="archivo" onchange="cambio();" />
						</div>
					<div class="form-group">
						<label for="mensaje">Mensaje</label>
						<textarea name="mensaje" id="mensaje" class="form-control" placeholder="Mensaje" required="true"></textarea>
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


<div class="modal" id="modal-mails" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Plantillas de mail</h4>
			</div>
			<div class="modal-body">
				<table class="table table-condensed">
					<thead>
						<tr>
							<th class="text-center">Contenido</th>
							<th class="text-center">Fecha de creación</th>
							<th></th>
						</tr>
					</thead>
					<tbody id="tabla-mails">
						<?php
						$mails = R::findAll("mails");
						foreach ($mails as $m) {
							echo "<tr>";
								echo "<td class='text-left'>{$m["contenido"]}</td>";
								echo "<td class='text-center'>{$m["autofecha"]}</td>";
								echo "<td class='text-center'><button data-accion='eliminar' class='btn btn-danger btn-xs' data-id='{$m["id"]}'><i class='far fa-trash-alt'></i></button> <button data-accion='editar' class='btn btn-warning btn-xs' data-id='{$m["id"]}'><i class='fas fa-pencil-alt'></i></button></td>";
							echo "</tr>";
						}
						?>
					</tbody>
				</table>
			</div>
			<hr/>
			<div class="row" style="padding-bottom: 10px">
				<div class="col-xs-12">
					<h3 style="margin:0; text-align: center;" onclick="toggleForm()" class="btn btn-info btn-lg btn-block">Nueva Plantilla</h3>
				</div>
			</div>
			<form action='ajax/cliente.php' onsubmit="event.preventDefault(); guardar_plantilla()" novalidate method="post" id="form-mails" hidden="true">
				<input type="hidden" id="mails-id" value="" />
				<div class="modal-body">
					<div class="form-group">
						<label for="mails-contenido">Contenido</label>
						<input type="text" id="mails-contenido" class="form-control texto-letra" name="mails-contenido" placeholder="Contenido" required="true"/>
					</div>
					<div class="form-group">
						<label for="mails-mensaje">Mensaje</label>
						<textarea name="mails-mensaje" id="mails-mensaje" class="form-control" placeholder="Mensaje" required="true"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button type="submit" id="btn-principal" class="btn btn-primary">Guardar</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
    $(document).ready(function() {
    	$("#tipo_mensaje").select2({width: 'resolve'});
    	$("#tipo_mensaje").change(function() {
    		var tipo = $(this).val();
    		var envio = {};
    		envio["id"] = tipo;
    		if(tipo == "") {
    			$('#mensaje').val("");
		        $('#mensaje').summernote('code', "");
    		} else {
	    		send("traerMail",envio,function(msg){
	    			if(msg.data["exito"]){
		            	$('#mensaje').val(msg.data["mensaje"]);
		            	$('#mensaje').summernote('code', msg.data["mensaje"]);
	                }
	    		});
	    	}
    	});
    	$('#mensaje,#mails-mensaje').summernote({
			dialogsInBody: true,
            tabsize: 2,
            height:200,
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                //['link', ['linkDialogShow', 'unlink']],
            ]
		});
		$("body").on("focus",".has-error *",function() {
            $(this).parent().removeClass("has-error");
        }).on("click","#modal-mails button[data-accion]",function() {
        	var accion = $(this).data("accion");
        	var id = $(this).data("id");

        	if(accion == "editar") {
        		$("#btn-principal").text("Editar");
        		$("#mails-id").val(id);
        		var envio = {};
        		envio["id"] = id;
        		send("traerMail",envio,function(msg){
        			if(msg.data["exito"]){
		            	$('#mails-mensaje').val(msg.data["mensaje"]);
		            	$('#mails-mensaje').summernote('code', msg.data["mensaje"]);
		            	$("#mails-contenido").val(msg.data["contenido"]);
	                }
	                if($('#form-mails').is(":hidden"))
            			$("#form-mails").toggle("fast");
        		});
        	} else {
        		if(id == $("#mails-id").val()) {
        			limpiarForm();
        		}
        		$.MessageBox({
                    buttonDone  : "Si",
                    buttonFail  : "No",
                    message     : "¿Esta seguro de eliminar la plantilla?"
                }).done(function(){
                	var envio = {};
	        		envio["id"] = id;
	        		send("eliminarMail",envio,function(msg){
	        			if(msg.data["exito"]){
			            	$("#tabla-mails").html(msg.data["plantillas"]);
		                }
	        		});
                });
        	}
        });

        $('#modal-mails').on('hide.bs.modal', function (e) {
			limpiarForm();
		});
		$("#modal-mail").on('show.bs.modal', function (e) {
			e = getCheckedBoxes("check");
			$("#comercios_cantidad").find("span").text(e.length);
			var input = "";
			for(i = 0; i < e.length; ++i) {
            	if(input != "") input += "-";
            	input += e[i].value;
			}
			$("#form-enviar-input").val(input);

			send("traerMails",null,function(msg){
	            if(msg.data["exito"]){
	                $("#tipo_mensaje").html(msg.data["plantillas"]);
                    $('#mensaje,input[type="archivo"]').val("");
                    $('#mensaje').summernote('code', "");
	            }
	        });
		});

		$("#form-enviar").ajaxForm({
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

			    $("#form-enviar-input").val("");
			    $('#mensaje').val("")
			    $('#mensaje').summernote('code', '');
			    $('#asunto').val("")
			    $('#archivo').val("")

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
    });
    function limpiarForm(toggle) {
    	$("#mails-id").val("");
        $("#mails-contenido").val("");
        $('#mails-mensaje').val("")
        $('#mails-mensaje').summernote('code', '');
		$("#btn-principal").text("Guardar");
		$('#form-mails').css({"display":"none"});
    }
    function toggleForm() {
    	if($('#form-mails').is(":visible")) {
    		$("#mails-id").val("");
            $("#mails-contenido").val("");
            $('#mails-mensaje').val("")
            $('#mails-mensaje').summernote('code', '');
    		if($("#btn-principal").text() == "Guardar") {
    			$('#form-mails').toggle('fast')
    		} else {
	    		$("#btn-principal").text("Guardar");
	        }
    	} else 
    		$('#form-mails').toggle('fast')
    }
    function habilitar(id){
        send("habilitar",{"id":id},function(msg){
            window.msg = msg;
            if(msg.data["exito"]){
                alert("habilitado correctamente");
                window.location.reload();
            } else alert("hubo un error, reintente");
        },function(msg){
            window.msg = msg;
            alert("hubo un error, reintente");
        });
    }
    
	function cambio(){
	    var input = $("input[type='file']");
	    var type = input[0].files[0].type;
	    var size = input[0].files[0].size;
	    console.log(type)
	    if(type == "image/jpeg" || type == "image/jpg" || type == "text/plain") {
	        if(size < 2048000) {//2mb
	            
	        } else {
	            $("input[type='file']").val("");
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
	        $("input[type='file']").val("");
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
    function inhabilitar(id){
        send("inhabilitar",{"id":id},function(msg){
            window.msg = msg;
            if(msg.data["exito"]){
                alert("inhabilitado correctamente");
                window.location.reload();
            } else alert("hubo un error, reintente");
        },function(msg){
            window.msg = msg;
            alert("hubo un error, reintente");
        });
    }
    function guardar_plantilla() {
    	if(validar()) {
    		envio = {};
    		envio["id"] = $("#mails-id").val();
    		envio["contenido"] = $("#mails-contenido").val();
    		envio["mensaje"] = $("#mails-mensaje").val();
    		envio["user"] = "<?php echo $_SESSION["id"] ?>";
    		send("crearMail",envio,function(msg){
                if(msg.data["exito"]){
                	$("#mails-id").val("");
                	$("#mails-contenido").val("");
                	$('#mails-mensaje').summernote('code', '');
                	$("#form-mails").toggle("fast");

                	$("#tabla-mails").html(msg.data["plantillas"]);
                }
            },function(msg){
                Lobibox.notify("error", {
                    size: 'mini',
                    title: 'Error',
                    msg: 'Hubo un error al intentar crear la plantilla, compruebe su conexión',
                    showClass: 'fadeInDown',
                    hideClass: 'fadeUpDown',
                    delay: 10000,
                    sound: false
                });
            });
    	}
    }
    function validar() {
        var flag = 1;
        $('*[required="true"]').each(function(){
            if($(this).is(":visible")) {
                if($(this).val() == "") {
                    flag = 0;
                    $(this).parent().addClass("has-error");
                }
            }
        });
        return flag;
    }
    function enviarMensaje(){
        e = getCheckedBoxes("check");
        if(e == null){
            Lobibox.notify("error", {
                size: 'mini',
                title: 'Error',
                msg: 'No se ha seleccionado ningún comercio',
                showClass: 'fadeInDown',
                hideClass: 'fadeUpDown',
                delay: 10000,
                sound: false
            });
            return false;
        }
        ids = [];
        for(i = 0; i < e.length; ++i)
            ids[i] = e[i].value;

        $("#modal-mail").modal("show")
        // muestro el alert
        /*msg = prompt("Ingrese el mensaje que desea enviar, si desea cancelar presione cancelar, o deje el mensaje vacio");
        if(msg== null || msg == ""){
            alert("mensaje cancelado por usuario");
        }else{
            envio = {};
            envio['mensaje'] = msg;
            envio['ids'] = [];
            for(i = 0; i < ids.length; ++i) envio['ids'][i] = ids[i];
            send("enviarMensaje",envio,function(msg){
                if(msg.data["exito"]){
                    alert("mensaje enviado correctamente");
                    window.retorno = msg.data["retorno"];
                }
            });
        }*/
    }

</script>


</body>
</html>