<?php
include("../model/conexion.php");

if (isset($_POST['modificar-estudiante'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $p_apellido = $_POST['p_apellido'];
    $s_apellido = $_POST['s_apellido'];
    $id_n = $_POST['cedula'];
    $programa_id = $_POST['programa_id'];
    $semestre = $_POST['semestre'];

    $json = json_encode($programa_id, true);

    for ($i = 0; $i < count($programa_id); $i++) {
        $update_e = $conexion->query("UPDATE estudiante SET nombre='$nombre', p_apellido='$p_apellido', s_apellido='$s_apellido', cedula='$id_n',
        programa_id='$programa_id[$i]',semestre='$semestre',usuario='$id_n' WHERE id = '$id'");

        $conexion->query("UPDATE estudiante e
        JOIN programas p ON e.programa_id = p.identificador
        SET e.programa = p.nombre");

        $conexion->query("UPDATE usuarios u JOIN estudiante e
        ON u.id = e.id_usuario
        SET u.usuario = e.cedula");
    }
    if (!$update_e) {
?>
        <p style="position: absolute; padding: 10px;border-radius: 10px; top: 20%; left: 650px;opacity: 1;
    text-align: center; width: 14%; background: rgb(255, 133, 133); color: rgb(184, 0, 0); border: 1px #1e9700 solid;" id="fail">No se guardaron los cambios</p>
        <script>
            setTimeout(function() {
                $('#fail').fadeOut('fast');
            }, 2000); // <-- time in milliseconds
        </script>
    <?php
    } else {
    ?>
        <p style="position: absolute; padding: 10px;border-radius: 10px; top: 20%; left: 650px;opacity: 1;
    text-align: center; width: 20%; background: #abff96; color: #1e9700; border: 1px #1e9700 solid;" id="success">Cambios guardados con éxito</p>
        <script>
            setTimeout(function() {
                $('#success').fadeOut('fast');
            }, 2000); // <-- time in milliseconds
        </script>
    <?php
        header("location: ../index.php");
    }
    mysqli_close($conexion);
}

if (isset($_POST['modificar-docente'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $p_apellido = $_POST['p_apellido'];
    $s_apellido = $_POST['s_apellido'];
    $id_n = $_POST['cedula'];
    $programa_id = $_POST['programa_id'];

    $json = json_encode($programa_id, true);

    for ($i = 0; $i < count($programa_id); $i++) {
        $update_d = $conexion->query("UPDATE docente SET nombres='$nombre', p_apellido='$p_apellido', s_apellido='$s_apellido', cedula='$id_n',
        programa_id='$programa_id[$i]',usuario='$id_n' WHERE id = '$id'");

        $conexion->query("UPDATE docente e
        JOIN programas p ON e.programa_id = p.identificador
        SET e.programa = p.nombre");

        $conexion->query("UPDATE usuarios u JOIN docente e
        ON u.id = e.id_usuario
        SET u.usuario = e.cedula");
    }
    if (!$update_d) {
    ?>
        <p style="position: absolute; padding: 10px;border-radius: 10px; top: 20%; left: 650px;opacity: 1;
    text-align: center; width: 14%; background: rgb(255, 133, 133); color: rgb(184, 0, 0); border: 1px #1e9700 solid;" id="fail">No se guardaron los cambios</p>
        <script>
            setTimeout(function() {
                $('#fail').fadeOut('fast');
            }, 2000); // <-- time in milliseconds
        </script>
    <?php
        include_once 'modificar-docente.php';
    } else {
    ?>
        <p style="position: absolute; padding: 10px;border-radius: 10px; top: 20%; left: 650px;opacity: 1;
    text-align: center; width: 20%; background: #abff96; color: #1e9700; border: 1px #1e9700 solid;" id="success">Cambios guardados con éxito</p>
        <script>
            setTimeout(function() {
                $('#success').fadeOut('fast');
            }, 2000); // <-- time in milliseconds
        </script>
    <?php
        header("location: ../index.php");
    }
    mysqli_close($conexion);
}


if (isset($_POST['modificar-coordinador'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $p_apellido = $_POST['p_apellido'];
    $s_apellido = $_POST['s_apellido'];
    $id_n = $_POST['cedula'];

    $update_c = $conexion->query("UPDATE coordinador SET nombres='$nombre', p_apellido='$p_apellido', s_apellido='$s_apellido', cedula='$id_n',
        usuario='$id_n' WHERE id = '$id'");

    $conexion->query("UPDATE coordinador e
        JOIN programas p ON e.programa_id = p.identificador
        SET e.programa = p.nombre");

    $conexion->query("UPDATE usuarios u JOIN coordinador e
        ON u.id = e.id_usuario
        SET u.usuario = e.cedula");

    if (!$update_c) {
    ?>
    
        <p style="position: absolute; padding: 10px;border-radius: 10px; top: 20%; left: 650px;opacity: 1;
    text-align: center; width: 14%; background: rgb(255, 133, 133); color: rgb(184, 0, 0); border: 1px #1e9700 solid;" id="fail">No se guardaron los cambios</p>
        <script>
            setTimeout(function() {
                $('#fail').fadeOut('fast');
            }, 2000); // <-- time in milliseconds
        </script>
    <?php
    } else {
    ?>
        <p style="position: absolute; padding: 10px;border-radius: 10px; top: 20%; left: 650px;opacity: 1;
    text-align: center; width: 20%; background: #abff96; color: #1e9700; border: 1px #1e9700 solid;" id="success">Cambios guardados con éxito</p>
        <script>
            setTimeout(function() {
                $('#success').fadeOut('fast');
            }, 2000); // <-- time in milliseconds
        </script>
<?php
        header("location: ../index.php");
    }
    mysqli_close($conexion);
}