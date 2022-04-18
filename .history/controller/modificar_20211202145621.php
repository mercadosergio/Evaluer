<?php
include("../model/conexion.php");
session_start();

if (isset($_POST['modificar-estudiante'])) {
    $nombre = $_POST['nombre'];
    $p_apellido = $_POST['p_apellido'];
    $s_apellido = $_POST['s_apellido'];
    $id_n = $_POST['cedula'];
    $programa_id = $_POST['programa_id'];
    $semestre = $_POST['semestre'];

    $json = json_encode($programa_id, true);

    for ($i = 0; $i < count($programa_id); $i++) {
        $update_e = $conexion->query("UPDATE estudiante SET nombre='$nombre', p_apellido='$p_apellido', s_apellido='$s_apellido', cedula='$id_n',
        programa='$programa_id[$i]',semestre='$semestre' WHERE cedula = '$id_n'");

        $conexion->query("UPDATE estudiante e
        JOIN programas p ON e.programa_id = p.identificador
        SET e.programa = p.nombre");

        $conexion->query("UPDATE usuarios u
        JOIN estudiante p ON e.programa_id = p.identificador
        SET e.programa = p.nombre");
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
		text-align: center; width: 14%; background: rgb(255, 133, 133); color: rgb(184, 0, 0); border: 1px #1e9700 solid;" id="fail">No se envió el archivo</p>
        <script>
            setTimeout(function() {
                $('#fail').fadeOut('fast');
            }, 2000); // <-- time in milliseconds
        </script>
<?php
        header("location: ../admin/index.php");
    }
    mysqli_close($conexion);
}
