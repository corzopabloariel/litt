<?php
include('./header.php');
?>	
<div class="container1" style="padding: 80px 0"> 
    <div class="panel-b col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">

        <div class="row panel-title">
            <div class="col-sm-3"></div>
            <div class="col-sm-6" style="border-bottom: 2px solid #769FCD;margin-bottom:20px"><h2 align="center">Nuevo Tipo Movimiento</h2></div>
            <div class="col-sm-3"></div>
        </div>

        <div class="row t-centered">
            <div class="col-xs-12">	<input class="form-control" type="text" name=""  placeholder="Nombre" id="nombre"></div>    
            <div class="col-xs-12">
                <select class="form-control" id="padre">
                    <?php
                    $g = R::findAll("tipo_movimiento_padre");
                    foreach ($g as $gx) {
                        ?>
                        <option value="<?php echo $gx["id"]; ?>"><?php echo $gx["nombre"]; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div class="col-xs-12">	<input class="form-control" type="text" name="observaciones" placeholder="Observaciones" id="observaciones"></div>	
        </div>	

        <div class="bottom-btns text-center">
            <a href="cajaFinanc.php" class="btn btn-primary btn-lg">Cancelar</a>
            <a class="btn btn-primary btn-lg" id="cargar">Crear Tipo Movimiento</a>
            
        </div>	
    </div>
</div>

<script type="text/javascript">
    window.litt_consultar_abandonar = true;
    $("#cargar").on("click",function(){
        window.litt_nombre = $("#nombre").val();
        window.litt_padre = $("#padre").val();
        window.litt_observaciones = $("#observaciones").val();
        envio = {};
        envio["nombre"] = window.litt_nombre;
        envio["id_padre"] = window.litt_padre;
        envio["observaciones"] = window.litt_observaciones;
        send("nuevoTipoMovimiento",envio,function(msg){
            window.msg = msg;
            if(msg.data["exito"]){
                alert("Se ha creado el tipo de movimiento");
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