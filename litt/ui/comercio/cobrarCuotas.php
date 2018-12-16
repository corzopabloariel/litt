<?php
$ARR_CSS = array();
$ARR_CSS[] = "/litt/ui/financiera/css/select2.min.css";
$ARR_CSS[] = "/litt/ui/financiera/css/jquery-ui.css";
$ARR_CSS[] = "/litt/ui/financiera/css/messagebox.css";
$ARR_JS = array();
$ARR_JS[] = "/litt/ui/financiera/js/select2.js";
$ARR_JS[] = "/litt/ui/financiera/js/jquery-ui.js";
$ARR_JS[] = "/litt/ui/financiera/js/messagebox.js";
$ARR_JS[] = "/litt/ui/financiera/js/lobibox.js";
include('./header.php');



?>
<div class="container">
    <form action="cuotasAdeudadas.php" method="POST" id="form" onsubmit="event.preventDefault(); validarForm();">
		<div class="panel-b col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12">
			<div class="row panel-title">
				<div class="col-sm-6 col-sm-offset-3" style="border-bottom: 2px solid #769FCD"><h2 align="center">Cobrar Cuotas</h2></div>
				<div class="col-sm-3"><img src="img/cuotas.png"></div>
			</div>
            <div class="row">
			<div class="form-d">
				<div class="col-xs-12">
					<input class="form-control validar texto-numero" type="tel" name="dni" placeholder="DNI">
				</div>
				<div class="col-xs-12">
					<input class="form-control validar texto-numero" type="tel" name="n_op" placeholder="Numero Op">
				</div>
			</div>
            </div>
			<div class="row"> 	
				<div class="bottom-btns">
                    <div class="btn-group">
                        <a href="<?php echo config::$ui_main_comercio; ?>" style="color: #FFFFFF;" class="btn btn-primary btn-lg">MENU</a>
    					<button style="margin: 0" class="btn btn-success btn-lg">BUSCAR</button>
                    </div>
				</div>
			</div>	
		</div>
    </form>
</div>
	<script>
	
    function validarForm() {
        var flag = false; 
        var inputElements = document.getElementsByClassName('validar');
        for(var i=0; inputElements[i]; ++i){
              if(inputElements[i].value != ""){
                   flag = true;
                   break;
              }
        }
        if(flag) {
            document.getElementById("form").submit();
        } else {
            Lobibox.notify("error", {
                size: 'mini',
                title: 'Error',
                msg: 'Ingrese DNI o Nro de Operación',
                showClass: 'fadeInDown',
                hideClass: 'fadeUpDown',
                delay: 10000,
                sound: false
            });
        }
    }
	</script>
</body>
</html>