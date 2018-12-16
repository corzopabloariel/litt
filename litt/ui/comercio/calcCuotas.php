<?php
include('./header.php');



?>
<div class="container"> 
	<div class="panel-b col-md-8 col-md-offset-2 col-sm-12 col-sm-offset-0 col-xs-12">
            <form action="calcCuotas.php" method="POST" onsubmit="event.preventDefault(); validarForm();" novalidate id="form">
			<div class="row panel-title">
				<div class="col-sm-6 col-sm-offset-3" style="border-bottom: 2px solid #769FCD"><h2 align="center">Calcular Cuotas</h2></div>
				<div class="col-sm-3"><img src="img/calc.png"></div>
			</div>
                        
			<div class="form-d">
                <div class="row">
				<div class="col-xs-4 col-sm-5">
						<h3 align="right">PLAN</h3>
				</div>
				<div class="col-xs-8 col-sm-7">
					<select class="form-control" name="plan" id="plan"></select>
				</div>
            </div>
			</div>
            <div class="form-d">
                <div class="row">
    			<div class="col-xs-12 col-sm-6">
    				<input class="form-control texto-numero" type="number" required="true" name="monto" id="monto" placeholder="Monto" value="<?php if(isset($_POST['monto'])) echo $_POST['monto']; ?>">
    			</div>
    			<div class="col-xs-12 col-sm-6">
                    <div class="row">
    				<div class="col-xs-6">
    					<h3 align="right">Cuotas</h3>
    				</div>
    				<div class="col-xs-6">
                        <select class="form-control" name="cuotas" id="cuotas"></select>
    				</div>
                </div>
    			</div>
            </div>
            </div>
                <?php 
                
                function pmt2($principal,$tasaDeInteres,$plazo){
                    $tasaDeInteres = $tasaDeInteres / 100;
                    return ($principal/( (1- pow(1+$tasaDeInteres,-$plazo)) / $tasaDeInteres));
                }
                
                if(isset($_POST['cuotas']) and isset($_POST['monto']) and isset($_POST["plan"])){
                    
                    $cuotas = $_POST['cuotas'];
                    $monto = $_POST['monto'];
                    
                    
                    if($_POST['plan'] == 2)
                        $primer_vencimiento = date("d/m/Y");
                    else
                        $primer_vencimiento = date("d/m/Y", strtotime("+1 month"));
                    $p = R::findOne("planes","id LIKE ?",array($_POST["plan"]));
                    $interes = $p['tna']/(365/30); // el tna / (365/30)
                    $valor_cuota = pmt($monto,$interes,$cuotas);
                    // echo $monto . " - " . $cuotas . " - " . $interes;
                ?>
                        <div class= c"ol-xs-12"><h3 class="t-centered" style="margin-top: 5px;"">Monto crédito: $ <span><?php echo $monto; ?></span></h3></div>
			<div class="col-xs-12"><h3 class="t-centered" style="margin-top: 5px;"">1er Vto: <span><?php echo $primer_vencimiento; ?></span></h3></div>
			<div class="col-xs-12"><h3 class="t-centered" style="margin-top: 5px;">Valor Cuotas $ <span><?php echo round($valor_cuota,0); ?></span></h3></div>
                <?php 
                    
                }
                ?>
			<div class="bottom-btns text-center">
                <div class="btn-group">
                    <a href="<?php echo config::$ui_main_comercio; ?>" style="color: #FFFFFF;" class="btn btn-primary btn-lg">MENU</a>
                    <button style="margin:0" class="btn btn-success btn-lg">CALCULAR</button>
                </div>
			</div>
            </form>
	</div>
</div>
<script>
    $(document).ready(function() {
        f_cuotas();
        $("body").on("focus",".has-error *",function() {
            $(this).parent().removeClass("has-error");
        });
    });

    function validarForm() {
        var flag = 1;
        $('*[required="true"]').each(function(){
            if($(this).is(":visible")) {
                if($(this).is(":invalid")) {
                    flag = 0;
                    $(this).parent().addClass("has-error");
                }
            }
        });
        
        if(flag)
            document.getElementById("form").submit();
    }

    function devolverFechaDDMMYYYY(fecha){
        var dd = fecha.getDate();
        var mm = fecha.getMonth()+1; //January is 0!
        var yyyy = fecha.getFullYear();
        if(dd<10) dd='0'+dd;
        if(mm<10) mm='0'+mm;
        return dd+'/'+mm+'/'+yyyy;
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
        var today = new Date();
        if(plan_id == 2){
            vencimiento = devolverFechaDDMMYYYY(today);
        }
        else{
            vencimiento = devolverFechaDDMMYYYY(new Date(today.setMonth(today.getMonth() + 1)));
        }
        //valor_cuota = pmt(monto,tem,cuotas);
        //$("#1er_vto").text(vencimiento);
        //$("#val_cuota").text(Math.round(valor_cuota));
    }

    function f_cuotas(){
        var data = {};
        data.id_comercio = "<?php echo $_SESSION["id_comercio"]; ?>";
        send("getPlanes",data,function(msg){
            planes_get = msg.data.planes;
            productos_get = msg.data.productos;
            planes = [];
            productos = [];
            console.log(msg.data.pr)
            selector = $("#plan");
            for(i = 0; i < planes_get.length; i++){
                planes[planes_get[i].id] = planes_get[i];
                // lleno las opciones de cuota
                op = $('<option></option>');
                op.attr('value',planes_get[i]['id']);
                op.text(planes_get[i]['designacion']);
                selector.append(op);
            }
            var p_min = -1,p_max = -1;
            var m_min = 0,m_max = 0;
            for(i = 0; i < productos_get.length; i++){
                productos[productos_get[i].plan] = productos_get[i];
                if(p_min < 0) {//se selecciona el primer producto
                    p_min = productos_get[i].plazo_minimo
                    p_max = productos_get[i].plazo_maximo
                    m_min = productos_get[i].monto_minimo
                    m_max = productos_get[i].monto_maximo
                }
            }
            $("#monto").attr({'min': m_min, 'max' : m_max })
            $("#cuotas").html("");
            selector = $("#cuotas");
            for(i = p_min ; i <= p_max; i++) {
                op = $('<option></option>');
                op.attr('value',i);
                op.text(i);
                selector.append(op);
            }
        });
        
        $("#plan").on("change",function () {
            plan_id = $("#plan").val();
            console.log(productos[plan_id])
            p_min = productos[plan_id].plazo_minimo
            p_max = productos[plan_id].plazo_maximo
            m_min = productos[plan_id].monto_minimo
            m_max = productos[plan_id].monto_maximo
            
            //$("#monto").attr({'pattern': '.{'+m_min+','+m_max+'}'});
            $("#monto").attr({'min': m_min, 'max' : m_max })
            $("#cuotas").html("");
            selector = $("#cuotas");
            for(i = p_min ; i <= p_max; i++) {
                op = $('<option></option>');
                op.attr('value',i);
                op.text(i);
                selector.append(op);
            }
            calcularCuota();
        });
        $("#monto").on("change",function () { calcularCuota(); });
        $("#cuotas").on("change",function () { calcularCuota(); });
    }

</script>
</body>
</html>