<?php

$id = $_POST['id'];
$id_asesor = $_POST['id_asesor'];

include("../model/Coordinador.php");
for ($i = 0; $i < count($id_asesor); $i++) {
    $obj = new Coordinator();
    $obj->AssignCoach($id_asesor[$i], $id);
}
?>
<script>
    window.location = "../pages/coordinador/modulos/asignar-asesor.php";
</script>