<?php
$resultado = 0;
$datos = $_POST['datos_select'];
$mensaje = $_POST["mensaje"];
$id_comercio = $_POST["id_comercio"];
$comercio = R::findOne("comercios","id LIKE ?",Array($id_comercio));

$cuerpo = "<div style='background:#769FCD;padding:80px 0'>";
$cuerpo .= "<div style='width:70%; padding:20px; background:#ffffff; margin:0px auto'>";
$cuerpo .= "<h3 style='text-align:center'>Comercio: {$comercio["nombre"]}</h3>";
$cuerpo .= "<div style='text-align:center'>";
$cuerpo .= "<p><strong>Razón Social:</strong> {$comercio["razon_social"]}</p>";
$cuerpo .= "<p><strong>Titular:</strong> {$comercio["nombre_titular"]}</p>";
$cuerpo .= "<p><strong>DNI:</strong> {$comercio["dni_titular"]}</p>";
$cuerpo .= "<p><strong>Mail:</strong> {$comercio["mail"]}</p>";
$cuerpo .= "<p><a style='' href='http://vps.riddle.com.ar/litt/ui/financiera/altaComFinal.php?id={$comercio["id"]}'>Ir a comercio</a></p>";
$cuerpo .= "</div>";
$cuerpo .= "<h3 style='text-align:center'>Datos a modificar</h3>";
$cuerpo .= "<ul>";
foreach ($datos as $d) {
	$cuerpo .= "<li>{$d}</li>";
}
$cuerpo .= "</ul><hr/>";
$cuerpo .= $mensaje;
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
$mail->FromName = "LITT";

$mail->AddBCC("copiaslitt@riddle.com.ar", $comercio["nombre"]." - Recibo");
$mail->addAddress("litt.consultas@gmail.com", "LITT Consultas");

$mail->isHTML(true);
$mail->CharSet = 'UTF-8';
$mail->Subject = "Modificación de datos";
$mail->Body = $cuerpo;
//$mail->AltBody = "This is the plain text version of the email content";
if(isset($_FILES['archivo'])) {
	$mail->AddAttachment($_FILES['archivo']['tmp_name'],$_FILES['archivo']['name']); 
}


if(!$mail->send()) {
    $resultado = json_encode(Array("resultado" => 0));
} else {
    $resultado = json_encode(Array("resultado" => 1));
}

echo $resultado;