<?php include($_SERVER['DOCUMENT_ROOT'] . '/litt/ui/comercio/header.php'); ?>
	<div class="container"> 
		<div class="panel-a">

			<div class="row panel-title">
				<div class="col-sm-3 "></div>
				<div class="col-sm-6" style="border-bottom: 2px solid #769FCD;margin-bottom:20px"><h2 align="center">Clientes</h2></div>
				<div class="col-sm-3"></div>
			</div>

			<div class="row t-centered" style="width:80%"> 
				<div class="col-sm-3 col-xs-12"><input class="form-control" type="text" name="" placeholder="DNI"></div>
				<div class="col-sm-3 col-xs-12"><input class="form-control" type="text" name="" placeholder="Apellidos"></div>
				<div class="col-sm-3 col-xs-12"><input class="form-control" type="text" name="" placeholder="Nro. Clientes"></div>
				<div class="col-sm-3 col-xs-12"><select class="form-control"> <option disabled selected hidden>Modulo/s</option></select></div>
			</div>
			<div class="col-xs-12"><div class="t-centered row-input"><select class="form-control"> <option disabled selected hidden>Comercio</option></select></div></div>

			<div class="col-xs-12">
				<div class="t-centered margin-v10">
					<button class="btn btn-primary btn-md" style="font-size:18px; padding: 5px 35px">Buscar</button>
				</div>
			</div>
				
			<div class="col-xs-12" style="overflow-x: auto; padding:0 20px">
				<table class="table" style="font-size:13px">
					<tr style="font-weight: 600; background:#ccc;">
						<td>Nro Cliente</td><td>Nombre</td>
						<td>Canc</td> <td>Vig</td>
						<td>Modulo</td><td>Max atraso</td>
						<td>Datos</td>
					</tr>
                                        <?php
                                        
                                        $arr = $_SESSION['clientes'];
                                        
                                        foreach($arr as $c){
                                        
                                        ?>
                                        
					<tr>
						<td><?php echo $c['id']; ?></td>
						<td><?php echo $c['apellido'] . ', ' . $c['nombre']; ?></td>
						<td>X</td>
						<td><?php echo $c['credito_vigente']; ?></td>
						<td><?php echo $c['situacion_actual']; ?></td>
						<td><?php echo $c['atraso_historico']; ?></td>
						<td>
                                                    <label><a href="../controlador/controller.php?verCliente=<?php echo $c['dni']; ?> ">Ver</a>
					            <input type="checkbox" value="">
					            <span class="cr" style="float:right; margin-left: 10px"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
					        </label>
						</td>
					</tr>
                                        
                                        <?php
                                            }
                                        ?>
                                </table>
			</div>

			<div class="bottom-btns botom-btns3">
                            <button class="btn btn-primary btn-lg"><a href="<?php echo config_financiera::$ui_main_financiera; ?>" style="color: #FFFFFF;">Salir</a></button>
				<button class="btn btn-primary btn-lg">Ver operaciones</button>
				<button class="btn btn-primary btn-lg">Impresora</button>
			</div>


		</div>
		</div>	
		</div>
		</div>
		

</body>
</html>
