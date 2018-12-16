<?php
$resultado = 0;
$id_comercios = $_POST['form-enviar-input'];
$asunto = $_POST['asunto'];
$mensaje = $_POST["mensaje"];

$cuerpo = "<div style='background:#769FCD;padding:80px 0'>";
$cuerpo .= "<div style='width:70%; padding:20px; background:#ffffff; margin:0px auto'>";
$cuerpo .= "<h3 style='text-align:center; font-size:18px'>LITT <img src='http://31.220.59.150/litt/new/img/pluma.png' style='display:inline-block; height:16px' /></h3>";
$cuerpo .= "<div>";
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

//$mail->addAddress("corzo.pabloariel@gmail.com", "Pablo");

$mail->isHTML(true);
$mail->CharSet = 'UTF-8';
$mail->Subject = strtoupper($asunto);
$mail->Body = $cuerpo;
//$mail->AltBody = "This is the plain text version of the email content";
if(isset($_FILES['archivo'])) {
	$mail->AddAttachment($_FILES['archivo']['tmp_name'],$_FILES['archivo']['name']); 
}

$Acomercios = Array();
if(strlen($id_comercios) == 1) $Acomercios[] = $id_comercios;
else $Acomercios = explode("-", $id_comercios);

$comercios_mail = "<p style='margin:0'><strong>Comercios:</strong></p>";
foreach ($Acomercios as $c) {
	$comercio = R::findOne("comercios","id LIKE ?",Array($c));

	$mail->addAddress(strtolower($comercio['mail']), ucwords(strtolower($comercio["nombre_titular"])));
     
    if (!$mail->send()) {
        break; //forzamos la salida del bucle en caso de error
    }
    $comercios_mail .= "<p style='margin:0px; padding-left:20px;'>{$comercio["nombre"]} - <a href='mailto:{$comercio["mail"]}'>{$comercio["mail"]}</a></p>";
    // Limpiamos los datos par próximos envíos
    $mail->clearAddresses();
    $mail->clearAttachments();
}

$cuerpo = "<div style='background:#769FCD;padding:80px 0'>";
$cuerpo .= "<div style='width:70%; padding:20px; background:#ffffff; margin:0px auto'>";
$cuerpo .= "<h3 style='text-align:center; font-size:18px'>LITT <img src='http://31.220.59.150/litt/new/img/pluma.png' style='display:inline-block; height:16px' /></h3>";
$cuerpo .= "<div>";
$cuerpo .= $mensaje;
$cuerpo .= "<hr/>";
$cuerpo .= $comercios_mail;
$cuerpo .= "</div>";
$cuerpo .= "</div>";

$mail->Subject = strtoupper($asunto." - mails a comercios");
$mail->Body = $cuerpo;
if(isset($_FILES)) {
	$mail->AddAttachment($_FILES['archivo']['tmp_name'],$_FILES['archivo']['name']); 
}

$mail->AddBCC("copiaslitt@riddle.com.ar", "LITT - mail");
$mail->addAddress("litt.consultas@gmail.com", "LITT Consultas");
//$mail->addAddress("corzo.pabloariel@gmail.com", "LITT Consultas");

if(!$mail->send()) {
    $resultado = json_encode(Array("resultado" => 0));
} else {
    $resultado = json_encode(Array("resultado" => 1));
}
echo $resultado;