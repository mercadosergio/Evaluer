<?php

if (isset($_POST['editar'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $p_apellido = $_POST['p_apellido'];
    $s_apellido = $_POST['s_apellido'];
    $cedula = $_POST['cedula'];
    $programa_id = $_POST['programa_id'];
    $semestre = $_POST['semestre'];


    $user = new User();

    for ($i = 0; $i < count($programa_id); $i++) {

        $user->editEstudiante($id, $nombre, $p_apellido, $s_apellido, $cedula, $programa_id[$i], $semestre);

        // $user->editAsesor($id, $nombre, $p_apellido, $s_apellido, $cedula, $programa_id[$i]);

        // $user->editCoordinador($id, $nombre, $p_apellido, $s_apellido, $cedula, $programa_id[$i]);
        // header("Location: ../index.php");
        // include("control-usuarios.php");
    }
}
