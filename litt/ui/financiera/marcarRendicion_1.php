<?php
include('./header.php');

// es por comercio, me viene el id
if(!isset($_GET["id"]))
    exit();
else
    $id = $_GET["id"];


?>

<!----------------------------------------------------------------------------------------------------
######################################################################################################
##############################      MARCAR DETALLE PREVIO      #######################################
######################################################################################################
------------------------------------------------------------------------------------------------------>

<div class="container1"> 
    <div class="panel-a">
        <div class="row panel-title">
            <div class="col-sm-3 "></div>
            <div class="col-sm-6" style="border-bottom: 2px solid #769FCD;margin-bottom:20px"><h2 align="center">Detalle</h2></div>
            <div class="col-sm-3"></div>
        </div>
        <div class="row"><h4 align="center">Rendición # <span>4</span></h4></div>
        <span><h3 align="center">Créditos a Cobrar</h3></span>

        <table class="table" style="font-size:13px">
            <tr style="font-weight: 600; background:#ccc;">
                <td>Fecha</td>
                <td>Nro Op</td>
                <td>Monto</td>
                <td>Desc</td>
                <td>Neto</td>
            </tr>


            <tr>
                <td>19/12/16</td>
                <td>1046</td>
                <td>$<span>1560</span></td>
                <td>$<span>-78</span></td>
                <td>$<span>1428</span></td>
            </tr>
            <!-- <tr><td>20/12/16</td><td>1047</td><td>$<span>560</span></td><td>$<span>-28</span></td> <td>$<span>532</span></td></tr>
            <tr><td>22/12/16</td><td>1048</td><td>$<span>430</span></td><td>$<span>-21</span></td><td>$<span>408.5</span></td></tr> -->
        </table>
        <div>
            <h3 align="center" style="color:#3b86ca;font-weight:600">
                Total $<span id="total_creditos">2422.5</span>
            </h3>
        </div>


        <span> <h3 align="center">Cuotas A Pagar</h3></span> 
        <table class="table" style="font-size:13px">
            <tr style="font-weight: 600; background:#ccc;">
                <td>Fecha</td>
                <td>Nro Op</td>
                <td>Cuota</td>
                <td>Monto</td>
            </tr>

            <tr>
                <td>19/12/16</td>
                <td>1021</td>
                <td>3</td>
                <td>$<span>220.52</span></td>
            </tr>
            <!-- <tr><td>19/12/16</td><td>1029</td><td>3</td><td>$<span>262.67</span></td></tr>
            <tr><td>20/12/16</td><td>1034</td><td>2</td><td>$<span>266.18</span></td></tr>
            <tr><td>20/12/16</td><td>1035</td><td>2</td><td>$<span>162.64</span></td></tr>
            <tr><td>22/12/16</td><td>1042</td><td>1</td><td>$<span>505.34</span></td></tr> -->
        </table>
        <div>
            <h3 align="center" style="color:#3b86ca;font-weight:600">
                Total $<span id="total_cuotas">1417.35</span>
            </h3>
        </div>

        <span>
            <h3 align="center" style="color:green;font-weight:600">
                
            </h3>
        </span>

        <div style="width:40%;display:block;margin:0 auto">
            <input class="form-control" type="text" id="fecha_rendicion" placeholder="Fecha Rendición" readonly="readonly" value="<?php echo date("Ymd"); ?>">
        </div>

        <div class="bottom-btns">
            <button class="btn btn-primary btn-lg">Cancelar</button>
            <button class="btn btn-primary btn-lg" id="btn-siguiente">Siguiente</button>
        </div>

    </div>
</div>

<!----------------------------------------------------------------------------------------------------
######################################################################################################
###############################      MARCAR DEFINITIVO      ##########################################
######################################################################################################
------------------------------------------------------------------------------------------------------>

<div class="container2" hidden> 
    <div class="panel-b">
        <div class="row panel-title">
            <div class="col-sm-3 "></div>
            <div class="col-sm-6" style="border-bottom: 2px solid #769FCD;margin-bottom:20px"><h2 align="center">Marcar Rendición</h2></div>
            <div class="col-sm-3"><img style="width:40%" src="img/marcar.png"></div>
        </div>

        <span> <h3 align="center">Esta por Marcar la</h3></span> 
        <div class="col-xs-12"><h4 align="center">Rendición # <span>4</span></h4></div>


        <table class="table" style="font-size:13px">
            <tr style="font-weight: 600; background:#ccc;"><td>Créditos</td><td>Liquidados</td><td>A Pagar</td></tr>

            <tr><td> 3 </td><td>-- $</td><td>$ <span>2422.50</span></td></tr>

        </table>

        <table class="table" style="font-size:13px">

        </table>

        <span>
            <h3 align="center" style="color:green;font-weight:600" id ="total">
                
            </h3>
        </span>
        <div style="width:40%;display:block;margin:0 auto">
            <input class="form-control" type="text" id="fecha_rendicion" placeholder="Fecha Rendición" readonly="readonly" value="<?php echo date("Ymd"); ?>">
        </div>


        <div class="bottom-btns bottom-btns-3">	
            <button class="btn btn-primary btn-lg" id="btn-volver">Volver</button>
            <button class="btn btn-primary btn-lg">Detalle</button>
            <button class="btn btn-primary btn-lg">Marcar</button>
        </div>

    </div>
</div>

<script type="text/javascript">
    window.litt_id_comercio = <?php echo $id; ?>;
    
    $("#fecha_rendicion").datepicker({
        changeMonth: true,
        changeYear: true });
    $("#fecha_rendicion").datepicker(
       "option","dateFormat","yymmdd" 
    );
    $("#fecha_rendicion").datepicker().on("change",
        function(ev){
            getRendicionPendiente($("#fecha_rendicion").val());
        });
    
    $("#btn-siguiente").on("click",function(){
        alert("entro");
        $(".container1").hide();
        $(".container2").show();
    });
    $("#btn-volver").on("click",function(){
        $(".container2").hide();
        $(".container1").show();
    });
    
    
    function getRendicionPendiente(fecha){
        envio = {};
        envio["id"] = window.litt_id_comercio;
        envio["fecha_hasta"] = fecha;
        
        send("getRendicionPendient",envio,function(msg){
            window.litt_rendicion_pendiente = msg.data;
            data = msg.data;
            // comienzo a setear
            $("#total_creditos").text(data["total_creditos"]);
            $("#total_cuotas").text(data["total_cuotas"]);
            if(data["total_cuotas"] > data["total_creditos"]){
                $("#total").text("A COBRAR $" + 
                    (parseFloat(data["total_cuotas"]) - parseFloat(data["total_creditos"])));
                $("#total").css("color","red");
            } else {
                $("#total").text("A COBRAR $" + 
                    (parseFloat(data["total_creditos"]) - parseFloat(data["total_cuotas"])));
                $("#total").css("color","green");
            }
        });
    }
</script>

</body>
</html>
