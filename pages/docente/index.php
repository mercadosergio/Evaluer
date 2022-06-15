<?php
include("../../model/conexion.php");
session_start();
error_reporting(0);
$variable_sesion = $_SESSION['usuario'];

if ($variable_sesion == null || $variable_sesion = '') {
    // echo "NO TIENE AUTORIZACIÓN";
    header("location: ../../index.php");
    die();
}

include_once  '../../controller/nombre.php';
?>

<!doctype html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="../../evaluer.ico">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Docente</title>

    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/unicons.css">
    <link rel="stylesheet" href="../../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../../css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../../utilities/loading/carga.css">


    <!-- MAIN STYLE -->
    <link rel="stylesheet" href="../../css/docente-styles.css">

</head>

<body>
    <!-- Pantalla de carga -->
    <div id="contenedor_carga">
        <div id="carga"></div>
    </div>
    <!-- MENU -->
    <nav class="navbar navbar-expand-sm navbar-light">
        <img src="../../img/aunar.png" class="aunar_logo">
        <a class="navbar-brand" href="index.php"><img class="logo" src="../../img/logo_p.png"></a>
        <div class="container">


            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <h3>DOCENTE</h3>
                <ul class="navbar-nav mx-auto">

                </ul>
                <ul class="log">
                    <li>
                        <a class="navbar-brand" href=""><i class='uil uil-user'></i><?php echo $nombre_usuario;
                                                                                    ?></a>
                        <ul>
                            <li><a class="out" href="">Perfil</a></li>
                            <li><a class="out" href="../../support/change-password.php">Cambiar contraseña</a></li>
                            <li><a class="out" href="../../controller/logout.php">Cerrar sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="docente-profile">
        <h3>Modulos de revisión y evaluación</h3>
        <div class="horizontal">
            <a href="../docente/modulos/revision-propuesta.php">
                <div class="seleccion">
                    <div>
                        <h3>Propuestas</h3>
                        <div>
                            <i class="icono fas fa-search"></i>
                        </div>

                    </div>
                </div>
            </a>
            <a href="../docente/modulos/revision-anteproyecto.php">
                <div class="seleccion">
                    <div>
                        <h3>Anteproyectos</h3>
                        <div>
                            <i class="fas fa-book-open"></i>
                        </div>
                    </div>
                </div>
            </a>
            <a href="../docente/modulos/revision-proyecto-grado.php">
                <div class="seleccion">
                    <div>
                        <h3>Proyectos de grado</h3>
                        <div>
                            <i class="fas fa-user-tie"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <script src="../../font/9390efa2c5.js"></script>
    <script src="../../utilities/loading/load.js"></script>

    <script src="../../js/jquery-3.3.1.min.js"></script>
    <script src="../../js/popper.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/Headroom.js"></script>
    <script src="../../js/jQuery.headroom.js"></script>
    <script src="../../js/owl.carousel.min.js"></script>
    <script src="../../js/smoothscroll.js"></script>
    <script src="../../js/custom.js"></script>

</body>

</html>