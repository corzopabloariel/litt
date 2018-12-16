<?php
include('./header.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];
}
else exit();

$path_base = "subidas/";
$extension = ".jpg";
$archivos = ["cuit","habilitacion","dni","contrato","anexo","adhesion"];
$elementos = [];
foreach($archivos as $k)
    $elementos[$k] = $path_base . $k . "_"; // "uploads/desarrollo_"


$c = R::findOne("comercios","id LIKE ?",[$id]);

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
<div class="panel-a col-md-8 col-md-offset-2 col-sm-12 col-sm-offset-0 col-xs-10 col-xs-offset-1">
    <form enctype="multipart/form-data" action="subirArchivos.php?id=<?php echo $id; ?>" method="POST">
			<div class="row panel-title">
				<div class="col-sm-6 col-sm-offset-3" style="border-bottom: 2px solid #769FCD;margin-bottom:20px">
                    <h2 align="center">Subir Archivos para<br/><b><?php echo $c['nombre']; ?></b></h2>
                </div>
			</div>
			<div class="text-center">
				<div class="row">
                    <div class="col-xs-12">
                        <p>Constancia de CUIT</p>
                        <span id="cuit">
                        <?php
                            if(file_exists($elementos["cuit"] . $id . ".jpg")){
                                echo "<a title='Descargar imagen' target='_blank' href='{$elementos["cuit"]}{$id}.jpg' download='cuit_{$id}.jpg' class='btn btn-success'><i class='far fa-file-image'></i></a>";
                            } else {
                                echo "<a class='btn btn-default' disabled><i class='far fa-file-image'></i></a>";
                            }
                        ?>
                        </span>
                        <label class="btn btn-default btn-file">
                            <i class="fas fa-upload"></i>
                            <input type="file" name="cuit" id="cuit_upload" onchange="javascript:cambio('cuit');" style="display: none">
                        </label>
                    </div>
				</div>
                <div class="row"><div class="col-xs-12"><hr/></div></div>
				<div class="row">
                    <div class="col-xs-12">
                        <p>Habilitación Municipal</p>
                        <span id="habilitacion">
                        <?php
                            if(file_exists($elementos["habilitacion"] . $id . ".jpg")){
                                echo "<a title='Descargar imagen' target='_blank' href='{$elementos["habilitacion"]}{$id}.jpg' download='habilitacion_{$id}.jpg' class='btn btn-success'><i class='far fa-file-image'></i></a>";
                            } else {
                                echo "<a class='btn btn-default' disabled><i class='far fa-file-image'></i></a>";
                            }
                        ?>
                        </span>
                        <label class="btn btn-default btn-file">
                            <i class="fas fa-upload"></i>
                            <input type="file" name="habilitacion" id="habilitacion_upload" onchange="javascript:cambio('habilitacion');" style="display: none">
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
                        <p>Contrato</p>
                        <span id="contrato">
                        <?php
                            if(file_exists($elementos["contrato"] . $id . ".jpg")){
                                echo "<a title='Descargar imagen' target='_blank' href='{$elementos["contrato"]}{$id}.jpg' download='contrato_{$id}.jpg' class='btn btn-success'><i class='far fa-file-image'></i></a>";
                            } else {
                                echo "<a class='btn btn-default' disabled><i class='far fa-file-image'></i></a>";
                            }
                        ?>
                        </span>
                        <label class="btn btn-default btn-file">
                            <i class="fas fa-upload"></i>
                            <input type="file" name="contrato" id="contrato_upload" onchange="javascript:cambio('contrato');" style="display: none">
                        </label>
                    </div>
				</div>
                <div class="row"><div class="col-xs-12"><hr/></div></div>
				<div class="row">
                    <div class="col-xs-12">
                        <p>Anexo Planes</p>
                        <span id="anexo">
                        <?php
                            if(file_exists($elementos["anexo"] . $id . ".jpg")){
                                echo "<a title='Descargar imagen' target='_blank' href='{$elementos["anexo"]}{$id}.jpg' download='anexo_{$id}.jpg' class='btn btn-success'><i class='far fa-file-image'></i></a>";
                            } else {
                                echo "<a class='btn btn-default' disabled><i class='far fa-file-image'></i></a>";
                            }
                        ?>
                        </span>
                        <label class="btn btn-default btn-file">
                            <i class="fas fa-upload"></i>
                            <input type="file" name="anexo" id="anexo_upload" onchange="javascript:cambio('anexo');" style="display: none">
                        </label>
                    </div>
				</div>
                <div class="row"><div class="col-xs-12"><hr/></div></div>
				<div class="row">
                    <div class="col-xs-12">
                        <p>Formulario de Adhesión</p>
                        <span id="adhesion">
                        <?php
                            if(file_exists($elementos["adhesion"] . $id . ".jpg")){
                                echo "<a title='Descargar imagen' target='_blank' href='{$elementos["adhesion"]}{$id}.jpg' download='adhesion_{$id}.jpg' class='btn btn-success'><i class='far fa-file-image'></i></a>";
                            } else {
                                echo "<a class='btn btn-default' disabled><i class='far fa-file-image'></i></a>";
                            }
                        ?>
                        </span>
                        <label class="btn btn-default btn-file">
                            <i class="fas fa-upload"></i>
                            <input type="file" name="adhesion" id="adhesion_upload" onchange="javascript:cambio('adhesion');" style="display: none">
                        </label>
                    </div>
                </div>
				<div class="row"> 	
					<div class="bottom-btns">
						<button class="btn btn-primary btn-lg" onclick="window.close();">Cerrar </button>
                        <button type="submit" class="btn btn-primary btn-lg" >Subir</button>
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
    
    /*
function camaraCarga(e){
 data = e.originalEvent.target.files[0];
  reader = new FileReader();
  reader.onload = function(evt){
  $('#imagen').attr('src',evt.target.result);
  reader.readAsDataUrl(data);
}}

$('#adhesion_camara').on('change', function(e){ camaraCarga(e); });
*/
<?php

// $archivos = ["solicitud","desarrollo","dni","servicio","sueldo"];

$recargar = false;
/*foreach($archivos as $k){
    $a = null;
    if(!isset($_FILES[$k]))
        continue; // si no existe ninguno, salto
    if(isset($_FILES[$k])){
        if($_FILES[$k]['size'] == 0) continue;
        if($_FILES[$k]['error'] == 0)
           $a = $_FILES[$k];
        else
            echo "alert('el archivo no se pudo subir, reintente'); ";
    }
    if($a != null){
        $ubicacion = $elementos[$k] . $id . $extension;
        if(move_uploaded_file($a['tmp_name'], $ubicacion )){
            $recargar = true;
            echo "alert('el archivo " . basename($a['name']) . " ha sido subido');";
            //echo "The file ".  basename( $a['name']). " has been uploaded like " . $ubicacion;
        }
        else
            echo "console.log('el archivo " . basename($a['name']) . " no se pudo subir, reintente');";
    }
}*/
$recargar = false;
foreach($archivos as $k) {
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
                //echo "The file ".  basename( $a['name']). " has been uploaded like " . $ubicacion;
            }
        }
    }
}
if($recargar) // si un archivo se cargo exitosamente, recargo la pagina
    echo "recargar()";
?>
</script>    
</body>
</html>
