<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class CorreoController extends Controller
{
    public function getEnviar()
    {
        return view("terracita.correo.enviar");
    }

    public function getEnviados()
    {
        return view("terracita.correo.enviados");
    }

    public function getRecibidos()
    {
        return view("terracita.correo.recibidos");
    }

    #servidor de correo
    public function getEnviarMensaje()
    {
        $mail = new PHPMailer(true);
        $mail->SMTPOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
            ],
        ];

        try {
            // Configuración del servidor SMTP
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host = '192.168.43.146';
            $mail->SMTPAuth = true;
            $mail->Username = 'ricardo@terracita.com';
            $mail->Password = '123';
            $mail->SMTPSecure = 'tls';
            // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            echo "mensaje".$mail->Password;

            // Configuración del remitente y destinatario
            $remitenteEmail = 'ricardo@terracita.com';
            $destinatarioEmail = 'francisco@terracita.com';
            $mail->setFrom($remitenteEmail, $destinatarioEmail);
            $mail->addAddress($destinatarioEmail);

            // Contenido del correo
            $mail->isHTML(true);
            $mail->Subject = 'Prueba correo laravel';
            $mail->Body = 'Esta es una prueba de envio de correo';

            // Enviar el correo
            $mail->send();

            return "Correo enviado correctamente de $remitenteEmail ($remitenteEmail) a $destinatarioEmail";
        } catch (Exception $e) {
            return "Error al enviar el correo: {$e->getMessage()}";
        }
    }

    public function getEnviarMensaje1()
    {

    }
}
