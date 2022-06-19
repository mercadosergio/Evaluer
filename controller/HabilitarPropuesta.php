<?php
// include '../model/db.php';
include '../model/conexion.php';
// include_once '../model/UserModel.php';
if (isset($_POST['begin'])) {
    session_start();
    error_reporting(0);

    $uses = $_POST['userr'];

    $ver = $conexion->query("SELECT * FROM docente WHERE usuario = '$uses'");
    $array = mysqli_fetch_array($ver);

    $conexion->query("UPDATE estudiante SET time_propuesta = 0 WHERE programa_id =" . $array['programa_id']);

    include "../pages/docente/modulos/revision-propuesta.php";

    // header("Location: ../pages/docente/modulos/revision-propuesta.php");
}
?>
<div id="success" class="alert alert-success" role="alert" style="z-index: 9999999999999999; position:absolute; top:2%; left: 50%; transform: translate(-50%, 0%);">
    Usted habilitó el envío de propuestas de grado
</div>
<script>
    setTimeout(function() {
        $('#success').fadeOut('fast');
    }, 2000); // <-- time in milliseconds
</script>