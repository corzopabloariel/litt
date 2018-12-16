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
            <?php
        if(isset($_GET['estado'])){
            if($_GET['estado'] == 'aceptado'){
                
            ?>
		<div class="panel-c">
			<div class="row">
				<div class="col-xs-12"><div class="t-centered" style="width:20%"><img style="width:100%" src="img/marcar.png"></div></div>
				<div class="col-sm-3 "></div>
				<div class="col-sm-6" style="border-bottom: 2px solid #769FCD"><h2 align="center">Aprobado</h2></div>
				<div class="col-sm-3"></div>
				<div class="col-xs-12" style="text-align:center;">
					<h3><?php echo $_GET['dni']; ?></h3>
					<h3><?php echo $_GET['nombre']; ?></h3>
				</div>
				<div class="bottom-btns">
					<button class="btn btn-primary btn-lg">Cancelar</button>
                                        <a href="<?php echo config::$ui_main_comercio; ?>"><button class="btn btn-primary btn-lg">Siguiente</button></a>
				</div>
			</div>
		</div>
            <?php
            }
            else {
                if(isset($_GET['mensaje'])){
                    echo "<center><br><br><b>" . $_GET['mensaje'] . "</b></center>";
                }
            ?>
		<div class="panel-c">
                    
			<div class="row">
				<div class="col-xs-12"><div class="t-centered" style="width:20%"><img style="width:100%" src="img/anular.png"></div></div>
				<div class="col-sm-3 "></div>
				<div class="col-sm-6" style="border-bottom: 2px solid #769FCD"><h2 align="center">Rechazado</h2></div>
				<div class="col-sm-3"></div>
				<div class="col-xs-12" style="text-align:center;">
					<h3><?php echo $_GET['dni']; ?></h3>
					<h3><?php echo $_GET['nombre']; ?></h3>
				</div>
				<div class="bottom-btns">   
					<a href="<?php echo config::$ui_main_comercio; ?>"><button class="btn btn-primary btn-lg">Aceptar</button></a>
				</div>
			</div>
		</div>
            <?php
            }
        }
            ?>
	</div>
</body>
</html>
