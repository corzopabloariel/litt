<?php
include('./header.php');
?>
<!-- Multiple Select -->
</script>
<div class="container"> 
	<div class="panel-b">

		<div class="row panel-title">
			<div class="col-sm-3"></div>
			<div class="col-sm-6" style="border-bottom: 2px solid #769FCD;margin-bottom:20px"><h2 align="center">Nuevo Grupo</h2></div>
			<div class="col-sm-3"></div>
		</div>
		<div class="row t-centered" style="width:80%">
			<div class="col-xs-12">	<input class="form-control" type="text" name="" placeholder="Nombre" id="nombre"></div>
		</div>
		
		<div class="bottom-btns">
			<a onclick="javascript:preguntarSalida('/litt/ui/financiera/menuPalLitt.php');">
                            <button class="btn btn-primary btn-lg">Salir</button>
                        </a>
			<button class="btn btn-primary btn-lg" id="cargar">Crear</button>
		</div>

			
		</div>	
		</div>
		</div>
		
<script type="text/javascript">
    window.litt_consultar_abandonar = true;
    $(document).ready(function(){
        
    });
    $("#cargar").on("click",function(){
        window.litt_nombre = $("#nombre").val();
        envio = {};
        envio["nombre"] = window.litt_nombre;
        send("nuevoGrupo",envio,function(msg){
            window.msg = msg;
            if(msg.data["exito"]){
                alert("Se ha creado el grupo exitosamente con el id " + msg.data["id_grupo"]);
                window.history.go(-1);
            } else alert("hubo un inconveniente, intente nuevamente");
        },function(msg){
            window.msg = msg;
            alert("hubo un inconveniente, intente nuevamente");
        });
    });
</script>
                
</body>
</html>
