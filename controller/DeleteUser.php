<?php

if (isset($_POST['deleteU'])) {

    $id = $_POST['del_id'];
    $usuario = $_POST['del_user'];
    $role = $_POST['del_role'];
    $user = new User();


    $user->deleteUser($usuario);
    if ($role == 2) {
        $user->deleteCoordinador($id);
    } else if ($role == 3) {
        $user->deleteEstudiante($id);
    } else if ($role == 4) {
        $user->deleteAsesor($id);
    }

?>
    <div id="success" class="alert alert-success" role="alert" style="z-index: 9999999999999999; position:absolute; top:2%; left: 50%; transform: translate(-50%, 0%);">
        Usuario eliminado con éxito
    </div>
    <script>
        setTimeout(function() {
            $('#success').fadeOut('fast');
        }, 2000); // <-- time in milliseconds
    </script>
<?php
   include_once 'control-usuarios.php';
}
?>