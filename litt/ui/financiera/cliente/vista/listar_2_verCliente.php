<?php include($_SERVER['DOCUMENT_ROOT'] . '/litt/ui/comercio/header.php'); ?>
<form class="login-form" action="../controlador/controller.php?guardarDatosModificados" method="POST">
	<div class="container"> 
		<div class="panel-a c-data-panel">

			<div class="row panel-title">
				<div class="col-sm-3 "></div>
				<div class="col-sm-6" style="border-bottom: 2px solid #769FCD;margin-bottom:20px"><h2 align="center">Datos Cliente</h2></div>
				<div class="col-sm-3"></div>
			</div>
			<div class="row data-cliente" align="center" style="padding-bottom:20px">
				<div class="col-sm-4 col-xs-12">
					<h4><input disabled type="text" name="" value="<?php echo $_POST['apellido'] . ', ' . $_POST['nombre']; ?>"></h4>
				</div>
				<div class="col-sm-4 col-xs-12">
					<div class="row"><h4><div class="col-xs-4" style="padding-top:11px;padding-right:0;text-align: right">DNI:</div><div class="col-xs-8"><input disabled type="text" name="" value="<?php echo $_POST['dni']; ?>" style="width:100%"></div></h4></div>
                                        <input type="hidden" name="dni" value="<?php echo $_POST['dni']; ?>">
				</div>
				<div class="col-sm-4 col-xs-12">
					<h4>Fecha Nac: <input disabled type="text" name="fecha_nacimiento" value="<?php echo $_POST['fecha_nacimiento']; ?>"></h4>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-4">
					<label>Teléfono Fijo</label><input disabled class="form-control" type="text" name="telefono_fijo" placeholder="Teléfono Fijo" value="<?php echo $_POST['telefono_fijo']; ?>"></div>
				<div class="col-sm-4">
                                    <label>Teléfono Celular</label><input disabled class="form-control" type="text" name="telefono_celular" placeholder="Teléfono Celular" value="<?php echo $_POST['telefono_celular']; ?>"></div>
				<div class="col-sm-4">
					<label>E-Mail</label><input disabled class="form-control" type="text" name="mail" placeholder="E-Mail" value="<?php echo $_POST['mail']; ?>"></div>
			</div>
			<div class="form-group">
				<h3 align="center">Domicilio Particular</h3>
				<div class="col-sm-4">
					<label>Calle Y Número</label><input disabled class="form-control" type="text" name="domicilio_calle_altura" placeholder="Calle y Número" value="<?php echo $_POST['domicilio_calle_altura']; ?>"></div>
				<div class="col-sm-4">
					<label>Piso, Depto, Barrio, Mnz</label><input disabled class="form-control" type="text" name="domicilio_piso_depto" placeholder="Piso, Depto, Barrio, Mnz" value="<?php echo $_POST['domicilio_piso_depto']; ?>"></div>
				<div class="col-sm-4">
					<label>Código Postal</label><input disabled class="form-control" type="text" name="domicilio_cpa" placeholder="Código Postal" value="<?php echo $_POST['domicilio_cpa']; ?>"></div>
				<div class="col-sm-6">
					<label>Localidad</label><input disabled class="form-control" type="text" name="domicilio_localidad" placeholder="Localidad" value="<?php echo $_POST['domicilio_localidad']; ?>"></div>
				<div class="col-sm-6">
					<label>Provincia</label><input disabled class="form-control" type="text" name="domicilio_provincia" placeholder="Provincia" value="<?php echo $_POST['domicilio_provincia']; ?>"></div>
			</div>
			<div class="form-group">
				<h3 align="center">Domicilio Laboral</h3>
				<div class="col-sm-4">
					<label>Calle y Número</label><input disabled class="form-control" type="text" name="empleo_calle_altura" placeholder="Calle y Número" value="<?php echo $_POST['empleo_calle_altura']; ?>"></div>
				<div class="col-sm-4">
					<label>Piso, Dpto, Barrio, Mnz</label><input disabled class="form-control" type="text" name="empleo_piso_depto" placeholder="Piso, Depto, Barrio, Mnz" value="<?php echo $_POST['empleo_piso_depto']; ?>"></div>
				<div class="col-sm-4">
					<label>Código Postal</label><input disabled class="form-control" type="text" name="empleo_cpa" placeholder="Código Postal" value="<?php echo $_POST['empleo_cpa']; ?>"></div>
				<div class="col-sm-6">
					<label>Localidad</label><input disabled class="form-control" type="text" name="empleo_localidad" placeholder="Localidad" value="<?php echo $_POST['empleo_localidad']; ?>"></div>
				<div class="col-sm-6">
					<label>Provincia</label><input disabled class="form-control" type="text" name="empleo_provincia" placeholder="Provincia" value="<?php echo $_POST['empleo_provincia']; ?>"></div>
			</div>
			<div class="form-group">
				<h3 align="center">Referido</h3>
				<div class="col-sm-3">
					<label>Nombre Completo</label>
					<input disabled class="form-control" type="text" name="referido_nombre" placeholder="Nombre Completo" value="<?php echo $_POST['referido_nombre']; ?>"></div>
				<div class="col-sm-3">
					<label>Teléfono Fijo</label>
					<input disabled class="form-control" type="text" name="referido_telefono_fijo" placeholder="Teléfono Fijo" value="<?php echo $_POST['referido_telefono_fijo']; ?>"></div>
				<div class="col-sm-3">
					<label>Teléfono Celular</label>
					<input disabled class="form-control" class="form-control" type="text" name="referido_telefono_celular" placeholder="Teléfono Celular" value="<?php echo $_POST['referido_telefono_celular']; ?>"></div>
				<div class="col-sm-3">
					<label>Parentesco</label>
					<input disabled class="form-control" type="text" name="referido_parentesco" placeholder="Parentesco" value="<?php echo $_POST['referido_parentesco']; ?>">
				</div>
			</div>
			<div class="form-group">
				<h3 align="center">Empleo</h3>
				<div class="col-sm-4">
					<label>Empresa</label><input disabled class="form-control" type="text" name="empleo_empresa" placeholder="Empresa" value="<?php echo $_POST['empleo_empresa']; ?>"></div>
				<div class="col-sm-4">
					<label>Teléfono Fijo</label><input disabled class="form-control" type="text" name="empleo_telefono" placeholder="Teléfono Fijo" value="<?php echo $_POST['empleo_telefono']; ?>"></div>
				<div class="col-sm-4">
					<label>Sueldo Neto</label><input disabled class="form-control" type="text" name="empleo_sueldo" placeholder="Sueldo Neto" value="<?php echo $_POST['empleo_sueldo']; ?>"></div>
			</div>
			<div class="form-group t-centered" style="width:33%">
				<div class="col-xs-12">
					<label>Producto Comprado</label>
					<input disabled class="form-control" type="text" name="" placeholder="Ej Suecos Block" value="ARRAY_PRODUCTOS">
				</div>
			</div>
			<div class="bottom-btns">
                            <a href="http://93.188.161.202/litt/ui/financiera/cliente/controlador/controller.php?listarClientes"><button type="button" class="btn btn-primary btn-lg exit-btn">Volver</button></a>
                            
                            <button type="button" class="btn btn-primary btn-lg c-data-edit edit-btn">Editar</button>
                                <input type="submit" class="btn btn-primary btn-lg" value="guardar">
                                <a href="http://93.188.161.202/litt/ui/financiera/cliente/controlador/controller.php?eliminar=<?php echo $_POST['dni']; ?>" style="color: #FFFFFF;"><button type="button" class="btn btn-primary btn-lg">Eliminar</button></a>
			</div>
		</div>
	</div>
		
</form>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/litt/ui/comercio/footer.php'); ?>