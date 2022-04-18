<?php

include("../model/conexion.php");

if(isset($_POST['cambiar'])){

$usuario = $_POST['user'];
$clave_actual = $_POST['c_actual'];
$nueva = $_POST['clave'];
$repetir_nueva = $_POST['clave2'];

if($nueva == $repetir_nueva){
    $conexion->query("UPDATE usuarios SET contraseña ='$nueva' WHERE usuario = '$usuario'");
}


}

?>