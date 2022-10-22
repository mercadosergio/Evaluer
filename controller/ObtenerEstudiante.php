<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dni1 = htmlspecialchars(trim($_POST["di_int1"]));

    // Codigo para buscar en tu base de datos acá


    require '../model/Estudiante.php';
    $estudiante = new Student();
    $res = $estudiante->getByDi($dni1);
    $dato = $resultado->fetch_assoc();

    $nombre = $dato['n_est'];
    $dir = $dato['d_est'];

    echo json_encode([
        'nombre' => $nombre,
        'dir'    => $dir
    ]);
} else {
    echo "<p>No se encontro el nombre en el sistema</p>";
}
