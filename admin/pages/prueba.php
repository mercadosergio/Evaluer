<?php


include_once '../../model/Metodos.php';
// $us = Metodos::all();

// var_dump($us);
session_start();

$obj = new Metodos();
$sql = "SELECT * FROM estudiante";
$datos = $obj->listar($sql);
$getProfile = $obj->getProfileUser();
$userP = mysqli_fetch_array($getProfile);
echo $userP['nombre'];

foreach ($datos as $key) {
    echo $key['id'];
    echo $key['nombre'];
    echo $key['p_apellido'];
    echo $key['s_apellido'];
}

$rep = $obj->viewAnuncio();

while ($actual = mysqli_fetch_array($rep)) {
    $mostrar = '<p>';
}

$getA = $obj->viewAnuncioSender();

foreach ($getA as $key) {
    echo $key['id'];
    echo $key['user_name'];
    echo $key['fecha'];
    echo $key['contenido'];
}

?>
<select name="" id="">
    <?php
    $selected = "SELECT * FROM estudiante WHERE usuario = " . $_SESSION['usuario'];
    $programa_sel = $obj->listar($selected);

    foreach ($programa_sel as $ref_p) {
    ?>
        <option value="<?php echo $ref_p['programa_id']; ?>"><?php echo $ref_p['programa']; ?></option>
    <?php
    }
    ?>
</select>