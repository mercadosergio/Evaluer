<?php

include("../model/conexion.php");

$remitente = $_GET['remitente'];

$conexion->query("DELETE FROM propuesta WHERE remitente = '$remitente'");
$conexion->query("ALTER TABLE estudiante SET time_propuesta = '0' WHERE usuario = '$remitente'");

