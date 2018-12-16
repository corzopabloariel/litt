<?php
$ARR_CSS = array();
$ARR_CSS[] = "/litt/ui/financiera/css/select2.min.css";
$ARR_JS = array();
$ARR_JS[] = "/litt/ui/financiera/js/select2.js";
include('./header.php');
?>
<style type="text/css">
    .select2-container--default .select2-selection--single {
        padding: 5px 8px !important;
        height: auto !important;
        border: 2px solid #41719c;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        top: 8px !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered,
    input[type="text"],textarea, select {
        text-transform: uppercase;
    }
    .row {
        margin:0;
    }
</style>
    <!-- PRIMERA -->
	<div class="container container1">
		<div class="panel-b col-md-8 col-md-offset-2 col-sm-12 col-sm-offset-0 col-xs-12">
			<div class="row panel-title">
                <div class="col-sm-6 col-sm-offset-3" style="border-bottom: 2px solid #769FCD"><h2 align="center">Alta Comercio</h2></div>
                <div class="col-sm-3"><img src="img/comercio.png"></div>
            </div>
            <div class="row">
    			<div class="col-xs-12">
    				<input class="form-control numerico texto-numero" type="tel" name=""  placeholder="C.U.I.T." id="cuit" required="true">
    			</div>
            </div>
            <div class="row">
    			<div class="col-xs-12">
    				<input class="form-control texto-alfanumerico" type="text" name="" placeholder="Razón Social" id="razon_social" required="true">
    			</div>
            </div>
            <div class="row">
                <div class="col-xs-12">
    				<input class="form-control texto-alfanumerico" type="text" name="" placeholder="Nombre fantasia comercio" id="nombre" required="true">
    			</div>
            </div>
            <div class="row">
    			<div class="col-xs-12">
    				<input class="form-control numerico texto-numero" type="tel" name=""  placeholder="DNI Titular" id="dni_titular" required="true">
    			</div>
            </div>
            <div class="row">
    			<div class="col-xs-12">
    				<input class="form-control texto-letra" type="text" name="" placeholder="Nombre Titular" id="nombre_titular" required="true">
    			</div>
            </div>
            <div class="row">
    			<div class="col-xs-12">
    				<input class="form-control texto-mail" type="email" name="" placeholder="Mail" id="mail" required="true" pattern="[^@\s]+@[^@\s]+\.[^@\s]+">
    			</div>
            </div>
            <div class="row">
    			<div class="col-xs-12">
    				<input class="form-control numerico texto-numero" type="tel" name="" placeholder="Teléfono Fijo"  id="telefono_fijo" required="true">
    			</div>
            </div>
            <div class="row">
    			<div class="col-xs-12">
    				<input class="form-control especial texto-numero" type="tel" name="" placeholder="Teléfono celular" id="telefono_celular" required="true">
    			</div>
            </div>

            <div class="row">
                <hr/>
            </div>

            <div class="row">
                <div class="col-xs-12">
                        <input class="form-control texto-alfanumerico" type="text" name="" placeholder="domicilio Comercio Calle" id="domicilio_comercio_calle" required="true">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                        <input class="form-control texto-numero" type="tel" name="" placeholder="domicilio Comercio Altura" id="domicilio_comercio_altura" required="true">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                        <input class="form-control texto-cp" type="text" name="" placeholder="domicilio Comercio Código Postal" id="domicilio_comercio_cpa" required="true">
                </div>
            </div>
                <!-- NUEVO ITEM - TESTING -->
            <div class="row">
                <div class="col-xs-12">
                    <select class="form-control" id="domicilio_comercio_provincia" disabled>
                            <?php
                                $c = R::findAll("provincias");
                                foreach($c as $cx){
                                    ?><option value="<?php echo $cx['id']; ?>" selected="selected"><?php echo $cx['nombre']; ?></option><?php
                                } 
                            ?>

                        </select>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12" style="padding-top: 10px;">
                        <select class="form-control js-example-basic-single" id="domicilio_comercio_localidad" style="width: 100%" required="true">
                            <?php
                            $localidades = R::findAll("localidades");
                            foreach($localidades as $l){
                                ?> <option value="<?php echo $l["id"]; ?>"><?php echo $l["nombre"]; ?></option> <?php
                            } ?>
                        </select>
                </div>
                <div class="col-xs-12">
                        <textarea class="form-control" name="" placeholder="domicilio Comercio Observacion" id="domicilio_comercio_observacion"></textarea>
                </div>
            </div>
                <!-- / NUEVO ITEM -->
            <div class="row">
                <hr/>
            </div>

            <div class="row">
                <div class="col-xs-12">
                        <input class="form-control texto-alfanumerico" type="text" name="" placeholder="domicilio Legal Calle" id="domicilio_legal_calle" required="true">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                        <input class="form-control texto-numero" type="tel" name="" placeholder="domicilio Legal Altura" id="domicilio_legal_altura" required="true">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                        <input class="form-control texto-cp" type="text" name="" placeholder="domicilio Legal Código Postal" id="domicilio_legal_cpa" required="true">
                </div>
            </div>
                <!-- NUEVO ITEM - TESTING -->
            <div class="row">
                <div class="col-xs-12">
                    <select class="form-control" id="domicilio_legal_provincia" disabled>
                            <?php
                                $c = R::findAll("provincias");
                                foreach($c as $cx){
                                    ?><option value="<?php echo $cx['id']; ?>" selected="selected"><?php echo $cx['nombre']; ?></option><?php
                                } 
                            ?>

                        </select>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12" style="padding-top: 10px;">
                        <select class="form-control js-example-basic-single" id="domicilio_legal_localidad" style="width: 100%" required="true">
                            <?php
                            $localidades = R::findAll("localidades");
                            foreach($localidades as $l){
                                ?> <option value="<?php echo $l["id"]; ?>"><?php echo $l["nombre"]; ?></option> <?php
                            } ?>
                        </select>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                        <textarea class="form-control" name="" placeholder="domicilio Legal Observacion" id="domicilio_legal_observacion"></textarea>
                </div>
            </div>
                <!-- / NUEVO ITEM -->
            <div class="row">
                <hr/>
            </div>

            <div class="row">
                <div class="col-xs-12">
                        <input class="form-control texto-alfanumerico" type="text" name="" placeholder="domicilio real Calle" id="domicilio_real_calle" required="true">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                        <input class="form-control texto-numero" type="text" name="" placeholder="domicilio real Altura" id="domicilio_real_altura" required="true">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                        <input class="form-control texto-cp" type="text" name="" placeholder="domicilio real Código Postal" id="domicilio_real_cpa" required="true">
                </div>
            </div>
                <!-- NUEVO ITEM - TESTING -->
            <div class="row">
                <div class="col-xs-12">
                    <select class="form-control" id="domicilio_real_provincia" disabled>
                            <?php
                                $c = R::findAll("provincias");
                                foreach($c as $cx){
                                    ?><option value="<?php echo $cx['id']; ?>" selected="selected"><?php echo $cx['nombre']; ?></option><?php
                                } 
                            ?>

                        </select>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12" style="padding-top: 10px;">
                        <select class="form-control js-example-basic-single" id="domicilio_real_localidad" style="width: 100%" required="true">
                            <?php
                            $localidades = R::findAll("localidades");
                            foreach($localidades as $l){
                                ?> <option value="<?php echo $l["id"]; ?>"><?php echo $l["nombre"]; ?></option> <?php
                            } ?>
                        </select>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                        <textarea class="form-control" name="" placeholder="domicilio real Observacion" id="domicilio_real_observacion"></textarea>
                </div>
            </div>
                <!-- / NUEVO ITEM -->
            <div class="row">
                <hr/>
            </div>

            <div class="row">
    			<div class="col-xs-12" style="padding-top:10px">
                    <?php 
                    $Arubros = Array(2 => "Animales y Mascotas","Arte y Cultura","Bebés","Belleza y Cuidado Personal","Automóviles","Hardware y Software Informático","Descargas","Moda y Complementos","Flores, Regalos y Artesanía","Alimentación y Bebidas","HiFi, Foto y Video","Hogar y Jardìn","Electrodomésticos","Joyería","Lencería y Adultos","mòviles y Telefonía","Servicios","Calzado y Complementos","Deporte y Ocio","Viajes y Turismo");
                    ?>
    				<select class="form-control" id="rubro" style="width: 100%;" required="true">
                        <option value=""></option>
                        <?php 
                        foreach ($Arubros as $key => $value) {
                            echo "<option value='{$key}'>{$value}</option>";
                        }
                        ?>
                    </select>
                    <script>
                        $('#rubro').select2({width: 'resolve',placeholder: 'Rubro'});
                    </script>
    			</div>
            </div>
            <div class="row">
    			<div class="col-xs-12" style="padding-top:10px">
    				<select class="form-control" id="convenios" style="width: 100%;" required="true">
                        <option value=""></option>
                        <?php
                            $c = R::findAll("convenios");
                            foreach($c as $cx){
                                echo "<option value='{$cx["id"]}'>{$cx["nombre"]}</option>";
                            }
                        ?>
                    </select>
                    <script>
                        $('#convenios').select2({width: 'resolve',placeholder: 'Convenios'});
                    </script>
    			</div>
            </div>
            <div class="row">
    			<div class="col-xs-12">
    				<textarea class="form-control" placeholder="Observaciones" id="observaciones"></textarea>
    			</div>
            </div>

			<div class="row"> 	
				<div class="bottom-btns">
					<a href = '/litt/ui/financiera/menuPalLitt.php' class="btn btn-primary btn-lg">Cancelar</a>
					<button class="btn btn-primary btn-lg" id="btn-siguiente">Siguiente</button>
				</div>
			</div>	
		</div>
	</div>
    <!-- /PRIMERA -->
    <!-- SEGUNDA -->
    <div class="container container2" hidden> 
        <div class="panel-b col-md-6 col-md-offset-3 col-sm-12 col-sm-offset-0 col-xs-12">
            <div class="row panel-title">
                    <div class="col-sm-6 col-sm-offset-3" style="border-bottom: 2px solid #769FCD"><h2 align="center">Alta Comercio</h2></div>
                    <div class="col-sm-3"><img src="img/comercio.png"></div>
            </div>

            <!-- <div class="col-xs-12"> <h4 align="center" style="font-weight: 600"> ID COMERCIO : <span>01</span></h4></div> -->
            <div class="row">
                <div class="col-xs-12"> <h4 align="center" style="font-weight: 600"><span id="razon_social2"> Nadia Buenos Aires</span></h4></div>
            </div>
            <div class="row">
                <div class="col-xs-12"> <h4 align="center" style="font-weight: 600"> Titular : <span id="nombre_titular2">Federico Bongiomo</span></h4></div>
            </div>

            <div class="row panel-title">
                <div class="col-sm-6 col-sm-offset-3" style="border-bottom: 2px solid #769FCD"><h2 align="center">Alta Usuario</h2></div>
            </div>

            <div class="row">
                <div class="col-xs-12"><input class="form-control" type="text" name="" placeholder="Nombre Usuario" id="user" required="true"></div>
            </div>
            <div class="row">
                <div class="col-xs-12"><input class="form-control" type="password" name="" placeholder=" Contraseña" id="pass" required="true"></div>
            </div>
            <div class="row">
                <div class="col-xs-12"><input class="form-control" type="password" name="" placeholder=" Repetir Contraseña" id="pass2" required="true"></div>
            </div>
            <div class="row"> 	
                <div class="bottom-btns">
                        <a href = '/litt/ui/financiera/menuPalLitt.php' class="btn btn-primary btn-lg">Cancelar</a>
                        <button class="btn btn-primary btn-lg" id="btn-siguiente2">Siguiente </button>
                </div>
            </div>
        </div>
    </div>
    <!-- /SEGUNDA -->
    <!-- TERCERA -->
    <div class="container container3" hidden> 
        <div class="panel-b col-md-6 col-md-offset-3 col-sm-12 col-sm-offset-0 col-xs-12">
            <div class="row panel-title">
                    <div class="col-sm-6 col-sm-offset-3" style="border-bottom: 2px solid #769FCD"><h2 align="center">Alta Comercio</h2></div>
                    <div class="col-sm-3"><img src="img/comercio.png"></div>
            </div>
            <div class="row">
                <div class="col-xs-12"> <h3 align="center" style="font-weight: 600"> ALTA EXITOSA !</h3></div>
            </div>
            <div class="row">
                <div class="col-xs-12"> <h4 align="center" style="font-weight: 600"> COMERCIO #<span id="id">01</span></h4></div>
            </div>
            <div class="row">
                <div class="col-xs-12"> <h4 id="razon_social3" align="center"> Nadia Buenos Aires</h4></div>
            </div>
            <div class="row">
                <div class="col-xs-12"> <h4 align="center"> Titular : <span id="nombre_titular3">Federico Bongiomo</span></h4></div>
            </div>
            <div class="row">
                <div class="col-xs-12"> <h4 align="center"> Usuario : <span id="user2"> Nadia01 </span></h4></div>
            </div>
            <div class="row">
                <div class="col-xs-12"> <h4 align="center"> Contraseña : <span id="pass3">Nadia01</span></h4></div>
            </div>
            <div class="row">
                <div class="col-xs-12"> <h4 align="center"> Mail : <span id="mail2">Federico@nadia.com.ar</span></h4></div>
            </div>
            <div class="row bottom-btns2">
                <div class="col-xs-12">
                    <a id="subir"><button class="btn btn-primary btn-lg">Subir Archivos </button></a>
                </div>
            </div>

            <div class="row bottom-btns2">
                <div class="col-xs-6 text-right">
                    <a href = '/litt/ui/financiera/menuPalLitt.php' class="btn btn-primary btn-lg">Cancelar</a>
                </div>
                <div class="col-xs-6 text-left">
                    <a href="/litt/ui/financiera/menuPalLitt.php" class="btn btn-primary btn-lg">Finalizar</a>
                </div>
            </div>
            <div class="row bottom-btns2">
                <div class="col-xs-12">
                    <a id="imprimir" href="#" class="btn btn-primary btn-lg print-btn">Imprimir</a></div>
            </div>
        </div>
    </div>
    <!-- /TERCERA -->
<!--30999253675-->
<script type="text/javascript">
    var flag_user = flag_pass = flag_nombre = flag_razon = flag_mail = flag_cuit = -1;

    function validar() {
        var flag = 1;
        $('*[required="true"]').each(function(){
            if($(this).is(":visible")) {
                if($(this).val() == "") {
                	if(flag) $(this).focus();
                    flag = 0;
                    $(this).parent().addClass("has-error");
                }
            }
        });
        return flag;
    }

    function validarEmail(mail) {
        var reg = /^[A-Z0-9_'%=+!`#~$*?^{}&|-]+([\.][A-Z0-9_'%=+!`#~$*?^{}&|-]+)*@[A-Z0-9-]+(\.[A-Z0-9-]+)+$/i;
        if (reg.test(mail) == false) return false;
        return true;
    }
    function validarCuit(cuit) {
        if(cuit.length != 11) {
            return false;
        }
        var acumulado   = 0;
        var digitos     = cuit.split("");
        var digito      = digitos.pop();
 
        for(var i = 0; i < digitos.length; i++) {
            acumulado += digitos[9 - i] * (2 + (i % 6));
        }
 
        var verif = 11 - (acumulado % 11);
        if(verif == 11) {
            verif = 0;
        } else if(verif == 10) {
            verif = 9;
        }
 
        return digito == verif;
    }
    window.litt_consultar_abandonar = true;
    
    $(document).ready(function() {
        $('.js-example-basic-single').select2({width: 'resolve'});
        $("body").on("focus",".has-error *",function() {
            $(this).parent().removeClass("has-error");
        });
        $("#user").on("focusout",function() {
            var valor = $(this).val();
            if(valor != "") {
                $.ajax({
                    url: 'ajax/cliente.php',
                    type: "post",
                    data: {"tipo":"buscar","user":valor},
                    beforeSend: function() {
                        Lobibox.notify("info", {
                            size: 'mini',
                            title: 'Info',
                            msg: 'La solicitud ha sido enviada al servidor',
                            delay: 1000,
                            sound: false
                        });
                    },
                    success: function(data) {
                        console.log(data)
                        if(!data) {
                            $("#user").parent().addClass("has-error");
                            flag_user = 0;
                            Lobibox.notify("error", {
                                size: 'mini',
                                title: 'Error',
                                msg: 'Nombre de usuario en uso',
                                showClass: 'fadeInDown',
                                hideClass: 'fadeUpDown',
                                delay: 10000,
                                sound: false
                            });
                        } else
                            flag_user = 1;
                    }
                })
            }
        });
        $("#razon_social").on("focusout",function() {
            var valor = $(this).val();
            if(valor != "") {
                flag_razon = 1;
                /*$.ajax({
                    url: 'ajax/cliente.php',
                    type: "post",
                    data: {"tipo":"buscar","razon_social":valor},
                    beforeSend: function() {
                        Lobibox.notify("info", {
                            size: 'mini',
                            title: 'Info',
                            msg: 'La solicitud ha sido enviada al servidor',
                            delay: 1000,
                            sound: false
                        });
                    },
                    success: function(data) {
                        console.log(data)
                        if(!data) {
                            $("#razon_social").parent().addClass("has-error");
                            flag_razon = 0;
                            Lobibox.notify("error", {
                                size: 'mini',
                                title: 'Error',
                                msg: 'Razón Social en uso',
                                showClass: 'fadeInDown',
                                hideClass: 'fadeUpDown',
                                delay: 10000,
                                sound: false
                            });
                        } else
                            flag_razon = 1;
                    }
                })*/
            }
        });
        $("#nombre").on("focusout",function() {//NOMBRE DE FANTASIA -> SE DEBE MOSTRAR EN TODO
            var valor = $(this).val();
            if(valor != "") {
                $.ajax({
                    url: 'ajax/cliente.php',
                    type: "post",
                    data: {"tipo":"buscar","nombre":valor},
                    beforeSend: function() {
                        Lobibox.notify("info", {
                            size: 'mini',
                            title: 'Info',
                            msg: 'La solicitud ha sido enviada al servidor',
                            delay: 1000,
                            sound: false
                        });
                    },
                    success: function(data) {
                        console.log(data)
                        if(!data) {
                            $("#nombre").parent().addClass("has-error");
                            flag_nombre = 0;
                            Lobibox.notify("error", {
                                size: 'mini',
                                title: 'Error',
                                msg: 'Nombre de fantasia en uso',
                                showClass: 'fadeInDown',
                                hideClass: 'fadeUpDown',
                                delay: 10000,
                                sound: false
                            });
                        } else
                            flag_nombre = 1;
                    }
                })
            }
        });
        $("#mail").on("focusout",function() {
            if($(this).val() != "") {
                if(validarEmail($(this).val())) {
                    flag_mail = 1;
                    /*$.ajax({
                        url: 'ajax/cliente.php',
                        type: "post",
                        data: {"tipo":"buscar","mail":$(this).val()},
                        beforeSend: function() {
                            Lobibox.notify("info", {
                                size: 'mini',
                                title: 'Info',
                                msg: 'La solicitud ha sido enviada al servidor',
                                delay: 1000,
                                sound: false
                            });
                        },
                        success: function(data) {
                            console.log(data)
                            if(!data) {
                                $("#mail").parent().addClass("has-error");
                                flag_mail = 0;
                                Lobibox.notify("error", {
                                    size: 'mini',
                                    title: 'Error',
                                    msg: 'Mail en uso',
                                    showClass: 'fadeInDown',
                                    hideClass: 'fadeUpDown',
                                    delay: 10000,
                                    sound: false
                                });
                            } else
                                flag_mail = 1;
                        }
                    })*/
                } else {
                    flag_mail = 0;
                    $("#mail").parent().addClass("has-error");
                    Lobibox.notify("error", {
                        size: 'mini',
                        title: 'Error',
                        msg: 'Formato de mail no válido',
                        showClass: 'fadeInDown',
                        hideClass: 'fadeUpDown',
                        delay: 10000,
                        sound: false
                    });
                }
            }
        });
        $("#cuit").on("focusout",function() {
            if($(this).val() != "") {
                if(validarCuit($(this).val())) {
                    flag_cuit = 1;
                    /*$.ajax({
                        url: 'ajax/cliente.php',
                        type: "post",
                        data: {"tipo":"buscar","cuit":$(this).val()},
                        beforeSend: function() {
                            Lobibox.notify("info", {
                                size: 'mini',
                                title: 'Info',
                                msg: 'La solicitud ha sido enviada al servidor',
                                delay: 1000,
                                sound: false
                            });
                        },
                        success: function(data) {
                            console.log(data)
                            if(!data) {
                                $("#cuit").parent().addClass("has-error");
                                flag_cuit = 0;
                                Lobibox.notify("error", {
                                    size: 'mini',
                                    title: 'Error',
                                    msg: 'CUIT en uso',
                                    showClass: 'fadeInDown',
                                    hideClass: 'fadeUpDown',
                                    delay: 10000,
                                    sound: false
                                });
                            } else
                                flag_cuit = 1;
                        }
                    })*/
                } else {
                    flag_cuit = 0;
                    $("#cuit").parent().addClass("has-error");
                    Lobibox.notify("error", {
                        size: 'mini',
                        title: 'Error',
                        msg: 'Verifique el CUIT',
                        showClass: 'fadeInDown',
                        hideClass: 'fadeUpDown',
                        delay: 10000,
                        sound: false
                    });
                }
            }
        });

        $("#pass,#pass2").on("focusout",function() {
            var p1 = $("#pass").val();
            var p2 = $("#pass2").val();

            if(p1 != "" && p2 != "") {
                if(p1 != p2) {
                    flag_pass = false;
                    $("#pass,#pass2").addClass("has-error");
                    Lobibox.notify("error", {
                        size: 'mini',
                        title: 'Error',
                        msg: 'Las claves no coinciden',
                        showClass: 'fadeInDown',
                        hideClass: 'fadeUpDown',
                        delay: 10000,
                        sound: false
                    });
                } else
                    flag_pass = true;
            }
        });
    });
    
    $("#btn-siguiente").on("click",function(){

        window.litt_cuit = $("#cuit").val();
        window.litt_razon_social = $("#razon_social").val();
        window.litt_nombre = $("#nombre").val();
        $("#razon_social2").text(window.litt_razon_social);
        window.litt_dni_titular = $("#dni_titular").val();
        window.litt_nombre_titular = $("#nombre_titular").val();
        $("#nombre_titular2").text(window.litt_nombre_titular);
        window.litt_mail = $("#mail").val();
        window.litt_telefono_fijo = $("#telefono_fijo").val();
        window.litt_telefono_celular = $("#telefono_celular").val();
        window.litt_domicilio_comercio_calle = $("#domicilio_comercio_calle").val();
        window.litt_domicilio_comercio_altura = $("#domicilio_comercio_altura").val();
        window.litt_domicilio_comercio_observacion = $("#domicilio_comercio_observacion").val();
        window.litt_domicilio_comercio_cpa = $("#domicilio_comercio_cpa").val();
        window.litt_domicilio_comercio_provincia = $("#domicilio_comercio_provincia").val();
        window.litt_domicilio_comercio_localidad = $("#domicilio_comercio_localidad").val();
        window.litt_domicilio_legal_calle = $("#domicilio_legal_calle").val();
        window.litt_domicilio_legal_altura = $("#domicilio_legal_altura").val();
        window.litt_domicilio_legal_observacion = $("#domicilio_legal_observacion").val();
        window.litt_domicilio_legal_cpa = $("#domicilio_legal_cpa").val();
        window.litt_domicilio_legal_provincia = $("#domicilio_legal_provincia").val();
        window.litt_domicilio_legal_localidad = $("#domicilio_legal_localidad").val();
        window.litt_domicilio_real_calle = $("#domicilio_real_calle").val();
        window.litt_domicilio_real_altura = $("#domicilio_real_altura").val();
        window.litt_domicilio_real_observacion = $("#domicilio_real_observacion").val();
        window.litt_domicilio_real_cpa = $("#domicilio_real_cpa").val();
        window.litt_domicilio_real_provincia = $("#domicilio_real_provincia").val();
        window.litt_domicilio_real_localidad = $("#domicilio_real_localidad").val();
        window.litt_rubro = $("#rubro").val();
        window.litt_convenio = $("#convenios").val();
        window.litt_observacion = $("#observaciones").val();

        var flag = validar();
        if(flag == 1 && flag_razon == 1 && flag_nombre == 1 && flag_mail == 1 && flag_cuit == 1) {
            $("#btn-siguiente").attr("disabled","disabled");
            $(".container1").hide();
            $(".container2").show();
        } else {
            var msg = "";
            if(flag == 0) {
                msg = "complete los datos marcados";
            } else {
                msg = "Verifique los datos marcados";
            }
            $("html, body").animate({ scrollTop: 0 }, "slow");
            Lobibox.notify("error", {
                size: 'mini',
                title: 'Error',
                msg: msg,
                showClass: 'fadeInDown',
                hideClass: 'fadeUpDown',
                delay: 10000,
                sound: false
            });
        }
    });
    $("#btn-siguiente2").on("click",function(){
        $("#btn-siguiente2").attr("disabled","disabled");
        
        var v = validar();
        if(v == 0) {
            Lobibox.notify("error", {
                size: 'mini',
                title: 'Error',
                msg: 'Faltan datos necesarios',
                showClass: 'fadeInDown',
                hideClass: 'fadeUpDown',
                delay: 10000,
                sound: false
            });
        } else {

        if(flag_user && flag_pass) {
            window.litt_user = $("#user").val();
            window.litt_pass = $("#pass").val();
            
            envio = {};
            envio["cuit"] = window.litt_cuit;
            envio["razon_social"] = window.litt_razon_social;
            envio["nombre"] = window.litt_nombre;
            envio["dni_titular"] = window.litt_dni_titular;
            envio["nombre_titular"] = window.litt_nombre_titular;
            envio["mail"] = window.litt_mail;
            envio["telefono_fijo"] = window.litt_telefono_fijo;
            envio["telefono_celular"] = window.litt_telefono_celular;
            envio["domicilio_comercio_calle"] = window.litt_domicilio_comercio_calle;
            envio["domicilio_comercio_altura"] = window.litt_domicilio_comercio_altura;
            envio["domicilio_comercio_observacion"] = window.litt_domicilio_comercio_observacion;
            envio["domicilio_comercio_cpa"] = window.litt_domicilio_comercio_cpa;
            envio["domicilio_comercio_provincia"] = window.litt_domicilio_comercio_provincia;
            envio["domicilio_comercio_localidad"] = window.litt_domicilio_comercio_localidad;
            envio["domicilio_legal_calle"] = window.litt_domicilio_legal_calle;
            envio["domicilio_legal_altura"] = window.litt_domicilio_legal_altura;
            envio["domicilio_legal_observacion"] = window.litt_domicilio_legal_observacion;
            envio["domicilio_legal_cpa"] = window.litt_domicilio_legal_cpa;
            envio["domicilio_legal_provincia"] = window.litt_domicilio_legal_provincia;
            envio["domicilio_legal_localidad"] = window.litt_domicilio_legal_localidad;

            envio["domicilio_real_calle"] = window.litt_domicilio_real_calle;
            envio["domicilio_real_altura"] = window.litt_domicilio_real_altura;
            envio["domicilio_real_observacion"] = window.litt_domicilio_real_observacion;
            envio["domicilio_real_cpa"] = window.litt_domicilio_real_cpa;
            envio["domicilio_real_provincia"] = window.litt_domicilio_real_provincia;
            envio["domicilio_real_localidad"] = window.litt_domicilio_real_localidad;
            envio["observacion"] = window.litt_observacion;
            envio["rubro"] = window.litt_rubro;
            envio["convenio"] = window.litt_convenio;
            envio["user"] = window.litt_user;
            envio["pass"] = window.litt_pass;
            
            send("crearComercio",envio,function(msg){
                if(msg.data["exito"]){
                    crearCarpeta(msg.data["id"]);
                    $("#id").text(msg.data["id"]);
                    $("#imprimir").attr("href","/litt/ui/financiera/altaComFinal.php?id=" + msg.data["id"]);
                    $("#subir").attr("href","/litt/ui/financiera/subirArchivos.php?id=" + msg.data["id"]);
                    $("#razon_social3").text(window.litt_razon_social);
                    $("#nombre_titular3").text(window.litt_nombre_titular);
                    $("#user2").text(window.litt_user);
                    $("#pass3").text(window.litt_pass);
                    $("#mail2").text(window.litt_mail);
                    $(".container2").hide();
                    $(".container3").show();
                }
            },function(msg){
                Lobibox.notify("error", {
                    size: 'mini',
                    title: 'Error',
                    msg: 'Hubo un error al intentar crear el comercio, compruebe su conexión',
                    showClass: 'fadeInDown',
                    hideClass: 'fadeUpDown',
                    delay: 10000,
                    sound: false
                });
            });
            
            }
        }
    });
function crearCarpeta(id) {
    $.ajax({
        url: 'carpeta.php',
        type: "post",
        data: {"comercio":id},
        success: function(data) {
            console.log(data)
            
        }
    })
}
</script>

</body>
</html>