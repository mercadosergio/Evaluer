<?php

include("../model/conexion.php");

if (isset($_POST['eliminar'])) {

    $id_estudiante = $_POST['getIdEstudiante'];
    mysqli_query($conexion, "DELETE FROM estudiante WHERE id = '$id_estudiante'") or die("Error al eliminar usuario");
    header("location: ../admin/index.php");
    mysqli_close($conexion);
}
