<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../../../../PHPMailer/Exception.php';
require '../../../../PHPMailer/PHPMailer.php';
require '../../../../PHPMailer/SMTP.php';
require_once('../conexion.php');
$email = $_POST['email'];

$queryUsuarios = "SELECT * FROM usuarios WHERE usu_email = 'santirocha000@gmail.com'";
$queryAliados = "SELECT * FROM aliados WHERE ali_email = '$email'";

$result = $link->query($queryUsuarios);
$result2 = $link->query($queryAliados);

if($result->num_rows > 0){
    $mail = new PHPMailer(true);

try {
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp-mail.outlook.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'colfexxiones@outlook.es';                     //SMTP username
    $mail->Password   = 'amosena123';                              //SMTP password
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('colfexxiones@outlook.es', 'Col-Fexxiones');
    $mail->addAddress('santirocha000@gmail.com', 'Santiago User'); 


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Recuperación de contraseña';
    $mail->Body    = 'Hola! este es un correo para recuperar tu contraseña porfavor ingresa a el siguiente link para ver tu contraseña';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}}else{
    header("location: ../../login.html");
}



?>