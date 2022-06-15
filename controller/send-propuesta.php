<?php
include("../model/conexion.php");
session_start();
error_reporting(0);

$titulo = $_POST['titulo'];
$linea = $_POST['linea'];
$integrantes = $_POST['integrantes'];
$tutor = $_POST['tutor'];
$lider = $_POST['lider'];
$semestre = $_POST['semestre'];
$descripcion = $_POST['description']; // TEXTAREA
$grupo = $_POST['grupo'];
$fecha = $_POST['fecha'];

$programa_id = $_POST['id_programa'];

$time_propuesta = $conexion->query("SELECT time_propuesta FROM estudiante WHERE usuario=" . $_SESSION['usuario']);
$tiempo = mysqli_fetch_array($time_propuesta);

if ($descripcion == null || $descripcion == '') {
?>
    <div id="fail" class="alert alert-danger" role="alert" style="z-index: 9999999999999999; position:absolute; top:2%;
  left: 50%;
  transform: translate(-50%, 0%);">
        Falta un campo por llenar
    </div>
    <script>
        setTimeout(function() {
            $('#fail').fadeOut('fast');
        }, 2000); // <-- time in milliseconds
    </script>
    <?php
} else {
    // Aquí comienza el proceso de envio de información de propuesta de grado
    if (time() > $tiempo['0']) {
        $time_propuesta = strtotime("+365 days, 12:00am", time());
        $json = json_encode($programa_id, true);

        for ($i = 0; $i < count($programa_id); $i++) {
            $conexion->query("INSERT INTO propuesta(titulo,linea,integrantes,tutor,lider,programa_id,semestre,descripcion,grupo,fecha,remitente)
                VALUES ('$titulo','$linea','$integrantes','$tutor','$lider','$programa_id[$i]','$semestre','$descripcion','$grupo','$fecha'," . $_SESSION['usuario'] . ")");

            $conexion->query("UPDATE propuesta a
                JOIN estudiante es ON a.remitente = es.usuario
                                    SET a.programa_id = es.programa_id");


            $conexion->query("UPDATE propuesta a
            JOIN estudiante es ON a.remitente = es.usuario
            JOIN programas p ON a.programa_id = p.identificador
            SET a.programa = p.nombre, a.id_estudiante = es.id");

            $conexion->query("UPDATE estudiante SET time_propuesta = '$time_propuesta' WHERE usuario =" . $_SESSION['usuario']);
            echo $programa_id[$i];
        }
        include("../pages/estudiante/index.php");

    ?>
        <div id="success" class="alert alert-success" role="alert" style="z-index: 9999999999999999; position:absolute; top:2%;
  left: 50%;
  transform: translate(-50%, 0%);">
            Información enviada con éxito
        </div>
        <script>
            setTimeout(function() {
                $('#success').fadeOut('fast');
            }, 2000); // <-- time in milliseconds
        </script>
<?php

        mysqli_close($conexion);
    }
}
