<?php

session_start();
include_once("../model/Metodos.php");
include("../model/UserModel.php");
$usuario = new User();
$getMyRole = $usuario->getStudentProfile();
$userE = mysqli_fetch_array($getMyRole);


$res = new Metodos();
$fecha = date("Y-m-d H:i:s");
$getTime = $res->restrictPropuesta();

$num_integrantes = $_POST['numero'];
$programa = $userE['programa'];
$semestre = $userE['semestre'];

$begin_num = $num_integrantes + 1; // El array que arroja el select empieza por 0, esto hace que incremente a 1 y empiece por este

$array = array();
$result = $res->listar("SELECT * FROM estudiante WHERE programa = '$programa' AND semestre = $semestre");

if ($result) {
    foreach ($result as $val) {
        array_push($array, $val['cedula']);
    }
}

for ($i = 1; $i < $begin_num; $i++) {
?>
    <div class="contenedor-estudiante">
        <label>Integrante #<?php echo $i ?>:</label>
        <div class="datos">
            <div>
                <label>Documento de identidad:</label>
                <div id="contenedorInput" class="campos">
                    <input class="" type="text" class="campotexto" id="dni_estudiante<?php echo  $i ?>" name="dni_int<?php echo  $i ?>">
                    <i class="fa-solid fa-user-pen"></i>
                </div>
            </div>
            <div>
                <label>Nombre:</label>
                <div id="contenedorInput" class="campos">
                    <input class="" type="text" class="campotexto" readonly id="nombres_estudiante<?php echo  $i ?>" name="nombres_miembro<?php echo  $i ?>">
                    <i class="fa-solid fa-user-pen"></i>
                </div>
            </div>
            <div>
                <label>Apellidos:</label>
                <div id="contenedorInput" class="campos">
                    <input class="" type="text" class="campotexto" readonly id="apellidos_estudiante<?php echo  $i ?>" name="apellidos_miembro<?php echo  $i ?>">
                    <i class="fa-solid fa-user-pen"></i>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var items = <?= json_encode($array) ?>

            $("#dni_estudiante<?= $i ?>").autocomplete({
                source: items,
                select: function(event, item) {
                    console.log(item);
                    var params = {
                        estudiante: item.item.value
                    };
                    $.get("getNombre.php", params, function(response) {
                        var json = JSON.parse(response);
                        if (json.status == 200) {
                            $("#nombres_estudiante<?= $i ?>").val(json.nombre);
                            $("#apellidos_estudiante<?= $i ?>").val(json.p_apellido);
                        } else {

                        }
                    }); // ajax
                }
            });

        });
    </script>
<?php
}
?>