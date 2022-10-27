<?php
session_start();
include_once("../model/Metodos.php");
include("../model/UserModel.php");
include("../model/Estudiante.php");
$usuario = new User();
$getMyRole = $usuario->getStudentProfile();
$userE = mysqli_fetch_array($getMyRole);


$res = new Metodos();
$estudiante = new Student();

$getMyRole = $usuario->getStudentProfile();
$userE = mysqli_fetch_array($getMyRole);

$fecha = date("Y-m-d H:i:s");
$getTime = $res->restrictPropuesta($userE['grupo_id']);
$num_integrantes = $_POST['numero'];
$programa = $userE['programa'];
$semestre = $userE['semestre'];

$agregar = $num_integrantes - 1;

$array = array();
$result = $res->listar("SELECT * FROM estudiante WHERE programa = '$programa' AND semestre = $semestre");
if ($result) {
    foreach ($result as $val) {
        array_push($array, $val['cedula']);
    }
}
for ($i = 0; $i < $agregar; $i++) {
?>
    <label>Integrante #<?php echo $i + 2 ?>:</label>
    <div class="component-miembro">
        <div>
            <label class="sub">Documento de identidad:</label>
            <div id="contenedorInput">
                <input class="" <?php echo (time() < $getTime) ? "disabled" : ''; ?> type="text" class="campotexto" id="dni_estudiante<?php echo  $i + 2 ?>" name="dni_int<?php echo  $i + 2 ?>" placeholder="">
                <i class="fa-solid fa-user-pen"></i>
            </div>
        </div>
        <div>
            <label class="sub">Nombre:</label>
            <div id="contenedorInput">
                <input class="" <?php echo (time() < $getTime) ? "disabled" : ''; ?> type="text" class="campotexto" readonly id="nombres_estudiante<?php echo  $i + 2 ?>" name="nombres_miembro<?php echo  $i + 2 ?>">
                <i class="fa-solid fa-user-pen"></i>
            </div>
        </div>
        <div>
            <label class="sub">Apellidos:</label>
            <div id="contenedorInput">
                <input class="" <?php echo (time() < $getTime) ? "disabled" : ''; ?> type="text" class="campotexto" readonly id="apellidos_estudiante<?php echo  $i + 2 ?>" name="apellidos_miembro<?php echo  $i + 2 ?>">
                <i class="fa-solid fa-user-pen"></i>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var items = <?= json_encode($array) ?>

            $("#dni_estudiante2").autocomplete({
                source: items,
                select: function(event, item) {
                    console.log(item);
                    var params = {
                        estudiante: item.item.value
                    };
                    $.get("getNombre.php", params, function(response) {
                        var json = JSON.parse(response);
                        if (json.status == 200) {
                            $("#nombres_estudiante2").val(json.nombre);
                            $("#apellidos_estudiante2").val(json.p_apellido);
                        } else {

                        }
                    }); // ajax
                }
            });
            $("#dni_estudiante3").autocomplete({
                source: items,
                select: function(event, item) {
                    console.log(item);
                    var params = {
                        estudiante: item.item.value
                    };
                    $.get("getNombre.php", params, function(response) {
                        var json = JSON.parse(response);
                        if (json.status == 200) {
                            $("#nombres_estudiante3").val(json.nombre);
                            $("#apellidos_estudiante3").val(json.p_apellido);
                        } else {

                        }
                    }); // ajax
                }
            });
        });
    </script>

<?php
}
