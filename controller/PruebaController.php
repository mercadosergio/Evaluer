<?php

// include("../model/UserModel.php");
if (isset($_POST['agregar'])) {
    $nombre = $_POST['nombre'];
    $p_apellido = $_POST['p_apellido'];
    $s_apellido = $_POST['s_apellido'];
    $cedula = $_POST['cedula'];
    $semestre = $_POST['semestre'];
    $user = $_POST['cedula'];

    $usuario = new User();

    $usuario->agregarEstudiante($nombre, $p_apellido, $s_apellido, $cedula, $semestre, $user);
}
