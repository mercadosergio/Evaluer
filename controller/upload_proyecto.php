<?php

include("../model/conexion.php");

if (isset($_POST['enviar'])) {
    $fecha = $_POST['fecha'];
    $nombre = $_FILES['archivo']['name'];
    $guardado = $_FILES['archivo']['tmp_name'];

    $nombre_final =  date("d-m-y") . "-" . date("H-m-s") . "-" . $nombre;
    $ruta = "../files/proyectos_de_grado/" . $nombre_final;

    $time_proyecto = $conexion->query("SELECT time_proyecto FROM estudiante WHERE usuario=" . $_SESSION['usuario']);
    $tiempo = mysqli_fetch_array($time_proyecto);

    if (!file_exists('../files/proyectos_de_grado')) {
        mkdir('../files/proyectos_de_grado', 0777, true);
        if (file_exists('../files/proyectos_de_grado')) {
            if (move_uploaded_file($guardado, '../files/proyectos_de_grado/' . $nombre_final)) {

                include_once("../pages/estudiante/proyecto-final-estudiante.php");
            } else {
                echo "Archivo no se pudo guardar";
            }
        }
    } else {
        if (time() > $tiempo['0']) {
            $time_proyecto = strtotime("+15 days, 12:00am", time());
            if (move_uploaded_file($guardado, '../files/proyectos_de_grado/' . $nombre_final)) {
                // Se inserta la dirección y detalles del archivo enviado
                $conexion->query("INSERT INTO proyecto_grado(nombre,documento,remitente,fecha) VALUES('$nombre','$ruta','" . $_SESSION['usuario'] . "','$fecha')");

                $conexion->query("UPDATE proyecto_grado p
            JOIN estudiante es ON p.remitente = es.usuario 
            SET p.programa_id = es.programa_id");

                $conexion->query("UPDATE proyecto_grado p
            JOIN estudiante es ON p.programa_id = es.programa_id 
            SET p.programa = es.programa");

                $conexion->query("UPDATE proyecto_grado p
            JOIN propuesta es ON p.remitente = es.remitente 
            SET p.titulo = es.titulo");

                $conexion->query("UPDATE estudiante SET time_proyecto = '$time_proyecto' WHERE usuario =" . $_SESSION['usuario']);

                include("../pages/main-estudiante.php");
?>
                <div id="success" class="alert alert-success" role="alert" style="z-index: 9999999999999999; position:absolute; top:2%;
  				left: 50%;
  				transform: translate(-50%, 0%);">
                    Documento enviado con éxito
                </div>

                <script>
                    setTimeout(function() {
                        $('#success').fadeOut('fast');
                    }, 2000); // <-- time in milliseconds
                </script>
            <?php
            } else {
            ?>
                <div id="fail" class="alert alert-danger" role="alert" style="z-index: 9999999999999999; position:absolute; top:2%;
  				left: 50%;
  				transform: translate(-50%, 0%);">
                    No se envió la entrega del documento
                </div>
                <script>
                    setTimeout(function() {
                        $('#fail').fadeOut('fast');
                    }, 2000); // <-- time in milliseconds
                </script>
<?php
            }
        }
    }
}
