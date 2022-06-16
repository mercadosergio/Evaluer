<?php

include("../model/conexion.php");



$id_p = $_POST['id_proyecto'];
$asesor = $_POST['asesor'];

$json = json_encode($asesor, true);

for ($i = 0; $i < count($asesor); $i++) {

    $var_asesor = $asesor[$i];
    $conexion->query("UPDATE proyecto_grado SET asesor_user = '$var_asesor' WHERE id = '$id_p'");
    $conexion->query("UPDATE proyecto_grado p JOIN DOCENTE d
        ON p.asesor_user = d.usuario
        SET p.nombre_asesor = concat(d.nombres,d.p_apellido)");
}
?>
<p style="position: absolute; padding: 10px;border-radius: 10px; top: 20%; left: 650px;opacity: 1;
    text-align: center; width: 20%; background: #abff96; color: #1e9700; border: 1px #1e9700 solid;" id="success">
    Asesor asignado</p>
<script>
setTimeout(function() {
    $('#success').fadeOut('fast');
}, 2000); // <-- time in milliseconds
</script>
<script>
window.location = "../pages/coordinador/modulos/asignar-asesor.php";
</script>
<?php

mysqli_close($conexion);
?>