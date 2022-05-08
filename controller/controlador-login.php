<?php
include("model/conexion.php");

if (isset($_POST['login'])) {

    //Obtenemos los valores de los input y select-option ubicados en home.
    $usuario = $_POST['user'];
    $contraseña = $_POST['pass'];
    session_start();

    $_SESSION['usuario'] = $usuario;

    $loggear = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND contraseña = '$contraseña'";
    $sesion = mysqli_query($conexion, $loggear);
    $arreglo = mysqli_fetch_array($sesion);

    if ($arreglo) {
        // Condición para iniciar sesión con los diferentes roles de la plataforma
        if ($arreglo['id_rol'] == 1) { //Administrador
            header("location: admin/index.php");
        } else if ($arreglo['id_rol'] == 2) { //Coordinador
            header("location: pages/main-coordinador.php");
        } else if ($arreglo['id_rol'] == 3) { //Estudiante
            header("location: pages/main-estudiante.php");
        } else if ($arreglo['id_rol'] == 4) { //Docente
            header("location: pages/main-docente.php");
        } else {
?>
            <?php
            header("index.php");
            ?>

            <h1 style="position: absolute; width: 360px;
left: 85%; background: red; color: lawngreen;" class="error-alerta">ERROR DE AUTENTICACIÓN</h1>
        <?php
        }
    } else { ?>

        <?php
        include_once 'index.php';
        $mensaje = "Datos incorrectos, el usuario y contraseña no coinciden";
        ?>
        <p style="position: absolute; width: 360px;
left: 75%; top: 77%; background: rgb(255, 162, 162); color: rgb(230, 3, 3); border-radius: 4px; padding: 5px;" id="alerta" class="error-alerta">Datos incorrectos, el usuario y contraseña no coinciden</p>
        <script>
            setTimeout(function() {
                $('#alerta').fadeOut('fast');
            }, 4000); // <-- time in milliseconds
        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<?php
    }
    mysqli_free_result($sesion);
    mysqli_close($conexion);
}


?>