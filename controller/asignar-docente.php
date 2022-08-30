<?php

$id = $_POST['id_proyecto'];
$asesor = $_POST['asesor'];

for ($i = 0; $i < count($asesor); $i++) {

    include("../model/Coordinador.php");
    $obj = new Coordinator();
    $obj->AssignCoach($asesor[$i], $id);
}
?>
<script>
    window.location = "../pages/coordinador/modulos/asignar-asesor.php";
</script>