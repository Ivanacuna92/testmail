<?php
// Validamos que se haya enviado el formulario y que el email sea válido.
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $destinatario = $_POST['email'];
    
    // Incluir archivos necesarios de PHPMailer (ajusta la ruta si es necesario).
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
    
    // Importar las clases de PHPMailer
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    // Crear una instancia de PHPMailer
    $mail = new PHPMailer(true);
    
    try {
        // Configurar el servidor SMTP
        $mail->isSMTP();
        $mail->Host       = 'mail.cyfsaai.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'notificaciones-ia@cyfsaai.com';
        $mail->Password   = '0<c0:m:FPG|E';
        $mail->SMTPSecure = 'ssl';
        $mail->Port       = 465;
    
        // Configurar remitente y destinatario
        $mail->setFrom('notificaciones-ia@cyfsaai.com', 'Notificaciones IA');
        $mail->addAddress($destinatario);
    
        // Configurar el contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'Prueba de correo';
        $mail->Body    = '<p>Este es un correo de prueba enviado desde script.php.</p>';
        $mail->AltBody = 'Este es un correo de prueba enviado desde script.php.';
    
        // Intentar enviar el correo
        $mail->send();
        $mensaje = 'El correo se envió correctamente a ' . htmlspecialchars($destinatario) . '.';
    } catch (Exception $e) {
        $mensaje = 'Error al enviar el correo: ' . $mail->ErrorInfo;
    }
} else {
    $mensaje = 'Por favor, ingresa un correo electrónico válido.';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Resultado del Envío</title>
</head>
<body>
  <h2>Resultado del Envío de Correo</h2>
  <p><?php echo $mensaje; ?></p>
  <p><a href="index.html">Volver al formulario</a></p>
</body>
</html>
