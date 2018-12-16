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

// es por comercio, me viene el id
if(!isset($_GET["id"]))
    exit();
else
    $id = $_GET["id"];

$comercio = R::findOne("comercios","id LIKE ?",[$id]);
$rendicion = R::count("rendiciones","id_comercio LIKE ?",[$id]) + 1;

?>

<!----------------------------------------------------------------------------------------------------
######################################################################################################
##############################      MARCAR DETALLE PREVIO      #######################################
######################################################################################################
------------------------------------------------------------------------------------------------------>

<div class="container1"> 
    <div class="panel-a col-md-8 col-md-offset-2 col-sm-12 col-sm-offset-0 col-xs-10 col-xs-offset-1">
        <div class="row panel-title">
            <div class="col-sm-3 "></div>
            <div class="col-sm-6" style="border-bottom: 2px solid #769FCD;margin-bottom:20px">
                <h2 align="center">Rendicion paso 1 - comercio: <?php echo $comercio['razon_social']; ?></h2></div>
            <div class="col-sm-3"></div>
        </div>
        <div class="row"><h4 align="center">Rendición # <span><?php echo $rendicion; ?></span></h4></div>
        <span><h3 align="center">Créditos liquidados a pagar</h3></span>
        <div style="overflow-x: auto;">
        <table class="table" style="width: 100%" id="tabla_credito">
            <tr style="font-weight: 600; background:#ccc;" class="credito">
                <td>Fecha de alta</td>
                <td>Fecha liquidacion</td>
                <td>Nro Op</td>
                <td>Monto</td>
                <td>Desc</td>
                <td>Neto</td>
            </tr>


            <!-- <tr id="molde_fila_credito">
                <td>19/12/16</td>
                <td>19/12/16</td>
                <td>1046</td>
                <td>$<span>1560</span></td>
                <td>$<span>-78</span></td>
                <td>$<span>1428</span></td>
            </tr> -->
            <!-- <tr><td>20/12/16</td><td>1047</td><td>$<span>560</span></td><td>$<span>-28</span></td> <td>$<span>532</span></td></tr>
            <tr><td>22/12/16</td><td>1048</td><td>$<span>430</span></td><td>$<span>-21</span></td><td>$<span>408.5</span></td></tr> -->
        </table>
    </div>
        <div>
            <h3 align="center" style="color:#3b86ca;font-weight:600">
                Total $<span id="total_creditos"></span>
            </h3>
        </div>


        <span> <h3 align="center">Cuotas cobradas a recibir</h3></span> 
        <div style="overflow-x: auto;">
        <table class="table" style="width: 100%" id="tabla_cuotas">
            <tr style="font-weight: 600; background:#ccc;" class="cuota">
                <td>Fecha de cobro</td>
                <td>Nro Op</td>
                <td>Cuota</td>
                <td>Monto</td>
            </tr>

            <!-- <tr id="molde_fila_cuota">
                <td>19/12/16</td>
                <td>1021</td>
                <td>3</td>
                <td>$<span>220.52</span></td>
            </tr> -->
            <!-- <tr><td>19/12/16</td><td>1029</td><td>3</td><td>$<span>262.67</span></td></tr>
            <tr><td>20/12/16</td><td>1034</td><td>2</td><td>$<span>266.18</span></td></tr>
            <tr><td>20/12/16</td><td>1035</td><td>2</td><td>$<span>162.64</span></td></tr>
            <tr><td>22/12/16</td><td>1042</td><td>1</td><td>$<span>505.34</span></td></tr> -->
        </table>
        </div>
        <div>
            <h3 align="center" style="color:#3b86ca;font-weight:600">
                Total $<span id="total_cuotas"></span>
            </h3>
        </div>

        <span>
            <h3 align="center" style="color:green;font-weight:600" class="total">
                
            </h3>
        </span>

        <div style="width:40%;display:block;margin:0 auto">
            <input class="form-control text-center" type="text" id="fecha_rendicion" placeholder="Fecha de Calculo" readonly="readonly" value="<?php echo date("d/m/Y"); ?>">
        </div>

        <div class="bottom-btns">
            <a HREF='/litt/ui/financiera/rendiciones.php' class="btn btn-primary btn-lg">Cancelar</a>
            <button class="btn btn-primary btn-lg" id="btn-siguiente">Siguiente</button>
        </div>

    </div>
</div>

<!----------------------------------------------------------------------------------------------------
######################################################################################################
###############################      MARCAR DEFINITIVO      ##########################################
######################################################################################################
------------------------------------------------------------------------------------------------------>

<div class="container2" hidden style="padding: 80px 0">
    <div class="panel-b col-md-8 col-md-offset-2 col-sm-12 col-sm-offset-0 col-xs-10 col-xs-offset-1">
        <div class="row panel-title">
            <div class="col-sm-3 "></div>
            <div class="col-sm-6" style="border-bottom: 2px solid #769FCD;margin-bottom:20px"><h2 align="center">Marcar Rendición</h2></div>
            <div class="col-sm-3"><img style="width:40%" src="img/marcar.png"></div>
        </div>

        <span> <h3 align="center">Esta por Marcar la</h3></span> 
        <div class="col-xs-12"><h4 align="center">Rendición # <span><?php echo $rendicion; ?></span></h4></div>


        <table class="table" style="width: 100%">
            <tr style="font-weight: 600; background:#ccc;"><td>Créditos Liquidados A Pagar</td></tr>

            <tr><td><span id="cantidad_creditos"> 3</span> -- $ <span id="total_creditos2"> 2422.50</span></td></tr>

        </table>

        <table class="table" style="width: 100%">
            <tr style="font-weight: 600; background:#ccc;"><td>Cuotas Cobradas A Recibir</td></tr>

            <tr><td><span id="cantidad_cuotas"> 5</span> -- $ <span id="total_cuotas2"> 1417.35</span></td></tr>

        </table>

        <span>
            <h3 align="center" style="color:green;font-weight:600" class ="total">
                A PAGAR $ <span>1005.15x</span>
            </h3>
        </span>
        <div style="width:40%;display:block;margin:0 auto">
            <input class="form-control text-center" type="text" id="fecha_rendicion2" placeholder="Fecha de Calculo" disabled>
        </div>


        <div class="bottom-btns bottom-btns-3">	
            <button class="btn btn-primary btn-lg" id="btn-volver">Volver</button>
            <!-- <button class="btn btn-primary btn-lg">Detalle</button> -->
            <button class="btn btn-primary btn-lg" id="btn-marcar">Marcar</button>
        </div>

    </div>
</div>

<script type="text/javascript">
    window.litt_consultar_abandonar = true;
    window.litt_id_comercio = <?php echo $id; ?>;
    hoy = <?php echo date("Ymd"); ?>;
    
    window.litt_procesado = true;
    
    $("#fecha_rendicion").datepicker({
        dateFormat: 'dd/mm/yy',
        prevText: '<i class="fa fa-chevron-left"></i>',
        nextText: '<i class="fa fa-chevron-right"></i>',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
        dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
        changeMonth: true,
        changeYear: true });
    
    
    $("#fecha_rendicion").datepicker().on("change",
        function(ev){
            // quiere decir que eligio una fecha
            window.litt_procesado = true;
            getRendicionPendiente(fecha($("#fecha_rendicion").val()));
        });
    
    $("#btn-siguiente").on("click",function(){
        if(window.litt_procesado){
            $("#fecha_rendicion2").val($("#fecha_rendicion").val());
            $(".container1").hide();
            $(".container2").show();
            $("#cantidad_creditos").text(window.litt_cantidad_credito);
            $("#cantidad_cuotas").text(window.litt_cantidad_cuotas);
            $("#total_creditos2").text(Math.round(window.litt_total_credito));
            $("#total_cuotas2").text(Math.round(window.litt_total_cuota));
        } else {
            Lobibox.notify("error", {
                size: 'mini',
                title: 'Error',
                msg: 'No ha elegido ninguna decha',
                showClass: 'fadeInDown',
                hideClass: 'fadeUpDown',
                delay: 10000,
                sound: false
            });
        }
    });
    
    $("#btn-volver").on("click",function(){
        $(".container2").hide();
        $(".container1").show();
    });
    
    function fecha(fecha) {
        var f = fecha.split("/");
        return f[2]+f[1]+f[0];
    }
    function getRendicionPendiente(fecha){
        envio = {};
        envio["id"] = window.litt_id_comercio;
        window.litt_fecha = fecha;
        envio["fecha_hasta"] = fecha;
        
        send("getRendicionPendient",envio,function(msg){
            window.litt_rendicion_pendiente = msg.data;
            data = msg.data;
            // comienzo a setear
            window.litt_total_credito = parseFloat(data["total_creditos"]).toFixed(2);
            $("#total_creditos").text(Math.round(window.litt_total_credito));
            window.litt_total_cuota = parseFloat(data["total_cuotas"]).toFixed(2);
            $("#total_cuotas").text(Math.round(window.litt_total_cuota));
            if(data["total_cuotas"] > data["total_creditos"]){
                $(".total").text("A COBRAR $" + 
                    Math.round(parseFloat(data["total_cuotas"]) - parseFloat(data["total_creditos"])));
                $(".total").css("color","green");
            } else {
                $(".total").text("A PAGAR $" + 
                    Math.round(parseFloat(data["total_creditos"]) - parseFloat(data["total_cuotas"])));
                $(".total").css("color","red");
            }
            // append los td hijos
            $("tr.cuota").slice(1).hide();
            cu = $.map(data["cuotas"],function(el){return el;});
            window.litt_cantidad_cuotas = cu.length;
            for(i = 0; i < cu.length; ++i){
                arg = [ retFormatDMYBar(cu[i]["fecha_depago"]),
                    cu[i]["id"],
                    cu[i]["n_cuota"],
                    "$" + Math.round(parseFloat(cu[i]["cuota_original"]) + parseFloat(cu[i]["punitorios"])) ];
                crearTR($("#tabla_cuotas"),"cuota",arg);
            }
            $("tr.credito").slice(1).hide();
            cr = $.map(data["creditos"],function(el){return el;});
            window.litt_cantidad_credito = cr.length;
            for(i = 0; i < cr.length; ++i){
                monto_descuento = parseFloat((cr[i]["monto"] / 100) * data["comision_convenio"]);
                arg = [ retFormatDMYBar(cr[i]["fecha_creacion"]),
                    retFormatDMYBar(cr[i]["fecha_liquidacion"]),
                    cr[i]["id"],
                    "$" + Math.round(parseFloat(cr[i]["monto"])),
                    // $monto = $ecc["monto"] - (($ecc["monto"] /100) * $comision_convenio);
                    "$-" + Math.round(monto_descuento),
                    "$" + Math.round(parseFloat(cr[i]["monto"] - monto_descuento)) ];
                crearTR($("#tabla_credito"),"credito",arg);
            }
        });
    }
    
    $("#btn-marcar").on("click",function(){
        $.MessageBox({
            buttonDone  : "Si",
            buttonFail  : "No",
            message     : "¿Está seguro de marcar esta rendición?"
        }).done(function(){
            $("button").attr("disabled");
            envio = {};
            envio["id"] = window.litt_id_comercio;
            envio["monto_credito"] = window.litt_total_credito;
            envio["monto_cuota"] = window.litt_total_cuota;
            envio["fecha_hasta"] = window.litt_fecha;
            send("setRendicionPendient",envio,function(msg){
                window.msg = msg;
                if(msg.data["exito"]) {
                    Lobibox.notify("success", {
                        size: 'mini',
                        msg: 'Se ha marcado la rendición exitosamente',
                        showClass: 'fadeInDown',
                        hideClass: 'fadeUpDown',
                        delay: 5000,
                        sound: false
                    });
                    setTimeout(function() {
                        location.href = "rendiciones.php";
                    },5000);
                } else {
                    Lobibox.notify("error", {
                        size: 'mini',
                        title: 'Error',
                        msg: 'Hubo un error, reintente',
                        showClass: 'fadeInDown',
                        hideClass: 'fadeUpDown',
                        delay: 10000,
                        sound: false
                    });
                }
            },function(msg){
                window.msg = msg;
                Lobibox.notify("error", {
                    size: 'mini',
                    title: 'Error',
                    msg: 'Hubo un error, reintente',
                    showClass: 'fadeInDown',
                    hideClass: 'fadeUpDown',
                    delay: 10000,
                    sound: false
                });
            });
        }).fail(function(){
        });
    });
    
    function crearTR(tabla,classs,array){
        tr = $("<tr>");
        tr.attr("class",classs);
        for(ix = 0; ix < array.length; ++ix){
            t = $("<td>");
            t.text(array[ix]);
            tr.append(t);
        }
        tabla.append(tr);
    }
    
    $(function(){
        getRendicionPendiente(hoy);
    });
</script>

</body>
</html>