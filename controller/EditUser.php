<?php

if (isset($_POST['modificar'])) {

    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $p_apellido = $_POST['p_apellido'];
    $s_apellido = $_POST['s_apellido'];
    $cedula = $_POST['cedula'];
    $programa = $_POST['programa'];
    $semestre = $_POST['semestre'];
    $usuario = $_POST['cedula'];
    $idUser = $_POST['usuario_id'];

    $rol = $_POST['rol'];

    $user = new User();

    $user->editUser($nombre, $usuario, $cedula);

    for ($i = 0; $i < count($programa); $i++) {
        if ($rol == 3) {
            $user->editEstudiante($id, $nombre, $p_apellido, $s_apellido, $cedula, $programa[$i], $semestre);
        } else if ($rol == 2) {
            $user->editCoordinador($id, $nombre, $p_apellido, $s_apellido, $cedula, $programa[$i]);
        } else {
            $user->editAsesor($id, $nombre, $p_apellido, $s_apellido, $cedula, $programa[$i]);
        }
    }
}
