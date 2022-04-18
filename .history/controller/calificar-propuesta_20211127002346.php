<?php

include("../model/conexion.php");

if (isset($_POST['calificar'])) {
    $nota = $_POST['estado'];
    $id_p = $_POST['getIdPropuesta'];
    $update_e = $conexion->query("UPDATE propuesta SET estado = '$nota' WHERE id = '$id_p'");
    mysqli_close($conexion);
?>
    <p style="position: absolute; padding: 10px;border-radius: 10px; top: 20%; left: 650px;opacity: 1;
		text-align: center; width: 20%; background: #abff96; color: #1e9700; border: 1px #1e9700 solid;" id="success">Calificación exitosa</p>
    <script>
        setTimeout(function() {
            $('#success').fadeOut('fast');
        }, 2000); // <-- time in milliseconds
    </script>

<?php
    header("location: ../pages/docente/revision-propuesta.php");
}
