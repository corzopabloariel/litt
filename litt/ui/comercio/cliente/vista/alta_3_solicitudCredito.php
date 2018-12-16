
	<?php
        include($_SERVER['DOCUMENT_ROOT'] . '/litt/ui/comercio/header.php');
        ?>
<div class="container"> 
	<div class="panel-b">
            <form class="login-form" action="../controlador/controller.php?guardarDatos1" method="POST" id="formulario">
			<div class="row panel-title">
				<div class="col-sm-3 "></div>
				<div class="col-sm-6" style="border-bottom: 2px solid #769FCD"><h2 align="center">
				Solicitud</h2></div>
			</div>


			<div class="col-xs-12"> <h3 align="center" style="font-weight: 600"><?php echo $_POST['dni']; ?></h3></div>
			<div class="col-xs-12"> <h3 align="center" style="font-weight: 600"><span> <?php echo $_POST['apellido'] . ', ' . $_POST['nombre']; ?></span></h3></div>
			<div class="col-xs-12"> <h3 align="center" style="font-weight: 600"><?php echo $_POST['fecha_nacimiento']; ?></span></h3></div>
                            <input type="hidden" name="dni" value="<?php echo $_POST['dni']; ?>">
			<div class="form-d">
  			<div class="col-xs-12">
  				<input class="form-control" type="text" name="telefono_fijo" placeholder="Telefono Fijo" value="<?php echo $_POST['telefono_fijo']; ?>">
  			</div>
			<div class="col-xs-12">
				<input class="form-control" type="text" name="telefono_celular" placeholder="Telefono celular" value="<?php echo $_POST['telefono_celular']; ?>">
			</div>
			<div class="col-xs-12">
				<input class="form-control" type="text" name="mail" placeholder=" Mail " value="<?php echo $_POST['mail']; ?>">
			</div>
			<div class="form-d">
				<div class="col-xs-6"><div class="margin-n10"><h3 align="right">PLAN</h3></div></div>
				<div class="col-xs-6"><div class="margin-n10"><select class="form-control" name="plan" id="plan">
                                            <?php
                                            if(isset($_SESSION['planes'])){
                                                foreach ($_SESSION['planes'] as $p)
                                                    echo "<option value='" . $p['id'] . "'>" . $p['designacion'] . "</option>";
                                                }
                                            ?>
                                            
                                        
                                        
                                        </select></div></div>
			</div>
			<div class="col-xs-6">
				<input class="form-control" type="text" name="monto" placeholder="Monto" id="monto" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
			</div>
			<div class="col-xs-6">
				<div class="col-xs-6">
					<div class="margin-n10">
						<h3 align="right">Cuotas</h3>
					</div>
				</div>
				<div class="col-xs-6">
					<div class="margin-n10">
                                            <select class="form-control" name="cuotas" id="cuotas">
                                                <option value="2">2</option>
                                                <option value="4">4</option>
                                                <option value="6">6</option>
                                                <option value="8">8</option>
                                                <option value="12">12</option>
                                            </select>
					</div>
				</div>
			</div>
			
                            
                            
			<div class="col-xs-12"><h3 class="t-centered" style="margin-top: 5px;">1er Vto: <span id="1er_vto">[VALOR NO DECLARADO]</span></h3></div>

			<div class="col-xs-12"><h3 class="t-centered" style="margin-top: 5px;">Valor Cuotas: $<span id="val_cuota">[VALOR NO DECLARADO]</span></h3></div>
			</div>

                            <script type="text/javascript">
                                <?php
                                    include_once($_SERVER['DOCUMENT_ROOT'] . '/litt/controller/basic.php');
                                    include_once($_SERVER['DOCUMENT_ROOT'] . '/litt/model/database.php');
                                ?>
                                planes = <?php echo json_encode(R::find("planes")); ?>;
                                $("#plan").on("change",function () { calcularCuota(); });
                                $("#monto").on("change",function () { calcularCuota(); });
                                $("#cuotas").on("change",function () { calcularCuota(); });
                                
                                function pmt(principal,tasaDeInteres,plazo){
                                    tasaDeInteres = tasaDeInteres / 100;
                                    return (principal/( (1- Math.pow(1+tasaDeInteres,-plazo)) / tasaDeInteres));
                                }
                                
                                function calcularCuota(){
                                    // encuentro el plan
                                    // voy a suponer que el n° de plan es la posicion
                                    plan_id = $("#plan").val();
                                    interes = planes[plan_id]["interes_porcuota"];
                                    tem = planes[plan_id]["tna"] / (365/30);
                                    monto = $("#monto").val();
                                    cuotas = $("#cuotas").val();
                                    // segun las correciones de christian, si el plan es == 2, vecimiento es hoy
                                    if(plan_id == 2)
                                        vencimiento = '<?php echo date("d/m/Y"); ?>';
                                    else 
                                        vencimiento = '<?php echo date("d/m/Y", strtotime("+1 month")); ?>';
                                    valor_cuota = pmt(monto,tem,cuotas);
                                    $("#1er_vto").text(vencimiento);
                                    $("#val_cuota").text(Math.round(valor_cuota));
                                }
                            </script>
                            
			<div class="row"> 	
				<div class="bottom-btns">
                                    <a href="<?php echo config::$ui_main_comercio; ?>" style="color: #FFFFFF;"><button class="btn btn-primary btn-lg" type="button">Cancelar</button></a>
					<input type="submit" class="btn btn-primary btn-lg">
				</div>
			</div>	
            </form>
                        
	</div>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/litt/ui/comercio/footer.php'); ?>