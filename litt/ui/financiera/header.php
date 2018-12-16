<?php
// include_once('/controller/basic.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/litt/controller/basic.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/litt/new/php/toolbox.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['user'])){
    header("Location: ../loginLitt.php");
    die();
}if(!validarUser([0,1,2])){
    header("Location: ../loginLitt.php");
    die();
}

$flag_modal = false;
if(isset($_POST["modal"])) {
    $flag_modal = true;
    unset($_POST["modal"]);
    foreach ($_POST as $nombre => $valor) {
        $config = R::findOne("configuraciones","variable LIKE ?",Array($nombre));
        $config["valor"] = $valor;
        R::store($config);
    }
}
?>

<!DOCTYPE html>

<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>LITT</title>
    
    <link rel="stylesheet" type="text/css" href="/litt/ui/comercio/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/litt/ui/comercio/css/fontawesome-all.css">
	<link rel="stylesheet" type="text/css" href="/litt/ui/comercio/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="/litt/ui/comercio/css/style.css">
    <link rel="stylesheet" type="text/css" href="/litt/ui/comercio/css/lobibox.css"/>
    <link rel="stylesheet" type="text/css" href="/litt/ui/financiera/css/messagebox.css">
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="/litt/ui/comercio/css/print.css" media="print" />

    <script type="text/javascript" src="/litt/ui/comercio/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/lobibox.js"></script>
    <script type="text/javascript" src="js/jquery-ui.js"></script>
    <script type="text/javascript" src="/litt/new/js/main.js"></script>
    <script type="text/javascript" src="/litt/new/js/toolbox.js"></script>
	<script type="text/javascript" src="/litt/ui/comercio/js/bootstrap.js"></script>
	<script type="text/javascript" src="/litt/ui/comercio/js/script.js"></script>
    <script type="text/javascript" src="/litt/ui/financiera/js/messagebox.js"></script>
    
        <?php if(isset($ARR_CSS)){
            foreach($ARR_CSS as $e){ ?>
            <link rel="stylesheet" type="text/css" href="<?php echo $e; ?>">
        <?php } } ?>
        <?php if(isset($ARR_JS)){
            foreach($ARR_JS as $e){ ?>
            <script type="text/javascript" src="<?php echo $e; ?>"></script>
        <?php } } ?>
    <style>
        a { text-decoration: none !important;/* scaffolding.less */}
        .user-config { float: right; margin: 24px 3% 6px 0; }
        .user-config i { font-size: 20px; cursor: pointer; }
    </style>
</head>
<body>

    <script type="text/javascript">
        function permite(e,letras) {
            var key = e.which,
                keye = e.keyCode,
                tecla = String.fromCharCode(key).toLowerCase();
            if (keye != 13) {
                if (letras.indexOf(tecla) == -1 && keye != 9 && (key == 37 || keye != 37) && (keye != 39 || key == 39) && keye != 8 && (keye != 46 || key == 46) || key == 161)
                    e.preventDefault();
            }
        }
        $(document).ready(function(){
            $(".texto-numero").on("keypress", function(e) { //----->SOLO NUMEROS
                permite(e,'0123456789');
            });
            $(".fecha").on("keypress", function(e) { //----->SOLO NUMEROS
                permite(e,'0123456789/');
            });
            $(".texto-alfanumerico").on("keypress", function(e) { //----->SOLO NUMEROS
                permite(e,'qwertyuiopasdfghjklñzxcvbnmáéíóú ,.-/()[]0123456789');
            });
            $(".texto-letra").on("keypress", function(e) { //----->SOLO NUMEROS
                permite(e,'qwertyuiopasdfghjklzxcvbnmñáéíóú ');
            });
            $(".texto-mail").on("keypress", function(e) { //----->SOLO NUMEROS
                permite(e,'qwertyuiopasdfghjklzxcvbnm._@');
            });
            $(".texto-cp").on("keypress", function(e) { //----->SOLO NUMEROS
                permite(e,'qwertyuiopasdfghjklzxcvbnm0123456789');
            });

            $("body").on("focus",".has-error *",function() {
                $(this).parent().removeClass("has-error");
            });
            
            <?php 
            if($flag_modal)
                echo "modal()";
            ?>
        })
        function cambiarClave_usuario() {
            $(".user-panel").toggle("fast");
            $.MessageBox({
                input    : {
                    clave : {
                        type    :   "text",
                        title   :   "Clave"
                    }
                },
                message  : "Ingrese la clave nueva",
            }).done(function(data){
                clave = data["clave"];

                if(clave == null || clave == ""){
                    Lobibox.notify("info", {
                        size: 'mini',
                        title: 'Info',
                        msg: 'Cancelado por el usuario',
                        delay: 5000,
                        sound: false,
                    });
                    return false;
                }
                send("cambiarClave",{
                    "id_usuario": <?php echo $_SESSION['id']; ?>,
                    "pass": clave
                },function(msg){
                    if(msg.data["exito"]){
                        Lobibox.notify("success", {
                            size: 'mini',
                            title: 'Info',
                            msg: 'Se ha cambiado correctamente la clave',
                            delay: 5000,
                            sound: false,
                        });
                    } else {
                        Lobibox.notify("info", {
                            size: 'mini',
                            title: 'Info',
                            msg: 'El usuario no esta registrado, probablemente se haya eliminado',
                            delay: 5000,
                            sound: false,
                        });
                    }
                },function(msg){
                    window.msg = msg;
                    Lobibox.notify("info", {
                        size: 'mini',
                        title: 'Info',
                        msg: 'Hubo un problema al procesar la peticion',
                        delay: 5000,
                        sound: false,
                    });
                });
            });
        }
        function verificarSalida() {
            var elements = document.getElementsByTagName('input');
            var flag = true;
            for (var i = 0, len = elements.length; i < len; ++i) {
                if(elements[i].value != "") {
                    flag = false;
                    break;
                }
            }
            if(flag) location.href = "menuPalLitt.php";
                else { if(confirm("¿Esta seguro de abandonar la pagina sin guardar?")) location.href = "menuPalLitt.php"; }
        }
        console.log(url_query_local);


        function cron() {
            $.ajax({
                url: 'periodicos_job.php',
            });
        }

        function log() {
            $.ajax({
                url: 'log.php',
            });
        }

        function validarForm() {
            if(validar())
                document.getElementById("modal-configuraciones-form").submit();
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
        function modal() {
            Lobibox.notify('success', {
                size: 'mini',
                msg: 'Datos LITT modificados',
                showClass: 'fadeInDown',
                hideClass: 'fadeUpDown',
                delay: 5000,
                sound: false
            });
        }
    </script>
<header>
    <div class="col-xs-3 col-sm-6 logo">
        <a href="/litt/ui/financiera/menuPalLitt.php">
        <!--<a onclick="verificarSalida()">-->
            <img src="/litt/ui/comercio/img/logo.png"/>
        </a>
    </div>
		<div class="col-xs-9 col-sm-6 user">
            <span class="user-name">
                <?php
                if(isset($_SESSION['user'])){
                    echo $_SESSION['user'];
                } else {?>
                    <script type="text/javascript">
                        window.location.href = "http://31.220.59.150/litt/ui/loginLitt.php";
                    </script>
                <?php exit(); }?>
                <i class="fa fa-caret-down user-options" aria-hidden="true"></i>
            </span>
            <span class="user-config"><i data-toggle="modal" data-target="#modal-configuraciones" class="fas fa-thumbtack" title="Configuraciones"></i></span>
        </div>
		<div class="user-panel">
			<span class="user-pass" onclick="cambiarClave_usuario();"><a style="cursor: pointer;">Cambiar Contraseña</a></span>
            <span class="logout"><a href="<?php echo config::$controller_login; ?>?logout">Cerrar Sesión</a></span>
        </div>
</header>
<div id="modal-configuraciones" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title">Configuraciones LITT</h5>
      </div>
      <form id="modal-configuraciones-form" novalidate method="post" onsubmit="event.preventDefault(); validarForm();">
          <div class="modal-body">
            <input type="hidden" name="modal" value="1">
            <?php 
            $configuraciones = R::findAll("configuraciones");
            foreach ($configuraciones as $config) {
                echo "<div class='form-group'>";
                    echo "<label for='{$config["variable"]}'>{$config["nombre"]}</label>";
                    echo "<input type='text' id='{$config["variable"]}' name='{$config["variable"]}' class='form-control' placeholder='{$config["nombre"]}' value='{$config["valor"]}' required='true'>";
                echo "</div>";
            }
            ?>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
      </form>
    </div>
  </div>
</div>
<?php

