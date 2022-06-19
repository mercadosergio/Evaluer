<?php
include("../model/conexion.php");
session_start();
error_reporting(0);

$fecha = $_POST['fecha'];
$comentario = $_POST['coment'];
$nombre = $_FILES['archivo']['name'];
$guardado = $_FILES['archivo']['tmp_name'];

$nombre_final =  date("d-m-y") . "-" . date("H-m-s") . "-" . $nombre;
$ruta = "../files/photos/" . $nombre_final;


if (!file_exists('../files/photos')) {
    mkdir('../files/photos', 0777, true);
    if (file_exists('../files/photos')) {
        if (move_uploaded_file($guardado, '../files/photos/' . $nombre_final)) {
            include_once("../pages/estudiante/index.php");
        } else {
            echo "Archivo no se pudo guardar";
        }
    }
} else {


    if (move_uploaded_file($guardado, '../files/photos/' . $nombre_final)) {
        // Se inserta la dirección y detalles del archivo enviado
        $conexion->query("UPDATE usuarios SET foto = '$nombre_final' WHERE usuario =" . $_SESSION['usuario']);

?>
        <div id="success" class="alert alert-success" role="alert" style="z-index: 9999999999999999; position:absolute; top:2%;
  				left: 50%;
  				transform: translate(-50%, 0%);">
            Cambios guardados con éxito
        </div>

        <script>
            setTimeout(function() {
                $('#success').fadeOut('fast');
            }, 2000); // <-- time in milliseconds
        </script>
    <?php
        // include_once("../pages/estudiante/index.php");
        header("Location: ../support/account.php");
    } else {
    ?>
        <div id="fail" class="alert alert-danger" role="alert" style="z-index: 9999999999999999; position:absolute; top:2%;
  				left: 50%;
  				transform: translate(-50%, 0%);">
            No se cambió la foto de perfil
        </div>
        <script>
            setTimeout(function() {
                $('#fail').fadeOut('fast');
            }, 2000); // <-- time in milliseconds
        </script>
<?php
    }
}
