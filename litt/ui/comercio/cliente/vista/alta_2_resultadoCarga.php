<?php include($_SERVER['DOCUMENT_ROOT'] . '/litt/ui/comercio/header.php'); ?>
	<div class="container">
            <?php
        if(isset($_GET['estado'])){
            if($_GET['estado'] == 'aceptado'){
                
            ?>
		<div class="panel-c">
			<div class="row">
				<div class="col-xs-12"><div class="t-centered" style="width:20%"><img style="width:100%" src="../../img/marcar.png"></div></div>
				<div class="col-sm-3 "></div>
				<div class="col-sm-6" style="border-bottom: 2px solid #769FCD"><h2 align="center">Aprobado</h2></div>
				<div class="col-sm-3"></div>
				<div class="col-xs-12" style="text-align:center;">
					<h3><?php echo $_GET['dni']; ?></h3>
					<h3><?php echo $_GET['nombre']; ?></h3>
				</div>
				<div class="bottom-btns">
                                        <button class="btn btn-primary btn-lg"><a href="<?php echo config::$ui_main_comercio; ?>" style="color: #FFFFFF;">Cancelar</a></button>
                                        
                                        <form class="login-form" action="../controlador/controller.php?solicitudCredito" method="POST">

                                            <input type="hidden" name="dni" value="<?php echo $_GET['dni']; ?>"> 
                                            <input type="submit" class="btn btn-primary btn-lg">
                                        </form>
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
				<div class="col-xs-12"><div class="t-centered" style="width:20%"><img style="width:100%" src="../../img/anular.png"></div></div>
				<div class="col-sm-3 "></div>
				<div class="col-sm-6" style="border-bottom: 2px solid #769FCD"><h2 align="center">Rechazado</h2></div>
				<div class="col-sm-3"></div>
				<div class="col-xs-12" style="text-align:center;">
					<h3><?php echo $_GET['dni']; ?></h3>
					<h3><?php echo $_GET['nombre']; ?></h3>
				</div>
				<div class="bottom-btns">   
                                    <a href="<?php echo config::$ui_main_comercio; ?>" style="color: #FFFFFF;"><button class="btn btn-primary btn-lg" type="button">Aceptar</button></a>
				</div>
			</div>
		</div>
            <?php
            }
        }
            ?>
	</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/litt/ui/comercio/footer.php'); ?>