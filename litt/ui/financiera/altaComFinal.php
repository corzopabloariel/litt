<?php
$ARR_CSS = array();
$ARR_CSS[] = "/litt/ui/financiera/css/select2.min.css";
$ARR_CSS[] = "/litt/ui/financiera/css/messagebox.css";
$ARR_JS = array();
$ARR_JS[] = "/litt/ui/financiera/js/select2.js";
$ARR_JS[] = "/litt/ui/financiera/js/messagebox.js";
$ARR_JS[] = "/litt/ui/financiera/js/lobibox.js";
include('./header.php');

// cargo el comercio por id

if(!isset($_GET['id'])) exit();

$id = $_GET['id'];
$c = R::findOne("comercios","id LIKE ?",array($id));


$referer = (isset($_SERVER['HTTP_REFERER'])) ? strtolower($_SERVER['HTTP_REFERER']) : "error";

$url = ($referer == "error" ? Array() : explode("/",$referer));
?>
<div class="container"> 
    <div class="panel-b col-md-8 col-md-offset-2 col-sm-12 col-sm-offset-0 col-xs-10 col-xs-offset-1">
        <div class="row panel-title">
            <div class="col-sm-6 col-sm-offset-3" style="border-bottom: 2px solid #769FCD;margin-bottom:20px"><h2 align="center"><?php echo strtoupper($c["nombre"]); ?></h2></div>
        </div>

        <div class="u-data-panel" id="imprimible" style="display: block">
            <div class="row col-espacio-t">
                <div class="col-xs-12 col-sm-6 col-text-center"><strong>Razon Social</strong></div>
                <div class="col-xs-12 col-sm-6"><input type="text" required="true" class="texto-alfanumerico col-text-center" value="<?php echo $c["razon_social"]; ?>" id="razon_social" disabled></div>
            </div>

            <div class="row col-espacio-t">
                <div class="col-xs-12 col-sm-6 col-text-center"><strong>Nombre de Fantasía</strong></div>
                <div class="col-xs-12 col-sm-6"><input type="text" required="true" class="texto-alfanumerico col-text-center" value="<?php echo $c["nombre"]; ?>" id="nombre" disabled></div>
            </div>
            <div class="row col-espacio-t">
                <div class="col-xs-12 col-sm-6 col-text-center"><strong>CUIT</strong></div>
                <div class="col-xs-12 col-sm-6"><input type="text" required="true" class="texto-numero col-text-center" value="<?php echo $c["cuit"]; ?>" id="cuit" disabled></div>
            </div>
            <div class="row col-espacio-t">
                <div class="col-xs-12 col-sm-6 col-text-center"><strong>Titular</strong></div>
                <div class="col-xs-12 col-sm-6"><input type="text" required="true" class="texto-letra col-text-center" value="<?php echo $c["nombre_titular"]; ?>" id="nombre_titular" disabled></div>
            </div>
            <div class="row col-espacio-t">
                <div class="col-xs-12 col-sm-6 col-text-center"><strong>DNI</strong></div>
                <div class="col-xs-12 col-sm-6"><input type="text" required="true" class="texto-numero col-text-center" value="<?php echo $c["dni_titular"]; ?>" id="dni_titular" disabled></div>
            </div>
            <div class="row col-espacio-t">
                <div class="col-xs-12 col-sm-6 col-text-center"><strong>Mail</strong></div>
                <div class="col-xs-12 col-sm-6"><input type="text" class="col-text-center" value="<?php echo $c["mail"]; ?>" id="mail"disabled></div>
            </div>
            <div class="row col-espacio-t">
                <div class="col-xs-12 col-sm-6 col-text-center"><strong>Teléfono Fijo</strong></div>
                <div class="col-xs-12 col-sm-6"><input type="text" class="texto-numero col-text-center" value="<?php echo $c["telefono_fijo"]; ?>" id="telefono_fijo" disabled></div>
            </div>
            <div class="row col-espacio-t">
                <div class="col-xs-12 col-sm-6 col-text-center"><strong>Teléfono Celular</strong></div>
                <div class="col-xs-12 col-sm-6"><input type="text" class="texto-numero col-text-center" value="<?php echo $c["telefono_celular"]; ?>" id="telefono_celular" disabled></div>
            </div>
            <div class="row col-espacio-t">
                <div class="col-xs-12"><hr/></div>
            </div>
            <!-- domicilio comercio -->
            <?php
            $x = R::getRow( 'SELECT CONCAT("de la localidad de ",L.nombre,", Provincia de ",P.nombre) AS nombre FROM localidades AS L JOIN provincias AS P ON (L.id_provincia = P.id) WHERE L.id = :localidad', array(':localidad'=>$c["domicilio_comercio_localidad"]) );
            ?>
            <input type="hidden" name="" id="domicilio_comercio" value="<?php echo $x['nombre']; ?>">
            <?php
            $x = R::getRow( 'SELECT CONCAT(L.nombre,", ",P.nombre) AS nombre FROM localidades AS L JOIN provincias AS P ON (L.id_provincia = P.id) WHERE L.id = :localidad', array(':localidad'=>$c["domicilio_comercio_localidad"]) );
            ?>
            <input type="hidden" name="" id="domicilio_comercial" value="<?php echo $x['nombre']; ?>">
            <div class="row col-espacio-t">
                <div class="col-xs-12 col-sm-6 col-text-center"><strong>Domicilio Comercio Calle</strong></div>
                <div class="col-xs-12 col-sm-6">
                    <input type="text" required="true" class="texto-alfanumerico col-text-center" value="<?php echo $c["domicilio_comercio_calle"]; ?>" id="domicilio_comercio_calle" disabled>
                </div>
            </div>
            <div class="row col-espacio-t">
                <div class="col-xs-12 col-sm-6 col-text-center"><strong>Domicilio Comercio Altura</strong></div>
                <div class="col-xs-12 col-sm-6">
                    <input type="text" required="true" class="texto-numero col-text-center" value="<?php echo $c["domicilio_comercio_altura"]; ?>" id="domicilio_comercio_altura" disabled>
                </div>
            </div>
            <div class="row col-espacio-t">
                <div class="col-xs-12 col-sm-6 col-text-center"><strong>Domicilio Comercio Observación</strong></div>
                <div class="col-xs-12 col-sm-6">
                    <input type="text" class="col-text-center" value="<?php echo $c["domicilio_comercio_observacion"]; ?>" id="domicilio_comercio_observacion" disabled>
                </div>
            </div>
            <div class="row col-espacio-t">
                <div class="col-xs-12 col-sm-6 col-text-center"><strong>Domicilio Comercio Código Postal</strong></div>
                <div class="col-xs-12 col-sm-6">
                    <input type="text" required="true" class="texto-cp col-text-center" value="<?php echo $c["domicilio_comercio_cpa"]; ?>" id="domicilio_comercio_cpa" disabled>
                </div>
            </div>
            <div class="row col-espacio-t">
                <div class="col-xs-12 col-sm-6 col-text-center"><strong>Domicilio Comercio Provincia</strong></div>
                <div class="col-xs-12 col-sm-6">
                    <select required="true" class="js-example-basic-single" id="domicilio_comercio_provincia" disabled style="width: 100%">
                        <?php
                        $con = R::findAll("provincias");
                        foreach ($con as $i) {
                            ?><option value="<?php echo $i["id"] ?>" <?php if ($c["domicilio_comercio_provincia"] == $i["id"]) echo "selected"; ?>>
                                <?php echo $i["nombre"] ?>
                            </option><?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row col-espacio-t">
                <div class="col-xs-12 col-sm-6 col-text-center"><strong>Domicilio Comercio Localidad</strong></div>
                <div class="col-xs-12 col-sm-6">
                    <select required="true" class="js-example-basic-single" id="domicilio_comercio_localidad" disabled style="width: 100%">
                        <?php
                        $con = R::findAll("localidades");
                        foreach ($con as $i) {
                            ?><option value="<?php echo $i["id"] ?>" <?php if ($c["domicilio_comercio_localidad"] == $i["id"]) echo "selected"; ?>>
                                <?php echo $i["nombre"] ?>
                            </option><?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <!-- / domicilio comercio -->
            <div class="row">
                <div class="col-xs-12"><hr/></div>
            </div>
            <!-- domicilio legal -->
            <?php
            $x = R::getRow( 'SELECT CONCAT("de la localidad de ",L.nombre,", Provincia de ",P.nombre) AS nombre FROM localidades AS L JOIN provincias AS P ON (L.id_provincia = P.id) WHERE L.id = :localidad', array(':localidad'=>$c["domicilio_legal_localidad"]) );
            ?>
            <input type="hidden" name="" id="domicilio_legal" value="<?php echo $x['nombre']; ?>">
            <div class="row col-espacio-t">
                <div class="col-xs-12 col-sm-6 col-text-center"><strong>Domicilio Legal Calle</strong></div>
                <div class="col-xs-12 col-sm-6">
                    <input type="text" required="true" class="texto-alfanumerico col-text-center" value="<?php echo $c["domicilio_legal_calle"]; ?>" id="domicilio_legal_calle" disabled>
                </div>
            </div>
            <div class="row col-espacio-t">
                <div class="col-xs-12 col-sm-6 col-text-center"><strong>Domicilio Legal Altura</strong></div>
                <div class="col-xs-12 col-sm-6">
                    <input type="text" required="true" class="texto-numero col-text-center" value="<?php echo $c["domicilio_legal_altura"]; ?>" id="domicilio_legal_altura" disabled>
                </div>
            </div>
            <div class="row col-espacio-t">
                <div class="col-xs-12 col-sm-6 col-text-center"><strong>Domicilio Legal Observación</strong></div><div class="col-xs-12 col-sm-6">
                    <input type="text" class="col-text-center" value="<?php echo $c["domicilio_legal_observacion"]; ?>" id="domicilio_legal_observacion" disabled>
                </div>
            </div>
            <div class="row col-espacio-t">
                <div class="col-xs-12 col-sm-6 col-text-center"><strong>Domicilio Legal Código Postal</strong></div>
                <div class="col-xs-12 col-sm-6">
                    <input class="col-text-center texto-cp" value="<?php echo $c["domicilio_legal_cpa"]; ?>" id="domicilio_legal_cpa" disabled>
                </div>
            </div>
            <div class="row col-espacio-t">
                <div class="col-xs-12 col-sm-6 col-text-center"><strong>Domicilio Legal Provincia</strong></div>
                <div class="col-xs-12 col-sm-6">
                    <select required="true" class="js-example-basic-single" id="domicilio_legal_provincia" disabled style="width: 100%">
                        <?php
                        $con = R::findAll("provincias");
                        foreach ($con as $i) {
                            ?><option value="<?php echo $i["id"] ?>" <?php if ($c["domicilio_legal_provincia"] == $i["id"]) echo "selected"; ?>>
                                <?php echo $i["nombre"] ?>
                            </option><?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row col-espacio-t">
                <div class="col-xs-12 col-sm-6 col-text-center"><strong>Domicilio Legal Localidad</strong></div>
                <div class="col-xs-12 col-sm-6">
                    <select required="true" class=" js-example-basic-single" id="domicilio_legal_localidad" disabled style="width: 100%;">
                        <?php
                        $con = R::findAll("localidades");
                        foreach ($con as $i) {
                            ?><option value="<?php echo $i["id"] ?>" <?php if ($c["domicilio_legal_localidad"] == $i["id"]) echo "selected"; ?>>
                                <?php echo $i["nombre"] ?>
                            </option><?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <!-- / domicilio legal -->
            <div class="row col-espacio-t">
                <div class="col-xs-12"><hr/></div>
            </div>
            <!-- domicilio real -->
            <div class="row col-espacio-t">
                <div class="col-xs-12 col-sm-6 col-text-center"><strong>Domicilio Real Calle</strong></div>
                <div class="col-xs-12 col-sm-6">
                    <input type="text" required="true" class="texto-alfanumerico col-text-center" value="<?php echo $c["domicilio_real_calle"]; ?>" id="domicilio_real_calle" disabled>
                </div>
            </div>
            <div class="row col-espacio-t">
                <div class="col-xs-12 col-sm-6 col-text-center"><strong>Domicilio Real Altura</strong></div>
                <div class="col-xs-12 col-sm-6">
                    <input type="text" required="true" class="texto-numero col-text-center" value="<?php echo $c["domicilio_real_altura"]; ?>" id="domicilio_real_altura" disabled>
                </div>
            </div>
            <div class="row col-espacio-t">
                <div class="col-xs-12 col-sm-6 col-text-center"><strong>Domicilio Real Observación</strong></div>
                <div class="col-xs-12 col-sm-6">
                    <input type="text" class="col-text-center" value="<?php echo $c["domicilio_real_observacion"]; ?>" id="domicilio_real_observacion" disabled>
                </div>
            </div>
            <div class="row col-espacio-t">
                <div class="col-xs-12 col-sm-6 col-text-center"><strong>Domicilio Real Código Postal</strong></div>
                <div class="col-xs-12 col-sm-6">
                    <input type="text" required="true" class="texto-cp col-text-center" value="<?php echo $c["domicilio_real_cpa"]; ?>" id="domicilio_real_cpa" disabled>
                </div>
            </div>
            <div class="row col-espacio-t">
                <div class="col-xs-12 col-sm-6 col-text-center"><strong>Domicilio Real Provincia</strong></div>
                <div class="col-xs-12 col-sm-6">
                    <select required="true" class="js-example-basic-single" id="domicilio_real_provincia" disabled style="width: 100%">
                        <?php
                        $con = R::findAll("provincias");
                        foreach ($con as $i) {
                            ?><option value="<?php echo $i["id"] ?>" <?php if ($c["domicilio_real_provincia"] == $i["id"]) echo "selected"; ?>>
                                <?php echo $i["nombre"] ?>
                            </option><?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row col-espacio-t">
                <div class="col-xs-12 col-sm-6 col-text-center"><strong>Domicilio Real Localidad</strong></div>
                <div class="col-xs-12 col-sm-6">
                    <select required="true" class=" js-example-basic-single" id="domicilio_real_localidad" disabled style="width: 100%;">
                        <?php
                        $con = R::findAll("localidades");
                        foreach ($con as $i) {
                            ?><option value="<?php echo $i["id"] ?>" <?php if ($c["domicilio_real_localidad"] == $i["id"]) echo "selected"; ?>>
                                <?php echo $i["nombre"] ?>
                            </option><?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <!-- / domicilio real -->
            <div class="row">
                <div class="col-xs-12"><hr/></div>
            </div>
            <!--<div class="col-xs-6"> Domicilio Legal:</div><div class="col-xs-6"><input value="<?php echo $c["domicilio_real"]; ?>" id="domicilio_real" disabled></div>
            <div class="col-xs-6"> Provincia:</div><div class="col-xs-6"><input value="<?php echo $c["real_provincia"]; ?>" id="real_provincia" disabled></div>-->
            <?php 
            $Arubros = Array(2 => "Animales y Mascotas","Arte y Cultura","Bebés","Belleza y Cuidado Personal","Automóviles","Hardware y Software Informático","Descargas","Moda y Complementos","Flores, Regalos y Artesanía","Alimentación y Bebidas","HiFi, Foto y Video","Hogar y Jardìn","Electrodomésticos","Joyería","Lencería y Adultos","mòviles y Telefonía","Servicios","Calzado y Complementos","Deporte y Ocio","Viajes y Turismo");
            ?>
            <div class="row col-espacio-t">
                <div class="col-xs-12 col-sm-6 col-text-center"><strong>Rubro</strong></div>
                <div class="col-xs-12 col-sm-6">
                    <select class="js-example-basic-single" id="rubro" disabled style="width: 100%;">
                        <?php 
                        $rubro_nombre = "";
                        foreach ($Arubros as $key => $value) {
                            if($key == $c["rubro"]) {
                                echo "<option value='{$key}' selected>{$value}</option>";
                                $rubro_nombre = $value;
                            }
                            else
                                echo "<option value='{$key}'>{$value}</option>";
                        }
                        ?>
                    </select>
                    <input type="hidden" name="" id="rubro_nombre" value="<?php echo $rubro_nombre; ?>">
                </div>
            </div>
            <div class="row col-espacio-t">
                <div class="col-xs-12 col-sm-6 col-text-center"><strong>Convenio</strong></div>
                <div class="col-xs-12 col-sm-6">
                    <select class="js-example-basic-single" id="convenio" disabled style="width: 100%">
                        <?php
                        $con = R::findAll("convenios");
                        foreach($con as $i){
                            ?><option value="<?php echo $i["id"]?>" <?php if($c["convenio"] == $i["id"]) echo "selected"; ?>>
                                <?php echo $i["nombre"]?>
                            </option><?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row col-espacio-t">
                <div class="col-xs-12 col-sm-6 col-text-center"><strong>Fecha Alta</strong></div>
                <div class="col-xs-12 col-sm-6 col-text-center">
                    <script type="text/javascript">
                        document.write(retFormatDMYBar('<?php echo $c["fecha_alta"]; ?>'));
                    </script>
                </div>
            </div>
            <div class="row col-espacio-t">
                <div class="col-xs-12 col-sm-6 col-text-center"><strong>Créditos</strong></div>
                <div class="col-xs-12 col-sm-6 col-text-center"><?php echo R::count("credito_instancia", "id_comercio LIKE ?", array($c["id"])); ?></div>
            </div>
            <div class="row col-espacio-t">
                <?php 
                $x = R::getRow( 'SELECT designacion AS nombre FROM categoria_comercio WHERE id = :categoria', array(':categoria'=>$c["id_categoria"]) );
                ?>
                <div class="col-xs-12 col-sm-6 col-text-center"><strong>Categoría</strong></div>
                <div class="col-xs-12 col-sm-6 col-text-center"><?php echo isset($x["nombre"]) ? $x["nombre"] : "NO ASIGNADO" ?></div>
            </div>
            <div class="row col-espacio-t">
                <div class="col-xs-12 col-sm-6 col-text-center"><strong>Estado</strong></div>
                <div class="col-xs-12 col-sm-6 col-text-center">
                    <?php 
                    $estado = $c["estado"];
                    if($estado == 0) echo "no activa";
                    if($estado == 3) echo "no activa hoy";
                    if($estado == 2) echo "semiactiva";
                    if($estado == 1) echo "activa";
                    ?>
                </div>
            </div>
            <div class="row col-espacio-t">
                <?php
                $x = R::getRow( 'SELECT round(sum(monto)/count(id),2) AS capital_promedio FROM `credito_instancia` WHERE id_comercio = :id group by id_comercio', array(':id'=>$id) );
                ?>
                <div class="col-xs-12 col-sm-6 col-text-center"><strong>Capital Promedio</strong></div>
                <div class="col-xs-12 col-sm-6 col-text-center"> <?php echo $x["capital_promedio"]; ?> </div>
            </div>
            <div class="row col-espacio-t">
                <?php 
                $x = R::getRow( 'SELECT round(sum(cuotas)/count(id),2) AS plazo_promedio FROM `credito_instancia` WHERE id_comercio = :id group by id_comercio', array(':id'=>$id) );
                ?>
                <div class="col-xs-12 col-sm-6 col-text-center"><strong>Plazo Promedio</strong></div>
                <div class="col-xs-12 col-sm-6 col-text-center"><?php echo $x["plazo_promedio"]; ?> </div> 
            </div>
            <div class="row col-espacio-t">
                <div class="col-xs-12 col-sm-6 col-text-center"><strong>Usuario</strong></div>
                <div class="col-xs-12 col-sm-6 col-text-center">
                    <?php echo R::findOne("user", "id_comercio LIKE ?", array($c["id"]))["user"]; ?> <button class="btn btn-primary btn-xs" style="display: inline-block;" onclick="javascript:cambiarClave();">Blanquear</button>
                </div>
            </div>
        </div>
        <div class="bottom-btns text-center" id="btn">
            <button class="btn btn-primary btn-lg u-data-edit edit-btn" onclick="javascript:$('#guardar').prop('disabled',false);$('html, body').animate({ scrollTop: 0 }, 'slow');">Editar Datos</button>
            <button class="btn btn-primary btn-lg u-data-save save-btn" id="guardar" onclick="javascript:guardarCambios();" disabled>Guardar</button>
            <button class="btn btn-primary btn-lg print-btn" onclick="print();">Imprimir</button>
            <a class="btn btn-primary btn-lg" style="margin: 10px 5px" target="_blank" href="/litt/ui/financiera/subirArchivos.php?id=<?php echo $id; ?>">
                <i class="fa fa-upload"></i> Documentacion
            </a>
            <button class="btn btn-primary btn-lg" onclick="imprimir_ca_cg();" title="Contrato de Adhesión y Gestión de Cobranzas"><i class="fas fa-download"></i> Contrato de Adhesión</button>
            <button class="btn btn-primary btn-lg" onclick="imprimir_ac();"><i class="fas fa-download"></i> Anexo Condiciones</button>
            <button class="btn btn-primary btn-lg" onclick="javascript:imprimir_sa();"><i class="fas fa-download"></i> Solicitud de Adhesión</button>
            
            <?php if(count($url) == 0) { ?>
            <a class="btn btn-primary btn-lg" href="/ui/financiera/comAdheridos.php">Volver</a>
            <?php } else {
                if(strpos($url[count($url) - 1],"comadheridos.php") !== false) {
            ?>
            <a class="btn btn-primary btn-lg" onclick="window.close();">Cerrar</a>
            <?php }
            } ?>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('.js-example-basic-single').select2({width: 'resolve'});
    });
    window.litt_consultar_abandonar = true;
    $(".edit-btn").on("click",function(){
        $(this).prop("disabled",true);
        $("#rubro").prop("disabled",false);
        $("#convenio").prop("disabled",false);
        $("#domicilio_legal_localidad").prop("disabled",false);
        $("#domicilio_comercio_localidad").prop("disabled",false);
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
    
    function cambiarClave(){
        $.MessageBox({
            input    : {
                clave : {
                    type    :   "text",
                    title   :   "Clave"
                }
            },
            message  : "Ingrese la clave nueva",
        }).done(function(data){
            clave = data["clave"];

            if(clave == null || clave == ""){
                Lobibox.notify("info", {
                    size: 'mini',
                    title: 'Info',
                    msg: 'Cancelado por el usuario',
                    delay: 5000,
                    sound: false,
                });
                return false;
            }
            send("cambiarClave",{
                "id_usuario": <?php echo R::findOne("user","id_comercio LIKE ?",array($c["id"]))["id"]; ?>,
                "pass": clave
            },function(msg){
                if(msg.data["exito"]){
                    Lobibox.notify("success", {
                        size: 'mini',
                        title: 'Info',
                        msg: 'Se ha cambiado correctamente la clave',
                        delay: 5000,
                        sound: false,
                    });
                } else {
                    Lobibox.notify("info", {
                        size: 'mini',
                        title: 'Info',
                        msg: 'El usuario no esta registrado, probablemente se haya eliminado',
                        delay: 5000,
                        sound: false,
                    });
                }
            },function(msg){
                window.msg = msg;
                Lobibox.notify("info", {
                    size: 'mini',
                    title: 'Info',
                    msg: 'Hubo un problema al procesar la peticion',
                    delay: 5000,
                    sound: false,
                });
            });
        });
    }
    
    function guardarCambios(){
        if(validar()) {
            envio = {};
            envio["id_comercio"] = <?php echo $id; ?>;
            envio["nombre"] = $("#nombre").val();
            envio["razon_social"] = $("#razon_social").val();
            envio["cuit"] = $("#cuit").val();
            envio["dni_titular"] = $("#dni_titular").val();
            envio["nombre_titular"] = $("#nombre_titular").val();
            envio["mail"] = $("#mail").val();
            envio["telefono_fijo"] = $("#telefono_fijo").val();
            envio["telefono_celular"] = $("#telefono_celular").val();
            
            envio["domicilio_comercio_calle"] = $("#domicilio_comercio_calle").val();
            envio["domicilio_comercio_altura"] = $("#domicilio_comercio_altura").val();
            envio["domicilio_comercio_observacion"] = $("#domicilio_comercio_observacion").val();
            envio["domicilio_comercio_cpa"] = $("#domicilio_comercio_cpa").val();
            envio["domicilio_comercio_provincia"] = $("#domicilio_comercio_provincia").val();
            envio["domicilio_comercio_localidad"] = $("#domicilio_comercio_localidad").val();
            envio["domicilio_legal_calle"] = $("#domicilio_legal_calle").val();
            envio["domicilio_legal_altura"] = $("#domicilio_legal_altura").val();
            envio["domicilio_legal_observacion"] = $("#domicilio_legal_observacion").val();
            envio["domicilio_legal_cpa"] = $("#domicilio_legal_cpa").val();
            envio["domicilio_legal_provincia"] = $("#domicilio_legal_provincia").val();
            envio["domicilio_legal_localidad"] = $("#domicilio_legal_localidad").val();
            
            /*envio["domicilio_comercio"] = $("#domicilio_comercio").val();
            envio["comercio_provincia"] = $("#comercio_provincia").val();
            envio["domicilio_real"] = $("#domicilio_real").val();
            envio["real_provincia"] = $("#real_provincia").val();*/
            envio["rubro"] = $("#rubro").val();
            envio["convenio"] = $("#convenio").val();
            $('#guardar').prop('disabled',true);
            send("guardarComercio",envio,function(msg){
                if(msg.data["exito"]){
                    $("#guardar").prop("disabled",true);
                    $("#editar").prop("disabled",false);
                    Lobibox.notify("success", {
                        size: 'mini',
                        msg: 'Cambios guardados exitosamente',
                        showClass: 'fadeInDown',
                        hideClass: 'fadeUpDown',
                        delay: 10000,
                        sound: false
                    });
                } else {
                    Lobibox.notify("error", {
                        size: 'mini',
                        title: 'Error',
                        msg: 'Ocurrió algo, reintente',
                        showClass: 'fadeInDown',
                        hideClass: 'fadeUpDown',
                        delay: 10000,
                        sound: false
                    });

                    $("#rubro").prop("disabled",false);
                    $("#convenio").prop("disabled",false);
                    $("#domicilio_legal_localidad").prop("disabled",false);
                    $("#domicilio_comercio_localidad").prop("disabled",false);
                }
            },function(msg){
                window.msg = msg;
                Lobibox.notify("error", {
                    size: 'mini',
                    title: 'Error',
                    msg: 'Ocurrió algo, revise su conexión y reintente',
                    showClass: 'fadeInDown',
                    hideClass: 'fadeUpDown',
                    delay: 10000,
                    sound: false
                });

                $("#rubro").prop("disabled",false);
                $("#convenio").prop("disabled",false);
                $("#domicilio_legal_localidad").prop("disabled",false);
                $("#domicilio_comercio_localidad").prop("disabled",false);
            });
        } else {
            $("html, body").animate({ scrollTop: 0 }, "slow");
            Lobibox.notify("error", {
                size: 'mini',
                title: 'Error',
                msg: 'Faltan datos necesarios',
                showClass: 'fadeInDown',
                hideClass: 'fadeUpDown',
                delay: 10000,
                sound: false
            });

            $("#rubro").prop("disabled",false);
            $("#convenio").prop("disabled",false);
            $("#domicilio_legal_localidad").prop("disabled",false);
            $("#domicilio_comercio_localidad").prop("disabled",false);
        }
    }
    
    function PrintElem()
    {
        var mywindow = window.open('', 'PRINT', 'height=400,width=600');
        var divContents = document.getElementById("imprimible").innerHTML;
        mywindow.document.write('<html><head><title>' + document.title  + '</title>'+document.head);
        mywindow.document.write('</head><body>');
        mywindow.document.write('<h1>' + document.title  + '</h1>');
        mywindow.document.write(divContents);
        mywindow.document.write('</body></html>');
        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10*/
        mywindow.print();
        myWindow.close();
        return true;
    }

    function imprimir_ac() {
        var id = "<?php echo $id; ?>";//
        var page = "ajax/ac.php?id="+id;
        descargar(page);
    }
    function imprimir_ca_cg() {
        var id = "<?php echo $id; ?>";//
        var page = "ajax/ca_cg.php?id="+id;
        descargar(page);
    }
    function imprimir_sa() {
        var id = "<?php echo $id; ?>";//
        var page = "ajax/sa.php?id="+id;
        descargar(page);
    }
    function descargar(url) {
        window.onfocus = finalizada;
        document.location = url;
    }

    function finalizada() {
        window.onfocus = vacia;
        // Modificar a partir de aquí
    }
    function vacia(){}
    function serialize(arr) {
        var res = 'a:'+arr.length+':{';
        for(i=0; i<arr.length; i++)
        {
        res += 'i:'+i+';s:'+arr[i].length+':"'+arr[i]+'";';
        }
        res += '}';
         
        return res;
    }
</script>

</body>
</html>