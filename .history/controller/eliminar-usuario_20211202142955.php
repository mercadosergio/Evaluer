<?php

include("../model/conexion.php");

if (isset($_POST['eliminar'])) {

    $id_usuario = $_POST['getIdU'];
    mysqli_query($conexion, "DELETE FROM estudiante WHERE id = '$id_usuario'") or die("Error al eliminar usuario");
    mysqli_query($conexion, "DELETE FROM docente WHERE id = '$id_usuario'") or die("Error al eliminar usuario");
    mysqli_query($conexion, "DELETE FROM docente WHERE id = '$id_usuario'") or die("Error al eliminar usuario");
    header("location: ../admin/index.php");
    mysqli_close($conexion);
}
