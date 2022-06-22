<?php
include("../model/conexion.php");
include("../model/Entidad.php");
session_start();
error_reporting(0);
$variable_sesion = $_SESSION['usuario'];

if ($variable_sesion == null || $variable_sesion = '') {
    header("location: ../index.php");
    die();
}

$profile = new Entidad;
?>
<!doctype html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="../evaluer.ico">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Cambiar contraseña</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/unicons.css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../css/owl.theme.default.min.css">

    <!-- MAIN STYLE -->
    <link rel="stylesheet" href="../css/change-password.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/scrollbar.css">
</head>


<body>
    <!-- MENU -->
    <nav class="navbar navbar-expand-sm navbar-light">
        <img src="../img/aunar.png" class="aunar_logo">
        <a class="navbar-brand" href="../pages/estudiante/index.php"><img class="logo" src="../img/logo_p.png"></a>
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarNav">
                <h3>CAMBIAR CONTRASEÑA</h3>

                <ul class="navbar-nav mx-auto">

                </ul>
                <ul class="log">
                    <li>
                        <img style="width: 40px; height: 40px; border-radius: 50%;" src="../files/photos/<?php $profile->getProfilePhoto();
                                                                                                            ?>" alt="">

                        <?php
                        $profile->getProfileUser();
                        ?>
                        <ul>
                            <li><a class="out" href="">Perfil</a></li>
                            <li><a class="out" href="../support/account.php">Cambiar contraseña</a></li>
                            <li><a class="out" href="../controller/logout.php">Cerrar sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?php
    include("../controller/cambiar-clave.php");
    ?>
    <div class="inf">
    </div>
    <div class="contenedor-soporte">
        <h3>Cambiar foto de perfil</h3>
        <form action="../controller/change-photo.php" name="envio_archivo" method="POST" enctype="multipart/form-data">
            <div class="settings">
                <div class="container-input">
                    <input hidden type="text" name="ug" value="<?php echo $_SESSION['usuario']; ?>">
                    <input type="file" name="archivo" id="file-5" class="inputfile inputfile-5" data-multiple-caption="{count} archivos seleccionados" multiple />
                    <label for="file-5">
                        <figure>
                            <svg xmlns="http://www.w3.org/2000/svg" class="iborrainputfile" width="20" height="17" viewBox="0 0 20 17">
                                <path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path>
                            </svg>
                        </figure>
                        <span class="iborrainputfile">Seleccionar archivo</span>
                    </label>
                </div>
                <div class="photo">
                    <?php
                    $profile->getProfileUser();
                    ?>
                    <img src="../files/photos/<?php $profile->getProfilePhoto(); ?>">
                </div>
            </div>
            <button class="btn btn-primary" type="submit" name="ch">Guardar</button>
        </form>
        <form action="" method="POST">
            <h3>Cambiar contraseña</h3>
            <label class="nombre_u">Usuario:</label>
            <input class="user" name="user" type="text" readonly value="<?php echo $_SESSION['usuario'] ?>">
            <label>Introduce tu contraseña actual:</label>
            <input class="campo" type="password" value="" name="c_actual">
            <label>Nueva contraseña:</label>
            <input class="campo" type="password" value="" name="clave">
            <label>Confirmar nueva contraseña:</label>
            <input class="campo" type="password" value="" name="clave2">
            <input class="btn-g" type="submit" name="cambiar" value="Guardar cambios">
        </form>
    </div>

    <script>
        'use strict';

        ;
        (function(document, window, index) {
            var inputs = document.querySelectorAll('.inputfile');
            Array.prototype.forEach.call(inputs, function(input) {
                var label = input.nextElementSibling,
                    labelVal = label.innerHTML;

                input.addEventListener('change', function(e) {
                    var fileName = '';
                    if (this.files && this.files.length > 1)
                        fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}',
                            this.files.length);
                    else
                        fileName = e.target.value.split('\\').pop();

                    if (fileName)
                        label.querySelector('span').innerHTML = fileName;
                    else
                        label.innerHTML = labelVal;
                });
            });
        }(document, window, 0));
    </script>
    <script>
        function confirmEnviar() {
            envio.archivo.disabled = true;
            envio.archivo.value = "Enviando...";
            setTimeout(function() {
                envio.archivo.disabled = false;
                envio.archivo.value = "Enviar";
            }, 10000);
            return false;
        }
        envio.enviar.addEventListener("click", function() {
            return confirmEnviar();
        }, false);
    </script>
    <script src="../font/9390efa2c5.js"></script>
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/Headroom.js"></script>
    <script src="../js/jQuery.headroom.js"></script>
    <script src="../js/owl.carousel.min.js"></script>
    <script src="../js/smoothscroll.js"></script>
    <script src="../js/custom.js"></script>

</body>

</html>