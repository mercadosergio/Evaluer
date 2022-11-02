<?php

if (isset($_POST['deleteU'])) {

    $id = $_POST['del_id'];
    $usuario = $_POST['del_user'];
    $role = $_POST['del_role'];
    $admin = new User();


    if ($role == 2) {
        $admin->deleteCoordinador($id);
    } else if ($role == 3) {
        $admin->deleteEstudiante($id);
    } else if ($role == 4) {
        $admin->deleteAsesor($id);
    }
    $admin->deleteUser($usuario);

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

}

?>