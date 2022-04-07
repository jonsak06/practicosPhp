<?php
    $user = $_POST["fusuario"];
    $pass = $_POST["fcontrasenia"];

    if($user == "tecnologo" and $pass == "1234")
    {
        echo "usuario logeado correctamente";
    }
    else
    {
        echo "Usuario o Contraseña es incorrecta";
    }
?>