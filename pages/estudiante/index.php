<?php

include_once("../../model/Metodos.php");
include("../../model/UserModel.php");

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
    <link rel="shortcut icon" href="../../evaluer.ico">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Estudiante</title>

    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/unicons.css">
    <link rel="stylesheet" href="../../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../../css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../../utilities/loading/carga.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">

    <!-- MAIN STYLE -->
    <link rel="stylesheet" href="../../css/estudiante-styles.css">
    <link rel="stylesheet" href="../../css/header.css">
    <link rel="stylesheet" href="../../css/scrollbar.css">
</head>


<body>

    <div class="fondo">
        <!-- Pantalla de carga -->
        <div id="contenedor_carga">
            <div id="carga"></div>
        </div>

        <!-- Side menu -->
        <div id="menu-side" class="menu-side">
            <button onclick="cerrar()" class="close_menu">
                <i class="bi bi-x"></i>
            </button>
            <div class="usuario">
                <?php echo $userP['nombre']; ?>
            </div>
            <ul class="menu-opciones">
                <li><a href=""><i class="bi bi-person-circle"></i> Perfil</a></li>
                <li><a href="../../support/account.php"><i class="bi bi-key-fill"></i> Cambiar contraseña</a>
                </li>
                <li><a href="../../controller/Logout.php"><i class="bi bi-box-arrow-left"></i> Cerrar sesión</a></li>
            </ul>
        </div>
        <!-- MENU -->
        <nav class="navbar navbar-expand-sm navbar-light">
            <button onclick="activar()" class="hamburger">
                <i class="bi bi-estP"></i>
            </button>
            <img src="../../img/aunar.png" class="aunar_logo">
            <a class="navbar-brand" href="../../pages/estudiante/index.php"><img class="logo" src="../../img/logo_p.png"></a>

            <div class="collapse navbar-collapse" id="navbarNav">
                <h3>ESTUDIANTE</h3>

                <ul class="navbar-nav mx-auto">
                    <li class="principal">
                        <a href="../../pages/estudiante/index.php" class="nav-link"><span data-hover="Principal"><label for="">Principal</label></a>
                    </li>
                    <li class="fecha">

                    </li>
                </ul>
                <ul class="">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img style="width: 40px; height: 40px; border-radius: 50%;" src="../../files/photos/<?php echo $userP['foto'] == null ? 'default.png' :  $userP['foto']; ?>" alt="">
                            <?php echo $userP['nombre']; ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Perfil</a></li>
                            <li><a class="dropdown-item" href="../../support/account.php">Cambiar contraseña</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="../../controller/Logout.php">Cerrar sesión</a></li>
                        </ul>
                    </li>
                </ul>

            </div>

        </nav>

        <div class="secciones" id="body">
            <div style="resize: horizontal;" class="anouncement_card">
                <div>
                    <span><i class="bi bi-info-circle-fill"></i> Anuncios y detalles</span>
                </div>
                <?php
                $recurso = new Metodos();
                $rep = $recurso->viewAnuncio();
                while ($actual = mysqli_fetch_array($rep)) {
                ?>
                    <div>
                        <p><?php echo $actual['nombre_usuario']; ?></p>
                        <p><?php echo $actual['contenido']; ?></p>
                        <p><?php echo $actual['fecha']; ?></p>
                    </div>
                <?php
                }

                ?>
                <div><label for="">Juan Diaz</label>
                    <h3>Bienvenidos a este curso</h3>
                    <p>A continuación podrán enviar su propuesta de proyecto con los datos solicitados.</p><em>12/09/2022</em>
                </div>
            </div>
            <div class="student-module">
                <h3>Módulos del curso</h3>
                <div class="container">
                    <a href="../../pages/estudiante/modulos/propuesta.php">
                        <div class="seleccion">
                            <img src="../../img/propuesta-e.png" alt="">
                            <p>Propuesta de grado</p>
                        </div>
                    </a>
                </div>
                <div class="container">
                    <a href="../../pages/estudiante/modulos/anteproyecto-estudiante.php">
                        <div class="seleccion">
                            <img src="../../img/anteproyecto.png" alt="">
                            <p>Anteproyecto</p>
                        </div>
                    </a>
                </div>
                <?php

                $myProfileStudent = $obj->getStudentProfile();
                $estP = mysqli_fetch_array($myProfileStudent);
                if ($estP['semestre'] == 9) {
                ?>
                    <div class="container">
                        <a href="../../pages/estudiante/modulos/proyecto-final-estudiante.php">
                            <div class="seleccion">
                                <img src="../../img/proyectof.png" alt="">
                                <p>Proyecto de grado</p>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div>

            <div class="guia_arbol">
                <ul>
                    <li>
                        <i class="fas fa-folder" style="margin-right: 3px;"></i>
                        <label>Guia de investigación</label>
                        <ul>
                            <li>
                                <i class="fas fa-file-alt"></i>
                                <a href="">Propuesta de grado</a>
                            </li>
                            <li>
                                <i class="fas fa-file-alt"></i>
                                <a href="">Anteproyecto</a>
                            </li>
                            <li>
                                <i class="fas fa-file-alt"></i>
                                <a href="../../guide/guia_ing.pdf" download="Guia_proyecto_inv_ing.pdf">Proyecto de
                                    grado</a>
                            </li>
                        </ul>
                        <i class="bi bi-bell-fill" style="margin-right: 3px;"></i>
                        <label>Anuncios</label>
                        <ul>

                        </ul>
                    </li>
                </ul>
            </div>

        </div>
        <div class="estado_propuesta">
            <h3>Estado de su proyecto</h3>
            <label>
                <?php
                // $estado = "SELECT estado FROM propuesta WHERE remitente =" . $_SESSION['usuario'];
                // $dato2 = mysqli_query($conexion, $estado);
                // $r = mysqli_fetch_array($dato2);
                // echo $r['0'];
                ?>
            </label>
        </div>
    </div>

    <script>
        function activar() {
            // document.getElementById("menu-side").style.width = "50%";
            // document.getElementById("menu-side").style.transform = "translate-x(-0%)";
            document.getElementById("menu-side").style.left = "60%";
        }

        function cerrar() {
            document.getElementById("menu-side").style.left = "0%";
        }
    </script>

    <script src="../../utilities/loading/load.js"></script>

    <script src="../../font/9390efa2c5.js"></script>
    <script src="../../js/jquery-3.3.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
</body>

</html>