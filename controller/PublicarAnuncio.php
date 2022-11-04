<?php

if (isset($_POST['submit'])) {
    $contenido = $_POST['txt-content'];
    $fecha = $_POST['datetime'];
    $programa = $_POST['programa'];
    $nombre = $_POST['nombre'];
    $id_docente = $_POST['docente_id'];

    if (empty($contenido)) {
        echo 'ERROR';
    } else {
        $asesor = new Asesor();
        $asesor->publicarAnuncio($contenido, $fecha, $programa, $nombre, $_SESSION['usuario'], $id_docente);
    }
}
