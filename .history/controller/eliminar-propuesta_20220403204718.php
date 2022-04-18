<?php

$remitente = $_GET['remitente'];

$conexion->query("DELETE FROM propuesta SET time_propuesta = '$time_propuesta' WHERE usuario =" . $_SESSION['usuario']);

?>