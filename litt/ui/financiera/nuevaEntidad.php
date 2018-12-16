<?php
include('./header.php');
?>	
<div class="container1" style="padding: 80px 0"> 
    <div class="panel-b col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">

        <div class="row panel-title">
            <div class="col-sm-3"></div>
            <div class="col-sm-6" style="border-bottom: 2px solid #769FCD;margin-bottom:20px"><h2 align="center">Nuevo Entidad</h2></div>
            <div class="col-sm-3"></div>
        </div>

        <div class="row t-centered">
            <div class="col-xs-12">	<input class="form-control" type="text" name="denominacion"  placeholder="Denominacion" id="denominacion"></div>
            <div class="col-xs-12">	<input class="form-control" type="text" name="descripcion" placeholder="Descripcion" id="descripcion"></div>
        </div>	

        <div class="bottom-btns text-center">
            <a href="cajaFinanc.php" class="btn btn-primary btn-lg">Cancelar</a>
            <a class="btn btn-primary btn-lg" id="cargar">Crear Entidad</a>
            
        </div>	
    </div>
</div>

<script type="text/javascript">
    window.litt_consultar_abandonar = true;
    $("#cargar").on("click",function(){
        window.litt_denominacion = $("#denominacion").val();
        window.litt_descripcion = $("#descripcion").val();
        envio = {};
        envio["denominacion"] = window.litt_denominacion;
        envio["descripcion"] = window.litt_descripcion;
        send("nuevaEntidad",envio,function(msg){
            window.msg = msg;
            if(msg.data["exito"]){
                alert("Se ha creado la nueva entidad con el id " + msg.data["id_entidad"]);
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