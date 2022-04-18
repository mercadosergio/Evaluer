<?php

$remitente = $_GET['remitente'];

$conexion->query("DELETE estudiante SET time_propuesta = '$time_propuesta' WHERE usuario =" . $_SESSION['usuario']);

?>