<?php

if (!isset($_SESSION)) {
    session_start();
}
$sesion = $_SESSION['usuario'];

if ($sesion == null || $sesion = '') {
    header("location: ../../index.php");
    die();
}

include_once("../../model/Metodos.php");
include("../../model/UserModel.php");
include("../../model/Estudiante.php");

$usuario = new User();
$est = new Student();
$getProfile = $usuario->getProfileUser($_SESSION['usuario']);
$userP = mysqli_fetch_array($getProfile);
if ($userP['rol_id'] != 3) {
    header("location: ../../index.php");
    die();
}
$getMyrole = $usuario->getStudentProfile();
$userE = mysqli_fetch_array($getMyrole);

$myGroup = $est->GroupByDi($userE['cedula']);
$row = mysqli_fetch_array($myGroup);

if ($userE['grupo_id']) {

    $findP = $est->getMyPropuesta($userE['grupo_id']);
}
if ($userE['grupo_id']) {
    $findA = $est->getMyAnteproyecto($userE['grupo_id']);
}
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
                            <li><a class="dropdown-item" href="../../support/pqrE.php">Solicitud PQR</a></li>
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
                if ($myGroup->num_rows > 0) {
                    $sql = "SELECT * FROM post WHERE docente_id =" . $row['asesor_id'];
                    $rep = $recurso->listar($sql);
                    foreach ($rep as $anuncio) {
                ?>
                        <div>
                            <p style="color: var(--primary);"><?php echo $anuncio['nombre_usuario']; ?></p>
                            <p><?php echo $anuncio['contenido']; ?></p>
                            <p class="format-distance">
                                <?php
                                $fechaActual = date("Y-m-d H:i:s");
                                $originalDate = $anuncio['fecha'];
                                $intervalo = $usuario->calcularIntervalo($originalDate, $fechaActual);
                                echo $intervalo;
                                ?></p>
                        </div>
                    <?php
                    }
                } else {
                    ?>
                    <div class="not-found">
                        <em>No hay contenido del curso</em>
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
                            <img src="../../img/grupo.png" alt="">
                            <p>Información de grupo</p>
                        </div>
                    </a>
                    <?php


                    ?>
                    <a href="../../pages/estudiante/modulos/propuesta.php" class="<?php echo ($row['asesor_id'] <= 0) ? 'deshabilitar' : '' ?> <?php echo ($myGroup->num_rows <= 0) ? 'deshabilitar' : '' ?>">
                        <div class="enlace">
                            <?php
                            if ($myGroup->num_rows <= 0) {
                                echo '<div class="salto"></div>';
                            }
                            if ($myGroup->num_rows >= 1) {
                                if ($row['asesor_id'] <= 0) {
                                    echo '<div class="salto"><p>Espere a ser asignado a un asesor</p></div>';
                                }
                            }
                            ?>
                            <img src="../../img/formulario-de-firma.png" alt="">
                            <p>Propuesta de grado</p>
                        </div>
                    </a>

                    <a href="../../pages/estudiante/modulos/anteproyecto-estudiante.php" class="<?php echo ($userE['grupo_id'] == 0 || $findP->num_rows < 1) ? 'deshabilitar' : '' ?>">
                        <div class="enlace">
                            <?php
                            if ($myGroup->num_rows >= 1) {
                                if ($userE['grupo_id'] == 0 || $findP->num_rows < 1) {
                                    echo '<div class="salto"></div>';
                                }
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
                    <a href="../../pages/estudiante/modulos/proyecto-final-estudiante.php" class="<?php echo ($userE['grupo_id'] == 0 || $findA->num_rows < 1) ? 'deshabilitar' : '' ?>">
                        <div class="enlace">
                            <?php
                            if ($myGroup->num_rows >= 1) {
                                if ($userE['grupo_id'] == 0 || $findP->num_rows < 1 || $findA->num_rows < 1) {
                                    echo '<div class="salto"></div>';
                                }
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
                        <summary>General</summary>
                        <div class="folder">
                            <p><i class="bi bi-bell-fill" style="margin-right: 3px;"></i><a href="">Anuncios</a></p>
                            <p><i class="fa-solid fa-book" style="margin-right: 3px;"></i><a target="_blank" href="../../guide/Manual-de-usuario.pdf">Manual de usuario</a></p>
                        </div>
                    </details>
                    <details open="open">
                        <summary>Guía de investigación</summary>
                        <div class="folder">
                            <details open="open">
                                <summary>Académico</summary>
                                <div class="folder">
                                    <?php
                                    if ($myGroup->num_rows > 0) {
                                        $get = $usuario->listar("SELECT * FROM material_academico WHERE asesor_id =" . $row['asesor_id']);
                                        foreach ($get as $key) {
                                    ?>
                                            <p>
                                                <i class="fas fa-file-alt"></i>
                                                <a href="<?php echo $key['ruta'] ?>" target="_blank"><?php echo $key['nombre'] ?></a>
                                            </p>

                                    <?php
                                        }
                                    }
                                    ?>
                                </div>

                            </details>
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

    <script src="../../font/d029bf1c92.js"></script>
    <script src="../../js/jquery-3.3.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
</body>

</html>