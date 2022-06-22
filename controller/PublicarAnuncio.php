<?php
// include '../model/db.php';
include '../model/Entidad.php';
session_start();
error_reporting(0);

$contenido = $_POST['txt-content'];
$fecha = $_POST['datetime'];
$programa = $_POST['programa_id'];
$nombre = $_POST['nombre'];
if (empty($contenido)) {
    echo 'ERROR';
} else {
    $card = new Entidad;
    $card->publicarAnuncio($contenido, $fecha, $programa, $nombre, $_SESSION['usuario']);

    // include '../pages/docente/index.php';
    header("Location: ../pages/docente/index.php");
}
