<?php

include("../model/conexion.php");

$remitente = $_GET['remitente'];

$conexion->query("DELETE FROM propuesta WHERE remitente = '$remitente' WHERE usuario =" . $_SESSION['usuario']);

?>