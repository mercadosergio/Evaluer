<?php
include("../model/conexion.php");
session_start();
error_reporting(0);

$variable_sesion = $_SESSION['usuario'];

if ($variable_sesion == null || $variable_sesion = '') {
    header("location: ../index.php");
    die();
}
// include_once  '../controller/nombre.php';
?>

<!doctype html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="../evaluer.ico">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Aministrador</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/unicons.css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../css/owl.theme.default.min.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- MAIN STYLE -->
    <link rel="stylesheet" href="css/admin.css">
    <!-- <script src="../js/action/tab.js" defer></script> -->
</head>
<style>
    .resaltar {
        background-color: yellow;
    }
</style>

<body>
    <!-- MENU -->
    <nav class="navbar navbar-expand-sm navbar-light">
        <img src="../img/aunar.png" class="aunar_logo">
        <a class="navbar-brand" href="index.php"><img class="logo" src="../img/logo_p.png"></a>
        <div class="container">


            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <h3>ADMINISTRADOR</h3>
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                    </li>
                </ul>
                <ul class="log">
                    <li>
                        <a class="navbar-brand" href=""><i class='uil uil-user'></i>
                            <label><?php echo $_SESSION['usuario'];
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



    <div id="sidemenu" class="menu-collapsed">
        <!-- Header -->
        <div class="header">
            <div class="btn-hamburguer"></div>
            <div class="btn-hamburguer"></div>
            <div class="btn-hamburguer"></div>
        </div>
        <!-- Perfil -->
        <div class="profile">
            <div class="foto">
                <img class="perfil" src="../img/perfil.png" alt="">
                <div class="name"><span><?php echo $_SESSION['usuario'] ?></span></div>
            </div>
        </div>
        <!-- Items -->
        <div class="menu-items">

            <div class="item">
                <a href="">
                    <div class="title">
                        <label>Registro de estudiante</label>
                    </div>
                </a>
            </div>
            <div class="separator">

            </div>
            <div class="item">
                <a href="">
                    <div class="title">
                        <label>Registro de asesor</label>
                    </div>
                </a>
            </div>
            <div class="separator">

            </div>
            <div class="item">
                <a href="">
                    <div class="title">
                        <label>Registro de coordinador</label>
                    </div>
                </a>
            </div>
            <div class="separator">

            </div>
            <div class="item">
                <a href="">
                    <div class="title">
                        <label>Buscar usuario</label>
                    </div>
                </a>
            </div>
        </div>
    </div>


    <section class="admin-profile-usuario">
        <div class="opciones_admin">
            <div class="separation">
                <a href="pages/agregar-estudiante.php">
                    <div class="option_ad">
                        <h2>Registro de estudiante</h2>
                        <center><i class="fas fa-user-plus"></i></center>
                    </div>
                </a>
            </div>

            <div class="separation">
                <a href="">
                    <div class="option_ad">
                        <h2>Registro de asesor</h2>
                        <center></i></center>
                    </div>
                </a>
            </div>

            <div class="separation">
                <a href="">
                    <div class="option_ad">
                        <h2>Asignar coordinador</h2>
                        <center><i class="fas fa-user-plus"></i></center>
                    </div>
                </a>
            </div>
        </div>
        <div class="opciones_admin">
            <div class="separation">
                <a href="pages/control-usuarios.php">
                    <div class="option_ad">
                        <h2>Buscar usuario</h2>
                        <center><i class="fas fa-search"></i></center>
                    </div>
                </a>
            </div>
            <div class="separation">
                <a href="">
                    <div class="option_ad">
                        <h2>Asignar coordinador</h2>
                        <center><i class="fas fa-user-plus"></i></center>
                    </div>
                </a>
            </div>
        </div>
    </section>

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