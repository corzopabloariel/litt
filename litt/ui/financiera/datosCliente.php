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

if(!isset($_GET['id'])) exit();

$id = $_GET['id'];


?>
<style type="text/css" media="screen">
    .select2-container { margin-top: 10px !important; margin-bottom: 10px !important; }
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
    .none {
        display: none !important
    }
</style>
<div class="container"> 
    <div class="panel-a c-data-panel col-md-8 col-md-offset-2 col-sm-12 col-sm-offset-0 col-xs-10 col-xs-offset-1" id="imprimible">
        <?php
        $c = R::findOne("clientes", "id LIKE ?", [$id]);
        
        ?>
        <div class="row panel-title">
            <div class="col-sm-3 "></div>
            <div class="col-sm-6" style="border-bottom: 2px solid #769FCD;margin-bottom:20px">
                <h2 align="center">
                    Datos Cliente
                </h2>
            </div>
             <div class="col-sm-3" style="margin-top: 10px;"></div>
        </div>


        <div class="form-group">
            <div class="row">
                <div class="col-sm-6" style="margin-top: 10px;">
                    <label>
                        DNI
                    </label>
                    <input disabled class="form-control texto-numero" type="text" name="dni" id="dni" placeholder="DNI" value="<?php echo $c["dni"]; ?>" pattern=".{7,8}" maxlength="8" required="true">
                </div>
                 <div class="col-sm-6" style="margin-top: 10px;">
                    <label>
                        Fecha Nacimiento
                    </label>
                    <input disabled class="form-control fecha" type="text" name="fecha_nacimiento" id="fecha_nacimiento" placeholder="Fecha Nacimiento" value="<?php echo $c["fecha_nacimiento"]; ?>" required="true">
                </div>
            </div>
        </div>        

        
        <div class="form-group">
            <div class="row">
             <div class="col-sm-6" style="margin-top: 10px;">
                <label>
                    Apellido
                </label>
                <input disabled class="form-control texto-letra" type="text" name="apellido" id="apellido" placeholder="Apellido" value="<?php echo $c["apellido"]; ?>" required="true">
            </div>
             <div class="col-sm-6" style="margin-top: 10px;">
                <label>
                    Nombre
                </label>
                <input disabled class="form-control texto-letra" type="text" name="nombre" id="nombre" placeholder="Nombre" value="<?php echo $c["nombre"]; ?>" required="true">
            </div>
        </div>
        </div>
        
        
        
        <div class="form-group">
            <div class="row">
             <div class="col-sm-4" style="margin-top: 10px;">
                <label>
                    Teléfono Fijo
                </label>
                <input disabled class="form-control texto-numero" type="text" name="telefono_fijo" id="telefono_fijo" placeholder="Teléfono Fijo"  value="<?php echo $c["telefono_fijo"]; ?>">
            </div>
             <div class="col-sm-4" style="margin-top: 10px;">
                <label>
                    Teléfono Celular
                </label>
                <input disabled class="form-control texto-numero" type="text" name="telefono_celular" id="telefono_celular" placeholder="Teléfono Celular"  value="<?php echo $c["telefono_celular"]; ?>">
            </div>
             <div class="col-sm-4" style="margin-top: 10px;">
                <label>
                    E-Mail
                </label>
                <input disabled class="form-control texto-mail" type="text" name="mail" id="mail" placeholder="E-Mail" value="<?php echo $c["mail"]; ?>" required="true">
            </div>
        </div>
        </div>
        <div class="row">
            <h3 align="center">
                Domicilio Particular
            </h3>
        </div>
        <div class="form-group">
            <div class="row">
             <div class="col-sm-4" style="margin-top: 10px;">
                <label>
                    Calle
                </label>
                <input disabled class="form-control texto-alfanumerico" type="text" name="domicilio_calle" id="domicilio_calle" placeholder="Calle" value="<?php echo $c["domicilio_calle"]; ?>" required="true">
            </div>
             <div class="col-sm-4" style="margin-top: 10px;">
                <label>Altura</label>
                <input disabled class="form-control texto-numero" type="text" name="domicilio_altura" id="domicilio_altura" placeholder="Altura" value="<?php echo $c["domicilio_altura"]; ?>" required="true">
            </div>
             <div class="col-sm-4" style="margin-top: 10px;">
                <label>Piso</label>
                <input disabled class="form-control texto-alfanumerico" type="text" name="domicilio_piso" id="domicilio_piso" placeholder="Piso" value="<?php echo $c["domicilio_piso"]; ?>" required="true">
            </div>
             <div class="col-sm-4" style="margin-top: 10px;">
                <label>Departamento</label>
                <input disabled class="form-control texto-alfanumerico" type="text" name="domicilio_depto" id="domicilio_depto" placeholder="Departamento" value="<?php echo $c["domicilio_depto"]; ?>" required="true">
            </div>
             <div class="col-sm-4" style="margin-top: 10px;">
                <label>Barrio</label>
                <input disabled class="form-control texto-alfanumerico" type="text" name="domicilio_barrio" id="domicilio_barrio" placeholder="Barrio" value="<?php echo $c["domicilio_barrio"]; ?>" required="true">
            </div>
             <div class="col-sm-4" style="margin-top: 10px;">
                <label>Manzana</label>
                <input disabled class="form-control texto-alfanumerico" type="text" name="domicilio_manzana" id="domicilio_manzana" placeholder="Manzana" value="<?php echo $c["domicilio_manzana"]; ?>" required="true">
            </div>
             <div class="col-sm-6" style="margin-top: 10px;">
                <label>
                    Localidad
                </label>
                <select disabled class="form-control loc" name="domicilio_localidad" id="domicilio_localidad" style="width: 100%" required="true">
                    <option value=""></option>
                    <?php 
                    $localidades = R::findAll("localidades");
                    foreach($localidades AS $l) {
                        echo "<option " . (strtoupper($c['domicilio_localidad']) == strtoupper($l["nombre"]) ? 'selected="true"' : '') . " value='{$l["nombre"]}'>{$l["nombre"]}</option>";
                    }
                    ?>
                </select>
                <script>
                    
                    $("*[name='domicilio_localidad']").select2({
                        placeholder: 'LOCALIDAD',
                        allowClear: true,
                        width: 'resolve',
                    })
                </script>
            </div>
             <div class="col-sm-6" style="margin-top: 10px;">
                <label>
                    Provincia
                </label>
                <select disabled class="form-control" name="domicilio_provincia" id="domicilio_provincia" style="width: 100%" required="true">
                    <option value=""></option>
                    <?php 
                    $provincias = R::findAll("provincias");
                    foreach($provincias AS $l) {
                        echo "<option " . (strtoupper($c['domicilio_provincia']) == strtoupper($l["nombre"]) ? 'selected="true"' : '') . " value='{$l["nombre"]}'>{$l["nombre"]}</option>";
                    }
                    ?>
                </select>
                <script>
                    
                    $("*[name='domicilio_provincia']").select2({
                        placeholder: 'PROVINCIA',
                        allowClear: true,
                        width: 'resolve',
                    })
                </script>
            </div>
             <div class="col-sm-4" style="margin-top: 10px;">
                <label>
                    Código Postal
                </label>
                <input disabled class="form-control texto-cp" type="text" name="domicilio_cpa" id="domicilio_cpa" placeholder="Código Postal" value="<?php echo $c["domicilio_cpa"]; ?>" required="true">
            </div>
        </div>
        </div>
        <div class="row">
            <h3 align="center">
                Domicilio Laboral
            </h3>
        </div>
        <div class="form-group">
            <div class="row">
             <div class="col-sm-4" style="margin-top: 10px;">
                <label>
                    Calle
                </label>
                <input disabled class="form-control texto-alfanumerico" type="text" name="empleo_calle" id="empleo_calle" placeholder="Calle" value="<?php echo $c["empleo_calle"]; ?>" required="true">
            </div>
             <div class="col-sm-4" style="margin-top: 10px;">
                <label>Altura</label>
                <input disabled class="form-control texto-alfanumerico" type="text" name="empleo_altura" id="empleo_altura" placeholder="Altura" value="<?php echo $c["empleo_altura"]; ?>" required="true">
            </div>
             <div class="col-sm-4" style="margin-top: 10px;">
                <label>
                    Piso
                </label>
                <input disabled class="form-control texto-alfanumerico" type="text" name="empleo_piso" id="empleo_piso" placeholder="Piso" value="<?php echo $c["empleo_piso"]; ?>" required="true">
            </div>
             <div class="col-sm-4" style="margin-top: 10px;">
                <label>
                    Departamento
                </label>
                <input disabled class="form-control texto-alfanumerico" type="text" name="empleo_depto" id="empleo_depto" placeholder="Departamento" value="<?php echo $c["empleo_depto"]; ?>" required="true">
            </div>
             <div class="col-sm-4" style="margin-top: 10px;">
                <label>
                    Barrio
                </label>
                <input disabled class="form-control texto-alfanumerico" type="text" name="empleo_barrio" id="empleo_barrio" placeholder="Barrio" value="<?php echo $c["empleo_barrio"]; ?>" required="true">
            </div>
             <div class="col-sm-4" style="margin-top: 10px;">
                <label>
                    Manzana
                </label>
                <input disabled class="form-control texto-alfanumerico" type="text" name="empleo_manzana" id="empleo_manzana" placeholder="Manzana" value="<?php echo $c["empleo_manzana"]; ?>" required="true">
            </div>
             <div class="col-sm-6" style="margin-top: 10px;">
                <label>
                    Localidad
                </label>
                <select disabled class="form-control loc" name="empleo_localidad" id="empleo_localidad" style="width: 100%" required="true">
                    <option value=""></option>
                    <?php 
                    $localidades = R::findAll("localidades");
                    foreach($localidades AS $l) {
                        echo "<option " . (strtoupper($c['empleo_localidad']) == strtoupper($l["nombre"]) ? 'selected="true"' : '') . " value='{$l["nombre"]}'>{$l["nombre"]}</option>";
                    }
                    ?>
                </select>
                <script>
                    
                    $("*[name='empleo_localidad']").select2({
                        placeholder: 'LOCALIDAD',
                        allowClear: true,
                        width: 'resolve',
                    })
                </script>
            </div>
             <div class="col-sm-6" style="margin-top: 10px;">
                <label>
                    Provincia
                </label>
                <select disabled class="form-control" name="empleo_provincia" id="empleo_provincia" style="width: 100%" required="true">
                    <option value=""></option>
                    <?php 
                    $provincias = R::findAll("provincias");
                    foreach($provincias AS $l) {
                        echo "<option " . (strtoupper($c['empleo_provincia']) == strtoupper($l["nombre"]) ? 'selected="true"' : '') . " value='{$l["nombre"]}'>{$l["nombre"]}</option>";
                    }
                    ?>
                </select>
                <script>
                    
                    $("*[name='empleo_provincia']").select2({
                        placeholder: 'PROVINCIA',
                        allowClear: true,
                        width: 'resolve',
                    })
                </script>
            </div>
             <div class="col-sm-4" style="margin-top: 10px;">
                <label>
                    Código Postal
                </label>
                <input disabled class="form-control texto-cp" type="text" name="empleo_cpa" id="empleo_cpa" placeholder="Código Postal" value="<?php echo $c["empleo_cpa"]; ?>" required="true">
            </div>
        </div>
        </div>
        <div class="row">
            <h3 align="center">
                Referido
            </h3>
        </div>
        <div class="form-group">
            <div class="row">
             <div class="col-sm-3" style="margin-top: 10px;">
                <label>
                    Nombre Completo
                </label>
                <input disabled class="form-control texto-letra" type="text" name="referido_nombre" id="referido_nombre" placeholder="Nombre Completo" value="<?php echo $c["referido_nombre"]; ?>" required="true">
            </div>
             <div class="col-sm-3" style="margin-top: 10px;">
                <label>
                    Teléfono Fijo
                </label>
                <input disabled class="form-control texto-numero" type="text" name="referido_telefono_fijo" id="referido_telefono_fijo" placeholder="Teléfono Fijo" value="<?php echo $c["referido_telefono_fijo"]; ?>">
            </div>
             <div class="col-sm-3" style="margin-top: 10px;">
                <label>
                    Teléfono Celular
                </label>
                <input disabled class="form-control texto-numero" class="form-control" type="text" name="referido_telefono_celular" id="referido_telefono_celular" placeholder="Teléfono Celular" value="<?php echo $c["referido_telefono_celular"]; ?>">
            </div>
             <div class="col-sm-3" style="margin-top: 10px;">
                <label>
                    Parentesco
                </label>
                <input disabled class="form-control texto-letra" type="text" name="referido_parentesco" id="referido_parentesco" placeholder="Parentesco" value="<?php echo $c["referido_parentesco"]; ?>" required="true">
            </div>
        </div>
        </div>
        <div class="row">
            <h3 align="center">
                Empleo
            </h3>
        </div>
        <div class="form-group">
            <div class="row">
             <div class="col-sm-4" style="margin-top: 10px;">
                <label>
                    Empresa
                </label>
                <input disabled class="form-control texto-alfanumerico" type="text" name="empleo_empresa" id="empleo_empresa" placeholder="Empresa" value="<?php echo $c["empleo_empresa"]; ?>" required="true">
            </div>
             <div class="col-sm-4" style="margin-top: 10px;">
                <label>
                    Teléfono Fijo
                </label>
                <input disabled class="form-control" type="text" name="empleo_telefono" id="empleo_telefono" placeholder="Teléfono Fijo" value="<?php echo $c["empleo_telefono"]; ?>" required="true">
            </div>
             <div class="col-sm-4" style="margin-top: 10px;">
                <label>
                    Sueldo Neto
                </label>
                <input disabled class="form-control texto-numero" type="text" name="empleo_sueldo" id="empleo_sueldo" placeholder="Sueldo Neto" value="<?php echo $c["empleo_sueldo"]; ?>" required="true">
            </div>
        </div>
        </div>
        <div class="row">
        <div class="form-group">
             <div class="col-xs-12" style="margin-top: 10px;">
                <label>
                    Observaciones
                </label>
                <textarea disabled="true" class="form-control" placeholder="Observaciones" name="observaciones" id="observaciones" style="height:120px"><?php echo $c["observaciones"]; ?></textarea>	
            </div>
        </div>
    </div>
        <div class="row">
        <div class="bottom-btns text-center">
            <a href="/litt/ui/financiera/clientes.php" class="btn btn-primary btn-lg exit-btn">Salir</a>
            <button class="btn btn-primary btn-lg c-data-edit edit-btn" id="btn-editar">
                Editar
            </button>
            <button disabled="true" class="btn btn-primary btn-lg save-btn" id="btn-guardar">
                Guardar
            </button>
            <!--<button class="btn btn-primary btn-lg print-btn" onclick="print();">
                Imprimir
            </button>-->
        </div>
    </div>
    </div>
</div>
		
<script type="text/javascript">
    $(document).ready(function() {
        
        //$("#p2,#p3,#p4,#p5,#p6,#p7,#p8,#p9").hide();
        fecha_datepicker();
        $("body").on("focus",".has-error *",function() {
            $(this).parent().removeClass("has-error");
        });
    });
    $("#btn-editar").click(function() {
        $("#btn-editar").attr("disabled",true);
        $("#btn-guardar").removeAttr("disabled");
        $("#empleo_localidad,#domicilio_localidad,textarea").removeAttr("disabled");
    });

    function validar() {
        var flag = 1;
        $('*[required="true"]').each(function(){
            if($(this).is(":visible")) {
                if($(this).is(":invalid")) {
                    flag = 0;
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    $(this).parent().addClass("has-error");
                }
            }
        });
        return flag;
    }

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
    window.litt_consultar_abandonar = true;
    $("#btn-guardar").on("click",function(){
        $("input[type='text'],#empleo_localidad,#domicilio_localidad,#btn-guardar").attr("disabled",true);
        if(validar()){
            envio = {};
            envio["id"] = <?php echo $_GET['id']; // PHP PARA EL ID ?>;
            envio["dni"] = $("#dni").val();
            envio["nombre"] = $("#nombre").val();
            envio["apellido"] = $("#apellido").val();
            envio["fecha_nacimiento"] = $("#fecha_nacimiento").val();
            envio["telefono_fijo"] = $("#telefono_fijo").val();
            envio["telefono_celular"] = $("#telefono_celular").val();
            envio["mail"] = $("#mail").val();
            envio["domicilio_calle"] = $("#domicilio_calle").val();
            envio["domicilio_altura"] = $("#domicilio_altura").val();
            envio["domicilio_depto"] = $("#domicilio_depto").val();
            envio["domicilio_piso"] = $("#domicilio_piso").val();
            envio["domicilio_barrio"] = $("#domicilio_barrio").val();
            envio["domicilio_manzana"] = $("#domicilio_manzana").val();
            envio["domicilio_cpa"] = $("#domicilio_cpa").val();
            envio["domicilio_localidad"] = $("#domicilio_localidad").val();
            envio["domicilio_provincia"] = $("#domicilio_provincia").val();
            envio["referido_nombre"] = $("#referido_nombre").val();
            envio["referido_telefono_fijo"] = $("#referido_telefono_fijo").val();
            envio["referido_telefono_celular"] = $("#referido_telefono_celular").val();
            envio["referido_parentesco"] = $("#referido_parentesco").val();
            envio["empleo_empresa"] = $("#empleo_empresa").val();
            envio["empleo_telefono"] = $("#empleo_telefono").val();
            envio["empleo_sueldo"] = $("#empleo_sueldo").val();
            envio["empleo_calle"] = $("#empleo_calle").val();
            envio["empleo_altura"] = $("#empleo_altura").val();
            envio["empleo_piso"] = $("#empleo_piso").val();
            envio["empleo_depto"] = $("#empleo_depto").val();
            envio["empleo_barrio"] = $("#empleo_barrio").val();
            envio["empleo_manzana"] = $("#empleo_manzana").val();
            envio["empleo_cpa"] = $("#empleo_cpa").val();
            envio["empleo_localidad"] = $("#empleo_localidad").val();
            envio["empleo_provincia"] = $("#empleo_provincia").val();
            envio["observaciones"] = $("#observaciones").val();
            console.log(envio);
            send("guardarCliente",envio,function(msg){
                window.msg = msg;
                if(msg.data["exito"]){
                    Lobibox.notify("success", {
                        size: 'mini',
                        msg: 'Se ha actualizado la información del usuario con éxito.',
                        showClass: 'fadeInDown',
                        hideClass: 'fadeUpDown',
                        delay: 6000,
                        sound: false
                    });
                    setTimeout(function() {
                        window.location.href = window.location.href;
                    },6000);
                } else alert("hubo un inconveniente, reintente");
            },function(msg){
                $("input[type='text'],#empleo_localidad,#domicilio_localidad,#btn-guardar").removeAttr("disabled");
                Lobibox.notify("error", {
                    size: 'mini',
                    title: 'Error',
                    msg: 'Hubo un inconveniente, reintente',
                    showClass: 'fadeInDown',
                    hideClass: 'fadeUpDown',
                    delay: 10000,
                    sound: false
                });
            });
        } else {
            $("input[type='text'],#empleo_localidad,#domicilio_localidad,#btn-guardar").removeAttr("disabled");
            Lobibox.notify("error", {
                size: 'mini',
                title: 'Error',
                msg: 'Faltan datos necesarios del cliente',
                showClass: 'fadeInDown',
                hideClass: 'fadeUpDown',
                delay: 10000,
                sound: false
            });
        }
    });
    
</script>

</body>
</html>
