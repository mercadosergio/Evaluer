<?php

include("../model/conexion.php");

$remitente = $_GET['remitente'];

$conexion->query("DELETE FROM propuesta WHERE remitente = '$remitente'");
$conexion->query("UPDATE estudiante DROP time_propuesta WHERE usuario = '$remitente'");

