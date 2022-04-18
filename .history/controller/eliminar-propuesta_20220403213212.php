<?php

include("../model/conexion.php");

echo $_SESSION['usuario'];

$conexion->query("DELETE FROM propuesta WHERE remitente = '".$_SESSION['usuario']);
$conexion->query("UPDATE estudiante SET time_propuesta = '0' WHERE usuario = '".$_SESSION['usuario']);
