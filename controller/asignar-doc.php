<?php

include("../model/conexion.php");

if (isset($_POST['asignar_d'])) {
    $id_p = $_POST['id_propuesta'];
    $asesor = $_POST['asesor'];

    $json = json_encode($asesor, true);

    for ($i = 0; $i < count($asesor); $i++) {
        $conexion->query("UPDATE propuesta SET tutor ='$asesor[$i]' WHERE id= '$id_p'");
    }
?>
    <p style="position: absolute; padding: 10px;border-radius: 10px; top: 20%; left: 650px;opacity: 1;
    text-align: center; width: 20%; background: #abff96; color: #1e9700; border: 1px #1e9700 solid;" id="success">Asesor asignado</p>
    <script>
        setTimeout(function() {
            $('#success').fadeOut('fast');
        }, 2000); // <-- time in milliseconds
    </script>

<?php
    header("location: ../coordinador/asignar-asesor.php");
    mysqli_close($conexion);
}
