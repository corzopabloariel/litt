<?php include($_SERVER['DOCUMENT_ROOT'] . '/litt/ui/comercio/header.php'); ?>
    <form class="login-form" action="../controlador/controller.php?guardarDatos3" method="POST" id="formulario">
        <input type="hidden" name="id_credito" value="<?php echo $_POST['id_credito']; ?>">
		<div class="container"> 
			<div class="panel-b">
			<div class="row panel-title">
				<div class="col-sm-3 "></div>
				<div class="col-sm-6" style="border-bottom: 2px solid #769FCD;margin-bottom:20px"><h2 align="center">Domicilios</h2></div>
				<div class="col-sm-3"></div>
			</div>
			<div class="form-d">
				<h3 align="center">Domicilio Particular</h3>
				<div class="form-group col-xs-12">
                                        <input type="hidden" name="dni" value="<?php echo $_POST['dni']; ?>">
					<input class="form-control" type="text" placeholder="Calle y Numero" name="domicilio_calle_altura" value="<?php echo $_POST['domicilio_calle_altura']; ?>">
					<input class="form-control" type="text" placeholder="Piso,Depto,Barrio,Mnz" name="domicilio_piso_depto" value="<?php echo $_POST['domicilio_piso_depto']; ?>">
					<input class="form-control" type="text" placeholder="Codigo Postal" name="domicilio_cpa" value="<?php echo $_POST['domicilio_cpa']; ?>">
                                        <input class="form-control" type="text" placeholder="localidad" name="domicilio_localidad" value="<?php echo $_POST['domicilio_localidad']; ?>">
					<input class="form-control" type="text" placeholder="Provincia" name="domicilio_provincia" value="<?php echo $_POST['domicilio_provincia']; ?>">

				</div><br>
				<h3 align="center">Domicilio Laboral</h3>
				<div class="form-group col-xs-12">
					<input class="form-control" type="text" placeholder="Calle y Numero" name="empleo_calle_altura" value="<?php echo $_POST['empleo_calle_altura']; ?>">
					<input class="form-control" type="text" placeholder="Piso,Depto,Barrio,Mnz" name="empleo_piso_depto" value="<?php echo $_POST['empleo_piso_depto']; ?>">
					<input class="form-control" type="text" placeholder="Codigo Postal" name="empleo_cpa" value="<?php echo $_POST['empleo_cpa']; ?>">
					<input class="form-control" type="text" placeholder="localidad" name="empleo_localidad" value="<?php echo $_POST['empleo_localidad']; ?>">
                                        <input class="form-control" type="text" placeholder="Provincia" name="empleo_provincia" value="<?php echo $_POST['empleo_provincia']; ?>">
					<textarea placeholder="Observaciones" class="form-control" style="height:120px" name="observaciones"><?php echo $_POST['observaciones']; ?></textarea>
				</div>
				</div><br>
				<div class="bottom-btns">
					<a href="<?php echo config::$ui_main_comercio; ?>" style="color: #FFFFFF;"><button class="btn btn-primary btn-lg"  type="button">Cancelar</button></a>
					<input type="submit" class="btn btn-primary btn-lg next-btn">
				</div>
				
			</div>
		</div>
</form>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/litt/ui/comercio/footer.php'); ?>