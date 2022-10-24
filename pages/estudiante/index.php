<?php

session_start();
$sesion = $_SESSION['usuario'];

if ($sesion == null || $sesion = '') {
    header("location: ../index.php");
    die();
}

include_once("../../model/Metodos.php");
include("../../model/UserModel.php");
include("../../model/Estudiante.php");

$usuario = new User();
$est = new Student();
$getProfile = $usuario->getProfileUser();
$userP = mysqli_fetch_array($getProfile);

$getMyrole = $usuario->getStudentProfile();
$userE = mysqli_fetch_array($getMyrole);

$findP = $est->getMyPropuesta();
$findA = $est->getMyAnteproyecto();
date_default_timezone_set('America/Bogota');
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <link rel="stylesheet" href="../../utilities/loading/carga.css">

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
                <i class="bi bi-list"></i>
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
            <div class="anouncement_card">
                <div>
                    <span><i class="bi bi-info-circle-fill"></i> Actividades del curso</span>
                </div>
                <?php
                $recurso = new Metodos();
                $sql = "SELECT * FROM post WHERE docente_id =" . $userE['asesor_id'];
                $rep = $recurso->listar($sql);
                foreach ($rep as $anuncio) {
                ?>
                    <div>
                        <p style="color: var(--primary);"><?php echo $anuncio['nombre_usuario']; ?></p>
                        <p><?php echo $anuncio['contenido']; ?></p>
                        <p class="format-distance"><?php
                                                    $fechaActual = date("Y-m-d H:i:s");
                                                    $originalDate = $anuncio['fecha'];
                                                    $intervalo = $usuario->calcularIntervalo($originalDate, $fechaActual);
                                                    echo $intervalo;
                                                    ?></p>
                    </div>
                <?php
                }

                ?>

            </div>
            <div class="student-module">

                <div class="cont-titulo">
                    <i class="bi bi-columns-gap"></i>
                    <h3>Módulos del curso</h3>
                </div>

                <div class="layout">
                    <a href="../../pages/estudiante/modulos/team.php">
                        <div class="enlace">
                            <img src="../../img/propuesta-e.png" alt="">
                            <p>Información de grupo</p>
                        </div>
                    </a>
                    <?php
                    $group = $est->GroupByDi($userE['cedula']);
                    ?>
                    <a href="../../pages/estudiante/modulos/propuesta.php" class="<?php echo ($group->num_rows <= 0) ? 'deshabilitar' : '' ?>">
                        <div class="enlace">
                            <?php
                            if ($group->num_rows <= 0) {
                                echo '<div class="salto"></div>';
                            }
                            ?>
                            <img src="../../img/propuesta-e.png" alt="">
                            <p>Propuesta de grado</p>
                        </div>
                    </a>
                    <?php


                    ?>
                    <a href="../../pages/estudiante/modulos/anteproyecto-estudiante.php" class="<?php echo ($findP == false) ? 'deshabilitar' : '' ?>">
                        <div class="enlace">
                            <?php
                            if ($findP == false) {
                                echo '<div class="salto"></div>';
                            }
                            ?>
                            <img src="../../img/anteproyecto.png" alt="">
                            <p>Anteproyecto</p>
                        </div>
                    </a>
                    <?php
                    $myProfileStudent = $usuario->getStudentProfile();
                    $estP = mysqli_fetch_array($myProfileStudent);
                    ?>
                    <a href="../../pages/estudiante/modulos/proyecto-final-estudiante.php" class="<?php echo ($findA == false) ? 'deshabilitar' : '' ?>">
                        <div class="enlace">
                            <?php
                            if ($findP == false && $findA == false) {
                                echo '<div class="salto"></div>';
                            }
                            ?>
                            <img src="../../img/proyectof.png" alt="">
                            <p>Proyecto de grado</p>
                        </div>
                    </a>
                </div>
            </div>

            <div class="treeview">
                <div class="tree-view">
                    <details open="open">
                        <summary>Guia de investigación</summary>
                        <div class="folder">
                            <details open="open">
                                <summary>Académico</summary>
                                <div class="folder">
                                    <p>
                                        <i class="fas fa-file-alt"></i>
                                        <a href="">Propuesta de grado</a>
                                    </p>
                                    <p>
                                        <i class="fas fa-file-alt"></i>
                                        <a href="">Anteproyecto</a>
                                    </p>
                                    <p>
                                        <i class="fas fa-file-alt"></i>
                                        <a href="../../guide/guia_ing.pdf" download="Guia_proyecto_inv_ing.pdf">Proyecto de grado</a>
                                    </p>
                                </div>
                            </details>
                        </div>
                    </details>
                    <details open="open">
                        <summary>General</summary>
                        <div class="folder">
                            <p><i class="bi bi-bell-fill" style="margin-right: 3px;"></i><a href="">Anuncios</a></p>
                        </div>
                    </details>
                </div>
            </div>

        </div>

    </div>

    <?php
    if ($findP == false) {
    ?>
        <div id="success" class="alert alert-success" role="alert" style="z-index: 9999999999999999; position:absolute; top:12%;left: 56%;transform: translate(-50%, 0%);">
            Paso 1: Diligencie y envíe su propuesta para avanzar a Anteproyectos
        </div>
        <script>
            setTimeout(function() {
                $('#success').fadeOut('fast');
            }, 7000); // <-- time in milliseconds
        </script>
    <?php
    }
    ?>

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
    <script>
        // $(document).ready(function() {
        //     $('a').on("click", function(e) {
        //         e.preventDefault();
        //     });
        // });
    </script>
    <script src="../../utilities/loading/load.js"></script>

    <script src="../../font/9390efa2c5.js"></script>
    <script src="../../js/jquery-3.3.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
</body>

</html>