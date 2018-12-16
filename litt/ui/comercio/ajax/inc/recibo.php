<?php
$resultado = 0;
$url = $_POST['url'];
$file = $_POST["file"];
$id_recibo = $_POST["recibo"];

$recibo = R::findOne("recibos","id LIKE ?",Array($id_recibo));
$cliente = R::findOne("clientes","id LIKE ?",Array($recibo["id_cliente"]));
$comercio = R::findOne("comercios","id LIKE ?",Array($recibo["id_comercio"]));

$mail_cliente = strtolower($cliente["mail"]);
$nombre = ucwords(strtolower($cliente["nombre"]." ".$cliente["apellido"]));

$fecha_alta = date("d/m/Y H:i",strtotime($recibo["autofecha"]));
$cuerpo = "<div style='background:#769FCD;padding:80px 0'>";
$cuerpo .= "<div style='width:70%; padding:20px; background:#ffffff; margin:0px auto'>";
$cuerpo .= "<h2 style='text-align:center'>{$comercio["nombre"]}</h2>";
$cuerpo .= "<div style='padding:20px;'>";
$cuerpo .= "<h3><strong>Recibo #{$id_recibo}</strong><span style='float:right;'>{$fecha_alta}</span></h3>";
$cuerpo .= "<p>Detalles:</p>";
$cuerpo .= "<table style='width:80%;margin:0px auto;border-spacing: 0px; border-collapse: collapse;'>";
$cuerpo .= "<thead>";
$cuerpo .= "<tr style='border-top: 1px solid #ccc; background:#ddd'>";
$cuerpo .= "<th style='padding:5px 10px; background:#ddd'>Nro. Cuota</th>";
$cuerpo .= "<th style='padding:5px 10px; background:#ddd'>Nro. Operación</th>";
$cuerpo .= "<th style='padding:5px 10px; background:#ddd'>Vencimiento</th>";
$cuerpo .= "<th style='padding:5px 10px; background:#ddd'>Cuota original</th>";
$cuerpo .= "<th style='padding:5px 10px; background:#ddd'>Interes</th>";
$cuerpo .= "<th style='padding:5px 10px; background:#ddd'>Sub Total</th>";
$cuerpo .= "</tr>";
$cuerpo .= "</thead>";
$cuerpo .= "<tbody>";
$cuotas = R::findAll("cuotas","id_recibo LIKE ?",Array($id_recibo));
foreach ($cuotas as $c) {
	$interes = round(floatval($c["compensatorios"]) + floatval($c["punitorios"]) + floatval($c["multa"]));
	$subtotal = round(floatval($c["cuota_original"]) + $interes);
	$cuota_original = round($c["cuota_original"]);
	$fecha = fecha($c["vencimiento"]);
	$cuerpo .= "<tr>";
		$cuerpo .= "<td style='border-top: 1px solid #ccc;text-align:center; padding:5px 10px;'>{$c["n_cuota"]}</td>";
		$cuerpo .= "<td style='border-top: 1px solid #ccc;text-align:center; padding:5px 10px;'>{$c["id_credito"]}</td>";
		$cuerpo .= "<td style='border-top: 1px solid #ccc;text-align:center; padding:5px 10px;'>{$fecha}</td>";
		$cuerpo .= "<td style='border-top: 1px solid #ccc;text-align:right; padding:5px 10px;'>{$cuota_original}</td>";
		$cuerpo .= "<td style='border-top: 1px solid #ccc;text-align:right; padding:5px 10px;'>{$interes}</td>";
		$cuerpo .= "<td style='border-top: 1px solid #ccc;text-align:right; padding:5px 10px;'>{$subtotal}</td>";
	$cuerpo .= "<tr>";
}
$cuerpo .= "</tbody>";
$cuerpo .= "</table>";
$cuerpo .= "<h2 style='text-align:center'>TOTAL: {$recibo["monto"]}</h2>";
$cuerpo .= "</div>";
$cuerpo .= "</div>";
$cuerpo .= "</div>";

$mail = new PHPMailer;

$mail->SMTPDebug = 3;                               
$mail->isSMTP();            
$mail->Host = "mx1.hostinger.com.ar";
$mail->SMTPAuth = true;                          
$mail->Username = "copiaslitt@riddle.com.ar";                 
$mail->Password = "contrasela";                           
$mail->SMTPSecure = "tls";                           
$mail->Port = 587;                                   

$mail->From = "copiaslitt@riddle.com.ar";
$mail->FromName = $comercio["nombre"]." - Recibo";

$mail->AddBCC("copiaslitt@riddle.com.ar", $comercio["nombre"]." - Recibo");

$mail->addAddress($mail_cliente, $nombre);

$mail->isHTML(true);
$mail->CharSet = 'UTF-8';
$mail->Subject = "Recibo {$id_recibo} - {$comercio["nombre"]}";
$mail->Body = $cuerpo;
//$mail->AltBody = "This is the plain text version of the email content";

$mail->AddAttachment( "{$url}", "recibo.pdf" );


if(!$mail->send()) {
    $resultado = json_encode(Array("resultado" => 0));
} else {
    $resultado = json_encode(Array("resultado" => 1));
}

echo $resultado;

function fecha($f) {
    $a = substr($f, 0,4);
    $m = substr($f, 4,2);
    $d = substr($f, 6,2);

    return $d."/".$m."/".$a;
}