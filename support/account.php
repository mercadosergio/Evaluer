<?php

include("../model/UserModel.php");
$obj = new User();

session_start();
error_reporting(0);
$sesion = $_SESSION['usuario'];
$getProfile = $obj->getProfileUser();
$userP = mysqli_fetch_array($getProfile);

if ($sesion == null || $sesion = '') {
    header("location: ../index.php");
    die();
}
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

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
        <a style="cursor: pointer;" class="navbar-brand" onclick="history.back()"><img class="logo" src="../img/logo_p.png"></a>

        <div class="collapse navbar-collapse" id="navbarNav">
            <h3>CAMBIAR CONTRASEÑA</h3>

            <ul class="navbar-nav mx-auto">

            </ul>
            <ul class="">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img style="width: 40px; height: 40px; border-radius: 50%;" src="../files/photos/<?php echo $userP['foto'] == null ? 'default.png' :  $userP['foto']; ?>" alt="">
                        <?php echo $userP['nombre']; ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Perfil</a></li>
                        <li><a class="dropdown-item" href="../support/account.php">Cambiar contraseña</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="../controller/Logout.php">Cerrar sesión</a></li>
                    </ul>
                </li>
            </ul>
        </div>

    </nav>
    <?php
    include("../controller/cambiar-clave.php");
    ?>
    <div class="inf">
    </div>
    <div class="contenedor-soporte shadow mb-5 bg-body rounded">
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
                    <?php echo $userP['nombre']; ?>
                    <img src="../files/photos/<?php echo $userP['foto'] == null ? 'default.png' :  $userP['foto']; ?>">
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
        'use strict';;
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
    <script src="../js/jquery-3.3.1.min.js"></script>
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
    <script src="../font/d029bf1c92.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>

</body>

</html>