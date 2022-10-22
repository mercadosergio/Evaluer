<?php

require '../../../model/Estudiante.php';
$estudiante = new Student();

$campo = $_POST["nombres_miembro1"];

$result = $estudiante->getByDi($campo);

$sql = "SELECT cp, asentamiento FROM codigos_postales WHERE cp LIKE ? OR asentamiento LIKE ? ORDER BY cp ASC LIMIT 0, 10";

$html = "";

// while ($row = mysqli_fetch_array($res)) {
//     $html .= "<li onclick=\"mostrar('" . $row["nombre"] . "')\">" . $row["nombre"] . " " . $row["p_apellido"] . "</li>";
// }

// echo json_encode($html, JSON_UNESCAPED_UNICODE);

if ($result->num_rows > 0) {
    $student = $result->fetch_object();
    $student->status = 200;
    echo json_encode($student);
} else {
    $error = array('status' => 400);
    echo json_encode((object)$error);
}
