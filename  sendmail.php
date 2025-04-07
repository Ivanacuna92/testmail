<?php
// Importar las clases de PHPMailer en el espacio de nombres global
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Incluir los archivos necesarios de PHPMailer (ajusta la ruta según tu estructura de directorios)
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if (isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $destinatario = $_POST['email'];

    $mail = new PHPMailer(true);
    
    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host       = 'mail.cyfsaai.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'notificaciones-ia@cyfsaai.com';
        $mail->Password   = '0<c0:m:FPG|E';
        $mail->SMTPSecure = 'ssl';
        $mail->Port       = 465;

        // Remitente y destinatario
        $mail->setFrom('notificaciones-ia@cyfsaai.com', 'Notificaciones IA');
        $mail->addAddress($destinatario);

        // Contenido del correo
        $mail->isHTML(true);                                  // Configura el correo en formato HTML
        $mail->Subject = 'Asunto del correo';
        $mail->Body    = '<p>Este es el mensaje de prueba enviado desde nuestra página.</p>';
        $mail->AltBody = 'Este es el mensaje de prueba enviado desde nuestra página.';

        $mail->send();
        echo '<p>El mensaje se envió exitosamente a ' . htmlspecialchars($destinatario) . '.</p>';
    } catch (Exception $e) {
        echo '<p>No se pudo enviar el mensaje. Error: ' . $mail->ErrorInfo . '</p>';
    }
} else {
    echo '<p>Por favor, ingresa un correo electrónico válido.</p>';
}
?>
