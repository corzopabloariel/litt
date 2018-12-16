	<?php
        include($_SERVER['DOCUMENT_ROOT'] . '/litt/ui/comercio/header.php');
        ?>
    
	<div class="container"> 
		<div class="panel-b">
                    <form class="login-form" action="/litt/controller/reglas_aprobacion.php" method="POST" id="formulario">
			<div class="row panel-title"><div class="col-sm-3 "></div><div class="col-sm-6" style="border-bottom: 2px solid #769FCD"><h2 align="center">Nuevo Credito</h2></div><div class="col-sm-3"><img src="../../img/credito.png"></div></div>
			<div class="form-d">
				<div class="col-xs-12">
					<input class="form-control" type="text" name="dni"  placeholder="DNI" value="<?php echo $_POST['dni']; ?>">
				</div>
				<div class="col-xs-12">
					<input class="form-control" type="text" name="apellido" placeholder=" Apellido/s">
				</div>
				<div class="col-xs-12">
					<input class="form-control" type="text" name="nombre"  placeholder="Nombre/s">
				</div>
                                <div class="col-xs-12">
					<input class="form-control" type="text" name="fecha_nacimiento"  placeholder="Fecha de nacimiento (dd/mm/yyy)">
				</div>
                                <div class="col-xs-12">
					<input class="form-control" type="text" name="score"  placeholder="Score" value="<?php echo $_POST['score']; ?>">
				</div>
			</div>

			<div class="row"> 	
				<div class="bottom-btns">
                                    <a href="<?php echo config::$ui_main_comercio; ?>" style="color: #FFFFFF;"><button class="btn btn-primary btn-lg" type="button">Cancelar</button></a>
					<button class="btn btn-primary btn-lg" type="submit">Consultar</button>
				</div>
			</div>	
		</div>
	</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/litt/ui/comercio/footer.php'); ?>