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
<!-- Multiple Select -->

<style>
    input[type="text"], select {
        text-transform: uppercase;
    }
</style>
<div class="container"> 
	<div class="panel-b col-md-8 col-md-offset-2 col-sm-12 col-sm-offset-0 col-xs-12">

		<div class="row panel-title">
			<div class="col-sm-3"></div>
			<div class="col-sm-6" style="border-bottom: 2px solid #769FCD;margin-bottom:20px"><h2 align="center">Nuevo Convenio</h2></div>
			<div class="col-sm-3"></div>
		</div>
            <div class="row">
    			<div class="col-xs-12">	<input class="form-control" type="text" name="" placeholder="Nombre" id="nombre"></div>
            </div>
            <div class="row" style="padding-top: 10px;">
    			<div class="col-xs-12">
                    <select class="js-example-basic-multiple js-states form-control" id="grupos" multiple="multiple" style="width: 100%">
                        <?php
                            $g = R::findAll("grupos");
                            foreach($g as $e)
                                echo "<option value='{$e["id"]}'>{$e["nombre"]}</option>";
                        ?>
                    </select>
                    <script>
                        $('#grupos').select2({width: 'resolve',placeholder: 'GRUPOS'});
                    </script>
                </div>
            </div>
            <div class="row">
    			<div class="col-xs-12">	<input class="form-control" type="text" name="" placeholder="% Comision" id="comision"></div>
            </div>
		
		
		<div class="bottom-btns">
			<a href="http://vps.riddle.com.ar/litt/ui/financiera/convenios.php" class="btn btn-primary btn-lg">Cancelar</a>
			<button class="btn btn-primary btn-lg" id="cargar">Cargar</button>
		</div>

			
		</div>	
		</div>
		</div>
		
<script type="text/javascript">
    window.litt_consultar_abandonar = true;
    $(document).ready(function(){
        
    });
    $("#cargar").on("click",function(){
        $("#cargar").attr("disabled","disabled");
        
        window.litt_nombre = $("#nombre").val();
        window.litt_comision = $("#comision").val();
        window.litt_grupos = $("#grupos").val();
        // los seleccionados
        
        if($("#nombre").val() != "" && $("#comision").val() != "" && $("#grupos").val() != null) {
            //window.litt_grupos = selectedValues;
            envio = {};
            envio["nombre"] = window.litt_nombre;
            envio["grupos"] = window.litt_grupos;
            envio["comision"] = window.litt_comision;
            send("nuevoConvenio",envio,function(msg){
                window.msg = msg;
                if(msg.data["exito"]){
                    window.location.href = "/litt/ui/financiera/convenios.php";
                } else {
                    Lobibox.notify("warning", {
                        size: 'mini',
                        title: 'Error',
                        msg: 'Hubo un inconveniente, intente nuevamente',
                        showClass: 'fadeInDown',
                        hideClass: 'fadeUpDown',
                        delay: 10000,
                        sound: false
                    });
                }
            },function(msg){
                window.msg = msg;
                Lobibox.notify("warning", {
                    size: 'mini',
                    title: 'Error',
                    msg: 'Hubo un inconveniente, intente nuevamente',
                    showClass: 'fadeInDown',
                    hideClass: 'fadeUpDown',
                    delay: 10000,
                    sound: false
                });
            });
        } else {
            Lobibox.notify("error", {
                size: 'mini',
                title: 'Error',
                msg: 'Todos los campos son necesarios',
                showClass: 'fadeInDown',
                hideClass: 'fadeUpDown',
                delay: 10000,
                sound: false
            });
        }
    });
</script>
                
</body>
</html>
