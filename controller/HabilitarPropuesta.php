<?php

if (isset($_POST['begin'])) {
    $user = $_POST['userr'];
    $fecha_string = $_POST['fecha'];
    $hora_string = $_POST['hora'];

    $datetime = $fecha_string . " " . $hora_string;

    $limite = strtotime("$datetime", time());

    $asesor = new Asesor();
    $asesor->fechaLimitePropuesta($limite);

    include "../pages/docente/modulos/revision-propuesta.php";
    // header("Location: ../pages/docente/modulos/revision-propuesta.php");
}
