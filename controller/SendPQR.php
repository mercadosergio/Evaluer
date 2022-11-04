<?php

if (isset($_POST['send'])) {
    $asunto = $_POST['asunto'];
    $contenido = $_POST['description'];

    $nombre = $_POST['nombre'];
    $apellido1 = $_POST['apellido1'];
    $apellido2 = $_POST['apellido2'];

    $rol_id = $_POST['rol_id'];
    $usuario_id = $_POST['id_usuario'];

    date_default_timezone_set("America/Bogota");
    $fecha = date("Y-m-d H:i:s");

    // include "../model/UserModel.php";
    // $general = new User();
    $usuario->createPqr($asunto, $contenido, $fecha, $nombre, $apellido1 . " " . $apellido2, $rol_id, $usuario_id);

?>
    <div id="success" class="alert alert-success" role="alert" style="z-index: 9999999999999999; position:absolute; top:2%;left: 50%;transform: translate(-50%, 0%);">
        Solicitud enviada con éxito
    </div>

    <script>
        setTimeout(function() {
            $('#success').fadeOut('fast');
        }, 2000); // <-- time in milliseconds
    </script>
<?php
}
