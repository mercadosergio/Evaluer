<?php 

include("../model/conexion.php");

if(isset($_POST['asignar_d'])){
    $id_p = $_POST['id_propuesta'];
    $asesor = $_POST['asesor'];

    $json = json_encode($asesor, true);

}
?>