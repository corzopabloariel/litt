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
<style type="text/css">
#p2,#p3,#p4,#p5,#p6,#p7,#p8,#p9 { display: none; }
    .select2-container--default .select2-selection--single,
    .select2-container--default.select2-container--focus .select2-selection--multiple,
    .select2-container--default .select2-selection--multiple {
        padding: 5px 8px !important;
        height: auto !important;
        border: 2px solid #41719c;
    }
    .select2-container--default input {
        height: auto !important
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        top: 8px !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered,
    input[type="text"],textarea, select {
        text-transform: uppercase;
    }

</style>
    <div class="container"> 
        <div class="col-sm-10 col-sm-offset-1 col-xs-12 col-lg-8 col-lg-offset-2">
            <div class="panel-b col-md-8 col-md-offset-2 col-sm-12 col-sm-offset-0 col-xs-12" id="p1">
                <div class="row panel-title">
                    <div class="col-sm-6 col-sm-offset-3 col-xs-12" style="border-bottom: 2px solid #769FCD">
                        <h2 align="center">Nuevo Crédito</h2>
                    </div>
                    <div class="col-sm-3 col-xs-12">
                        <img src="img/credito.png">
                    </div>
                </div>
                <div class="row form-d">
                    <div class="col-xs-12">
                        <input class="form-control txt-dni texto-numero" pattern="^[0-9]{8}" maxlength="8" type="tel" name="dni" placeholder="DNI" id="txt-dni" required="true">
                    </div>
                </div>
                <div class="row form-d">
                    <div class="col-xs-12">
                        <input class="form-control txt-score texto-numero" type="tel" name="score" placeholder="Score" id="txt-score" required="true">
                    </div>
                </div>
                <div class="row">   
                    <div class="bottom-btns">
                        <div class="btn-group">
                            <a href="<?php echo config::$ui_main_comercio; ?>" class="btn btn-primary btn-lg">MENU</a>
                            <a class="btn btn-success btn-lg" id="btn-consultar">SIGUIENTE</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel-b col-md-8 col-md-offset-2 col-sm-12 col-sm-offset-0 col-xs-12" id="p2">
                <div class="row panel-title">
                    <div class="col-sm-6 col-sm-offset-3 col-xs-12" style="border-bottom: 2px solid #769FCD"><h2 align="center">Nuevo Crédito</h2></div>
                    <div class="col-sm-3 col-xs-12"><img src="img/credito.png"></div>
                </div>
                <div class="row form-d">
                    <div class="col-xs-12">
                        <input class="form-control txt-dni texto-numero" type="tel" name="dni" placeholder="DNI" id="txt-dni" disabled required="true">
                    </div>
                </div>
                <div class="row form-d">
                    <div class="col-xs-12">
                        <input class="form-control txt-apellido texto-letra" type="text" name="apellido" placeholder=" Apellido/s" id="txt-apellido" required="true">
                    </div>
                </div>
                <div class="row form-d">
                    <div class="col-xs-12">
                        <input class="form-control txt-nombre texto-letra" type="text" name="nombre" placeholder="Nombre/s" id="txt-nombre" required="true">
                    </div>
                </div>
                <div class="row form-d">
                    <div class="col-xs-12">
                        <input class="form-control txt-fecha_nacimiento fecha" type="text" name="fecha_nacimiento" placeholder="Fecha de nacimiento (dd/mm/yyy)" id="txt-fecha_nacimiento" required="true">
                    </div>
                </div>
                <div class="row form-d">
                    <div class="col-xs-12">
                        <input class="form-control txt-score texto-numero" type="text" name="score" placeholder="Score" id="txt-score" disabled required="true">
                    </div>
                </div>

                <div class="row">   
                    <div class="bottom-btns">
                        <div class="btn-group">
                            <a href="<?php echo config::$ui_main_comercio; ?>" class="btn btn-primary btn-lg">MENU</a>
                            <a class="btn btn-success btn-lg" id="btn-alta">SIGUIENTE</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel-c col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1" id="p3">
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <div class="col-sm-6 col-sm-offset-3 col-xs-6 col-xs-offset-3">
                            <img style="width:100%" src="img/anular.png">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2 col-xs-12" style="border-bottom: 2px solid #769FCD"><h2 align="center">Rechazado</h2></div>
                </div>
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <h3 id="h_dni" style="text-transform: uppercase;"><!-- DNI --></h3>
                        <br>
                        <h3 id="h_motivo"></h3>
                    </div>
                </div>
                <div class="row">
                    <div class="bottom-btns">   
                        <a class="btn btn-primary btn-lg" href="/litt/ui/comercio/menuPrincipCom.php" style="color: #FFFFFF;">MENU</a>
                    </div>
                </div>
            </div>

            <div class="panel-c col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1" id="p4">
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <div class="col-sm-6 col-sm-offset-3 col-xs-6 col-xs-offset-3">
                            <img style="width:100%" src="img/marcar.png">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3" style="border-bottom: 2px solid #769FCD"><h2 align="center">Aprobado</h2></div>
                </div>
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <h3 id="h_dni" style="text-transform: uppercase;"><!-- DNI --></h3>
                        <h3 id="h_nombre" style="text-transform: uppercase;"><!-- NOMBRE --></h3>
                    </div>
                </div>
                <div class="row">
                    <div class="bottom-btns">
                        <div class="btn-group">
                            <a href="<?php echo config::$ui_main_comercio; ?>" class="btn btn-primary btn-lg">MENU</a>
                            <a class="btn btn-success btn-lg" id="btn-continuar">SIGUIENTE</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel-b col-md-8 col-md-offset-2 col-sm-12 col-sm-offset-0 col-xs-12" id="p5">
                <div class="row panel-title">
                    <div class="col-sm-6 col-sm-offset-3 col-xs-12" style="border-bottom: 2px solid #769FCD"><h2 align="center">Solicitud</h2></div>
                </div>
                <div class="row form-d">
                    <div class="col-xs-12">
                        <h3 align="center" style="font-weight: 600"><!-- DNI --></h3>
                    </div>
                    <div class="col-xs-12">
                        <h3 align="center" style="font-weight: 600">
                            <span id="s_apellido_nombre" style="text-transform: uppercase;"> <!-- APELLIDO Y NOMBRE --> </span>
                        </h3>
                    </div>
                    <div class="col-xs-12">
                        <h3 align="center" style="font-weight: 600">
                            <span id="s_fecha_nacimiento"> <!-- FECHA NACIMINETO --> </span>
                        </h3>
                    </div>
                </div>
                <div class="row form-d">
                    <div class="col-xs-12">
                        <input class="form-control texto-numero" type="tel" name="telefono_fijo" placeholder="Telefono Fijo" value="" id="txt-telefono_fijo" > <!-- VALUE TELEFONO FIJO -->
                    </div>
                </div>
                <div class="row form-d">
                    <div class="col-xs-12">
                        <input class="form-control texto-numero" type="tel" name="telefono_celular" placeholder="Telefono celular" value="" id="txt-telefono_celular"> <!-- VALUE TELEOFNO CELULAR -->
                    </div>
                </div>
                <div class="row form-d">
                    <div class="col-xs-12">
                        <input class="form-control texto-mail" required="true" type="email" name="mail" placeholder="Mail" value="" id="txt-mail" pattern="[^@\s]+@[^@\s]+\.[^@\s]+"> <!-- VALUE EMAIL -->
                    </div>
                </div>
                <div class="row form-d">
                    <div class="col-xs-6"><h3 align="right">PLAN</h3></div>
                    <div class="col-xs-6">
                        <select class="form-control" name="plan" id="op-plan">
                            <!-- CREO OPTIONS CON TODOS LOS PLANES Y SUS ID -->
                        </select>
                    </div>
                </div>
                <div class="row form-d">
                    <div class="col-xs-12">
                        <input class="form-control texto-numero" type="number" name="monto" required="true" placeholder="Monto" id="txt-monto">
                    </div>
                    <div class="col-xs-12">
                        <div class="row">
                            <div class="col-xs-6"><h3 align="right">Cuotas</h3></div>
                            <div class="col-xs-6">
                                <select class="form-control" name="cuotas" id="op-cuotas">
                                    <option value="2">2</option>
                                    <option value="4">4</option>
                                    <option value="6">6</option>
                                    <option value="8">8</option>
                                    <option value="12">12</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-d">    
                    <div class="col-xs-12"><h3 class="t-centered" style="margin-top: 5px;">1er Vto: <span id="1er_vto">[VALOR NO DECLARADO]</span></h3></div>
                </div>
                <div class="row form-d">
                    <div class="col-xs-12"><h3 class="t-centered" style="margin-top: 5px;">Valor Cuotas: $<span id="val_cuota">[VALOR NO DECLARADO]</span></h3></div>
                </div>
                <div class="row form-d">
                    <div class="bottom-btns">
                        <div class="btn-group">
                            <a href="<?php echo config::$ui_main_comercio; ?>" class="btn btn-primary btn-lg">MENU</a>
                            <a class="btn btn-success btn-lg" id="btn-continuar2">SIGUIENTE</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel-b col-md-8 col-md-offset-2 col-sm-12 col-sm-offset-0 col-xs-12" id="p6">
                <div class="form-d">
                    <h3 align="center">Referido</h3>
                    <div class="form-group col-xs-12">
                        <input class="form-control texto-letra" type="text" placeholder="Nombre Completo" name="referido_nombre" id="referido_nombre" required="true">
                        <input class="form-control texto-numero" type="tel" placeholder="Teléfono Fijo" name="referido_telefono_fijo" id="referido_telefono_fijo">
                        <input class="form-control texto-numero" type="tel" placeholder="Teléfono Celular" name="referido_telefono_celular" id="referido_telefono_celular">
                        <input class="form-control texto-letra" type="text" placeholder="Parentesco" name="referido_parentesco" id="referido_parentesco" required="true">
                    </div><br>
                    <h3 align="center">Empleo</h3>
                    <div class="form-group col-xs-12">
                        <input class="form-control texto-letra" type="text" placeholder="Empresa" name="empleo_empresa" id="empleo_empresa" required="true">
                        <input class="form-control texto-numero" type="tel" placeholder="Teléfono Fijo" name="empleo_telefono" id="empleo_telefono" required="true">
                        <input class="form-control texto-numero" type="tel" placeholder="Sueldo Neto" name="empleo_sueldo" id="empleo_sueldo" required="true">
                    </div><br>
                    <h3 align="center">Producto Comprado</h3>
                    <div class="form-group col-xs-12">
                        <input class="form-control texto-alfanumerico" type="text" placeholder="Ej. Suecos Block" name="producto_designacion" id="producto_nombre" required="true">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <div class="btn-group">
                            <a href="<?php echo config::$ui_main_comercio; ?>" class="btn btn-primary btn-lg">MENU</a>
                            <a class="btn btn-success btn-lg" id="btn-continuar3">SIGUIENTE</a>
                        </div>
                    </div>
                </div>
                <div class="row" style="padding-top: 10px;">
                    <div class="col-sm-12 text-center">
                        <a class="btn btn-warning btn-lg" id="btn-altaProvisoria">ALTA PROVISORIA</a>
                    </div>
                </div>
            </div>

            <div class="panel-c col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1" id="p7">
                <div class="row">
                    <div class="row panel-title">
                        <div class="col-sm-6 col-sm-offset-3" style="border-bottom: 2px solid #769FCD;margin-bottom:20px"><h2 align="center">Alta Provisoria</h2></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="bottom-btns" style="width: 80%">
                            <p style="position:relative; padding-left: 20px;"><a onclick="terminos();" style="cursor: pointer;"><i style="position:absolute; left: 0; top: 0; font-size: 20px; color: red;" class="far fa-file-pdf"></i> Terminos y Condiciones</a></p>
                            <p style="position:relative; padding-left: 20px;"><a onclick="desarrollo();" style="cursor: pointer;"><i style="position:absolute; left: 0; top: 0; font-size: 20px; color: red;" class="far fa-file-pdf"></i> Desarrollo de Cuotas</a></p>

                            <p style="position:relative; padding-left: 20px;"><a onclick="sc();" style="cursor: pointer;"><i style="position:absolute; left: 0; top: 0; font-size: 20px; color: red;" class="far fa-file-pdf"></i> Solicitud de Crédito Personal</a></p>
                            <p style="position:relative; padding-left: 20px;"><a class="a-otorgamiento" style="cursor: pointer;"><i style="position:absolute; left: 0; top: 0; font-size: 20px; color: red;" class="far fa-file-pdf"></i> <strong>Recibo:</strong> Gastos de Otorgamiento</a></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">     
                        <div class="bottom-btns text-center">
                            <div class="btn-group">
                                <a class="btn btn-primary btn-lg" href="<?php echo config::$ui_main_comercio; ?>">MENU</a>
                                <!--<button style="margin: 0" class="btn btn-warning btn-lg"><i class="fas fa-envelope"></i> ENVIAR</button>
                                <form onsubmit="$('frm-altaprovisoria').attr('disabled','disabled')" id="frm-altaprovisoria" class="login-form" action="../controlador/controller.php?guardarDatos1" method="POST" style="border-top: 0px; text-align: center; display: inline-block; padding-top: 0px; width: auto;">
                                    <input type="hidden" name="dni" value="">
                                    <button type="submit" class="btn btn-warning btn-lg"><i class="fas fa-envelope"></i></button>
                                </form>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel-b col-md-8 col-md-offset-2 col-sm-12 col-sm-offset-0 col-xs-12" id="p8">
                <div class="row panel-title">
                    <div class="col-sm-6 col-sm-offset-3" style="border-bottom: 2px solid #769FCD;margin-bottom:20px">
                        <h2 align="center">Domicilios</h2>
                    </div>
                </div>
                <div class="">
                    <h3 align="center">Domicilio Particular</h3>
                    <div class="form-group col-xs-12">
                        <input type="hidden" name="dni" value=""> <!-- VALUE HIDDEN DNI -->
                        <input class="form-control texto-alfanumerico" type="text" placeholder="Calle" id="domicilio_calle" required="true">
                        <input class="form-control texto-numero" type="tel" placeholder="Altura" id="domicilio_altura">
                        <input class="form-control texto-numero" type="tel" placeholder="Piso" id="domicilio_piso">
                        <input class="form-control texto-cp" type="text" placeholder="Depto" id="domicilio_depto">
                        <input class="form-control texto-alfanumerico" type="text" placeholder="Barrio" id="domicilio_barrio">
                        <input class="form-control texto-alfanumerico" type="text" placeholder="Manzana" id="domicilio_manzana">
                        <input class="form-control texto-cp" type="text" placeholder="Codigo Postal" id="domicilio_cpa" value="" required="true">
                        <select class="form-control" id="domicilio_provincia" style="width: 100%" disabled>
                            <option selected="selected">BUENOS AIRES</option>
                        </select>
                        <hr/>
                        <select id="domicilio_localidad" style="width: 100%" required="true">
                            <option value=""></option>
                        <?php 
                        $localidades = R::findAll("localidades");
                        foreach ($localidades as $l) {
                            $loc = strtoupper($l["nombre"]);
                            echo "<option value='{$loc}'>{$loc}</option>";
                        }
                        ?>
                        </select>
                    </div>
                    <h3 align="center">Domicilio Laboral</h3>
                    <div class="form-group col-xs-12">
                        <input class="form-control texto-alfanumerico" type="text" placeholder="Calle" id="empleo_calle" value="" required="true">
                        <input class="form-control texto-numero" type="tel" placeholder="Altura" id="empleo_altura">
                        <input class="form-control texto-numero" type="tel" placeholder="Piso" id="empleo_piso">
                        <input class="form-control texto-cp" type="text" placeholder="Depto" id="empleo_depto">
                        <input class="form-control texto-alfanumerico" type="text" placeholder="Barrio" id="empleo_barrio">
                        <input class="form-control texto-alfanumerico" type="text" placeholder="Manzana" id="empleo_manzana">
                        <input class="form-control texto-cp" type="text" placeholder="Codigo Postal" id="empleo_cpa" value="" required="true">
                        <select class="form-control" id="empleo_provincia" style="width: 100%" disabled>
                            <option selected="selected">BUENOS AIRES</option>
                        </select>
                        <br/>
                        <select id="empleo_localidad" style="width: 100%" required="true">
                            <option value=""></option>
                        <?php 
                        $localidades = R::findAll("localidades");
                        foreach ($localidades as $l) {
                            $loc = strtoupper($l["nombre"]);
                            echo "<option value='{$loc}'>{$loc}</option>";
                        }
                        ?>
                        </select>
                        <hr/>
                        <script>
                            $("#domicilio_localidad,#empleo_localidad").select2({
                                placeholder: 'LOCALIDAD',
                                allowClear: true,
                                width: 'resolve',
                            })
                        </script>
                        <hr/>
                        <textarea placeholder="Observaciones" class="form-control" style="height:120px" id="observaciones"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="bottom-btns col-xs-12 col-sm-12 text-center">
                        <div class="btn-group">
                            <a href="<?php echo config::$ui_main_comercio; ?>" class="btn btn-primary btn-lg">MENU</a>
                            <a class="btn btn-success btn-lg" id="btn-finalizar">SIGUIENTE</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel-c col-sm-6 col-sm-offset-3 col-xs-12 col-xs-offset-0" id="p9">
                <div class="row panel-title">
                    <div class="col-sm-6 col-sm-offset-3 col-xs-12" style="border-bottom: 2px solid #769FCD;margin-bottom:20px"><h2 align="center">Alta Definitiva</h2></div>
                </div>
                <div class="row">
                    <div class="bottom-btns" style="width: 80%;">
                        <!--<form action="../../descargarPDF.php" method="POST" target="_blank">-->
                            <!-- PARA DESCARGAR EL PDF, LE PASO EL ID, Y DEL OTRO LADO LO IMPRIME COMPLETANDOLO DESDE LA BD -->
                        <p style="position:relative; padding-left: 20px;"><a onclick="terminos();" style="cursor: pointer;"><i style="position:absolute; left: 0; top: 0; font-size: 20px; color: red;" class="far fa-file-pdf"></i> Terminos y Condiciones</a></p>
                        <p style="position:relative; padding-left: 20px;"><a onclick="desarrollo();" style="cursor: pointer;"><i style="position:absolute; left: 0; top: 0; font-size: 20px; color: red;" class="far fa-file-pdf"></i> Desarrollo de Cuotas</a></p>

                        <p style="position:relative; padding-left: 20px;"><a style="cursor: pointer;" onclick="sc();"><i style="position:absolute; left: 0; top: 0; font-size: 20px; color: red;" class="far fa-file-pdf"></i> Solicitud de Crédito Personal</a></p>
                        <p style="position:relative; padding-left: 20px;"><a class="a-otorgamiento" style="cursor: pointer;"><i style="position:absolute; left: 0; top: 0; font-size: 20px; color: red;" class="far fa-file-pdf"></i> <strong>Recibo:</strong> Gastos de Otorgamiento</a></p>
                    </div>
                </div>
                <div class="row col-espacio-t">
                    <div class="col-xs-12 text-center">
                        <div class="btn-group">
                            <a href="/litt/ui/comercio/menuPrincipCom.php" class="btn btn-primary btn-lg">MENU</a> 
                            <a href="" style="color: #FFFFFF;" class="btn btn-warning btn-lg">N. CRÉDITO</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">
    window.litt_consultar_abandonar = true;
    $(document).ready(function() {
        credito_getScoreMinimo();
        //$("#p2,#p3,#p4,#p5,#p6,#p7,#p8,#p9").hide();
        fecha_datepicker();
        $("body").on("focus",".has-error *",function() {
            $(this).parent().removeClass("has-error");
        });
    });
    
    function validar() {
        var flag = 1;
        $('*[required="true"]').each(function(){
            if($(this).is(":visible")) {
                if($(this).is(":invalid")) {
                    flag = 0;
                    $(this).parent().addClass("has-error");
                }
            }
        });
        return flag;
    }

    /*function imprimir() {
        sc();
        setTimeout(function() {
            desarrollo();
        },1000);
        setTimeout(function() {
            terminos();
        },2000);
    }*/
    function sc() {
        var id_credito = window.litt_credito;
        console.log(id_credito)
        var page = "/litt/ui/financiera/ajax/sc.php?id_credito="+id_credito;
        descargar(page);
    }
    function desarrollo() {
        var id_credito = window.litt_credito;
        console.log(id_credito)
        page = "/litt/ui/financiera/ajax/desarrollo.php?id_credito="+id_credito;
        descargar(page);
    }
    function terminos() {
        var id_credito = window.litt_credito;
        console.log(id_credito)
        page = "/litt/ui/financiera/ajax/terminos.php?id_credito="+id_credito;
        descargar(page);
    }
    
    function descargar(url) {
        window.onfocus = finalizada;
        document.location = url;
    }
    function finalizada() {
        window.onfocus = vacia;
    }
    function vacia(){}

    function fecha_datepicker(){
        $("*[name='fecha_nacimiento']").datepicker({
            dateFormat: 'dd/mm/yy',
            //prevText: '',
            //nextText: '',
            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
            dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
            dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
            changeMonth: true,
            changeYear: true,
            yearRange: "-100:+0"
        });
    }
    
    $('#btn-consultar').on('click',function(){
        window.litt_cliente_dni = $('#txt-dni').val();
        window.litt_cliente_score = $('#txt-score').val();
        // llega al minimo del score para acceder?
        if(validar()) {
            $('#btn-consultar').attr("disabled","disabled");
            if(parseInt($('#txt-score').val()) >= parseInt(window.litt_verazScoreMinimo)){
            // existe la persona?
            	var bandera = true;
                send('existeCliente',{'cliente_dni' : $('#txt-dni').val()},
                function (msg){
                    $("#p1").hide();
                    console.log(msg.data['leyenda']);
                    if(msg.data['existe']){
                        // hago el retrieve de la informacion del usuario
                        if(msg.data['leyenda'] == "") {
	            			cargarClienteAEntorno($('#txt-dni').val());
	                		$("#p4").show();
	                	} else {
	                		window.litt_rechazo_motivo = msg.data['leyenda'];
			                f_resultadoNO();
			                $("#p3").show();
	                	}
                    }
                    else {
                        // le indico a la otra pagina que haga la carga
                        f_cargaAlta();
                        $("#p2").show();
                    }
                });
            } else {
                // no le da el score, lo rechazo
                window.litt_rechazo_motivo = "Score insuficiente para operar";
                f_resultadoNO();
                $("#p1").hide();
                $("#p3").show();
            }
        }
    });

    $("#btn-altaProvisoria").on("click",function(){
        if(validar()) {
            $("#btn-altaProvisoria").attr("disabled","disabled");
            envio = {};
            envio['apellido'] = window.litt_cliente_apellido;
            envio['atraso_historico'] = window.litt_cliente_atraso_historico;
            envio['comercio_credito'] = window.litt_cliente_comercio_credito;
            envio['credito_vigente'] = window.litt_cliente_credito_vigente;
            envio['dni'] = window.litt_cliente_dni;
            envio['domicilio_calle'] = "";
            envio['domicilio_altura'] = "";
            envio['domicilio_cpa'] = "";
            envio['domicilio_localidad'] = "";
            envio['domicilio_piso'] = "";
            envio['domicilio_depto'] = "";
            envio['domicilio_barrio'] = "";
            envio['domicilio_manzana'] = "";
            envio['domicilio_provincia'] = "Buenos Aires";
            envio['empleo_calle'] = "";
            envio['empleo_altura'] = "";
            envio['empleo_cpa'] = "";
            envio['empleo_empresa'] = $("#empleo_empresa").val();
            envio['empleo_localidad'] = "";
            envio['empleo_piso'] = "";
            envio['empleo_depto'] = "";
            envio['empleo_barrio'] = "";
            envio['empleo_manzana'] = "";
            envio['empleo_provincia'] = "Buenos Aires";
            envio['empleo_sueldo'] = $("#empleo_sueldo").val();
            envio['empleo_telefono'] = $("#empleo_telefono").val();
            envio['estado_mora'] = window.litt_cliente_estado_mora;
            envio['fecha_nacimiento'] = window.litt_cliente_fecha_nacimiento;
            envio['id'] = window.litt_cliente_id;
            envio['mail'] = window.litt_cliente_mail;
            envio['nombre'] = window.litt_cliente_nombre;
            envio['observaciones'] = $("#observaciones").val();
            envio['referido_nombre'] = $("#referido_nombre").val();
            envio['referido_parentesco'] = $("#referido_parentesco").val();
            envio['referido_telefono_celular'] = $("#referido_telefono_celular").val();
            envio['referido_telefono_fijo'] = $("#referido_telefono_fijo").val();
            envio['telefono_celular'] = window.litt_cliente_telefono_celular;
            envio['telefono_fijo'] = window.litt_cliente_telefono_fijo;
            // credito
            envio['credito_cuotas'] = window.litt_credito_cuotas;
            envio['credito_monto'] = window.litt_credito_monto;
            envio['credito_plan'] = window.litt_credito_plan;
            envio['credito_producto_designacion'] = $("#producto_nombre").val();
            envio['credito_score'] = window.litt_cliente_score;
            
            send("crearCredito",envio,function(msg){
                window.msg = msg;
                if(msg.data["exito"]){
                    $("#p6").hide();
                    $("#p7").show();
                    window.litt_credito = msg.data["id_credito"];
                    imprimir();
                } else {
                    Lobibox.notify("error", {
                        size: 'mini',
                        title: 'Error',
                        msg: 'Hubo un error al guardar el crédito, reintente',
                        showClass: 'fadeInDown',
                        hideClass: 'fadeUpDown',
                        delay: 10000,
                        sound: false
                    });
                }
            }, function(msg){
                window.msg = msg;
                Lobibox.notify("error", {
                    size: 'mini',
                    title: 'Error',
                    msg: 'Hubo un error al guardar el crédito, reintente',
                    showClass: 'fadeInDown',
                    hideClass: 'fadeUpDown',
                    delay: 10000,
                    sound: false
                });
            });
        }
    })
    
    $("#formulario").on('submit',function(){
        window.retornar = true;
        $(":text, :file, :checkbox, select, textarea").each(function() {
            if($(this).val() == ""){
                alert("Hay campos vacios, por favor, verifiquelos");
                window.retornar = false;
                return false;
            }
        });
        return window.retornar;
    });
    
    function cargarClienteAEntorno(dni){
        send('getClienteData',{'cliente_dni': dni},function(msg){
            console.log(msg)
            window.msg = msg;
            window.litt_cliente_apellido = msg.data.cliente['apellido'];
            window.litt_cliente_atraso_historico = msg.data.cliente['atraso_historico'];
            window.litt_cliente_comercio_credito = msg.data.cliente['comercio_credito'];
            window.litt_cliente_credito_vigente = msg.data.cliente['credito_vigente'];
            window.litt_cliente_dni = msg.data.cliente['dni'];
            window.litt_cliente_domicilio_calle = msg.data.cliente['domicilio_calle'];
            window.litt_cliente_domicilio_altura = msg.data.cliente['domicilio_altura'];
            window.litt_cliente_domicilio_cpa = msg.data.cliente['domicilio_cpa'];
            window.litt_cliente_domicilio_localidad = msg.data.cliente['domicilio_localidad'];//
            window.litt_cliente_domicilio_piso = msg.data.cliente['domicilio_piso'];
            window.litt_cliente_domicilio_depto = msg.data.cliente['domicilio_depto'];
            window.litt_cliente_domicilio_barrio = msg.data.cliente['domicilio_barrio'];
            window.litt_cliente_domicilio_manzana = msg.data.cliente['domicilio_manzana'];
            window.litt_cliente_domicilio_provincia = msg.data.cliente['domicilio_provincia'];//
            window.litt_cliente_empleo_calle = msg.data.cliente['empleo_calle'];
            window.litt_cliente_empleo_altura = msg.data.cliente['empleo_altura'];
            window.litt_cliente_empleo_cpa = msg.data.cliente['empleo_cpa'];
            window.litt_cliente_empleo_empresa = msg.data.cliente['empleo_empresa'];
            window.litt_cliente_empleo_localidad = msg.data.cliente['empleo_localidad'];//
            window.litt_cliente_empleo_piso = msg.data.cliente['empleo_piso'];
            window.litt_cliente_empleo_depto = msg.data.cliente['empleo_depto'];
            window.litt_cliente_empleo_barrio = msg.data.cliente['empleo_barrio'];
            window.litt_cliente_empleo_manzana = msg.data.cliente['empleo_manzana'];
            window.litt_cliente_empleo_provincia = msg.data.cliente['empleo_provincia'];//
            window.litt_cliente_empleo_sueldo = msg.data.cliente['empleo_sueldo'];
            window.litt_cliente_empleo_telefono = msg.data.cliente['empleo_telefono'];
            window.litt_cliente_estado_mora = msg.data.cliente['estado_mora'];
            window.litt_cliente_fecha_nacimiento = msg.data.cliente['fecha_nacimiento'];
            window.litt_cliente_id = msg.data.cliente['id'];
            window.litt_cliente_mail = msg.data.cliente['mail'];
            window.litt_cliente_nombre = msg.data.cliente['nombre'];
            window.litt_cliente_observaciones = msg.data.cliente['observaciones'];
            window.litt_cliente_referido_nombre = msg.data.cliente['referido_nombre'];
            window.litt_cliente_referido_parentesco = msg.data.cliente['referido_parentesco'];
            window.litt_cliente_referido_telefono_celular = msg.data.cliente['referido_telefono_celular'];
            window.litt_cliente_referido_telefono_fijo = msg.data.cliente['referido_telefono_fijo'];
            window.litt_cliente_telefono_celular = msg.data.cliente['telefono_celular'];
            window.litt_cliente_telefono_fijo = msg.data.cliente['telefono_fijo'];
            // va aca por que tiene que terminar de cargar los resultados

            //$("#domicilio_provincia").val(msg.data.cliente['domicilio_provincia'])
            //$("#empleo_provincia").val(msg.data.cliente['empleo_provincia'])
            //$("#btn-altaProvisoria").hide();
            if(window.litt_cliente_domicilio_calle != "") // indica que es cliente nuevo
                $("#btn-altaProvisoria").parent().parent().hide();
            f_resultadoOK();
        });
    }
    
    function f_cargaAlta(){
        // traigo la info de las variables de entorno
        $(".txt-dni").val(window.litt_cliente_dni);
        $(".txt-score").val(window.litt_cliente_score);
        
        $("#btn-alta").on("click",function(){
            // cargo los elementos nuevos a las variables de entorno
            window.litt_cliente_nombre = $("#txt-nombre").val();
            window.litt_cliente_apellido = $("#txt-apellido").val();
            window.litt_cliente_fecha_nacimiento = $("#txt-fecha_nacimiento").val();
            if(validar()) {
                $("#btn-alta").attr("disabled","disabled");
                $("#p2").hide();
                if(obtenerEdad(window.litt_cliente_fecha_nacimiento) >= 18){
                    // hago el send primero para crear al cliente
                    envio = {};
                    envio["dni"] = window.litt_cliente_dni;
                    envio["apellido"] = window.litt_cliente_apellido;
                    envio["nombre"] = window.litt_cliente_nombre;
                    envio["fecha_nacimiento"] = window.litt_cliente_fecha_nacimiento;
                    send("crearCliente",envio,function(msg){
                        window.msg = msg;
                        if(msg.data["exito"]){
                            f_resultadoOK();
                            $("#p4").show();
                        } else {
                            window.litt_rechazo_motivo = "Error al procesar";
                            f_resultadoNO();
                            $("#p3").show();
                        }
                    },function(msg){
                        window.msg = msg;
                        window.litt_rechazo_motivo = "Error al procesar";
                        f_resultadoNO();
                        $("#p3").show();
                    });
                } else {
                    window.litt_rechazo_motivo = "edad insuficiente";
                    f_resultadoNO();
                    $("#p3").show();
                }
            }
        });
    }
    
    function obtenerEdad(edad){
        birthday = edad.split("/");
        birthday = new Date(birthday[2], birthday[1] - 1, birthday[0]);
        return calculateAge(birthday);
    }
    
    function calculateAge(birthday) {
        var ageDifMs = Date.now() - birthday.getTime();
        var ageDate = new Date(ageDifMs);
        return Math.abs(ageDate.getUTCFullYear() - 1970);
    }
    function f_resultadoNO(){
        $("#h_dni").text(window.litt_cliente_dni);
        $("#h_motivo").text(window.litt_rechazo_motivo);
    }
    function f_resultadoOK(){
        $("#h_dni").text(window.litt_cliente_dni);
        $("#h_nombre").text(window.litt_cliente_apellido + ", " + window.litt_cliente_nombre);
        
        $('#btn-continuar').on('click',function(){
            // oculto esta y continuo
            $("#p4").hide();
            f_cuotas();
            $("#p5").show();
        });
    }

    function pmt(principal,tasaDeInteres,plazo){
        tasaDeInteres = tasaDeInteres / 100;
        return (principal/( (1- Math.pow(1+tasaDeInteres,-plazo)) / tasaDeInteres));
    }
    
    function calcularCuota(){
        // encuentro el plan
        // voy a suponer que el n° de plan es la posicion
        plan_id = $("#op-plan").val();
        interes = planes[plan_id]["interes_porcuota"];
        tem = planes[plan_id]["tna"] / (365/30);
        monto = $("#txt-monto").val();
        cuotas = $("#op-cuotas").val();

        // segun las correciones de christian, si el plan es == 2, vecimiento es hoy
        var today = new Date();
        if(plan_id == 2){
            vencimiento = devolverFechaDDMMYYYY(today);
        }
        else{
            vencimiento = devolverFechaDDMMYYYY(new Date(today.setMonth(today.getMonth() + 1)));
        }
        valor_cuota = pmt(monto,tem,cuotas);
        $("#1er_vto").text(vencimiento);
        $("#val_cuota").text(Math.round(valor_cuota));
    }

    function f_cuotas(){
        $("#s_apellido_nombre").text(window.litt_cliente_apellido + ", " + window.litt_cliente_nombre);
        $("#s_fecha_nacimiento").text(window.litt_cliente_fecha_nacimiento);
        $("#txt-telefono_fijo").val(window.litt_cliente_telefono_fijo);
        $("#txt-telefono_celular").val(window.litt_cliente_telefono_celular);
        $("#txt-mail").val(window.litt_cliente_mail);
        var data = {};
        data.id_comercio = "<?php echo $_SESSION["id_comercio"]; ?>";
        send("getPlanes",data,function(msg){
            planes_get = msg.data.planes;
            productos_get = msg.data.productos;
            planes = [];
            productos = [];
            console.log(msg.data.pr)
            selector = $("#op-plan");
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
            $("#txt-monto").attr({'min': m_min, 'max' : m_max })
            $("#op-cuotas").html("");
            selector = $("#op-cuotas");
            for(i = p_min ; i <= p_max; i++) {
                op = $('<option></option>');
                op.attr('value',i);
                op.text(i);
                selector.append(op);
            }
        });
        
        $("#op-plan").on("change",function () {
            plan_id = $("#op-plan").val();
            console.log(productos[plan_id])
            p_min = productos[plan_id].plazo_minimo
            p_max = productos[plan_id].plazo_maximo
            m_min = productos[plan_id].monto_minimo
            m_max = productos[plan_id].monto_maximo
            
            //$("#txt-monto").attr({'pattern': '.{'+m_min+','+m_max+'}'});
            $("#txt-monto").attr({'min': m_min, 'max' : m_max })
            $("#op-cuotas").html("");
            selector = $("#op-cuotas");
            for(i = p_min ; i <= p_max; i++) {
                op = $('<option></option>');
                op.attr('value',i);
                op.text(i);
                selector.append(op);
            }
            calcularCuota();
        });
        $("#txt-monto").on("change",function () { calcularCuota(); });
        $("#op-cuotas").on("change",function () { calcularCuota(); });
        
        $("#btn-continuar2").on("click",function(){
            // cargo a la memoria
            if(validar()) {
                $("#btn-continuar2").attr("disabled","disabled");
                window.litt_cliente_telefono_fijo = $("#txt-telefono_fijo").val();
                window.litt_cliente_telefono_celular = $("#txt-telefono_celular").val();
                window.litt_cliente_mail = $("#txt-mail").val();
                window.litt_credito_plan = $("#op-plan").val();
                window.litt_credito_cuotas = $("#op-cuotas").val();
                window.litt_credito_monto = $("#txt-monto").val();
                $("#p5").hide();
                f_referidoYempleo();
                $("#p6").show();
            }
        });
    }
    
    function devolverFechaDDMMYYYY(fecha){
        var dd = fecha.getDate();
        var mm = fecha.getMonth()+1; //January is 0!
        var yyyy = fecha.getFullYear();
        if(dd<10) dd='0'+dd;
        if(mm<10) mm='0'+mm;
        return dd+'/'+mm+'/'+yyyy;
    }

    function f_referidoYempleo(){
        $("#referido_nombre").val(window.litt_cliente_referido_nombre);
        $("#referido_telefono_fijo").val(window.litt_cliente_referido_telefono_fijo);
        $("#referido_telefono_celular").val(window.litt_cliente_referido_telefono_celular);
        $("#referido_parentesco").val(window.litt_cliente_referido_parentesco);
        $("#empleo_empresa").val(window.litt_cliente_empleo_empresa);
        $("#empleo_telefono").val(window.litt_cliente_empleo_telefono);
        $("#empleo_sueldo").val(window.litt_cliente_empleo_sueldo);
        
        $("#btn-continuar3").on("click",function(){
            if(validar()) {
                $("#btn-continuar3").attr("disabled","disabled");
                window.litt_cliente_referido_nombre = $("#referido_nombre").val();
                window.litt_cliente_referido_telefono_fijo = $("#referido_telefono_fijo").val();
                window.litt_cliente_referido_telefono_celular = $("#referido_telefono_celular").val();
                window.litt_cliente_referido_parentesco = $("#referido_parentesco").val();
                window.litt_cliente_empleo_empresa = $("#empleo_empresa").val();
                window.litt_cliente_empleo_telefono = $("#empleo_telefono").val();
                window.litt_cliente_empleo_sueldo = $("#empleo_sueldo").val();
                window.litt_credito_producto_designacion = $("#producto_nombre").val();
                $("#p6").hide();
                f_domicilios();
                $("#p8").show();
            }
        });
    }
    
    function f_domicilios(){
        $("#domicilio_calle").val(window.litt_cliente_domicilio_calle);
        $("#domicilio_altura").val(window.litt_cliente_domicilio_altura);
        $("#domicilio_piso").val(window.litt_cliente_domicilio_piso);
        $("#domicilio_depto").val(window.litt_cliente_domicilio_depto);
        $("#domicilio_barrio").val(window.litt_cliente_domicilio_barrio);
        $("#domicilio_manzana").val(window.litt_cliente_domicilio_manzana);
        $("#domicilio_cpa").val(window.litt_cliente_domicilio_cpa);
        $("#domicilio_localidad").val(window.litt_cliente_domicilio_localidad).trigger('change');

        if(window.litt_cliente_domicilio_provincia != null)
            $("#domicilio_provincia").val(window.litt_cliente_domicilio_provincia).trigger('change');
        $("#empleo_calle").val(window.litt_cliente_empleo_calle);
        $("#empleo_altura").val(window.litt_cliente_empleo_altura);
        $("#empleo_piso").val(window.litt_cliente_empleo_piso);
        $("#empleo_depto").val(window.litt_cliente_empleo_depto);
        $("#empleo_barrio").val(window.litt_cliente_empleo_barrio);
        $("#empleo_manzana").val(window.litt_cliente_empleo_manzana);
        $("#empleo_cpa").val(window.litt_cliente_empleo_cpa);
        $("#empleo_localidad").val(window.litt_cliente_empleo_localidad).trigger('change');
        
        if(window.litt_cliente_empleo_provincia != null)
            $("#empleo_provincia").val(window.litt_cliente_empleo_provincia).trigger('change');
        $("#observaciones").val(window.litt_cliente_observaciones);
        
        $("#btn-finalizar").on("click",function(){
            if(validar()) {
                $.MessageBox({
                    buttonDone  : "Si",
                    buttonFail  : "No",
                    message     : "Esta dando de alta un crédito de manera definitiva, desea continuar?"
                }).done(function(){
                    $("#btn-finalizar").attr("disabled","disabled");
                    window.litt_cliente_domicilio_calle = $("#domicilio_calle").val();
                    window.litt_cliente_domicilio_altura = $("#domicilio_altura").val();
                    window.litt_cliente_domicilio_piso = $("#domicilio_piso").val();
                    window.litt_cliente_domicilio_depto = $("#domicilio_depto").val();
                    window.litt_cliente_domicilio_barrio = $("#domicilio_barrio").val();
                    window.litt_cliente_domicilio_manzana = $("#domicilio_manzana").val();
                    window.litt_cliente_domicilio_cpa = $("#domicilio_cpa").val();
                    window.litt_cliente_domicilio_localidad = $("#domicilio_localidad").val();
                    window.litt_cliente_domicilio_provincia = $("#domicilio_provincia").val();
                    window.litt_cliente_empleo_calle = $("#empleo_calle").val();
                    window.litt_cliente_empleo_altura = $("#empleo_altura").val();
                    window.litt_cliente_empleo_piso = $("#empleo_piso").val();
                    window.litt_cliente_empleo_depto = $("#empleo_depto").val();
                    window.litt_cliente_empleo_barrio = $("#empleo_barrio").val();
                    window.litt_cliente_empleo_manzana = $("#empleo_manzana").val();
                    window.litt_cliente_empleo_cpa = $("#empleo_cpa").val();
                    window.litt_cliente_empleo_localidad = $("#empleo_localidad").val();
                    window.litt_cliente_empleo_provincia = $("#empleo_provincia").val();
                    window.litt_cliente_observaciones = $("#observaciones").val();
                    guardarFinalizado();
                }).fail(function(){
                });
            }
        });
    }
    
    function imprimir() {
        $(".a-otorgamiento").attr("disabled",true);
        var dni = window.litt_cliente_dni;
        var nombre = window.litt_cliente_apellido + ", " + window.litt_cliente_nombre;
        var id_comercio = "<?php echo $_SESSION["id_comercio"] ?>";
        var id_credito = window.litt_credito;
        var page = "ajax/recibo.php?nombre="+nombre+"&dni="+dni;
        $.ajax({
            url: 'ajax/recibo.php',
            type: "get",
            data: {"nombre":nombre,"dni":dni,"otorgamiento":1,"id_comercio":id_comercio,"id_credito":id_credito},
        }).done(function(data){
            var done = JSON.parse(data);
            $(".a-otorgamiento").removeAttr("disabled");
            $(".a-otorgamiento").attr("href",done.href);
            $(".a-otorgamiento").attr("download",done.download);
            nro_recibo = done.nro_recibo;
            url_pdf = "../"+done.href;
            console.log(data);
        })
        //descargar(page);
    }

    function guardarFinalizado(){
        envio = {};
        envio['apellido'] = window.litt_cliente_apellido;
        envio['atraso_historico'] = window.litt_cliente_atraso_historico;
        envio['comercio_credito'] = window.litt_cliente_comercio_credito;
        envio['credito_vigente'] = window.litt_cliente_credito_vigente;
        envio['dni'] = window.litt_cliente_dni;
        envio['domicilio_calle'] = window.litt_cliente_domicilio_calle;
        envio['domicilio_altura'] = window.litt_cliente_domicilio_altura;
        envio['domicilio_cpa'] = window.litt_cliente_domicilio_cpa;
        envio['domicilio_localidad'] = window.litt_cliente_domicilio_localidad;
        envio['domicilio_piso'] = window.litt_cliente_domicilio_piso;
        envio['domicilio_depto'] = window.litt_cliente_domicilio_depto;
        envio['domicilio_barrio'] = window.litt_cliente_domicilio_barrio;
        envio['domicilio_manzana'] = window.litt_cliente_domicilio_manzana;
        envio['domicilio_provincia'] = window.litt_cliente_domicilio_provincia;
        envio['empleo_calle'] = window.litt_cliente_empleo_calle;
        envio['empleo_altura'] = window.litt_cliente_empleo_altura;
        envio['empleo_cpa'] = window.litt_cliente_empleo_cpa;
        envio['empleo_empresa'] = window.litt_cliente_empleo_empresa;
        envio['empleo_localidad'] = window.litt_cliente_empleo_localidad;
        envio['empleo_piso'] = window.litt_cliente_empleo_piso;
        envio['empleo_depto'] = window.litt_cliente_empleo_depto;
        envio['empleo_barrio'] = window.litt_cliente_empleo_barrio;
        envio['empleo_manzana'] = window.litt_cliente_empleo_manzana;
        envio['empleo_provincia'] = window.litt_cliente_empleo_provincia;
        envio['empleo_sueldo'] = window.litt_cliente_empleo_sueldo;
        envio['empleo_telefono'] = window.litt_cliente_empleo_telefono;
        envio['estado_mora'] = window.litt_cliente_estado_mora;
        envio['fecha_nacimiento'] = window.litt_cliente_fecha_nacimiento;
        envio['id'] = window.litt_cliente_id;
        envio['mail'] = window.litt_cliente_mail;
        envio['nombre'] = window.litt_cliente_nombre;
        envio['observaciones'] = window.litt_cliente_observaciones;
        envio['referido_nombre'] = window.litt_cliente_referido_nombre;
        envio['referido_parentesco'] = window.litt_cliente_referido_parentesco;
        envio['referido_telefono_celular'] = window.litt_cliente_referido_telefono_celular;
        envio['referido_telefono_fijo'] = window.litt_cliente_referido_telefono_fijo;
        envio['telefono_celular'] = window.litt_cliente_telefono_celular;
        envio['telefono_fijo'] = window.litt_cliente_telefono_fijo;
        // credito
        envio['credito_cuotas'] = window.litt_credito_cuotas;
        envio['credito_monto'] = window.litt_credito_monto;
        envio['credito_plan'] = window.litt_credito_plan;
        envio['credito_producto_designacion'] = window.litt_credito_producto_designacion;
        envio['credito_score'] = window.litt_cliente_score;
        console.log(envio);
        send("crearCredito",envio,function(msg){
            window.msg = msg;
            if(msg.data["exito"]){
                $("#p8").hide();
                $("#p9").show();
                window.litt_credito = msg.data["id_credito"]
                imprimir();
            } else {
                Lobibox.notify("error", {
                    size: 'mini',
                    title: 'Error',
                    msg: 'Hubo un error al guardar el crédito, reintente',
                    showClass: 'fadeInDown',
                    hideClass: 'fadeUpDown',
                    delay: 10000,
                    sound: false
                });
            }
        }, function(msg){
            window.msg = msg;
            Lobibox.notify("error", {
                size: 'mini',
                title: 'Error',
                msg: 'Hubo un error al guardar el crédito, reintente',
                showClass: 'fadeInDown',
                hideClass: 'fadeUpDown',
                delay: 10000,
                sound: false
            });
        });
    }

    function credito_getScoreMinimo(){
        console.log("D")
        send("verazScoreMinimo",null,function(msg){
            console.log(msg)
            window.litt_verazScoreMinimo = msg.data['score'];
        });
    }
</script>
</html>
