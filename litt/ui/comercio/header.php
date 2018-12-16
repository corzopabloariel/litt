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
}
if(!validarUser([0,3,4])){
    header("Location: ../loginLitt.php");
    die();
}
        

?>

<!DOCTYPE html>

<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>LITT :: Comercio</title>
    
    <link rel="stylesheet" type="text/css" href="/litt/ui/comercio/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="/litt/ui/comercio/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="/litt/ui/comercio/css/fontawesome-all.css">
	<link rel="stylesheet" type="text/css" href="/litt/ui/comercio/css/style.css">
    <link rel="stylesheet" type="text/css" href="/litt/ui/comercio/css/lobibox.css"/>
    <link rel="stylesheet" type="text/css" href="/litt/ui/financiera/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="/litt/ui/financiera/css/messagebox.css">
    
    <script type="text/javascript">
        history.pushState(null, null, document.URL);
        window.addEventListener('popstate', function () {
          history.pushState(null, null, document.URL);
        });
        const url_query_local = "/litt/new/php/concentrador.php";
    </script>
    <script type="text/javascript" src="/litt/ui/comercio/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/litt/ui/financiera/js/lobibox.js"></script>
    <script type="text/javascript" src="/litt/ui/financiera/js/jquery-ui.js"></script>
    <script type="text/javascript" src="/litt/ui/comercio/js/main.js"></script>
    <script type="text/javascript" src="/litt/new/js/toolbox.js"></script>
    <script type="text/javascript" src="/litt/ui/comercio/js/bootstrap.js"></script>
    <script type="text/javascript" src="/litt/ui/comercio/js/script.js"></script>
    
    <script src="/litt/ui/financiera/js/select2.js" type="text/javascript"></script>
        <?php if(isset($ARR_CSS)){
            foreach($ARR_CSS as $e){ ?>
            <link rel="stylesheet" type="text/css" href="<?php echo $e; ?>">
        <?php } } ?>
        <?php if(isset($ARR_JS)){
            foreach($ARR_JS as $e){ ?>
            <script type="text/javascript" src="<?php echo $e; ?>"></script>
        <?php } } ?>

    <style>
    .form-group .form-control {
            margin-bottom: 28px;
    }

    .data-cliente input {
            border:none;
            background: none;
            height:100%;
    }

    .data-cliente h4 {
            font-weight: 600;
    }
    </style>
    <script>
        $(document).ready(function(){
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
            })
        })
    </script>
</head>


<body>
    <script type="text/javascript" src="/litt/ui/financiera/js/messagebox.js"></script>
<script>
    function log() {
        $.ajax({
            url: 'log.php',
        });
    }
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
</script>
<header>
    <div class="col-xs-3 col-sm-6 logo">
        <a href="<?php echo config::$ui_main_comercio; ?>">
        <img src="/litt/ui/comercio/img/logo.png"/>
        </a>
    </div>
		<div class="col-xs-9 col-sm-6 user"><span class="user-name">
            <?php echo $_SESSION['user']; ?>
            <i class="fa fa-caret-down user-options" aria-hidden="true"></i></span></div>
		<div class="user-panel">
			<span class="user-pass"><a onclick="cambiarClave_usuario()" style="cursor: pointer;">Cambiar Contraseña</a></span>
            <span class="logout"><a href="<?php echo config::$controller_login; ?>?logout">Cerrar Sesión</a></span>
        </div>
</header>
<?php

