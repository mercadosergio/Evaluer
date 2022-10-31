<?php
if (!isset($_SESSION)) {
    session_start();
}
$sesion = $_SESSION['usuario'];


if ($sesion == null || $sesion = '') {
    header("location: ../index.php");
    die();
}
include("../model/UserModel.php");
$obj = new User();
$getProfile = $obj->getProfileUser($_SESSION['usuario']);
$userP = mysqli_fetch_array($getProfile);
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
    <link rel="stylesheet" href="../css/settings.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/scrollbar.css">
</head>


<body>
    <!-- MENU -->
    <nav class="navbar navbar-expand-sm navbar-light">
        <img src="../img/aunar.png" class="aunar_logo">
        <a style="cursor: pointer;" class="navbar-brand" href="<?php
                                                                if ($userP['rol_id'] == 1) {
                                                                    echo "../admin/index.php";
                                                                } else if ($userP['rol_id'] == 2) {
                                                                    echo "../pages/coordinador/index.php";
                                                                } else if ($userP['rol_id'] == 3) {
                                                                    echo "../pages/estudiante/index.php";
                                                                } else if ($userP['rol_id'] == 4) {
                                                                    echo "../pages/docente/index.php";
                                                                }
                                                                ?>"><img class="logo" src="../img/logo_p.png"></a>

        <div class="collapse navbar-collapse" id="navbarNav">
            <h3>AJUSTES DEL PERFIL</h3>

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
    include("../controller/ConfigProfile.php");
    ?>
    <div class="inf">
    </div>
    <div class="contenedor-soporte shadow mb-5 bg-body rounded">
        <h3>Perfil</h3>
        <form action="" name="envio_archivo" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="settings card p-3">
                <div class="photo">
                    <img src="../files/photos/<?php echo $userP['foto'] == null ? 'default.png' :  $userP['foto']; ?>">
                </div>

                <div class="mb-3">
                    <input hidden type="text" name="ug" value="<?php echo $_SESSION['usuario']; ?>">
                    <input class="form-control" type="file" id="formFile" name="file_photo">
                </div>
            </div>
            <button class="btn-set" type="submit" name="file_save">Guardar</button>

            <div class="card p-3">
                <h3>Cambiar contraseña</h3>
                <div class="bloque">
                    <label class="nombre_u">Usuario:</label>
                    <input class="user" name="user" type="text" readonly value="<?php echo $_SESSION['usuario'] ?>">
                </div>
                <div class="bloque">
                    <label>Introduce tu contraseña actual:</label>
                    <input autocomplete="off" class="campo" type="password" value="" name="c_actual">
                </div>
                <div class="bloque">
                    <label>Nueva contraseña:</label>
                    <input class="campo" type="password" value="" name="clave">
                </div>
                <div class="bloque">
                    <label>Confirmar nueva contraseña:</label>
                    <input class="campo" type="password" value="" name="clave2">
                </div>
                <div class="button-pass">
                    <button class="btn-g" type="submit" name="cambiar">Aceptar</button>
                </div>
            </div>
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