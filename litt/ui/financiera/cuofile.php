<?php   
require_once '../../model/database.php';
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=cuofile.xls");
// comienzo con el dumpeado - traigo todos los creditos
$cuo = R::findAll("cuotas");
?>
<table>
    <tr>
        <td> DNI</td>
        <td> NOMBRE</td>
        <td> NRO OP</td>
        <td> NRO CUOTA</td>
        <td> CUOTAS</td>
        <td> OPCUOTA</td>
        <td> FECHA VENCIMIENTO</td>
        <td> CAPITAL</td>
        <td> INTERES</td>
        <td> CUOTA PURA</td>
        <td> TEM</td>
        <td> FECHA PAGO</td>
        <td> MONTO PAGO</td>
        <td> DIAS ATRASO</td>
        <td> MULTA</td>
        <td> PUNITORIOS</td>
        <td> COMPENSATORIOS</td>
        <td> TOTAL CUOTA</td>
        <td> ESTADO
    </tr>
<?php
foreach($cuo as $c){
    // traigo al usuario
    $cliente = R::findOne("clientes","dni LIKE ?",[$c['dni_cliente']]);
    $credito = R::findOne("credito_instancia","id LIKE ?",[$c["id_credito"]]);
    $plan = R::findOne("planes","id LIKE ?",[$credito["plan"]]);
    $estado_mora = R::findOne("estado_mora","id LIKE ?",[$c["estado_mora"]]);
    
    echo "<tr>";
    td($c["dni_cliente"]);
    td($cliente["apellido"] . ", " . $cliente["nombre"]);
    td($c["id_credito"]);
    td($c["n_cuota"]);
    td($credito["cuotas"]);
    td($c["id"]);
    td(fecha_out($c["vencimiento"]));
    td($c['capital']); // capital
    td($c['interes']); // interes
    td($c["cuota_original"]);
    td($c['tem']); // tem
    td($c["fecha_depago"]);
    if($c["abonado"]){
        td($c["cuota_original"] + $c["punitorios"]);
        $t = $c["vencimiento"];
        $n = $c["fecha_depago"]; 
        $dif = round(($n - $t) / (60*60*24)); // dias diferencia 
        td($dif);
    } else {
        td("0");
        $t = $c["vencimiento"];
        $n = date("Ymd"); // hoy
        if($t < $n) // si ya esta vencida
            $dif = round(($n - $t) / (60*60*24)); // dias diferencia 
        else // si no esta vencida
            $dif = 0;
        td($dif);
    }
    td($c["multa"]);
    td($c["punitorios"]);
    td($c["compensatorios"]); // int comp
    $total_cuota = $c["cuota_original"] + $c["multa"] + $c["punitorios"] + $c["comprensatorios"];
    td($total_cuota); // total cuota = orignal + compensatorios + punitorios + multa
    td($estado_mora["designacion"]);
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
