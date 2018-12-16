<?php
include_once('../controller/basic.php');
include_once('../model/database.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?> 

<!DOCTYPE html>  
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title> 
	<link rel="stylesheet" type="text/css" href="comercio/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="comercio/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="comercio/css/style.css">
	<script type="text/javascript" src="comercio/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="comercio/js/bootstrap.js"></script>
</head>
<body>

	<div class="container">
		<div class="login-panel col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
			<div class="row">
				<span><img src="/litt/new/img/pluma.png"></span>
				<span><h2 align="center">Ingreso al sistema</h2></span>
                                <center><?php if(isset($_GET['fail'])){ echo "Usuario o clave incorrectos"; }
                                elseif(isset($_GET['comercio_inhabilitado'])){ echo "Comercio inhabilitado para operar"; }?></center>
			</div>
			<div class="row">
                            <form class="login-form" action="../controller/login.php" method="POST">
					<input class="form-control" type="text" name="user" placeholder="Usuario">
					<input class="form-control" type="password" name="pass" placeholder="Contraseña">
					<button type="submit" class="login-btn">Entrar</button>
					<label>
			            <input type="checkbox" value="">
			            <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
			            Recordarme
			        </label>
				</form>
				<span><a href="">¿Olvidó su contraseña?</a></span>
			</div>
		</div>
	</div>
</body>
</html>
