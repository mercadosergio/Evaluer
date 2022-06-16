<?php

if (isset($_POST['agregar'])) {

    $id_rol = $_POST['role'];
    $nombre = $_POST['nombre'];
    $p_apellido = $_POST['p_apellido'];
    $s_apellido = $_POST['s_apellido'];
    $cedula = $_POST['cedula'];
    $programa_id = $_POST['programa_id'];
    $semestre = $_POST['semestre'];
    $email = $_POST['email'];


    if ($programa_id == '1') {
?>
        <div id="fail" class="alert alert-danger" role="alert" style="z-index: 9999999999999999; position:absolute; top:2%;
  left: 50%;
  transform: translate(-50%, 0%);">
            Seleccione un programa académico
        </div>
        <script>
            setTimeout(function() {
                $('#fail').fadeOut('fast');
            }, 2000); // <-- time in milliseconds
        </script>
    <?php
    } else {
        $user = new User;
        for ($i = 0; $i < count($id_rol); $i++) {
            $user->createUser($nombre, $email, $cedula, $cedula, $id_rol[$i]);

            for ($j = 0; $j < count($programa_id); $j++) {
                if ($id_rol[$i] == '2') {
                    $user->createCoordinador($nombre, $p_apellido, $s_apellido, $cedula, $programa_id[$j], $cedula);
                } else if ($id_rol[$i] == '3') {
                    $user->createEstudiante($nombre, $p_apellido, $s_apellido, $cedula, $programa_id[$j], $semestre, $cedula);
                } else if ($id_rol[$i] == '4') {
                    $user->createAsesor($nombre, $p_apellido, $s_apellido, $cedula, $programa_id[$j], $cedula);
                }
            }
        }
    ?>
        <div id="success" class="alert alert-success" role="alert" style="z-index: 9999999999999999; position:absolute; top:2%; left: 50%; transform: translate(-50%, 0%);">
            Usuario registrado con éxito
        </div>
        <script>
            setTimeout(function() {
                $('#success').fadeOut('fast');
            }, 2000); // <-- time in milliseconds
        </script>
<?php
    }
}
?>