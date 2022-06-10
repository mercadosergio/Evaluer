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
    <link rel="stylesheet" href="utilities/loading/carga.css">
    <script src="font/d029bf1c92.js" crossorigin="anonymous"></script>

</head>
<?php
include("controller/controlador-login.php");
?>

<body>
    <div id="contenedor_carga">
        <div id="carga"></div>
    </div>
    <div class="desktop">
        <!-- MENU DE NAVEGACIÓN-->
        <nav class="navbar navbar-expand-sm navbar-light">

            <img src="img/aunar2.png" class="aunar_logo">
            <a class="navbar-brand" href="index.php"><img class="logo" src="img/logo-transparente.png"></a>

            <div class="container">
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
            <p style="text-align: justify; font-size: 28px; color: white;">Éste es el campus virtual de seguimiento e investigación. Interactua con entregas de proyectos de grado, evaluaciones, comentarios y notas.</p><br>
        </div>

        <form method="POST">

            <div class="login">

                <h3 class="titulo-i" style="text-align: center;">Ingresa a tu cuenta</h3>
                <label>Usuario</label>

                <div class="cont-input">
                    <input class="user" type="text" require placeholder="Ingrese su usuario" name="user">
                    <i class="fa-solid fa-user"></i>
                </div>

                <label>Contraseña</label>
                <div class="cont-input">
                    <input class="pass" type="password" require placeholder="Ingrese su contraseña" name="pass">
                    <i class="fa-solid fa-unlock-keyhole"></i>
                </div>

                <input class="boton" type="submit" value="Iniciar Sesión" name="login">

                <p style="text-align: justify; font-size: 15px;">Una vez registrado, su usuario y contraseña será su documento de identidad.</p>

            </div>
        </form>
        <div class="contenedor-campus">
            <h3 class="titulo-aunar">CAMPUS EDUCATIVO AUNAR</h3>
        </div>

        <div class="second-section">
            <div class="info-aunar">
                <div>
                    <p>La Corporación Universitaria Autónoma de Nariño Extensión Cartagena fomenta el desarrollo académico y administrativo de los programas, es una Institución de Educación Superior comprometida con la Cultura, la Investigación, el Emprendimiento y el Bilingüismo, que forman profesionales íntegros y Líderes en el Desarrollo Social. A través de nuestras herramientas fortalecemos y promovemos una experiencia que posibilite la excelencia académica de toda la comunidad, para contribuir al desarrollo integral y sostenible; en el campus Aunar Cartagena te encontrarás con diversas actividades organizadas por el equipo estudiante que mejoran el bienestar educativo.
                    </p>
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
                                <p style="display: block;" class="des">Equipo</p>
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
    </div>
    <div class="mobile">
        <!-- MENU DE NAVEGACIÓN-->
        <nav class="navbar navbar-expand-sm navbar-light">

            <img src="img/aunar2.png" class="aunar_logo">
            <a class="navbar-brand" href="index.php"><img class="logo" src="img/logo-transparente.png"></a>

            <div class="container">
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
        <form method="POST">

            <div class="login">

                <h3 class="titulo-i" style="text-align: center;">Ingresa a tu cuenta</h3>
                <label>Usuario</label>

                <div class="cont-input">
                    <input class="user" type="text" require placeholder="Ingrese su usuario" name="user">
                    <i class="fa-solid fa-user"></i>
                </div>

                <label>Contraseña</label>
                <div class="cont-input">
                    <input class="pass" type="password" require placeholder="Ingrese su contraseña" name="pass">
                    <i class="fa-solid fa-unlock-keyhole"></i>
                </div>

                <input class="boton" type="submit" value="Iniciar Sesión" name="login">

                <p style="text-align: justify; font-size: 15px;">Una vez registrado, su usuario y contraseña será su documento de identidad.</p>
            </div>
        </form>

        <div class="contenedor-campus">
            <h3 class="titulo-aunar">CAMPUS EDUCATIVO AUNAR</h3>

            <div class="info-aunar">
                <div>
                    <p>
                        La Corporación Universitaria Autónoma de Nariño Extensión Cartagena fomenta el desarrollo académico y administrativo de los programas, es una Institución de Educación Superior comprometida con la Cultura, la Investigación, el Emprendimiento y el Bilingüismo, que forman profesionales íntegros y Líderes en el Desarrollo Social. A través de nuestras herramientas fortalecemos y promovemos una experiencia que posibilite la excelencia académica de toda la comunidad, para contribuir al desarrollo integral y sostenible; en el campus Aunar Cartagena te encontrarás con diversas actividades organizadas por el equipo estudiante que mejoran el bienestar educativo.
                    </p>
                </div>
            </div>
            <img src="img/sede.jpeg" alt="">
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

                            <span style="display: block;" class="des">Equipo</span>
                            <div class="develop">
                                <label>Sergio Mercado</label><label>Dager Lopez</label>
                                <center><img src="img/foto-sergio.jpeg" alt=""></center>
                                <center><img src="img/foto-dager.png" alt=""></center>
                                <label>Desarrollador y diseñador</label><label>Diseñador</label>
                            </div>
                        </div>
                        <p class="copyright-text text-center">Copyright &copy; 2021 Evaluer. All rights reserved
                        </p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script src="utilities/loading/load.js"></script>
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