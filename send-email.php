<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Configura tu dirección de correo
    $to = "dev.taissantos@gmail.com";
    $subject = "Nuevo mensaje del formulario de contacto";

    // Captura los datos del formulario
    $name = strip_tags($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $message = htmlspecialchars($_POST['message']);

    if (!$email) {
        http_response_code(400);
        echo "Por favor ingresa un correo válido.";
        exit;
    }

    // Cuerpo del correo
    $emailContent = "Nombre: $name\n";
    $emailContent .= "Correo: $email\n\n";
    $emailContent .= "Mensaje:\n$message\n";

    // Encabezados del correo
    $headers = "From: $email";

    // Intenta enviar el correo
    if (mail($to, $subject, $emailContent, $headers)) {
        http_response_code(200);
        echo "OK";
    } else {
        http_response_code(500);
        echo "Hubo un error al enviar tu mensaje. Inténtalo más tarde.";
    }
} else {
    http_response_code(403);
    echo "No se puede acceder a este recurso de esa manera.";
}
?>