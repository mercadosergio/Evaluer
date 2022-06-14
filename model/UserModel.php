<?php

class User extends DataBase
{
    public function getUser($username, $password)
    {
        $sql = "SELECT * FROM usuarios WHERE usuario = '$username' AND contraseña = '$password'";
        $result = $this->connect()->query($sql);
        $numrows = $result->num_rows;

        if ($numrows == 1) {
            $array = mysqli_fetch_array($result);
            if ($array) {
                // Condición para iniciar sesión con los diferentes roles de la plataforma
                if ($array['id_rol'] == 1) { //Administrador
                    header("location: admin/index.php");
                } else if ($array['id_rol'] == 2) { //Coordinador
                    header("location: pages/main-coordinador.php");
                } else if ($array['id_rol'] == 3) { //Estudiante
                    header("location: pages/main-estudiante.php");
                } else if ($array['id_rol'] == 4) { //Docente
                    header("location: pages/main-docente.php");
                } else {
                    header("index.php");
                }
            } else {
                echo '<div id="alerta" class="alert alert-danger" role="alert" style="z-index: 9999999999999999; position:absolute; top:2%;
            left: 50%;transform: translate(-50%, 0%);">
                Usuario no existe
            </div>';
                include_once 'index.php';
            }
            return true;
        } else {
            return false;
        }
    }
}
?>
<script>
    setTimeout(function() {
        $('#alerta').fadeOut('fast');
    }, 4000); // <-- time in milliseconds
</script>