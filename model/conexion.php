<?php
$servidor = "localhost";
$user = "root";
$BD = "evaluer";

$conexion = mysqli_connect($servidor, $user, "", $BD);

if (mysqli_connect_errno()) {
	print("error de conexion" . mysqli_connect_error());
	exit();
}
