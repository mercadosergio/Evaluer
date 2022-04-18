<?php

$sql = "SELECT * FROM usuarios WHERE usuario = " . $_SESSION['usuario'];
$sesion = mysqli_query($conexion, $sql);
$array = mysqli_fetch_array($sesion);

$nombre_usuario = $array['nombre'];
