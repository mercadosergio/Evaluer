<?php

if (isset($_POST['login'])) {

    // define('CLAVE', '6LecX3MhAAAAAL2K7kpIQOU_YspLboVwXDP62-31');

    // $token = $_POST['token'];
    // $action = $_POST['action'];

    // $cu = curl_init();
    // curl_setopt($cu, CURLOPT_URL, "");

    $usuario = $_POST['user'];
    $contraseña = $_POST['pass'];

    if (empty($usuario) || empty($contraseña)) {
?>
        <div id="alerta" class="alert alert-danger" role="alert" style="z-index: 9999999999999999; position:absolute; top:2%;
        left: 50%;transform: translate(-50%, 0%);">
            Nombre de usuario o contraseña vacíos
        </div>

        <?php
    } else {
        $user = new User;
        if ($user->getUser($usuario, $contraseña)) {
            session_start();
            $_SESSION['usuario'] = $usuario;
            $_SESSION['programa_id'] = $pro;
        } else {
            header('index.php');
        ?>
            <div id="alerta" class="alert alert-danger" role="alert" style="z-index: 9999999999999999; position:absolute; top:2%;
          left: 50%;transform: translate(-50%, 0%);">
                Usuario no existe
            </div>
            <script>
                setTimeout(function() {
                    $('#alerta').fadeOut('fast');
                }, 4000); // <-- time in milliseconds
            </script>

<?php
        }
    }
}

?>