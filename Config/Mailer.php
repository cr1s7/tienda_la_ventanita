<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../vendor/autoload.php';

class Mailer
{
    public static function enviar($para, $asunto, $mensaje)
    {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'TU_CORREO@gmail.com';
            $mail->Password   = 'TU_APP_PASSWORD';
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            $mail->setFrom('TU_CORREO@gmail.com', 'La Ventanita');
            $mail->addAddress($para);

            $mail->isHTML(true);
            $mail->Subject = $asunto;
            $mail->Body    = $mensaje;

            $mail->send();
            return true;

        } catch (Exception $e) {
            return false;
        }
    }
}
