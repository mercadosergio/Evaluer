<?php

include("../model/conexion.php");

if (isset($_POST['evaluar'])) {
    $estado = $_POST['estado'];
    $nota = $_POST['nota'];
    $id_a = $_POST['getIdAnteproyecto'];
    $update_e = $conexion->query("UPDATE anteproyecto SET estado = '$estado' WHERE id = '$id_a'");

    echo ;''
    mysqli_close($conexion);
?>
    <p style="position: absolute; padding: 10px;border-radius: 10px; top: 20%; left: 650px;opacity: 1;
		text-align: center; width: 20%; background: #abff96; color: #1e9700; border: 1px #1e9700 solid;" id="success">Evaluación exitosa</p>
    <script>
        setTimeout(function() {
            $('#success').fadeOut('fast');
        }, 2000); // <-- time in milliseconds
    </script>
<script>alert($id_a);</script>
<?php
    // header("location: ../pages/docente/revision-anteproyecto.php");

}
