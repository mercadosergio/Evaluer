<?php

include("../model/conexion.php");

$remitente = $_GET['remitente'];

$conexion->query("DELETE FROM propuesta WHERE remitente = '$time_propuesta' WHERE usuario =" . $_SESSION['usuario']);

?>