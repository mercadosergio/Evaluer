<?php
include("../model/conexion.php");
session_start();
error_reporting(0);

$variable_sesion = $_SESSION['usuario'];

if ($variable_sesion == null || $variable_sesion = '') {
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

    <title>Aministrador</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/unicons.css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../utilities/loading/carga.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">

    <!-- MAIN STYLE -->
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="../css/header.css">
</head>


<body>

    <!-- Pantalla de carga -->
    <div id="contenedor_carga">
        <div id="carga"></div>
    </div>
    <!-- MENU -->
    <nav class="navbar navbar-expand-sm navbar-light">
        <img src="../img/aunar.png" class="aunar_logo">
        <a class="navbar-brand" href="index.php"><img class="logo" src="../img/logo_p.png"></a>


        <div class="collapse navbar-collapse" id="navbarNav">
            <h3>ADMINISTRADOR</h3>
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                </li>
            </ul>
            <ul class="log">
                <li>
                    <a class="navbar-brand" href=""><i class='uil uil-user'></i>
                        <label>
                            <?php echo $_SESSION['usuario'];
                            ?>
                        </label>
                    </a>
                    <ul>
                        <li><a class="out" href="">Perfil</a></li>
                        <li><a class="out" href="../support/account.php">Cambiar contraseña</a></li>
                        <li><a class="out" href="../controller/logout.php">Cerrar sesión</a></li>
                    </ul>
                </li>
            </ul>
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
                        <i class="fas fa-user-plus"></i>
                        <label>Registro de usuario</label>
                    </div>
                </a>
            </div>
            <div class="separator">

            </div>


            <div class="item">
                <a href="">
                    <div class="title">
                        <i class="fas fa-search"></i>
                        <label>Gestión de usuarios</label>
                    </div>
                </a>
            </div>
        </div>
    </div>


    <div class="admin-profile-usuario">

        <div class="grid-template">
            <div class="separation">
                <a href="pages/agregar-usuario.php">
                    <div class="option_ad">
                        <h2>Registro de usuario</h2>
                        <center><i class="fas fa-user-plus"></i></center>
                    </div>
                </a>
            </div>

            <div class="separation">
                <a href="pages/control-usuarios.php">
                    <div class="option_ad">
                        <h2>Gestión de usuarios</h2>
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
    </div>
    <div class="mobile_alert">
        <div><i class="bi bi-exclamation-octagon-fill"></i>
            <img src="../img/logo_p.png" alt="">
            <p>Lo sentimos, esta sección es sólo para uso de escritorio</p>
        </div>
    </div>
    <script src="../utilities/loading/load.js"></script>
    <script src="../font/9390efa2c5.js"></script>
    <script src="../js/jquery-3.3.1.min.js"></script>
</body>

</html>