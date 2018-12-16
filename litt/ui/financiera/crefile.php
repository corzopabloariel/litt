<?php
require_once '../../model/database.php';
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=crefile.xls");

//header("Content-Type:   text/csv; charset=utf-8");
//header('Content-disposition: attachment;filename=MyVerySpecial.csv');

// comienzo con el dumpeado - traigo todos los creditos
$cre = R::findAll("credito_instancia");
?>
<table>
    <tr>
        <td> NRO OP</td>
        <td> FECHA ALTA</td>
        <td> APELLIDO</td>
        <td> NOMBRES</td>
        <td> DNI</td>
        <td> PLAN</td>
        <td> MONTO</td>
        <td> CUOTAS</td>
        <td> VALOR CUOTAS</td>
        <td> PRIMER VTO</td>
        <td> ULT VTO</td>
        <td> FECHA NAC</td>
        <td> SCORE</td>
        <td> MAIL</td>
        <td> TEL FIJO</td>
        <td> CELULAR</td>
        <td> CALLE</td>
        <td> DEPTO</td>
        <td> LOCALIDAD</td>
        <td> COD POSTAL</td>
        <td> PROVINCIA</td>
        <td> EMPRESA</td>
        <td> LAB_TEL</td>
        <td> SUELDO NETO</td>
        <td> LAB_CALLE </td>
        <td> LAB_DEPTO</td>
        <td> LAB_LOCALIDAD</td>
        <td> LAB_COD POSTAL</td>
        <td> LAB_PROVINCIA</td>
        <td> REF_1 NOMBRE COMP</td>
        <td> RF_1 TEL FIJO</td>
        <td> REF_1 CELULAR</td>
        <td> REF_1 PARENTESCO</td>
        <!-- <td> REF_2 NOMBRE COMP</td>
        <td> REF_2 TEL FIJO</td>
        <td> REF_2 CELULAR</td>
        <td> REF_2 PARENTESCO</td> -->
    </tr>
<?php
foreach($cre as $c){
    // traigo al usuario
    $cliente = R::findOne("clientes","dni LIKE ?",[$c['dni_cliente']]);
    $plan = R::findOne("planes","id LIKE ?",[$c["id_plan"]]);
    // traigo una cuota
    $primera_cuota = R::findOne("cuotas","id_credito LIKE ? ORDER BY n_cuota DESC",[$c["id"]]);
    $ultima_cuota = R::findOne("cuotas","id_credito LIKE ? ORDER BY n_cuota ASC",[$c["id"]]);
    echo "<tr>";
    td($c["id"]);
    td(fecha_out($c["fecha_creacion"]));
    td($cliente["apellido"]);
    td($cliente["nombre"]);
    td($cliente["dni"]);
    td($plan["designacion"]);
    td($c["monto"]);
    td($c["cuotas"]);
    td($primera_cuota["cuota_original"] + $primera_cuota["punitorios"]);
    td(fecha_out($primera_cuota["vencimiento"]));
    td(fecha_out($ultima_cuota["vencimiento"]));
    td($cliente["fecha_nacimiento"]);
    td($c["score"]);
    td($cliente["mail"]);
    td($cliente["telefono_fijo"]);
    td($cliente["telefono_celular"]);
    td($cliente["domicilio_calle_altura"]);
    td($cliente["domicilio_piso_depto"]);
    td($cliente["domicilio_localidad"]);
    td($cliente["domicilio_cpa"]);
    td($cliente["domicilio_provincia"]);
    td($cliente["empleo_empresa"]);
    td($cliente["empleo_telefono"]);
    td($cliente["empleo_sueldo"]);
    td($cliente["empleo_calle_altura"]);
    td($cliente["empleo_piso_depto"]);
    td($cliente["empleo_localidad"]);
    td($cliente["empleo_cpa"]);
    td($cliente["empleo_provincia"]);
    td($cliente["referido_nombre"]);
    td($cliente["referido_telefono_fijo"]);
    td($cliente["referido_telefono_celular"]);
    td($cliente["referido_parentesco"]);
    // faltaria el segundo referido que no esta en la documentacion inicial
    
    echo "</tr>";
    
}
echo "</table>";

function td($in){
    echo "<td>" . $in . "</td>";
}
function fecha_out($f){
    $anio = substr($f,0,4);
    $mes = substr($f,4,2);
    $dia = substr($f,6,2);
    return $dia . "/". $mes . "/" . $anio;
}