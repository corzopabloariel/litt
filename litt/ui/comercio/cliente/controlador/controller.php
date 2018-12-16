<?php

/*
 * El controlador principal de cada entidad general administra todo, inclusive las
 * redirecciones
 * Cada controlador toma la seguridad del sistema, por momento deshabilitado, lee la 
 * sesion y se fija que sea la correcta
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once('../../../../model/database.php');
include_once('../../../../controller/basic.php');

$g = quitarInyeccion($_GET);
$p = quitarInyeccion($_POST);

// todas envian un dato post, asi que lo cargo en un "disparador"
$send = array();
$to = null;

// primer pantalla
if(isset($g['nuevoCredito'])){
    header('Location: ../../nuevoCredito.php');   
    //header('Location: /litt/new/main.html');
}

if(isset($g['listarClientes'])){
    // cuando observaciones pasa de null a vacio, es cuando se culmino
    // el proceso
    $q = "SELECT GROUP_CONCAT(DISTINCT dni_cliente) AS clientes FROM `credito_instancia` WHERE id_comercio = ".$_SESSION['id_comercio'];
    $cl = query_ret($q);
    $clientes = "";
    while($f = $cl->fetch_assoc()){
        $clientes = $f["clientes"];
        //$clientes = str_replace(",", "','", $clientes);
    }
    //var_dump($clientes);
    //die();
    $arr_clientes = array();
    if($clientes != "") {
        $q = "select * from clientes WHERE dni IN(".$clientes.")"; // where observaciones is not null";
        $ret = query_ret($q);
        while($f = $ret->fetch_assoc()){
            $arr_clientes[] = $f;
        }
    }
    $_SESSION['clientes'] = $arr_clientes;
    $to =  '../vista/listar_1.php';
}

if(isset($g['verCliente'])){
    $q = "select * from clientes where dni = '" . $g['verCliente'] . "'";
    $ret = query_ret($q);
    $ret = $ret->fetch_array(MYSQLI_ASSOC);
    if(count($ret) > 0){
        $send = $ret;
        $to =  '../vista/listar_2_verCliente.php';
    }    
}



if(isset($g['guardarDatosModificados']))
{
    $q = "update clientes set ";
    $dni = $p['dni'];
    unset($p['dni']);
    // ahora me quedan el resto de los elementos
    foreach($p as $k => $v)
        $q .= " " . $k . " = '" . strtoupper($v) . "',";
    // quito la ultima coma
    $q = substr($q, 0, -1);
    $q .= " where dni = '" . $dni . "'";
    query_noret($q);
    // echo $q;
    header('Location: ./controller.php?listarClientes');   
}

// bifurcacion dependiendo del resultado
if(isset($g['verificacion'])){
    // consulto si esta en la BD, si esta lo mando directo a 2_resultadoCarga
    $q = "select * from clientes where dni = '" . $p['dni'] . "'";
    $ret = query_ret($q);
    $ret = $ret->fetch_array(MYSQLI_ASSOC);
    if(count($ret) > 0){
        // lo envio a 3_solicitudCredito, el primer resultado
        $to =  '/litt/controller/reglas_aprobacion.php';
        // var_dump($ret);
        $send['dni'] = $ret['dni'];
        $send['nombre'] = $ret['nombre']; 
        $send['apellido'] = $ret['apellido'];
        $send['fecha_nacimiento'] = $ret['fecha_nacimiento'];
        $send['score'] = $p['score'];
    } else
    {
        // no existe el usuario, lo mando para crear
        $to =  '../vista/alta_1b_crearUsuario.php';
        // var_dump($ret);
        $send['dni'] = $p['dni'];
        $send['score'] = $p['score'];
    }
}

// solicitud de credito
if(isset($g['solicitudCredito'])){
    $q = "select * from clientes where dni = " . $p['dni'];
    $ret = query_ret($q);
    $ret = $ret->fetch_array(MYSQLI_ASSOC);
    if(count($ret) > 0){
        // lo envio a 3_solicitudCredito, el primer resultado
        $to =  '../vista/alta_3_solicitudCredito.php';
        // var_dump($ret);
        $send['dni'] = $ret['dni'];
        $send['nombre'] = $ret['nombre'];
        $send['apellido'] = $ret['apellido'];
        $send['fecha_nacimiento'] = $ret['fecha_nacimiento'];
        $send['telefono_fijo'] = $ret['telefono_fijo'];
        $send['telefono_celular'] = $ret['telefono_celular'];
        $send['mail'] = $ret['mail'];
        // le envio los planes disponibles en forma de array
        $q = "select * from planes";
        $ret = query_ret($q);
        $arr_planes = array();
        while($f = $ret->fetch_assoc()){
            $arr_planes[] = $f;
        }
        $_SESSION['planes'] = $arr_planes;
    } else {
        header('Location: ../vista/alta_1_cargarDni.php');   
    }
}

if(isset($g['guardarDatos1'])){
    $q = "update clientes set"
            . " telefono_fijo = '" . $p['telefono_fijo'] . "',"
            . " telefono_celular = '" . $p['telefono_celular'] . "',"
            . " mail = '" . $p['mail'] . "'"  
            . " where dni = '" . $p['dni'] . "'";
    query_noret($q);
    // creo el credito
    $x = "insert into credito_instancia (dni_cliente,monto,id_plan,cuotas,fecha_creacion) values ("
            . "'" . $p['dni'] . "',"
            . "'" . $p['monto'] . "',"
            . "'" . $p['plan'] . "',"
            . $p['cuotas'] . ","
            . "'" . date("Ymd") . "')";
    query_noret($x);
    
    // traigo de la BD el ultimo de este DNI con el ID mas alto
    $ret = R::findOne("credito_instancia","dni_cliente LIKE ? ORDER BY id DESC LIMIT 0,1",array($p['dni']));
    // divido el precio por la cantidad de cuotas
    $valor_cuota = $p['monto'] / $p['cuotas'];
    //var_dump($ret);

    for($i = 0; $i < $p['cuotas']; ++$i){
        $cuota = R::dispense('cuotas');
        // $cuota->id = 3 + $i;
        $cuota->id_credito = $ret['id'];
        $cuota->n_cuota = $i + 1;
        $cuota->cuota_original = $valor_cuota;
        $cuota->punitorios = 1;
        $t = date("Ymd", strtotime("+" . ($i + 1) . " month"));
        $cuota->vencimiento = $t;
        $cuota->estado = '0';
        $cuota->dni_cliente = $p['dni'];
        // echo "por lo menos llego aca";
        R::store($cuota);
    }
    
    $id = $mdb->insert_id;
    
    $q = "select * from clientes where dni = " . $p['dni'];
    $ret = query_ret($q);
    $ret = $ret->fetch_array(MYSQLI_ASSOC);
    if(count($ret) > 0){
        $send['referido_nombre'] = $ret['referido_nombre'];
        $send['referido_telefono_fijo'] = $ret['referido_telefono_fijo'];
        $send['referido_telefono_celular'] = $ret['referido_telefono_celular'];
        $send['referido_parentesco'] = $ret['referido_parentesco'];
        $send['empleo_empresa'] = $ret['empleo_empresa'];
        $send['empleo_telefono'] = $ret['empleo_telefono'];
        $send['empleo_sueldo'] = $ret['empleo_sueldo'];
        $send['dni'] = $ret['dni'];
    }
    $to =  '../vista/alta_4_solicitudReferidoEmpleo.php';
    $send['id_credito_instancia'] = $id;
}

if(isset($g['guardarDatos2'])){
    $q = "update clientes set"
            . " referido_nombre = '" . $p['referido_nombre'] . "',"
            . " referido_telefono_fijo = '" . $p['referido_telefono_fijo'] . "',"
            . " referido_telefono_celular = '" . $p['referido_telefono_celular'] . "',"
            . " referido_parentesco = '" . $p['referido_parentesco'] . "',"
            . " empleo_empresa = '" . $p['empleo_empresa'] . "',"
            . " empleo_telefono = '" . $p['empleo_telefono'] . "',"
            . " empleo_sueldo = '" . $p['empleo_sueldo'] . "'"
            . " where dni = '" . $p['dni'] . "'";
    query_noret($q);
    $q = "update credito_instancia set"
            . " producto_designacion = '" . $p['producto_designacion'] . "'"
            . " where id = '" . $p['id_credito_instancia'] . "'";
    query_noret($q);
    
    $q = "select * from clientes where dni = " . $p['dni'];
    $ret = query_ret($q);
    $ret = $ret->fetch_array(MYSQLI_ASSOC);
    if(count($ret) > 0){
        $send['domicilio_calle_altura'] = $ret['domicilio_calle_altura'];
        $send['domicilio_piso_depto'] = $ret['domicilio_piso_depto'];
        $send['domicilio_cpa'] = $ret['domicilio_cpa'];
        $send['domicilio_localidad'] = $ret['domicilio_localidad'];
        $send['domicilio_provincia'] = $ret['domicilio_provincia'];
        $send['empleo_calle_altura'] = $ret['empleo_calle_altura'];
        $send['empleo_piso_depto'] = $ret['empleo_piso_depto'];
        $send['empleo_cpa'] = $ret['empleo_cpa'];
        $send['empleo_localidad'] = $ret['empleo_localidad'];
        $send['empleo_provincia'] = $ret['empleo_provincia'];
        $send['observaciones'] = $ret['observaciones'];
        $send['id_credito'] = $p['id_credito_instancia'];
    }
    if($p['alta_provisoria'] == "true")
        $to = '../vista/altaProvisoria.php?id_credito=' . $p['id_credito_instancia'];
    else
        $to = '../vista/alta_6_solicitarDomicilioParticularLaboral.php';
    $send['dni'] = $p['dni'];
}

if(isset($g['guardarDatos3'])){
    $q = "update clientes set"
        . " domicilio_calle_altura = '" . $p['domicilio_calle_altura'] . "',"
        . " domicilio_piso_depto = '" . $p['domicilio_piso_depto'] . "',"
        . " domicilio_cpa = '" . $p['domicilio_cpa'] . "',"
        . " domicilio_localidad = '" . $p['domicilio_localidad'] . "',"
        . " domicilio_provincia = '" . $p['domicilio_provincia'] . "',"
        . " empleo_calle_altura = '" . $p['empleo_calle_altura'] . "',"
        . " empleo_piso_depto = '" . $p['empleo_piso_depto'] . "',"
        . " empleo_cpa = '" . $p['empleo_cpa'] . "',"
        . " empleo_localidad = '" . $p['empleo_localidad'] . "',"
        . " empleo_provincia = '" . $p['empleo_provincia'] . "',"
        . " observaciones = '" . $p['observaciones'] . "'"
        . " where dni = '" . $p['dni'] . "'";
    query_ret($q);
    
    header('Location: ../vista/alta_7_altaDefinitiva.php?id_credito=' . $p['id_credito']);   
}

// en envio en caso de que se de
if(!is_null($to)){  ?>
<form id="myForm" action="<?php echo $to; ?>" method="post">
<?php
    foreach ($send as $a => $b) {
        echo '<input type="hidden" name="'.htmlentities($a).'" value="'.htmlentities($b).'">';
    }
?>
</form>
<script type="text/javascript">
    document.getElementById('myForm').submit();
</script>
<?php } ?>

