<?php
include('./header.php');
?>

	<div class="container1" style="padding: 80px 0"> 
		<div class="panel-b col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">

			<div class="row panel-title">
				<div class="col-sm-3"></div>
				<div class="col-sm-6" style="border-bottom: 2px solid #769FCD;margin-bottom:20px"><h2 align="center">Cargar Pago</h2></div>
				<div class="col-sm-3"></div>
			</div>
			 
			<div class="row t-centered">
                            <div class="col-xs-12">	<input class="form-control" type="text" name="fecha"  placeholder="Fecha" id="fecha" value="<?php echo date('d/m/Y'); ?>" disabled="disabled"></div>
				<div class="col-xs-12">
                                    <select class="form-control" id="ingreso_egreso">
                                        <option value="0">Egreso</option>
                                        <option value="1">Ingreso</option>
                                    </select>
                                </div>
                                <div class="col-xs-12">
                                    <select class="form-control" id="tipo_movimiento">
                                        <?php
                                        $g = R::findAll("tipo_movimiento","nombre NOT LIKE ?",Array("rendicion"));
                                        foreach($g as $gx){
                                            ?>
                                            <option value="<?php echo $gx["id"];?>"><?php echo $gx["nombre"];?></option>
                                        <?php 
                                        
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-xs-12">
                                    <select class="form-control" id="entidad">
                                        <?php
                                        $g = R::findAll("entidades");
                                        foreach($g as $gx){
                                            ?>
                                            <option value="<?php echo $gx["id"];?>"><?php echo $gx["denominacion"];?></option>
                                        <?php 
                                        
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-xs-12">
                                    <select class="form-control" id="tipo_comprobante">
                                        <?php
                                        $g = R::findAll("tipo_comprobante","nombre NOT LIKE ?",Array("RENDICION"));
                                        foreach($g as $gx){
                                            ?>
                                            <option value="<?php echo $gx["id"];?>"><?php echo $gx["nombre"];?></option>
                                        <?php 
                                        
                                        }
                                        ?>
                                    </select>
                                </div>
				<div class="col-xs-12">
                                    <input class="form-control flotante" type="text" name="" placeholder="Numero Comprobante" id="numero_comprobante">
                                </div>
                                <div class="col-xs-12">
                                    <input class="form-control flotante fecha" type="text" name="" placeholder="Fecha Comprobante" id="fecha_comprobante" readonly="readonly">
                                </div>
                                <!-- <div class="col-xs-12" style="padding-top: 10px;">Digitalizado de comprobante (opcional): 
                                    <label class="btn btn-primary btn-warning" aria-hidden="true" id="lbl-comprobante" style="float: right;"> Subir comprobante	
                                        <input type="file" name="desarrollo" id="file_comprobante" style="display:none;">
                                    </label>
                                    <label id="lbl_upx"></label>
				</div> -->
				<div class="col-xs-12">	<input class="form-control numerico" type="text" name="" placeholder="Monto" id="monto"></div>
                <div class="col-xs-12"> <input class="form-control" type="text" name="" placeholder="Observaciones" id="observaciones"></div>
                                <div class="col-xs-12">	<input class="form-control flotante" type="text" name="" placeholder="IVA" id="iva"></div>	
			</div>	
			
			<div class="bottom-btns text-center">
				<a href="cajaFinanc.php" class="btn btn-primary btn-lg">Cancelar</a>
				<a class="btn btn-primary btn-lg" id="cargar">Aceptar</a>
			</div>	
		</div>
	</div>

<script type="text/javascript">
    window.litt_consultar_abandonar = true;
    $("#cargar").on("click",function(){
        envio = {};
        envio["ingreso_egreso"] = $("#ingreso_egreso").val();
        envio["id_movimiento"] = $("#tipo_movimiento").val();
        envio["id_entidad"] = $("#entidad").val();
        envio["id_tipo_comprobante"] = $("#tipo_comprobante").val();
        envio["observaciones"] = $("#observaciones").val();
        envio["numero_comprobante"] = $("#numero_comprobante").val();
        envio["fecha_comprobante"] = fecha($("#fecha_comprobante").val());
        envio["monto"] = $("#monto").val();
        envio["iva"] = $("#iva").val();
        // envio["file_comprobante"] = $("#file_comprobante").prop("files");
        
        send("nuevoPago",envio,function(msg){
            window.msg = msg;
            if(msg.data["exito"]){
                alert("Se ingreso el pago exitoso");
                location.href = "cajaFinanc.php";
            } else alert("hubo un error");
        },function(msg){
            alert("hubo un error, reintente");
            window.msg = msg;
        });
    });
    function fecha(fecha) {
        var f = fecha.split("/");

        return f[2]+"/"+f[1]+"/"+f[0];
    }
    $(".fecha").datepicker({
        dateFormat: 'dd/mm/yy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
        dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
        changeMonth: true,
        changeYear: true
    });

    
</script>
            
</body>
</html>
