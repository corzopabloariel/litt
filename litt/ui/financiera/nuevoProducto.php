<?php
include('./header.php');
?>
<style>
    input[type="text"] {
        text-transform: uppercase;
    }
</style>
	<div class="container container1"> 
		<div class="panel-b col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1">
			<div class="row panel-title">
				<div class="col-sm-6 col-sm-offset-3" style="border-bottom: 2px solid #769FCD;margin-bottom:20px"><h2 align="center">Nuevo Producto</h2></div>
			</div>
			<div class="row t-centered">
				<div class="col-xs-12">	<input class="form-control texto-letra" type="text" name=""  placeholder="Nombre" id="nombre"></div>
				<div class="col-xs-12">
                    <select name="plan" id="plan" class="form-control">
                    <?php
                    $planes = R::findAll("planes");
                    foreach ($planes as $p) {
                        echo "<option value='{$p["id"]}'>{$p["designacion"]}</option>";
                    }
                    ?>
                    </select>
                </div>
				<div class="col-xs-12">
                                    <select class="form-control" id="grupo">
                                        <?php
                                        $g = R::findAll("grupos");
                                        foreach($g as $gx){
                                            ?>
                                            <option value="<?php echo $gx["id"];?>"><?php echo $gx["nombre"];?></option>
                                        <?php 
                                        
                                        }
                                        ?>
                                    </select>
                                </div>
				<div class="col-xs-12">	<input class="form-control flotante texto-numero" type="tel" name="" placeholder="Monto Minimo" id="monto_minimo"></div>
				<div class="col-xs-12">	<input class="form-control flotante texto-numero" type="tel" name="" placeholder="Monto Máximo" id="monto_maximo"></div>
				<div class="col-xs-12">	<input class="form-control numerico texto-numero" type="tel" name="" placeholder="Plazo Mínimo" id="plazo_minimo"></div>
				<div class="col-xs-12">	<input class="form-control numerico texto-numero" type="tel" name="" placeholder="Plazo Máximo" id="plazo_maximo"></div>
                <div class="col-xs-12">	<input class="form-control flotante texto-numero" type="text" name="" placeholder="TNA" id="tna"></div>	
			</div>	
			
			<div class="bottom-btns text-center">
				<a href='/litt/ui/financiera/productos.php' class="btn btn-primary btn-lg">Cancelar</a>
				<button class="btn btn-primary btn-lg" id="cargar">Cargar</button>
                <button class="btn btn-primary btn-lg" id="crear_grupo">Nuevo Grupo </button>
			</div>	
		</div>
	</div>
        <div class="container container2" hidden> 
            <div class="panel-c col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1">
                    <div class="t-centered" style="width:40%; padding:20px"><img src="img/productos.png" width="100%"></div>
                    <span><h4 align="center"><strong>Se ha dado de alta el siguiente Producto:</strong></h4></span>
                            <div class="t-centered">
                                    <div class="row">
                                            <h5><strong>Nombre </strong><span id="s_nombre">Ce Dic16</span></h5>
                                    </div>
                                    <div class="row">
                                            <h5><strong>Plan </strong><span id="s_plan">Ce</span></h5>
                                    </div>
                                    <div class="row">
                                            <h5><strong>Grupo </strong><span id="s_grupo">1</span></h5>
                                    </div>
                                    <div class="row">
                                            <h5><strong>Monto Min </strong><span id="s_monto_minimo">200.00</span></h5>
                                    </div>
                                    <div class="row">
                                            <h5><strong>Monto Max </strong><span id="s_monto_maximo">2000.00</span></h5>
                                    </div>
                                    <div class="row">
                                            <h5><strong>Plazo Min </strong><span id="s_plazo_minimo">2</span></h5>
                                    </div>
                                    <div class="row">
                                            <h5><strong>Plazo Max </strong><span id="s_plazo_maximo">4</span></h5>
                                    </div>
                                    <div class="row">
                                            <h5><strong>TNA </strong><span id="s_tna">85%</span></h5>
                                    </div>
                                    <div class="bottom-btns">
                                        <a href='/litt/ui/financiera/menuPalLitt.php' class="btn btn-primary btn-lg">Salir</a>
                                    </div>
                            </div>
                    </div>	
            </div>
            
<script type="text/javascript">
    window.litt_consultar_abandonar = true;
    
    $("#crear_grupo").on("click",function(){
        window.location.href = "nuevoGrupo.php";
    });
    $("#cargar").on("click",function(){
        $("#cargar").attr("disabled","disabled");
        window.litt_nombre = $("#nombre").val();
        window.litt_plan = $("#plan").val();
        window.litt_grupo = $("#grupo").val();
        window.litt_monto_minimo = $("#monto_minimo").val();
        window.litt_monto_maximo = $("#monto_maximo").val();
        window.litt_plazo_minimo = $("#plazo_minimo").val();
        window.litt_plazo_maximo = $("#plazo_maximo").val();
        window.litt_tna = $("#tna").val();
        
        envio = {};
        envio["nombre"] = window.litt_nombre;
        envio["plan"] = window.litt_plan;
        envio["grupo"] = window.litt_grupo;
        envio["monto_minimo"] = window.litt_monto_minimo;
        envio["monto_maximo"] = window.litt_monto_maximo;
        envio["plazo_minimo"] = window.litt_plazo_minimo;
        envio["plazo_maximo"] = window.litt_plazo_maximo;
        envio["tna"] = window.litt_tna;
        console.log(envio)
        send("nuevoProducto",envio,function(msg){
            window.msg = msg;
            console.log(msg);
            if(msg.data["exito"]){
                $(".container1").hide();
                $("#s_nombre").text(window.litt_nombre);
                $("#s_plan").text(msg.data["plan_designacion"]);
                $("#s_grupo").text(window.litt_grupo);
                $("#s_monto_minimo").text(window.litt_monto_minimo);
                $("#s_monto_maximo").text(window.litt_monto_maximo);
                $("#s_plazo_minimo").text(window.litt_plazo_minimo);
                $("#s_plazo_maximo").text(window.litt_plazo_maximo);
                $("#s_tna").text(window.litt_tna);
                $(".container2").show();
            } else alert("hubo un error");
        },function(msg){
            alert("hubo un error, reintente");
            window.msg = msg;
        });
    });
    
</script>
            
</body>
</html>
