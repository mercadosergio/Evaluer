<?php


include_once '../../model/Metodos.php';
// $us = Metodos::all();

// var_dump($us);


$obj = new Metodos();
$sql = "SELECT * FROM estudiante";
$datos = $obj->listar($sql);


foreach($datos as $key){
echo $key['id'];
echo $key['nombre'];
echo $key['p_apellido'];
echo $key['s_apellido'];
}

?>