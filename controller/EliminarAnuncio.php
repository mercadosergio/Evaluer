<?php
include '../model/Entidad.php';

session_start();
error_reporting(0);


$card = new Entidad;
$card->deleteAnuncio();

header("Location: ../pages/docente/index.php");
