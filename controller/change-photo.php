<?php
include("../model/conexion.php");

session_start();
error_reporting(0);

$user = $_POST['ug'];
$nombre = $_FILES['archivo']['name'];
$guardado = $_FILES['archivo']['tmp_name'];

$nombre_final = $nombre . "_" . $user;

echo '<h1 style="font-size: 500px;">'.$nombre.$guardado.'</h1>';


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
        $conexion->query("UPDATE usuarios SET foto = '$nombre_final' WHERE usuario = '$user'");

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
        include_once("../pages/estudiante/index.php");
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

?>