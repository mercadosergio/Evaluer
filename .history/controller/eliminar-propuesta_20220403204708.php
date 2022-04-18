<?php

$remitente = $_GET['remitente'];

$conexion->query("DELETE FROM estudiante SET time_propuesta = '$time_propuesta' WHERE usuario =" . $_SESSION['usuario']);

?>