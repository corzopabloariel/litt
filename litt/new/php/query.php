<?php

require_once './rb.php';

/**
 * Dado un user y pass determina si se puede loguar y
 * genera su session
 * @param type $p [obligatorio]
 */
function login($p){
    checkParamPost(["user","pass"]);
    $user = $p["user"]; $pass = $p["pass"];
    $l = R::findOne("user","user LIKE ? and pass LIKE ?",array($user, md5($pass)));
    if($l['user'] == $user and $l['pass'] == md5($pass)){
        $_SESSION['user'] = json_encode($l);
        response(200,"logueo correcto",["logueo" => true]);
    }
    else{
        $_SESSION['user'] = NULL;
        response(401,"logueo incorrecto",["logueo" => false]);
    }
}

function logout($p){
    $_SESSION['user'] = NULL;
    response(200,"deslogueo correcto",["logout" => true]);
}

/**
 * Devuelve el valor del score minimo para poder procesar una peticion
 * @param type $p [obligatorio]
 * @return int
 */
function getScoreMinimo($p){
    // obtengo el score minimo
    $veraz_minimo = getValueBD('configuraciones', 'variable', 'score_veraz_minimo');
    if(!$veraz_minimo){
        $r = R::dispense('configuraciones');
        $r['variable'] = 'score_veraz_minimo';
        $valor = 500;
        $r['valor'] = $valor;
        R::store($r);
        response(200,'score minimo no seteado, notese configurarlo',['score' => $valor]);
    } else response(200,'score minimo',['score' => $veraz_minimo['valor']]);
}

/**
 * Devuelve de manera cruda la informacion del usuario, para uso manual exclusivamente
 * @param type $p
 */
function getUserData($p){
    //response(200,'informacion cruda del user',['p' => $p]);
    if(isset($_SESSION['user'])){
        response(200,'informacion cruda del user',['userData' => $_SESSION]);
    }
    else
        response(400,'el usuario no esta seteado',['userData' => null]);
}

/**
 * Devuelve true o false dependiendo de si el cliente enviado existe o no
 * @param type $p
 */
function existeCliente($p){
    checkParamPost(['cliente_dni']);
    $cliente = getValueBD('clientes', 'dni', $p['cliente_dni']);
    if(!$cliente) 
        response(200,'el cliente no existe, pase a crearlo',['existe' => false]);
    else {
        $vigentes = 0;
        $leyenda = "";

        $cuotas = R::getAll("SELECT id_credito, MIN(abonado) AS estado FROM `cuotas` where dni_cliente = ? GROUP BY id_credito",Array($cliente["dni"]));
        foreach ($cuotas as $cuota) {
            $credito = R::findOne("credito_instancia","id LIKE ?",Array($cuota["id_credito"]));
            if($cuota["estado"] == 0)
                $vigentes ++;
            if($credito["estado_mora"] > 2 && $credito["estado_mora"] < 7) // mayor a "normal" / menor a "incobrable"
                $leyenda = "Cliente con deuda vigente en LITT";
            if($credito["estado_mora"] == 7)
                $leyenda = "Cliente con antecendente de morosidad grave en LITT";
        }
        if($vigentes == 3) $leyenda = "Cliente con 3 créditos vigentes";
        response(200,'el cliente existe',['existe' => true,"leyenda" => $leyenda]);
    }

/*

    $cliente = R::findOne("clientes","dni LIKE ?",Array($p['cliente_dni']));
    if($cliente) {
        
    }*/
}

/**
 *  Devuelve true si tiene 3 creditos
 */
function cantidadVigentes($p) {
    $cliente = R::findOne("clientes","dni LIKE ?",Array($p['cliente_dni']));
    if($cliente) {
        $vigentes = 0;
        $leyenda = "";
        $cuotas = R::getAll("SELECT id_credito, MIN(abonado) AS estado FROM `cuotas` where dni_cliente = ? GROUP BY id_credito",Array($cliente["dni"]));
        foreach ($cuotas as $cuota) {
            $credito = R::findOne("credito_instancia","id LIKE ?",Array($cuota["id_credito"]));
            if($cuota["estado"] == 0)
                $vigentes ++;
            if($credito["estado_mora"] > 2 && $credito["estado_mora"] < 7) // mayor a "normal" / menor a "incobrable"
                $leyenda = "Cliente con deuda vigente en LITT";
            if($credito["estado_mora"] == 7)
                $leyenda = "Cliente con antecendente de morosidad grave en LITT";
        }
        if($vigentes == 3) $leyenda = "Cliente con 3 créditos vigentes";

        response(200,'exito',['leyenda' => $leyenda]);
    } else response(400,'el cliente no existe, pase a crearlo',null);
}
function getClienteData($p){
    checkParamPost(['cliente_dni']);
    //$cliente = getValueBD('clientes', 'dni', $p['cliente_dni']);
    $cliente = R::findOne("clientes","dni LIKE ?",Array($p['cliente_dni']));
    if(!$cliente)
        response(400,'el cliente no existe, pase a crearlo',null);
    else
        response(200,'cliente cargado correctamente',['cliente' => $cliente]);
    
}

function getPlanes($p){
    $c = R::findOne("comercios","id LIKE ?",Array($p["id_comercio"]));
    $cn = R::findOne("convenios_grupos_habilitados","id_convenio LIKE ?",Array($c["convenio"]));
    $pr = R::findAll("productos","grupo = ? AND habilitado = 1",Array($cn["id_grupo"]));

    $Aproductos = Array();
    $planes_str = "";
    foreach ($pr as $pp) {
        $Aproductos[] = Array("plan" => $pp["plan"], "monto_minimo" => $pp["monto_minimo"], "monto_maximo" => $pp["monto_maximo"], "plazo_minimo" => $pp["plazo_minimo"],"plazo_maximo" => $pp["plazo_maximo"]);

        if(!empty($planes_str)) $planes_str .= ",";

        $planes_str .= $pp["plan"];
    }

    $pl = R::getAll("SELECT * FROM planes WHERE id IN (".$planes_str.")");
    $planes = Array();
    foreach ($pl as $pp) {
        $planes[] = Array('id' => $pp["id"],'designacion' => $pp["designacion"],'interes_porcuota' => $pp["interes_porcuota"],'tna' => $pp["tna"]);
    }
    response(200,'planes cargados correctamente',['planes' => $planes,'productos' => $Aproductos,'pr' => count($pr)]);
}

function eliminarMail($p){
    $id = $p["id"];

    $bean = R::findOne('mails',"id LIKE ?",Array($id));
    R::trash($bean);
    $plantillas = R::findAll("mails");
    $plantillaHTML = "";

    foreach ($plantillas as $plantilla) {
        $plantillaHTML .= "<tr>";
            $plantillaHTML .= "<td class='text-left'>{$plantilla["contenido"]}</td>";
            $plantillaHTML .= "<td class='text-center'>{$plantilla["autofecha"]}</td>";
            $plantillaHTML .= "<td class='text-center'><button data-accion='eliminar' class='btn btn-danger btn-xs' data-id='{$plantilla["id"]}'><input type='hidden' value='{$plantilla["id"]}'/><i class='far fa-trash-alt'></i></button> <button data-accion='editar' class='btn btn-warning btn-xs' data-id='{$plantilla["id"]}'><i class='fas fa-pencil-alt'></i></button></td>";
        $plantillaHTML .= "</tr>";
    }
    response(200,"plantilla creada exitosamente",["exito" => true, "plantillas" => $plantillaHTML]);
}
function traerMail($p){
    $id = $p["id"];
    $c = R::findOne("mails","id LIKE ?",Array($id));

    response(200,"plantilla",["exito" => true, "contenido" => $c["contenido"], "mensaje" => $c["mensaje"]]);
}
function traerMails($p){
    $mails = R::findAll("mails");
    $plantillas = "<option value=''>VACIO</option>";

    foreach ($mails as $p) {
        $plantillas .= "<option value='{$p["id"]}'>{$p["contenido"]}</option>";
    }

    response(200,"plantilla",["exito" => true, "plantillas" => $plantillas]);
}
function crearMail($p){
    $id = $p["id"];
    if($id == "")
        $c = R::dispense("mails");
    else
        $c = R::findOne("mails","id LIKE ?",Array($id));

    $c["contenido"] = $p["contenido"];
    $c["mensaje"] = $p["mensaje"];
    $c["id_user"] = $p["user"];
    $id = R::store($c);
    $plantillas = R::findAll("mails");
    $plantillaHTML = "";

    foreach ($plantillas as $plantilla) {
        $plantillaHTML .= "<tr>";
            $plantillaHTML .= "<td class='text-left'>{$plantilla["contenido"]}</td>";
            $plantillaHTML .= "<td class='text-center'>{$plantilla["autofecha"]}</td>";
            $plantillaHTML .= "<td class='text-center'><button data-accion='eliminar' class='btn btn-danger btn-xs' data-id='{$plantilla["id"]}'><input type='hidden' value='{$plantilla["id"]}'/><i class='far fa-trash-alt'></i></button> <button data-accion='editar' class='btn btn-warning btn-xs' data-id='{$plantilla["id"]}'><i class='fas fa-pencil-alt'></i></button></td>";
        $plantillaHTML .= "</tr>";
    }
    response(200,"plantilla creada exitosamente",["exito" => true, "plantillas" => $plantillaHTML]);
}

function crearCliente($p){
    $c = R::dispense("clientes");
    $c["dni"] = $p["dni"];
    $c["apellido"] = strtoupper($p["apellido"]);
    $c["nombre"] = strtoupper($p["nombre"]);
    $c["fecha_nacimiento"] = $p["fecha_nacimiento"];
    $id = R::store($c);
    response(200,"cliente creado exitosamente",["exito" => true, "id_cliente" => $id]);
}

function crearCredito($p){
    $c = R::xdispense("credito_instancia");
    $c['dni_cliente'] = $p['dni'];
    $c['id_plan'] = $p['credito_plan'];
    $c['producto_designacion'] = $p['credito_producto_designacion'];
    $c['monto'] = $p['credito_monto'];
    $c['cuotas'] = $p['credito_cuotas'];
    $c['fecha_creacion'] = date('YmdHi'); // añomesdiahoraminuto
    $c['estado_mora'] = 2; // normal, siempre arranca normal
    $c['score'] = $p['credito_score'];
    // obtengo el id de comercio a partir del id del usuario
    $id_comercio = R::findOne("user","id LIKE ?",[$_SESSION['id']])['id_comercio'];
    if($id_comercio) $c['id_comercio'] = $id_comercio; // ACA VA SESSION, ARREGLARLO
    else{ response(400,'error, no existe la session',['exito' => false]); return false; }
    $c['estado_liquidacion'] = 0; // pendiente
    $id = R::store($c);
    // actualizo la infomacion del cliente
    actualizarDatosClientes($c['dni_cliente'], $p);
    // genero las cuotas
    generarCuotas($c['monto'],$c['cuotas'],$c['id_plan'],$id_comercio,$id,$c['dni_cliente']);
    response(200,'credito creado correctamente',['exito' => true, 'id_credito' => $id]);
}

function actualizarDatosClientes($dni,$p){
    $c = R::findOne("clientes","dni LIKE ?",[$dni]);
    $c['credito_vigente'] = 1; // con este credito ya tiene un credito vigente
    $c['domicilio_calle'] = strtoupper($p['domicilio_calle']);
    $c['domicilio_altura'] = strtoupper($p['domicilio_altura']);
    $c['domicilio_cpa'] = strtoupper($p['domicilio_cpa']);
    $c['domicilio_localidad'] = $p['domicilio_localidad'];
    $c['domicilio_piso'] = strtoupper($p['domicilio_piso']);
    $c['domicilio_depto'] = strtoupper($p['domicilio_depto']);
    $c['domicilio_barrio'] = strtoupper($p['domicilio_barrio']);
    $c['domicilio_manzana'] = strtoupper($p['domicilio_manzana']);
    $c['domicilio_provincia'] = $p['domicilio_provincia'];
    $c['empleo_calle'] = strtoupper($p['empleo_calle']);
    $c['empleo_altura'] = strtoupper($p['empleo_altura']);
    $c['mail'] = strtoupper($p['mail']);
    $c['empleo_cpa'] = strtoupper($p['empleo_cpa']);
    $c['empleo_empresa'] = strtoupper($p['empleo_empresa']);
    $c['empleo_localidad'] = $p['empleo_localidad'];
    $c['empleo_piso'] = strtoupper($p['empleo_piso']);
    $c['empleo_depto'] = strtoupper($p['empleo_depto']);
    $c['empleo_barrio'] = strtoupper($p['empleo_barrio']);
    $c['empleo_manzana'] = strtoupper($p['empleo_manzana']);
    $c['empleo_provincia'] = $p['empleo_provincia'];
    $c['empleo_sueldo'] = $p['empleo_sueldo'];
    $c['empleo_telefono'] = $p['empleo_telefono'];
    $c['observaciones'] = $p['observaciones'];
    $c['referido_nombre'] = strtoupper($p['referido_nombre']);
    $c['referido_parentesco'] = strtoupper($p['referido_parentesco']);
    $c['referido_telefono_celular'] = $p['referido_telefono_celular'];
    $c['referido_telefono_fijo'] = $p['referido_telefono_fijo'];
    $c['telefono_celular'] = $p['telefono_celular'];
    $c['telefono_fijo'] = $p['telefono_fijo'];
    R::store($c); // ahora ya tengo la informacion de cliente actualizada
}

function generarCuotas($monto,$cuotas,$id_plan,$id_comercio,$id_credito,$dni_cliente){
    // como se calculan los punitorios
    $resto = $monto;
    $plan = R::findOne("planes","id LIKE ?",array($id_plan));
    $tem = $plan['tna']/(365/30); // el tna / (365/30) // EL TEM es el Interes
    $cuota_pura = pmt($monto,$tem,$cuotas); // valor cuota o cuota pura
    for($i = 1; $i <= $cuotas; ++$i){
        $c = R::dispense('cuotas');
        $c['id_credito'] = $id_credito;
        $c['n_cuota'] = $i;
        $c['cuota_original'] = $cuota_pura;
        $interes = round(($resto / 100) * $tem,2); 
        $capital = round($cuota_pura - $interes,2);
        $resto = round($resto - $capital,2);
        $c['interes'] = $interes;
        $c['capital'] = $capital;
        $c['resto'] = $resto;
        $c['tem'] = round($tem,2);
        $c['tna'] = round($plan['tna'],2);
        $c['punitorios'] = 0; // arrancan en cero, despues pasa el cron
        // si el plan es 2 (con entrega) el primer vencimiento es HOY
        $c['compensatorios'] = 0;
        $c['multa'] = 0;
        $c["estado_mora"] = 2; // normal
        if($id_plan == 2) $agregado = $i - 1;
        else $agregado = $i; // si no, dentro de un mes
        $vencimiento = date("Ymd", strtotime("+" . ($agregado) . " month"));
        $c['vencimiento'] = $vencimiento;
        $c['dni_cliente'] = $dni_cliente;
        $c['id_comercio'] = $id_comercio;
        R::store($c);
    }
}

function crearComercio($p){
    /* $arr[] ="cuit"; $arr[] ="razon_social"; $arr[] ="dni_titular"; $arr[] ="nombre_titular";
    $arr[] ="mail"; $arr[] ="telefono_fijo"; $arr[] ="telefono_celular"; $arr[] ="domicilio_comercio";
    $arr[] ="comercio_cp_localidad_provincia"; $arr[] ="domicilio_real";
    $arr[] ="real_cp_localidad_provincia"; $arr[] ="rubro"; $arr[] ="convenio"; $arr[] ="user";
    $arr[] ="pass"; checkParamPost($arr);*/
    // creo comercio
    $c = R::dispense("comercios");
    $c["cuit"] = $p["cuit"];
    $c["razon_social"] = $p["razon_social"];
    $c["nombre"] = $p["nombre"];
    $c["dni_titular"] = $p["dni_titular"];
    $c["nombre_titular"] = $p["nombre_titular"];
    $c["mail"] = $p["mail"];
    $c["telefono_fijo"] = $p["telefono_fijo"];
    $c["telefono_celular"] = $p["telefono_celular"];
    // [comercio]
    $c["domicilio_comercio_calle"] = $p["domicilio_comercio_calle"];
    $c["domicilio_comercio_altura"] = $p["domicilio_comercio_altura"];
    $c["domicilio_comercio_observacion"] = $p["domicilio_comercio_observacion"];
    $c["domicilio_comercio_cpa"] = $p["domicilio_comercio_cpa"];
    $c["domicilio_comercio_provincia"] = $p["domicilio_comercio_provincia"];
    $c["domicilio_comercio_localidad"] = $p["domicilio_comercio_localidad"];
    // [legal]
    $c["domicilio_legal_calle"] = $p["domicilio_legal_calle"];
    $c["domicilio_legal_altura"] = $p["domicilio_legal_altura"];
    $c["domicilio_legal_observacion"] = $p["domicilio_legal_observacion"];
    $c["domicilio_legal_cpa"] = $p["domicilio_legal_cpa"];
    $c["domicilio_legal_provincia"] = $p["domicilio_legal_provincia"];
    $c["domicilio_legal_localidad"] = $p["domicilio_legal_localidad"];
    // [real]
    $c["domicilio_real_calle"] = $p["domicilio_real_calle"];
    $c["domicilio_real_altura"] = $p["domicilio_real_altura"];
    $c["domicilio_real_observacion"] = $p["domicilio_real_observacion"];
    $c["domicilio_real_cpa"] = $p["domicilio_real_cpa"];
    $c["domicilio_real_provincia"] = $p["domicilio_real_provincia"];
    $c["domicilio_real_localidad"] = $p["domicilio_real_localidad"];
    // [/domicilio]
    $c["observacion"] = $p["observacion"];
    $c["rubro"] = $p["rubro"];
    $c["convenio"] = $p["convenio"];
    $c["fecha_alta"] = date("Ymd");
    $c["estado"] = true;
    $id_comercio = R::store($c);
    // creo usuario
    $u = R::dispense("user");
    $u["user"] = $p["user"];
    $u["pass"] = md5($p["pass"]);
    $u["level"] = 3; // ESTO DEBERIA ESTAR EN LA BD, QUIENES SON COMERCIO; y FINANCIERA
    $u["titular"] = $p["nombre_titular"];
    $u["dni"] = $p["dni_titular"];
    $u["id_comercio"] = $id_comercio;
    R::store($u);
    response(200,"comercio creado exitosamente",["exito" => true, "id" => $id_comercio, "ret" => $p]);
}

function guardarComercio($p){
    /* $arr[] ="cuit"; $arr[] ="razon_social"; $arr[] ="dni_titular"; $arr[] ="nombre_titular";
    $arr[] ="mail"; $arr[] ="telefono_fijo"; $arr[] ="telefono_celular"; $arr[] ="domicilio_comercio";
    $arr[] ="comercio_cp_localidad_provincia"; $arr[] ="domicilio_real";
    $arr[] ="real_cp_localidad_provincia"; $arr[] ="rubro"; $arr[] ="convenio"; $arr[] ="user";
    $arr[] ="pass"; checkParamPost($arr);*/
    // creo comercio
    $c = R::findOne("comercios","id LIKE ?",array($p["id_comercio"]));
    $c["cuit"] = $p["cuit"];
    $c["dni_titular"] = $p["dni_titular"];
    $c["nombre"] = $p["nombre"];
    $c["razon_social"] = $p["razon_social"];
    $c["nombre_titular"] = $p["nombre_titular"];
    $c["mail"] = $p["mail"];
    $c["telefono_fijo"] = $p["telefono_fijo"];
    $c["telefono_celular"] = $p["telefono_celular"];
    // [legal]
    $c["domicilio_legal_calle"] = $p["domicilio_legal_calle"];
    $c["domicilio_legal_altura"] = $p["domicilio_legal_altura"];
    $c["domicilio_legal_observacion"] = $p["domicilio_legal_observacion"];
    $c["domicilio_legal_cpa"] = $p["domicilio_legal_cpa"];
    $c["domicilio_legal_provincia"] = $p["domicilio_legal_provincia"];
    $c["domicilio_legal_localidad"] = $p["domicilio_legal_localidad"];
    // [comercio]
    $c["domicilio_comercio_calle"] = $p["domicilio_comercio_calle"];
    $c["domicilio_comercio_altura"] = $p["domicilio_comercio_altura"];
    $c["domicilio_comercio_observacion"] = $p["domicilio_comercio_observacion"];
    $c["domicilio_comercio_cpa"] = $p["domicilio_comercio_cpa"];
    $c["domicilio_comercio_provincia"] = $p["domicilio_comercio_provincia"];
    $c["domicilio_comercio_localidad"] = $p["domicilio_comercio_localidad"];
    // [/domicilio]
    $c["rubro"] = $p["rubro"];
    $c["convenio"] = $p["convenio"];
    $c["estado"] = 0; // inactivo
    $c["habilitado"] = 1; // habilitado para ingresar, para el Login
    $id_comercio = R::store($c);
    response(200,"comercio creado exitosamente",["exito" => true, "id" => $id_comercio]);
}

function cambiarClave($p){
    // checkParamPost(["id_usuario","pass"]);
    $u = R::findOne("user","id LIKE ?",array($p["id_usuario"]));
    if($u){
        $u["pass"] = md5($p["pass"]);
        R::store($u);
        response(200,"cambio aceptado",["exito" => true]);
    } else response(200,"no se encontro usuario",["exito" => false]);
}

function enviarMensaje($p){
    response(200,"mensaje enviado", ["exito" => true, "retorno" => $p]);
}

function habilitarProductos($p){
    // checkParamPost(['ids']);
    foreach($p['ids'] as $i){
        $k = R::findOne("productos","id LIKE ?",[$i]);
        $k["habilitado"] = 1;
        R::store($k);
    }
    response(200,"alta correcta",["exito" => true,"retorno" => $p]);
}

function inhabilitarProducto($p){
    // checkParamPost(['ids']);
        $k = R::findOne("productos","id LIKE ?",[$p['id']]);
        $k["habilitado"] = 0;
        R::store($k);
    response(200,"baja correcta",["exito" => true,"retorno" => $p]);
}

function nuevoProducto($p){
    $e = R::dispense("productos");
    $e["designacion"] = $p["nombre"];
    $e["plan"] = $p["plan"];
    $e["grupo"] = $p["grupo"];
    $e["monto_minimo"] = $p["monto_minimo"];
    $e["monto_maximo"] = $p["monto_maximo"];
    $e["plazo_minimo"] = $p["plazo_minimo"];
    $e["plazo_maximo"] = $p["plazo_maximo"];
    $e["tna"] = $p["tna"];
    R::store($e);
    $plan_designacion = R::findOne("planes","id LIKE ?",[$p["plan"]])["designacion"];
    response(200,"carga correcta",["exito" => true,"plan_designacion" => $plan_designacion]);
}

function nuevoConvenio($p){
    $c = R::dispense("convenios");
    $c["nombre"] = $p["nombre"];
    $c["comision"] = $p["comision"];
    $id_convenio = R::store($c);
    foreach($p["grupos"] as $g){
        $cg = R::xdispense("convenios_grupos_habilitados");
        $cg["id_convenio"] = $id_convenio;
        $cg["id_grupo"] = $g;
        R::store($cg);
    }
    response(200,"carga correcta",["exito" => true,"id_convenio" => $id_convenio]);
}

function nuevoGrupo($p){
    $c = R::dispense("grupos");
    $c["nombre"] = $p["nombre"];
    $id = R::store($c);
    response(200,"carga correcta",["exito" => true,"id_grupo" => $id]);
}

function liquidarOperaciones($p){
    $ids = $p["ids"];
    foreach($ids as $i){
        $e = R::findOne("credito_instancia","id LIKE ?",[$i]);
        $e["estado_liquidacion"] = 1;
        $e["liquidado_litt"] = 1;
        $e["fecha_liquidacion"] = date("Ymd");
        R::store($e);
    }
    response(200,"liquidacion correcta",["exito" => true]);
}

function guardarCliente($p){
    $c = R::findOne("clientes","id LIKE ?",[$p["id"]]);
    $c["dni"] = $p["dni"];
    $c["nombre"] = strtoupper($p["nombre"]);
    $c["apellido"] = strtoupper($p["apellido"]);
    $c["fecha_nacimiento"] = $p["fecha_nacimiento"];
    $c["telefono_fijo"] = $p["telefono_fijo"];
    $c["telefono_celular"] = $p["telefono_celular"];
    $c["mail"] = strtoupper($p["mail"]);
    $c["domicilio_calle"] = strtoupper($p["domicilio_calle"]);
    $c["domicilio_altura"] = $p["domicilio_altura"];
    $c["domicilio_piso_depto"] = strtoupper($p["domicilio_piso_depto"]);
    $c["domicilio_cpa"] = strtoupper($p["domicilio_cpa"]);
    $c["domicilio_localidad"] = strtoupper($p["domicilio_localidad"]);
    $c["domicilio_provincia"] = strtoupper($p["domicilio_provincia"]);
    $c["referido_nombre"] = strtoupper($p["referido_nombre"]);
    $c["referido_telefono_fijo"] = $p["referido_telefono_fijo"];
    $c["referido_telefono_celular"] = $p["referido_telefono_celular"];
    $c["referido_parentesco"] = strtoupper($p["referido_parentesco"]);
    $c["empleo_empresa"] = strtoupper($p["empleo_empresa"]);
    $c["empleo_telefono"] = $p["empleo_telefono"];
    $c["empleo_sueldo"] = $p["empleo_sueldo"];
    $c["empleo_calle"] = $p["empleo_calle"];
    $c["empleo_altura"] = strtoupper($p["empleo_altura"]);
    $c["empleo_piso_depto"] = strtoupper($p["empleo_piso_depto"]);
    $c["empleo_cpa"] = strtoupper($p["empleo_cpa"]);
    $c["empleo_localidad"] = strtoupper($p["empleo_localidad"]);
    $c["empleo_provincia"] = strtoupper($p["empleo_provincia"]);
    $c["observaciones"] = $p["observaciones"];
    R::store($c);
    response(200,"carga correcta correcta",["exito" => true]);
}

function getRendicionPendient($p){
    // 
    // checkParamPost(["id","fecha_hasta"]);
    $id = $p["id"];
    $fecha_hasta = $p["fecha_hasta"];
    $e = R::findOne("comercios","id LIKE ?",[$id]);
    // primero traigo las cuotas que el comercio ya recibio pago
    // las NO rendidas, ABONADAS y de ESTE COMERCIO
    $cuotas = R::findAll("cuotas","rendida LIKE ? and abonado LIKE ? and id_comercio LIKE ? and fecha_depago <= ?",[0,1,$e["id"],$fecha_hasta]);
    $cuotas_abonadas_total = 0;
    foreach($cuotas as $ec)
        $cuotas_abonadas_total += $ec["cuota_original"] + $ec["punitorios"];
    // traigo el porcentaje de comision del comercio
    $comision_convenio = R::findOne("convenios","id LIKE ?",[$e["convenio"]])["comision"];
    // traigo los creditos a pagar al comercio los LIQUIDADOS y no RENDIDOS
    $creditos = R::findAll("credito_instancia","liquidado_litt LIKE ? and rendida LIKE ? and fecha_liquidacion <= ? AND id_comercio = ?",[1,0,$fecha_hasta,$e["id"]]);
    $creditos_liquidados_total = 0;
    foreach($creditos as $ecc){
        $monto = $ecc["monto"] - (($ecc["monto"] /100) * $comision_convenio);
        $creditos_liquidados_total += $monto;
    }
    response(200,"devolviendo los datos solicitados de la rendicion pendiente",
            ["cuotas" => $cuotas,
                "creditos" => $creditos,
                "total_cuotas" => $cuotas_abonadas_total,
                "total_creditos" => $creditos_liquidados_total,
                "comision_convenio" => $comision_convenio,
                "fecha_hasta" => $fecha_hasta,
                "id_comercio" => $id]);
}

function setRendicionPendient($p){
    // checkParamPost(["id","fecha_hasta"]);
    $id = $p["id"];//id_comercio
    $fecha_hasta = $p["fecha_hasta"];
    $d = R::dispense("rendiciones");
    $d["id_comercio"] = $id;
    $d["fecha_limite_rendicion"] = $fecha_hasta;
    $d["fecha_creacion"] = date("Ymd");
    $d["monto_cuota"] = $p["monto_cuota"];
    $d["monto_credito"] = $p["monto_credito"];
    $id_rendiciones = R::store($d);
    
    $e = R::findOne("comercios","id LIKE ?",[$id]);
    // primero traigo las cuotas que el comercio ya recibio pago
    // las NO rendidas, ABONADAS y de ESTE COMERCIO
    $cuotas = R::findAll("cuotas","rendida LIKE ? and abonado LIKE ? and id_comercio LIKE ? and fecha_depago <= ?",[0,1,$e["id"],$fecha_hasta]);
    foreach($cuotas as $ec){
        $ec["rendida"] = 1;
        $ec["id_rendicion"] = $id_rendiciones;
        R::store($ec);
        nuevoPago(["ingreso_egreso" => 1, // ingreso
            "id_movimiento" => 3, // rendicion
            "id_entidad" => $id, // comercios
            "id_tipo_comprobante" => 8, // rendicion
            "observaciones" => "",
            "fecha_comprobante" => date("Ymd"),
            "numero_comprobante" => $id_rendiciones,
            "monto" => $ec["cuota_original"] + $ec["punitorios"],
            "iva" => null],false); // null de iva
    }
    // traigo los creditos a pagar al comercio los LIQUIDADOS y no RENDIDOS
    $creditos = R::findALl("credito_instancia","liquidado_litt LIKE ? and rendida LIKE ? and fecha_liquidacion <= ?",[1,0,$fecha_hasta]);
    $comision_convenio = R::findOne("convenios","id LIKE ?",[$e["convenio"]])["comision"];
    foreach($creditos as $ecc){
        $ecc["rendida"] = 1;
        $ecc["id_rendicion"] = $id_rendiciones;
        R::store($ecc);
        nuevoPago(["ingreso_egreso" => 0, // egreso
            "id_movimiento" => 3, // rendicion
            "id_entidad" => $id, // comercios
            "id_tipo_comprobante" => 8, // rendicion
            "observaciones" => "",
            "fecha_comprobante" => date("Ymd"),
            "numero_comprobante" => $id_rendiciones,
            "monto" => $ecc["monto"] - (($ecc["monto"] /100) * $comision_convenio),
            "iva" => null],false); // null de iva
    }
    response(200,"rendicion realizada exitosamente",["exito" => true]);
}

function habilitar($p){
    $id = $p["id"];
    $c = R::findOne("comercios","id LIKE ?",[$id]);
    $c["habilitado"] = 1;
    R::store($c);
    response(200,"habilitacion realizada exitosamente",["exito" => true]);
}

function inhabilitar($p){
    $id = $p["id"];
    $c = R::findOne("comercios","id LIKE ?",[$id]);
    $c["habilitado"] = 0;
    R::store($c);
    response(200,"inhabilitacion realizada exitosamente",["exito" => true]);
}

function nuevoTipoMovimiento($p){
    $c = R::xdispense("tipo_movimiento");
    $c["nombre"] = $p["nombre"];
    $c["id_padre"] = $p["id_padre"];
    $c["observaciones"] = $p["observaciones"];
    $id = R::store($c);
    response(200,"carga correcta",["exito" => true]);
}

function nuevaEntidad($p){
    $c = R::dispense("entidades");
    $c["denominacion"] = $p["denominacion"];
    $c["descripcion"] = $p["descripcion"];
    $id = R::store($c);
    response(200,"carga correcta",["exito" => true, "id_entidad" => $id]);
}

function nuevoPago($p,$ret = true){
    $c = R::xdispense("registro_pago");
    $c["fecha_hora"] = date('YmdHi'); // añomesdiahoraminuto
    $c["ingreso_egreso"] = $p["ingreso_egreso"];
    $c["id_movimiento"] = $p["id_movimiento"];
    $c["id_entidad"] = $p["id_entidad"];
    $c["id_tipo_comprobante"] = $p["id_tipo_comprobante"];
    $c["numero_comprobante"] = $p["numero_comprobante"];
    $c["fecha_comprobante"] = $p["fecha_comprobante"];
    $c["observaciones"] = $p["observaciones"];
    $c["monto"] = $p["monto"];
    $c["iva"] = $p["iva"];
    // $c["file_comprobante"] = $p["file_comprobante"];
    $id = R::store($c);
    if($ret)response(200,"carga correcta",["exito" => true, "id_pago" => $id]);
}