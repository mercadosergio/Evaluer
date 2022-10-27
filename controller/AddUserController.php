<?php

if (isset($_POST['agregar'])) {
    $id_rol = $_POST['role'];
    $nombre = $_POST['nombre'];
    $p_apellido = $_POST['p_apellido'];
    $s_apellido = $_POST['s_apellido'];
    $cedula = $_POST['cedula'];
    $programa = $_POST['programa'];
    $semestre = $_POST['semestre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];

    $contraseña = $_POST['cedula'];
    $pass_cifrado = password_hash($contraseña, PASSWORD_DEFAULT);

    for ($j = 0; $j < count($programa); $j++) {
        if ($programa[$j] == 1) {
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
            // $user = new User();
            for ($i = 0; $i < count($id_rol); $i++) {

                $usuario->createUser($nombre, $cedula, $pass_cifrado, $id_rol[$i]);
                if ($id_rol[$i] == 2) {
                    $usuario->createCoordinador($nombre, $p_apellido, $s_apellido, $cedula, $programa[$j], $cedula, $email, $telefono);
                } else if ($id_rol[$i] == 3) {
                    $usuario->createEstudiante($nombre, $p_apellido, $s_apellido, $cedula, $programa[$j], $semestre, $cedula, $email, $telefono);
                } else if ($id_rol[$i] == 4) {
                    $usuario->createAsesor($nombre, $p_apellido, $s_apellido, $cedula, $programa[$j], $cedula, $email, $telefono);
                }
            }

            // include("control-usuarios.php");
            header("location: control-usuarios.php")
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
}
?>