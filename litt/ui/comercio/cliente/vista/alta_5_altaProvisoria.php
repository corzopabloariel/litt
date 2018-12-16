	<?php
        include($_SERVER['DOCUMENT_ROOT'] . '/litt/ui/comercio/header.php');
        ?>
		<div class="container"> 
			<div class="panel-c">
				<div class="row">
					<div class="row panel-title">
						<div class="col-sm-3 "></div>
						<div class="col-sm-6" style="border-bottom: 2px solid #769FCD;margin-bottom:20px"><h2 align="center">Alta Provisoria</h2></div>
					</div>
					<div class="form-d">
							<p align="center">Recuerde para liquidar el crédito debe ingresar los domicilios del cliente.</p>
					</div>
					
				<div class="col-xs-12"> 	
					<div class="bottom-btns">
						<button class="btn btn-primary btn-lg" onclick="javascript:alert('formularios otorgados por Litt');"><i class="fa fa-print fa-5x" aria-hidden="true"></i>
							<br> Imprimir Formularios </button>
					</div>
				</div>
				<div class="col-xs-12"> 	
					<div class="bottom-btns">
						<a href="<?php echo config::$ui_main_comercio; ?>" style="color: #FFFFFF;"><button class="btn btn-primary btn-lg"  type="button">Cancelar</button></a>
                                                <form class="login-form" action="../controlador/controller.php?guardarDatos1" method="POST">
                                                    <input type="hidden" name="dni" value="<?php echo $_POST['dni']; ?>">
                                                    <input type="submit" class="btn btn-primary btn-lg">
                                                </form>
                                                
                                                
					</div>
				</div>
			</div>
		</div>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/litt/ui/comercio/footer.php'); ?>