<?php
include_once('../../controller/basic.php');

?>

<!DOCTYPE html>

<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
</head>
<body>
	<?php
        include('./header.php');
        ?>
    
	<div class="container"> 
		<div class="panel-b">
                    <form class="login-form" action="../../controller/reglas_aprobacion.php" method="POST">
			<div class="row panel-title"><div class="col-sm-3 "></div><div class="col-sm-6" style="border-bottom: 2px solid #769FCD"><h2 align="center">Nuevo Credito</h2></div><div class="col-sm-3"><img src="img/credito.png"></div></div>
			<div class="form-d">
				<div class="col-xs-12">
					<input class="form-control" type="text" name="dni"  placeholder="DNI">
				</div>
				<div class="col-xs-12">
					<input class="form-control" type="text" name="apellido" placeholder=" Apellido/s">
				</div>
				<div class="col-xs-12">
					<input class="form-control" type="text" name="nombre"  placeholder="Nombre/s">
				</div>
                                <div class="col-xs-12">
					<input class="form-control" type="text" name="score"  placeholder="Score">
				</div>
			</div>

			<div class="row"> 	
				<div class="bottom-btns">
                                    <button class="btn btn-primary btn-lg"><a href="<?php echo config::$ui_main_comercio; ?>">Cancelar</a></button>
					<button class="btn btn-primary btn-lg" type="submit">Consultar</button>
				</div>
			</div>	
		</div>
	</div>
</body>
</html>