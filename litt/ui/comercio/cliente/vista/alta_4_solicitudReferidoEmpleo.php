
	<?php
        include($_SERVER['DOCUMENT_ROOT'] . '/litt/ui/comercio/header.php');
        ?>
         <form class="login-form" action="../controlador/controller.php?guardarDatos2" method="POST" id="formulario">
		<div class="container"> 
			<div class="panel-b">
				<div class="form-d">
				<h3 align="center">Referido</h3>
				<div class="form-group col-xs-12">
                                    <input type="hidden" name="id_credito_instancia" value="<?php echo $_POST['id_credito_instancia']; ?>">
                                    <input type="hidden" name="dni" value="<?php echo $_POST['dni']; ?>">
					<input class="form-control" type="text" placeholder="Nombre Completo" name="referido_nombre" value="<?php echo $_POST['referido_nombre']; ?>">
					<input class="form-control" type="text" placeholder="Teléfono Fijo" name="referido_telefono_fijo" value="<?php echo $_POST['referido_telefono_fijo']; ?>">
					<input class="form-control" type="text" placeholder="Teléfono Celular" name="referido_telefono_celular" value="<?php echo $_POST['referido_telefono_celular']; ?>">
					<input class="form-control" type="text" placeholder="Parentesco" name="referido_parentesco" value="<?php echo $_POST['referido_parentesco']; ?>">
				</div><br>
				<h3 align="center">Empleo</h3>
				<div class="form-group col-xs-12">
					<input class="form-control" type="text" placeholder="Empresa" name="empleo_empresa" value="<?php echo $_POST['empleo_empresa']; ?>">
					<input class="form-control" type="text" placeholder="Teléfono Fijo" name="empleo_telefono" value="<?php echo $_POST['empleo_telefono']; ?>">
					<input class="form-control" type="text" placeholder="Sueldo Neto" name="empleo_sueldo" value="<?php echo $_POST['empleo_sueldo']; ?>">
				</div><br>
				<h3 align="center">Producto Comprado</h3>
				<div class="form-group col-xs-12">
					<input class="form-control" type="text" placeholder="Ej. Suecos Block" name="producto_designacion">
				</div>
				</div><br>
				<div class="bottom-btns">
					<a href="<?php echo config::$ui_main_comercio; ?>" style="color: #FFFFFF;"><button class="btn btn-primary btn-lg"  type="button">Cancelar</button></a>
                                        <input type="submit" class="btn btn-primary btn-lg next-btn">
				</div>
				<div class="bottom-btns">
                                    <input type="hidden" name="alta_provisoria" value="false" id="alta">
                                    <button class="btn btn-primary btn-lg" onclick="javascript:jQuery('#alta').val('true');">Alta Provisoria</button>
				</div>
			</div>
		</div>
         </form>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/litt/ui/comercio/footer.php'); ?>