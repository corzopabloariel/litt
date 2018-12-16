 
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
                                                                                    <form action="../../descargarPDF.php" method="POST" target="_blank">
                                            <?php 

                                            // tomo el id del credito y comienzo a traer los datos

                                            $id = $_GET['id_credito'];
                                            include_once($_SERVER['DOCUMENT_ROOT'] . '/litt/controller/basic.php');
                                            include_once($_SERVER['DOCUMENT_ROOT'] . '/litt/model/database.php');

                                            $c = R::findOne('credito_instancia','id LIKE ?',array($id));
                                            $p = R::findOne('clientes','dni LIKE ?', array($c['dni_cliente']));
                                            // var_dump($_POST);
                                            ?>
                                            <input type="hidden" name="id" value="<?php echo $id; ?>"> 
                                            <input type="hidden" name="capital_aprobado" value="<?php echo $c['monto']; ?>"> 
                                            <input type="hidden" name="cantidad_cuotas" value="<?php echo $c['cuotas']; ?>"> 
                                            <input type="hidden" name="apellido" value="<?php echo $p['apellido']; ?>"> 
                                            <input type="hidden" name="nombre" value="<?php echo $p['nombre']; ?>"> 
                                            <input type="hidden" name="dni" value="<?php echo $p['dni']; ?>"> 
                                            <input type="hidden" name="fecha_nacimiento" value="<?php echo $p['fecha_nacimiento']; ?>"> 
                                            <input type="hidden" name="email" value="<?php echo $p['mail']; ?>"> 
                                            <input type="hidden" name="telefono_celular" value="<?php echo $p['telefono_celular']; ?>"> 
                                            <input type="hidden" name="domicilio_calle" value="<?php echo $p['domicilio_calle_altura']; ?>">
                                            <input type="hidden" name="domicilio_altura" value="<?php echo "."; ?>">
                                            <input type="hidden" name="domicilio_barrio" value="<?php echo "."; ?>">
                                            <input type="hidden" name="domicilio_localidad" value="<?php echo $p['domicilio_localidad']; ?>">
                                            <input type="hidden" name="domicilio_provincia" value="<?php echo $p['domicilio_provincia']; ?>">
                                            <input type="hidden" name="domicilio_cp" value="<?php echo $p['domicilio_cpa']; ?>">
                                            <input type="hidden" name="domicilio_departamento" value="">
                                            <input type="hidden" name="domicilio_manzana" value="">
                                            <input type="hidden" name="laboral_empresa" value="">
                                            <input type="hidden" name="laboral_telefono" value="">
                                            <input type="hidden" name="laboral_sueldo" value="">
                                            <input type="hidden" name="laboral_calle" value="">
                                            <input type="hidden" name="laboral_altura" value="">
                                            <input type="hidden" name="laboral_piso" value="">

						<button class="btn btn-primary btn-lg"><i class="fa fa-print fa-5x" aria-hidden="true"></i>
							<br> Imprimir Formularios </button>
                                        </form>
					</div>
				</div>
				<div class="col-xs-12"> 	
					<div class="bottom-btns">
                                            <a href="<?php echo config::$ui_main_comercio; ?>" style="color: #FFFFFF;"><button class="btn btn-primary btn-lg"  type="button">Cancelar</button></a>
					</div>
				</div>
			</div>
		</div>

</body>
</html>