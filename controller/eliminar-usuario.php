<?php

include("../model/conexion.php");

if (isset($_POST['eliminar'])) {

    $id_usuario = $_POST['getIdU'];
    $usuario = $_POST['user'];

    mysqli_query($conexion, "DELETE FROM estudiante WHERE usuario = '$usuario'") or die("Error al eliminar usuario");
    mysqli_query($conexion, "DELETE FROM docente WHERE usuario = '$usuario'") or die("Error al eliminar usuario");
    mysqli_query($conexion, "DELETE FROM coordinador WHERE usuario = '$usuario'") or die("Error al eliminar usuario");

    mysqli_query($conexion, "DELETE FROM usuarios WHERE usuario = '$usuario'") or die("Error al eliminar usuario");

    header("location: ../admin/index.php");
    mysqli_close($conexion);
}
