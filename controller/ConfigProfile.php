<?php

if (isset($_POST['cambiar'])) {
    $usuario = $_POST['user'];
    $clave_actual = $_POST['c_actual'];
    $nueva_contraseña = $_POST['clave'];
    $confirm_nueva = $_POST['clave2'];

    $pass_cifrado = password_hash($nueva_contraseña, PASSWORD_DEFAULT);

    if (password_verify($nueva_contraseña, $clave_actual)) {
?>
        <div id="fail" class="alert alert-danger" role="alert" style="z-index: 9999999999999999; position:absolute; top:2%;left: 50%;transform: translate(-50%, 0%);">
            Su nueva contraseña es igual a la anterior
        </div>
        <script>
            setTimeout(function() {
                $('#fail').fadeOut('fast');
            }, 2000); // <-- time in milliseconds
        </script>
        <?php
    } else {

        if ($nueva_contraseña == $confirm_nueva) {
            $user = new User();
            $user->ChangePassword($pass_cifrado, $usuario);
        ?>
            <div id="success" class="alert alert-success" role="alert" style="z-index: 9999999999999999; position:absolute; top:2%; left: 50%; transform: translate(-50%, 0%);">
                Cambios guardados con éxito
            </div>
            <script>
                setTimeout(function() {
                    $('#success').fadeOut('fast');
                }, 2000); // <-- time in milliseconds
            </script>
        <?php
            // $consulta_rol = $conexion->query("SELECT * FROM usuarios WHERE usuario = '$usuario'");
            // $tupla = mysqli_fetch_array($consulta_rol);

            // // Dependiendo del rol que tenga ese usuario que cambio la contraseña redirigir a su pargina principal
            // if ($tupla['id_rol'] == 1) {
            //     header("location: ../admin/index.php");
            // } else if ($tupla['id_rol'] == 2) {
            //     header("location: ../pages/coordinador/index.php");
            // } else if ($tupla['id_rol'] == 3) {
            //     header("location: ../pages/estudiante/index.php");
            // } else if ($tupla['id_rol'] == 4) {
            //     header("location: ../pages/docente/index.php");
            // }
            // mysqli_close($conexion);
        } else {
        ?>
            <div id="fail" class="alert alert-danger" role="alert" style="z-index: 9999999999999999; position:absolute; top:2%;left: 50%;transform: translate(-50%, 0%);">
                La confirmación de contraseña no coincide
            </div>
            <script>
                setTimeout(function() {
                    $('#fail').fadeOut('fast');
                }, 2000); // <-- time in milliseconds
            </script>
        <?php
        }
    }
} else if (isset($_POST['file_save'])) {

    $fichero = $_FILES['file_photo']['name'];
    $guardado = $_FILES['file_photo']['tmp_name'];

    $photo =  date("d-m-y") . "-" . date("H-m-s") . "-" . $nombre;
    $ruta = "../files/photos/" . $photo;

    if (!file_exists('../files/photos')) {
        mkdir('../files/photos', 0777, true);
        if (file_exists('../files/photos')) {
            if (move_uploaded_file($guardado, '../files/photos/' . $photo)) {
                include_once("../pages/estudiante/index.php");
            } else {
                echo "Archivo no se pudo guardar";
            }
        }
    } else {

        if (move_uploaded_file($guardado, '../files/photos/' . $photo)) {
            $userP = new User();
            $userP->ChangeProfilePhoto($photo, $_SESSION['usuario']);
        ?>
            <div id="success" class="alert alert-success" role="alert" style="z-index: 9999999999999999; position:absolute; top:2%;left: 50%;transform: translate(-50%, 0%);">
                Cambios guardados con éxito
            </div>

            <script>
                setTimeout(function() {
                    $('#success').fadeOut('fast');
                }, 2000); // <-- time in milliseconds
            </script>
        <?php
            // include_once("../pages/estudiante/index.php");
            // header("Location: ../support/account.php");
        } else {
        ?>
            <div id="fail" class="alert alert-danger" role="alert" style="z-index: 9999999999999999; position:absolute; top:2%;left: 50%;transform: translate(-50%, 0%);">
                Error al cambiar su foto de perfil
            </div>
            <script>
                setTimeout(function() {
                    $('#fail').fadeOut('fast');
                }, 2000); // <-- time in milliseconds
            </script>
<?php
        }
    }
}

?>