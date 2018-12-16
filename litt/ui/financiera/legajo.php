<?php
include('./header.php');
if(isset($_GET['id'])){
    $id = $_GET['id'];
}
else exit();

$path_base = "/var/www/html/litt/ui/comercio/uploads/";
$extension = ".jpg";
$archivos = ["solicitud","desarrollo","dni","servicio","sueldo","terminos"];
$elementos = [];
foreach($archivos as $k)
    $elementos[$k] = $path_base . $k . "_"; // "uploads/desarrollo_"

$recargar_eliminar =false;
if(isset($_GET['eliminar'])){
    if(!unlink($path_base . $_GET['eliminar'] . "_" . $id . $extension))
        echo "Hubo un problema al eliminar";
    else $recargar_eliminar = true;
}

$c = R::findOne("credito_instancia","id LIKE ?",[$id]);
$cliente = R::findOne("clientes","dni LIKE ?",[$c["dni_cliente"]]);

//var_dump($_FILES);
if(isset($_FILES[$k])) {
    echo "<script>Lobibox.notify('success', {
                    size: 'mini',
                    msg: 'Archivos subidos. Espere',
                    showClass: 'fadeInDown',
                    hideClass: 'fadeUpDown',
                    onClick: function(){
                        window.location.href = window.location.href;
                    },
                    delay: false,
                    sound: false
                });</script>";
}
?>
<style type="text/css" media="screen">
    .panel-a .row {
        padding-top: 10px;
    }
</style>
<div class="container"> 
<div class="panel-a col-md-8 col-md-offset-2 col-sm-12 col-sm-offset-0 col-xs-10 col-xs-offset-1">
    <form enctype="multipart/form-data" action="legajo.php?id=<?php echo $id; ?>" method="POST">
			<div class="row panel-title">
				<div class="col-sm-6 col-sm-offset-3" style="border-bottom: 2px solid #769FCD;margin-bottom:20px">
                    <h2 align="center">Legajo de credito N° <?php echo $c["id"]; ?>, 
                        cliente <b><?php echo strtoupper($cliente["apellido"] . ", " . $cliente["nombre"]); ?></b></h2>
                </div>
			</div>
			<div class="" style="text-align: center !important;">
				<div class="row">
					<div class="col-xs-12">
                        <p>Solicitud de Crédito</p>
                        <span id="solicitud">
                        <?php
                            if(file_exists($elementos["solicitud"] . $id . ".jpg")){
                                echo "<a title='Descargar imagen' target='_blank' href='/litt/ui/comercio/uploads/solicitud_{$id}.jpg' download='solicitud_{$id}.jpg' class='btn btn-success'><i class='far fa-file-image'></i></a>";
                                ?> <a title="Eliminar imagen" class="btn btn-default btn-danger eliminar" href="?id=<?php echo $id; ?>&eliminar=solicitud"><i class="fas fa-trash"></i></a><?php
                            }else{
                                echo "<a class='btn btn-default' disabled><i class='far fa-file-image'></i></a>";
                            }
                        ?>
                        </span>
                        <label class="btn btn-default btn-file">
                            <i class="fas fa-upload"></i>
                            <input type="file" name="solicitud" id="solicitud_upload" onchange="javascript:cambio('solicitud');" style="display: none">
                        </label>
                    </div>
				</div>
                <div class="row"><div class="col-xs-12"><hr/></div></div>
				<div class="row">
					<div class="col-xs-12">
                        Desarrollo de Cuotas<br/>
                        <span id="desarrollo">
                        <?php
                            if(file_exists($elementos["desarrollo"] . $id . ".jpg")){
                                echo "<a title='Descargar imagen' target='_blank' href='/litt/ui/comercio/uploads/desarrollo_{$id}.jpg' download='desarrollo_{$id}.jpg' class='btn btn-success'><i class='far fa-file-image'></i></a>";
                                ?> <a title="Eliminar imagen" class="btn btn-default btn-danger eliminar" href="?id=<?php echo $id; ?>&eliminar=desarrollo"><i class="fas fa-trash"></i></a><?php
                            }else{
                                echo "<a class='btn btn-default' disabled><i class='far fa-file-image'></i></a>";
                            }
                        ?>
                        </span>
                        <label class="btn btn-default btn-file">
                            <i class="fas fa-upload"></i>
                            <input type="file" name="desarrollo" id="desarrollo_upload" onchange="javascript:cambio('desarrollo');" style="display: none">
                        </label>
                    </div>
				</div>
                <div class="row"><div class="col-xs-12"><hr/></div></div>
                <div class="row">
                    <div class="col-xs-12">
                        Términos y Condiciones<br/>
                        <span id="terminos">
                        <?php
                            if(file_exists($elementos["terminos"] . $id . ".jpg")){
                                echo "<a title='Descargar imagen' target='_blank' href='/litt/ui/comercio/uploads/terminos_{$id}.jpg' download='terminos_{$id}.jpg' class='btn btn-success'><i class='far fa-file-image'></i></a>";
                                ?> <a title="Eliminar imagen" class="btn btn-default btn-danger eliminar" href="?id=<?php echo $id; ?>&eliminar=terminos"><i class="fas fa-trash"></i></a><?php
                            }else{
                                echo "<a class='btn btn-default' disabled><i class='far fa-file-image'></i></a>";
                            }
                        ?>
                        </span>
                        <label class="btn btn-default btn-file">
                            <i class="fas fa-upload"></i>
                            <input type="file" name="terminos" id="terminos_upload" onchange="javascript:cambio('terminos');" style="display: none">
                        </label>
                    </div>
                </div>
                <div class="row"><div class="col-xs-12"><hr/></div></div>
				<div class="row">
                    <div class="col-xs-12">
                        DNI titular<br/>
                        <span id="dni">
                        <?php
                            if(file_exists($elementos["dni"] . $id . ".jpg")){
                                echo "<a title='Descargar imagen' target='_blank' href='/litt/ui/comercio/uploads/dni_{$id}.jpg' download='dni_{$id}.jpg' class='btn btn-success'><i class='far fa-file-image'></i></a>";
                                ?> <a title="Eliminar imagen" class="btn btn-default btn-danger eliminar" href="?id=<?php echo $id; ?>&eliminar=dni"><i class="fas fa-trash"></i></a><?php
                            }else{
                                echo "<a class='btn btn-default' disabled><i class='far fa-file-image'></i></a>";
                            }
                        ?>
                        </span>
                        <label class="btn btn-default btn-file">
                            <i class="fas fa-upload"></i>
                            <input type="file" name="dni" id="dni_upload" onchange="javascript:cambio('dni');" style="display: none">
                        </label>
                    </div>
	 			</div>
                <div class="row"><div class="col-xs-12"><hr/></div></div>
				<div class="row">
                    <div class="col-xs-12">
                        Servicio<br/>
                        <span id="servicio">
                        <?php
                            if(file_exists($elementos["servicio"] . $id . ".jpg")){
                                echo "<a title='Descargar imagen' target='_blank' href='/litt/ui/comercio/uploads/servicio_{$id}.jpg' download='servicio_{$id}.jpg' class='btn btn-success'><i class='far fa-file-image'></i></a>";
                                ?> <a title="Eliminar imagen" class="btn btn-default btn-danger eliminar" href="?id=<?php echo $id; ?>&eliminar=servicio"><i class="fas fa-trash"></i></a><?php
                            }else{
                                echo "<a class='btn btn-default' disabled><i class='far fa-file-image'></i></a>";
                            }
                        ?>
                        </span>
                        <label class="btn btn-default btn-file">
                            <i class="fas fa-upload"></i>
                            <input type="file" name="servicio" id="servicio_upload" onchange="javascript:cambio('servicio');" style="display: none">
                        </label>
                    </div>  
				</div>
                <div class="row"><div class="col-xs-12"><hr/></div></div>
				<div class="row">
                    <div class="col-xs-12">
                        Sueldo<br/>
                        <span id="sueldo">
                        <?php
                            if(file_exists($elementos["sueldo"] . $id . ".jpg")){
                                echo "<a title='Descargar imagen' target='_blank' href='/litt/ui/comercio/uploads/sueldo_{$id}.jpg' download='sueldo_{$id}.jpg' class='btn btn-success'><i class='far fa-file-image'></i></a>";
                                ?> <a title="Eliminar imagen" class="btn btn-default btn-danger eliminar" href="?id=<?php echo $id; ?>&eliminar=sueldo"><i class="fas fa-trash"></i></a><?php
                            }else{
                                echo "<a class='btn btn-default' disabled><i class='far fa-file-image'></i></a>";
                            }
                        ?>
                        </span>
                        <label class="btn btn-default btn-file">
                            <i class="fas fa-upload"></i>
                            <input type="file" name="sueldo" id="sueldo_upload" onchange="javascript:cambio('sueldo');" style="display: none">
                        </label>
                    </div>
				</div>
				<div class="row">	
					<div class="bottom-btns">
						<button class="btn btn-primary btn-lg" onclick="window.close();">Cancelar </button>
                        <button type="submit" class="btn btn-primary btn-lg" >Subir</button>
					</div>
				</div>
            </div>
        </form>
    </div>
<script>
    $(".eliminar").click(function(e) {
        e.preventDefault();
        var href = $(this).attr("href");
        eliminarConfirmacion("legajo.php"+href);
    })
function recargar() {
    setTimeout(function() {
        window.location.href = window.location.href;
    },10000);
}
function cambio(nombre){
    var input = $("*[name='"+nombre+"']");
    var type = input[0].files[0].type;
    var size = input[0].files[0].size;
    console.log(size)
    if(type == "image/jpeg" || type == "image/jpg") {
        if(size < 2048000) {//2mb
            if($("#" + nombre).find("a.btn.btn-success").length == 1) {
                $.MessageBox({
                    buttonDone  : "Si",
                    buttonFail  : "No",
                    message     : "Ya existe un archivo en el servidor para este campo.<br/>Si sube otro, se sobreescribirá el anterior, esta acción es irreversible.<br/>¿Está seguro de querer elegir un nuevo archivo para este campo?"
                }).done(function(){
                    $("#" + nombre).html("<span title='Marcado para subir' disabled class='btn btn-warning'><i class='fas fa-file-image'></i></span>");
                }).fail(function(){
                    $("*[name='"+nombre+"']").val("");

                });
            } else if(document.getElementById(nombre + "_upload").value != ""){
                $("#" + nombre).html("<span title='Marcado para subir' disabled class='btn btn-warning'><i class='fas fa-file-image'></i></span>");
            }
        } else {
            $("*[name='"+nombre+"']").val("");
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
        $("*[name='"+nombre+"']").val("");
        Lobibox.notify('error', {
            size: 'mini',
            title: 'Error',
            msg: 'Solo imágenes con extensión JPG',
            showClass: 'fadeInDown',
            hideClass: 'fadeUpDown',
            delay: 10000,
            sound: false
        });
    }
}

function eliminarConfirmacion(url){
    $.MessageBox({
        buttonDone  : "Si",
        buttonFail  : "No",
        message     : "¿Está seguro de desea eliminar este recurso?<br/>Esta acción no se podrá deshacer."
    }).done(function(){
        window.location.href = url;
    }).fail(function(){
    });
}
    
/*
function camaraCarga(e){
 data = e.originalEvent.target.files[0];
  reader = new FileReader();
  reader.onload = function(evt){
  $('#imagen').attr('src',evt.target.result);
  reader.readAsDataUrl(data);
}}

$('#adhesion_upload').on('change', function(e){ camaraCarga(e); });
**/
<?PHP

// $archivos = ["solicitud","desarrollo","dni","servicio","sueldo"];

$recargar = false;
foreach($archivos as $k){
    $a = null;
    if(!isset($_FILES[$k])) {
        continue; // si no existe ninguno, salto
    }

    if($_FILES[$k]['error'] == 0)
       $a = $_FILES[$k];
    elseif($_FILES[$k]['error'] == 0)
       $a = $_FILES[$k];
    if($a != null){
        if($a["type"] == "image/jpeg" || $a["type"] == "image/pjpeg") {
            $ubicacion = $elementos[$k] . $id . $extension;
            if(move_uploaded_file($a['tmp_name'], $ubicacion )){
                $recargar = true;
                /**/
                //echo "The file ".  basename( $a['name']). " has been uploaded like " . $ubicacion;
            } else {
                /*echo "Lobibox.notify('error', {
                    size: 'mini',
                    title: 'Error',
                    msg: 'El archivo " . basename($a['name']) . " no se pudo subir, reintente',
                    showClass: 'fadeInDown',
                    hideClass: 'fadeUpDown',
                    delay: false,
                    onClick: function(){
                        window.location.href = window.location.href;
                    },
                    sound: false
                });";*/
            }
        } else {
            /*echo "Lobibox.notify('error', {
                    size: 'mini',
                    title: 'Error',
                    msg: 'Solo imágenes con extensión JPG',
                    showClass: 'fadeInDown',
                    hideClass: 'fadeUpDown',
                    delay: 10000,
                    sound: false
                });";*/
        }
    }
}
if($recargar) // si un archivo se cargo exitosamente, recargo la pagina
    echo "recargar()";
elseif($recargar_eliminar)
    echo "window.location.href = 'legajo.php?id=" . $id . "'"; 
?>
</script>    
</body>
</html>