<?php

include("../model/conexion.php");

$remitente = $_SESSION['usuario'];

$conexion->query("DELETE FROM propuesta WHERE remitente = '$remitente'");
$conexion->query("UPDATE estudiante SET time_propuesta = '0' WHERE usuario = '$remitente'");
