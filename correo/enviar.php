<?php  


// Llamando a los campos
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];

// Datos para el envio de correo
$destinatario = "agrupacioncajamarca@gmail.com";
$asunto = "Solicitud de registro a nuestra web - APPPA";
$destinatario1 = $correo;

$carta = "De: $nombre \n";
$carta .= "Correo: $correo \n";
$carta .= "Telefono: $telefono \n";
$carta .= "Mensaje: Soy un nuevo usuario $nombre\n";

//$carta1 .= "Mensaje para el solicitante: En unos minutos le estaremos dando de alta su solicitud";
// Enviando Mensaje
mail($destinatario, $asunto, $carta);

//header('Location:mensaje-de-envio.html');

?>