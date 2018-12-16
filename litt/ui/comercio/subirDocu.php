<?php
include('./header.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];
}
else exit();

$path_base = "uploads/";
$extension = ".jpg";
$archivos = ["solicitud","desarrollo","dni","servicio","sueldo","terminos"];
$elementos = [];
foreach($archivos as $k)
    $elementos[$k] = $path_base . $k . "_"; // "uploads/desarrollo_"

$referer = (isset($_SERVER['HTTP_REFERER'])) ? strtolower($_SERVER['HTTP_REFERER']) : "error";

$url = ($referer == "error" ? "" : $referer);


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
<div class="container"> 
<div class="panel-a col-md-6 col-md-offset-3 col-sm-12 col-sm-offset-0 col-xs-10 col-xs-offset-1">
	<div class="row panel-title">
		<div class="col-sm-10 col-sm-offset-1" style="border-bottom: 2px solid #769FCD;margin-bottom:20px">
            <?php $c = R::findOne("credito_instancia","id = ?",Array($id));$cliente = R::findOne("clientes","dni = ?",Array($c["dni_cliente"])) ?>
            <h2 align="center">Subir Documentación<br/>cliente <b><?php echo strtoupper($cliente["apellido"] . ", " . $cliente["nombre"]); ?></b></h2>
        </div>
	</div>
    <img id="imagen"/>
    <form enctype="multipart/form-data" action="subirDocu.php?id=<?php echo $id; ?>" method="POST">
	<div class="text-center">
        <div class="row">
            <div class="col-xs-12">
                <p>Solicitud de Crédito</p>
                <span id="solicitud">
                <?php
                    if(file_exists($elementos["solicitud"] . $id . ".jpg")){
                        echo "<a title='Descargar imagen' target='_blank' href='{$elementos["solicitud"]}{$id}.jpg' download='solicitud_{$id}.jpg' class='btn btn-success'><i class='far fa-file-image'></i></a>";
                    } else {
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
                <p>Desarrollo de Cuotas</p>
                <span id="desarrollo">
                <?php
                    if(file_exists($elementos["desarrollo"] . $id . ".jpg")){
                        echo "<a title='Descargar imagen' target='_blank' href='{$elementos["desarrollo"]}{$id}.jpg' download='desarrollo_{$id}.jpg' class='btn btn-success'><i class='far fa-file-image'></i></a>";
                    } else {
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
                <p>Términos y Condiciones</p>
                <span id="terminos">
                <?php
                    if(file_exists($elementos["terminos"] . $id . ".jpg")){
                        echo "<a title='Descargar imagen' target='_blank' href='{$elementos["terminos"]}{$id}.jpg' download='terminos_{$id}.jpg' class='btn btn-success'><i class='far fa-file-image'></i></a>";
                    } else {
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
                <p>DNI Titular</p>
                <span id="dni">
                <?php
                    if(file_exists($elementos["dni"] . $id . ".jpg")){
                        echo "<a title='Descargar imagen' target='_blank' href='{$elementos["dni"]}{$id}.jpg' download='dni_{$id}.jpg' class='btn btn-success'><i class='far fa-file-image'></i></a>";
                    } else {
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
                <p>Servicio</p>
                <span id="servicio">
                <?php
                    if(file_exists($elementos["servicio"] . $id . ".jpg")){
                        echo "<a title='Descargar imagen' target='_blank' href='{$elementos["servicio"]}{$id}.jpg' download='servicio_{$id}.jpg' class='btn btn-success'><i class='far fa-file-image'></i></a>";
                    } else {
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
                <p>Recibo de Sueldo</p>
                <span id="sueldo">
                <?php
                    if(file_exists($elementos["sueldo"] . $id . ".jpg")){
                        echo "<a title='Descargar imagen' target='_blank' href='{$elementos["sueldo"]}{$id}.jpg' download='sueldo_{$id}.jpg' class='btn btn-success'><i class='far fa-file-image'></i></a>";
                    } else {
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
                <div class="btn-group">
                    <?php if(strpos($url, "operaciones.php") === false) { ?>
                    <a class="btn btn-primary btn-lg" href="<?php echo config::$ui_main_comercio; ?>">MENU</a>
                    <?php } else { ?>
                    <a class="btn btn-danger btn-lg" onclick="window.close();">CERRAR</a>
                    <?php } ?>
                    <button type="submit" style="margin:0;" class="btn btn-success btn-lg">SUBIR</button>
                </div>
			</div>
		</div>	
	</div>
    </form>
</div>
    
<script>
function recargar() {
    setTimeout(function() {
        window.location.href = window.location.href;
    },10000);
}
$(document).ready( function() {
    $(document).on('change', ':file', function() {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
    });
    $(':file').on('fileselect', function(event, numFiles, label) {
        console.log(numFiles);
        console.log(label);
    });
});
function camaraCarga(e){
    console.log(e);
    console.log(e.target.id)
    //data = e.originalEvent.target.files[0];
    //console.log(data)
    //reader = new FileReader();
    //reader.onload = function(e){
    //$('#imagen').attr('src',evt.target.result);
    //reader.readAsDataUrl(data);
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

$('#solicitud_camara').on('change', function(e){ camaraCarga(e); });
$('#desarrollo_camara').on('change', function(e){ camaraCarga(e); });
$('#dni_camara').on('change', function(e){ camaraCarga(e); });
$('#servicio_camara').on('change', function(e){ camaraCarga(e); });
$('#sueldo_camara').on('change', function(e){ camaraCarga(e); });

<?PHP

// $archivos = ["solicitud","desarrollo","dni","servicio","sueldo"];

$recargar = false;
foreach($archivos as $k){
    $a = null;
    if(!isset($_FILES[$k]))
        continue;

    if($_FILES[$k]['error'] == 0)
       $a = $_FILES[$k];
    elseif($_FILES[$k]['error'] == 0)
       $a = $_FILES[$k];
    if($a != null){
        if($a["type"] == "image/jpeg" || $a["type"] == "image/pjpeg") {
            $ubicacion = $elementos[$k] . $id . $extension;
            if(move_uploaded_file($a['tmp_name'], $ubicacion )){
                $recargar = true;
                //echo "The file ".  basename( $a['name']). " has been uploaded like " . $ubicacion;
            }
        }
    }
}
echo "p = 'una variable';";
if($recargar) // si un archivo se cargo exitosamente, recargo la pagina
    echo "recargar()";
?>
</script>
<?php
// var_dump($_FILES['servicio_camara']);
/*
if(!empty($_FILES['servicio'])){
    // $path = $path . basename( $_FILES['solicitud']['name']);
    if(move_uploaded_file($_FILES['solicitud']['tmp_name'], $path_solicitud)) {
      echo "The file ".  basename( $_FILES['solicitud']['name']). 
      " has been uploaded";
    } else
        echo "There was an error uploading the file, please try again! 1";
  }elseif(!empty($_FILES['servicio_camara'])){
    $path = "uploads/";
    $path = $path . basename( $_FILES['cameraInput']['name']);
    if(move_uploaded_file($_FILES['cameraInput']['tmp_name'], $path_solicitud)) {
      echo "The file ".  basename( $_FILES['cameraInput']['name']). 
      " has been uploaded in cameraInput";
    } else
        echo "There was an error uploading the file, please try again! 2";
  } */
?>

</div></body></html>