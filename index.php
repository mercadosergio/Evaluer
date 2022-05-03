<!doctype html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="evaluer.ico">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Inicio</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/unicons.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">

    <!-- MAIN STYLE -->
    <link rel="stylesheet" href="css/main-style.css">
    <link rel="stylesheet" href="css/scrollbar.css">

</head>
<?php
include("controller/controlador-login.php");
?>

<body>

    <!-- MENU DE NAVEGACIÓN-->
    <nav class="navbar navbar-expand-sm navbar-light">
        <!-- <div class="division"> -->
        <img src="img/aunar2.png" class="aunar_logo">
        <a class="navbar-brand" href="index.php"><img class="logo" src="img/logo-transparente.png"></a>
        <!-- </div> -->
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="inicio">
                        <a href="index.php" class="nav-link"><span data-hover="Inicio" style="color: white;">Inicio</span></a>
                    </li>
                </ul>

                <ul class="navbar-nav ml-lg-auto">
                    <div class="ml-lg-4">
                        <div id=color class="color-mode d-lg-flex justify-content-center align-items-center">

                        </div>
                    </div>
                </ul>
            </div>
        </div>
    </nav>


    <div class="container-title">
        <h1>Bienvenido!</h1>

        <!-- <p class="subtitulo">Campus de seguimiento e investigación.</p><br> -->
        <p style="text-align: justify; font-size: 28px; color: white;">Campus de seguimiento e investigación. Interactua con entregas de proyectos de grado, evaluaciones, comentarios y notas.</p><br>
    </div>

    <form method="POST">
        <div class="login">

            <h3 class="titulo-i" style="text-align: center;">Ingresa a tu cuenta</h3>
            <label>Usuario</label>
            <i class="fa fa-user"></i>
            <input class="user" type="text" require placeholder="Ingrese su usuario" name="user">
            <label>Contraseña</label>
            <input class="pass" type="password" require placeholder="Ingrese su contraseña" name="pass">

            <input class="boton" type="submit" value="Iniciar Sesión" name="login">

            <p style="text-align: justify; font-size: 15px;">Una vez registrado, su usuario y contraseña será su documento de identidad.</p>

        </div>
    </form>
    <div class="contenedor-campus">
        <h3 class="titulo-aunar">CAMPUS UNVERSITARIO AUNAR</h3>
    </div>

    <div class="second-section">
        <div class="info-aunar">
            <div>
                AUNAR Cartagena
            </div>
        </div>
    </div>



    <!-- FOOTER -->
    <footer class="footer py-5">
        <div class="container">
            <div class="row">

                <div class="col-lg-12 col-12">

                    <div class="team">
                        <div class="info">
                            <label style="font-weight: bold;" for="">Sobre nosotros:</label><br><br>
                            <p style="text-align: justify;">Evaluer es una plataforma que permite establecer los pasos específicos para el buen manejo y administración de los recursos digitales que se hacen con la entrega de estos, para la Gestión de Proyectos de Grado en la Corporacion Universitaria Autonoma de Nariño, esto con el fin de promover una interacción entre el estudiante y el docente.</p>
                        </div>

                        <div class="develop">
                            <p style="display: block;" class="des">Equipo Desarrollador</p>
                            <div class="programer1">
                                <label>Sergio Mercado</label>
                                <img src="img/foto-sergio.jpeg" alt="">
                                <label>Desarrollador y diseñador</label>
                            </div>

                            <div class="programer2">
                                <label>Dager Lopez</label>
                                <img src="img/foto-dager.png" alt="">
                                <label>Diseñador</label>
                            </div>
                        </div>
                    </div>
                    <p class="copyright-text text-center">Copyright &copy; 2021 Evaluer. All rights reserved
                    </p>
                </div>

            </div>
        </div>
    </footer>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/Headroom.js"></script>
    <script src="js/jQuery.headroom.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/smoothscroll.js"></script>
    <script src="js/custom.js"></script>

</body>

</html>