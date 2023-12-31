<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// se requiere de estos tres archivos bajados desde github - https://github.com/PHPMailer/PHPMailer
require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

$mail = new PHPMailer(true);

$autoresponder_subject = "Gracias por contactarnos";

try {
    //Server settings
    $mail->SMTPDebug = 0;                           //Enable verbose debug output
    $mail->isSMTP();                                //Send using SMTP
    $mail->CharSet = 'UTF-8';                       // se habilita signos UTF-8
    $mail->Host       = 'smtp.gmail.com';           //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                       //Enable SMTP authentication
    $mail->Username   = 'criosoguttest@gmail.com';  //SMTP username
    $mail->Password   = 'aleumyagctlojxhk';         // se habilita contraseña de aplicacion en gmail, contraseña temporal SMTP correoSMTPcontacto, no utilizar contraseña de acceso de gmail
    $mail->SMTPSecure = 'tls';                      //Enable implicit TLS encryption
    $mail->Port       = 587;                        //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('criosoguttest@gmail.com', 'Cotizacion');
    $mail->addAddress('criosoguttest@gmail.com');   //Add a recipient
    $mail->addCC('cosoriogut@gmail.com');           // con copia

    //Content
    $mail->isHTML(true); 
    //Set email format to HTML



    $mail->Subject = 'Cotización';
    $mail->Body    = <<<EOT
    Nombre:	{$_POST['name']}<br/>
    Correo: {$_POST['email']}<br/>
    Teléfono: {$_POST['phone']}<br/>
    Asunto: {$_POST['subject']}<br/>
    Mensaje: {$_POST['message']}<br/>
    EOT;

    $mail->send();
    echo 'Mensaje enviado!';

    $autoresponder->addAddress($email);
    $autoresponder->Subject = $autoresponder_subject;

} catch (Exception $e) {
    echo "Error al enviar... {$mail->ErrorInfo}";
}