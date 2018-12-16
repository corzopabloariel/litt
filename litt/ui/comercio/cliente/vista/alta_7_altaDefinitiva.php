	<?php
        include($_SERVER['DOCUMENT_ROOT'] . '/litt/ui/comercio/header.php');
        ?>
		<div class="container"> 
			<div class="panel-c">
				<div class="row">
					<div class="row panel-title">
						<div class="col-sm-3 "></div>
						<div class="col-sm-6" style="border-bottom: 2px solid #769FCD;margin-bottom:20px"><h2 align="center">Alta Definitiva</h2></div>
					</div>
					
                                    <div class="col-xs-12"><center> 	
                                            Al oprimir "imprimir formularios", se abrira en una nueva pestaña los enlaces a los documentos que 
                                            debe descargar, imprimir y firmar.<br> Para subirlos debe dirigirse al apartado de operaciones en el 
                                            menu "mis clientes".</center>
					<div class="bottom-btns">
						
                                        <form action="../../descargarPDF.php" method="POST" target="_blank">
                                            <?php 

                                            // tomo el id del credito y comienzo a traer los datos

                                            $id = $_GET['id_credito'];
                                            include_once($_SERVER['DOCUMENT_ROOT'] . '/litt/controller/basic.php');
                                            include_once($_SERVER['DOCUMENT_ROOT'] . '/litt/model/database.php');

                                            $c = R::findOne('credito_instancia','id LIKE ?',array($id));
                                            $p = R::findOne('clientes','dni LIKE ?', array($c['dni_cliente']));
                                                                                        $pp = R::findOne('planes','id LIKE ?',array($c['id_plan']));
                                            // var_dump($_POST);
                                            ?>
                                            <input type="hidden" name="id" value="<?php echo $id; ?>"> 
                                            <input type="hidden" name="tem" value="<?php echo round($pp['tna'] / (365/30),2); ?>"> 
                                            <input type="hidden" name="capital_aprobado" value="<?php echo $c['monto']; ?>"> 
                                            <input type="hidden" name="cantidad_cuotas" value="<?php echo $c['cuotas']; ?>"> 
                                            <input type="hidden" name="apellido" value="<?php echo $p['apellido']; ?>"> 
                                            <input type="hidden" name="nombre" value="<?php echo $p['nombre']; ?>"> 
                                            <input type="hidden" name="dni" value="<?php echo $p['dni']; ?>"> 
                                            <input type="hidden" name="fecha_nacimiento" value="<?php echo $p['fecha_nacimiento']; ?>"> 
                                            <input type="hidden" name="email" value="<?php echo $p['mail']; ?>"> 
                                            <input type="hidden" name="telefono_celular" value="<?php echo $p['telefono_celular']; ?>"> 
                                            <input type="hidden" name="telefono_fijo" value="<?php echo $p['telefono_fijo']; ?>"> 
                                            <input type="hidden" name="domicilio_calle" value="<?php echo $p['domicilio_calle_altura']; ?>">
                                            <input type="hidden" name="domicilio_altura" value="<?php echo "."; ?>">
                                            <input type="hidden" name="domicilio_barrio" value="<?php echo "."; ?>">
                                            <input type="hidden" name="domicilio_localidad" value="<?php echo $p['domicilio_localidad']; ?>">
                                            <input type="hidden" name="domicilio_provincia" value="<?php echo $p['domicilio_provincia']; ?>">
                                            <input type="hidden" name="domicilio_cp" value="<?php echo $p['domicilio_cpa']; ?>">
                                            <input type="hidden" name="domicilio_piso" value="<?php echo $p['domicilio_piso_depto']; ?>">
                                            <input type="hidden" name="domicilio_departamento" value="<?php echo ''; ?>">
                                            <input type="hidden" name="domicilio_manzana" value="<?php echo $p['']; ?>">
                                            <input type="hidden" name="laboral_empresa" value="<?php echo $p['empleo_empresa']; ?>">
                                            <input type="hidden" name="laboral_telefono" value="<?php echo $p['empleo_telefono']; ?>">
                                            <input type="hidden" name="laboral_sueldo" value="<?php echo $p['empleo_sueldo']; ?>">
                                            <input type="hidden" name="laboral_calle" value="<?php echo $p['empleo_calle_altura']; ?>">
                                            <input type="hidden" name="laboral_altura" value="<?php echo "."; ?>">
                                            <input type="hidden" name="laboral_piso" value="<?php echo $p['empleo_piso_depto']; ?>">
                                            <input type="hidden" name="laboral_departamento" value="<?php echo $p['empleo_piso_depto']; ?>">
                                            <input type="hidden" name="laboral_manzana" value="<?php echo "."; ?>">
                                            <input type="hidden" name="laboral_barrio" value="<?php echo "."; ?>">
                                            <input type="hidden" name="laboral_localidad" value="<?php echo $p['empleo_localidad']; ?>">
                                            <input type="hidden" name="laboral_provincia" value="<?php echo $p['empleo_provincia']; ?>">
                                            <input type="hidden" name="laboral_cp" value="<?php echo $p['empleo_cpa']; ?>">
                                            <input type="hidden" name="referencia1_nombre_apellido" value="<?php echo $p['referido_nombre']; ?>">
                                            <input type="hidden" name="referencia1_parentesco" value="<?php echo $p['referido_parentesco']; ?>">
                                            <input type="hidden" name="referencia1_telefono_fijo" value="<?php echo $p['referido_telefono_fijo']; ?>">
                                            <input type="hidden" name="referencia1_telefono_celular" value="<?php echo $p['referido_telefono_celular']; ?>">
                                            <input type="hidden" name="referencia2_nombre_apellido" value="">
                                            <input type="hidden" name="referencia2_parentesco" value="">
                                            <input type="hidden" name="referencia2_telefono_fijo" value="">
                                            <input type="hidden" name="referencia2_telefono_celular" value="">
                                            <input type="hidden" name="fecha" value="<?php echo $c['fecha_creacion']; ?>">
                                            <input type="hidden" name="numero_operacion" value="<?php echo $c['id']; ?>">
                                            <input type="hidden" name="capital_aprobado_letras" value="<?php $k = new NumberToLetterConverter(); echo $k->to_word($c['monto']); ?>">
                                            <!-- <input type="hidden" name="" value="<?php echo $p['']; ?>"> -->

                                            
                                            
                                            <button class="btn btn-primary btn-lg"><i class="fa fa-print fa-3x" aria-hidden="true"></i>
                                                
                                            <br> Imprimir Formularios </button>
                                        </form> 
					</div>
				</div>
				<div class="col-xs-12"> 	
					<div class="bottom-btns">
						<a href="<?php echo config::$ui_main_comercio; ?>" style="color: #FFFFFF;"><button class="btn btn-primary btn-lg"  type="button">Menu principal</button></a>
					</div>
				</div>
			</div>
		</div>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/litt/ui/comercio/footer.php'); ?>