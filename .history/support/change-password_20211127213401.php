<?php
include("../model/conexion.php");
session_start();
error_reporting(0);
$variable_sesion = $_SESSION['usuario'];

if ($variable_sesion == null || $variable_sesion = '') {
    header("location: ../index.php");
    die();
}
include("../controller/nombre.php");
?>
<!doctype html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="../evaluer.ico">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Estudiante</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/unicons.css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../css/owl.theme.default.min.css">

    <!-- MAIN STYLE -->
    <link rel="stylesheet" href="../css/change-password.css">
</head>


<body>
    <!-- MENU -->
    <nav class="navbar navbar-expand-sm navbar-light">
        <img src="../img/aunar.png" class="aunar_logo">
        <a class="navbar-brand" href="../pages/main-estudiante.php"><img class="logo" src="../img/logo_p.png"></a>
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <h3>ESTUDIANTE</h3>

                <ul class="navbar-nav mx-auto">
                    <li class="principal">
                        <a href="main-estudiante.php" class="nav-link"><span data-hover="Principal">Principal</span></a>
                    </li>
                    <li class="fecha">
                        <a href="estudiante/fecha-entrega.php" class="nav-link"><span data-hover="Fechas de entrega">Fechas de
                                entrega</span></a>
                    </li>
                </ul>
                <ul class="log">
                    <li>
                        <a class="navbar-brand" href=""><i class='uil uil-user'></i>
                            <label><?php echo $nombre_usuario;
                                    ?>
                            </label>
                        </a>
                        <ul>
                            <li><a class="out" href="">Perfil</a></li>
                            <li><a class="out" href="../support/change-password.php">Cambiar contraseña</a></li>
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
    <form action="" method="POST">
        <div class="contenedor-soporte">
            <label>Usuario:</label>
            <label>Contraseña actual:</label>
            <p>Introduce tu contraseña actual para verificarla y cambiarla</p>
            <input type="password" value="" name="c_actual">
            <label>Nueva contraseña:</label>
            <input type="password" value="" name="clave">
            <label>Confirmar nueva contraseña: clave</label>
            <input type="password" value="" name="clave2">
            <input type="submit" name="cambiar" value="Cambiar contraseña">
        </div>
    </form>
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