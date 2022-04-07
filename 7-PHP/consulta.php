<?php
    $nombre = $_POST["fnombre"];
    $email = $_POST["femail"];
    $asunto = $_POST["fasunto"];
    $mensaje = $_POST["fmensaje"];

    echo "Nombre: ", $nombre, "<br>";
    echo "Correo Electrónico: ", $email, "<br>";
    echo "Asunto: ", $asunto, "<br>";
    echo "Mensaje: ", $mensaje, "<br>";

?>