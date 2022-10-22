<?php
include_once("../model/Metodos.php");

session_start();
error_reporting(0);

$res = new Metodos();
$fecha = date("Y-m-d H:i:s");
$getTime = $res->restrictPropuesta();
$num_integrantes = $_POST['numero'];

$agregar = $num_integrantes - 1;

for ($i = 0; $i < $agregar; $i++) {
?>
    <label>Integrante #<?php echo $i + 2 ?>:</label>
    <div class="component-miembro">
        <label class="sub">Nombres:</label>
        <div id="contenedorInput">
            <input class="" <?php echo (time() < $getTime) ? "disabled" : ''; ?> type="text" class="campotexto" name="nombres_miembro<?php echo  $i + 2 ?>">
            <i class="fa-solid fa-user-pen"></i>
        </div>
        <label class="sub">Apellidos:</label>
        <div id="contenedorInput">
            <input class="" <?php echo (time() < $getTime) ? "disabled" : ''; ?> type="text" class="campotexto" name="apellidos_miembro<?php echo  $i + 2 ?>">
            <i class="fa-solid fa-user-pen"></i>
        </div>
    </div>
<?php
}
