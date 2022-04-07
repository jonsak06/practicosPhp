<?php
    $nombre = $_POST["fnombre"];
    $apellido = $_POST["fapellido"];
    $horas = $_POST["fhoras"];
    $horasExtras = $_POST["fhoras-extras"];
    $valorHora = $_POST["fvalor-hora"];
    $faltaCobrar = $horas * $valorHora + $horasExtras * 1.5 * $valorHora;

    echo $nombre, " ", $apellido, " le corresponde cobrar por sus horas trabajadas ", $faltaCobrar, " pesos.";
?>