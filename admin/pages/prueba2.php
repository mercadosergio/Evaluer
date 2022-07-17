<?php
require_once("../../model/UserModel.php");
// include '../../model/UserModel.php';

// include '../../controller/PruebaController.php';
// $usuario = new User();
// $listado = $usuario->read()
$usuario = new User();
require_once("../../controller/PruebaController.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="../../evaluer.ico">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="POST">
        <div class="content shadow p-3 mb-5 bg-white rounded">
            <div class="roles">
                <h5>Seleccione el rol de usuario:</h5>
                <select name="role[]" id="role" class="role form-select" onchange="cambiarRol()">
                    <option class="coo" value="2">Coordinador</option>
                    <option class="other" value="3" selected>Estudiante</option>
                    <option class="other" value="4">Docente</option>
                </select>
            </div>

            <div class="form-add-user">
                <div class="cont-title">
                    <i class="fas fa-user"></i>
                    <h3 class="title" id="stitle">Información del usuario</h3>
                </div>

                <input type="text" name="nombre" class="campo-nombre form-control" placeholder="Nombres">
                <input type="text" name="p_apellido" class="campo-primer-apellido form-control" placeholder="Primer apellido">
                <input type="text" name="s_apellido" class="campo-segundo-apellido form-control" placeholder="Segundo apellido">
                <input type="text" name="cedula" class="campo-cedula form-control" placeholder="No. documento de identidad">

                <div class="programa">
                    <label>Programa:</label>
                    <select name="programa_id[]" class="programa-s form-select">
                        <option selected value="1">Seleccione...</option>
                    </select>
                </div>
                <input type="number" min="6" max="9" name="semestre" class="cammpo-semestre form-control" placeholder="Semestre" id="semestre">
                <input type="text" name="email" class="campo-email form-control" placeholder="Email">
                <input type="submit" name="agregar" class="btn-agregar form-control" value="Registrar">

            </div>
        </div>
    </form>
    <?php

    $lista = $usuario->getStudent();

    foreach ($lista as $key) {
    ?>
        <td><?php echo $key['id'] ?></td>
        <td><?php echo $key['nombre'] ?></td>
        <td><?php echo $key['p_apellido'] ?></td>
        <td><?php echo $key['s_apellido'] ?></td>
        <td><?php echo $key['cedula'] ?></td>
        <td><?php echo $key['programa'] ?></td>
    <?php } ?>
</body>

</html>