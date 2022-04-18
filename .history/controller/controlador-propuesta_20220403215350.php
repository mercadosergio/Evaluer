<?php
include("../model/conexion.php");


if (isset($_POST['send'])) {
    $titulo = $_POST['titulo'];
    $linea = $_POST['linea'];
    $integrantes = $_POST['integrantes'];
    $tutor = $_POST['tutor'];
    $lider = $_POST['lider'];
    // $programa_id = $_POST['programa_id'];
    $semestre = $_POST['semestre'];
    // TEXTAREA
    $descripcion = $_POST['description'];
    $grupo = $_POST['grupo'];
    $fecha = $_POST['fecha'];

    $programa_id = $_POST['id_programa'];

    $time_propuesta = $conexion->query("SELECT time_propuesta FROM estudiante WHERE usuario=" . $_SESSION['usuario']);
    $tiempo = mysqli_fetch_array($time_propuesta);

    if ($descripcion == null || $descripcion == '') {
?>
        <p style="position: absolute; padding: 10px;border-radius: 10px; top: 20%; left: 650px;opacity: 1;
        text-align: center; width: 14%; background: rgb(255, 133, 133); color: rgb(184, 0, 0); border: 1px #1e9700 solid;" id="fail">Falta un campo por llenar</p>
        <script>
            setTimeout(function() {
                $('#fail').fadeOut('fast');
            }, 2000); // <-- time in milliseconds
        </script>
        <?php
    } else {
        if (time() > $tiempo['0']) {
            $time_propuesta = strtotime("+365 days, 12:00am", time());
            $json = json_encode($programa_id, true);
            for ($i = 0; $i < count($programa_id); $i++) {
                $conexion->query("INSERT INTO propuesta(titulo,linea,integrantes,tutor,lider,semestre,descripcion,grupo,fecha,remitente)
        VALUES ('$titulo','$linea','$integrantes','$tutor','$lider','$semestre','$descripcion','$grupo','$fecha'," . $_SESSION['usuario'] . ")");

                $conexion->query("UPDATE propuesta a
                JOIN estudiante es ON a.remitente = es.usuario 
                SET a.programa_id = es.programa_id");

                $conexion->query("UPDATE propuesta i
                JOIN programas p ON i.programa_id = p.identificador
                SET i.programa = p.nombre");

                $conexion->query("UPDATE propuesta i
                JOIN estudiante es ON i.remitente = es.usuario
                SET i.id_estudiante = es.id");

                $conexion->query("UPDATE estudiante SET time_propuesta = '$time_propuesta' WHERE usuario =" . $_SESSION['usuario']);
            }
            include("../pages/main-estudiante.php");
        ?>
            <p style="position: absolute; padding: 10px;border-radius: 10px; top: 20%; left: 650px;opacity: 1;
		text-align: center; width: 20%; background: #abff96; color: #1e9700; border: 1px #1e9700 solid;" id="success">Propuesta enviada con éxito</p>
            <script>
                setTimeout(function() {
                    $('#success').fadeOut('fast');
                }, 2000); // <-- time in milliseconds
            </script>
<?php

            mysqli_close($conexion);
        }
    }
}
