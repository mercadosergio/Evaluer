<?php
include("../../model/conexion.php");
include("../../model/Entidad.php");
$profile = new Entidad;
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/unicons.css">
    <link rel="stylesheet" href="../../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../../css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../../utilities/loading/carga.css">


    <!-- MAIN STYLE -->
    <link rel="stylesheet" href="../../css/docente-styles.css">
    <link rel="stylesheet" href="../../css/scrollbar.css">
    <script>
        $(document).ready(function() {
            $('txt-content').Editor();
        });
    </script>
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

            <div class="collapse navbar-collapse" id="navbarNav">
                <h3>DOCENTE</h3>
                <ul class="navbar-nav mx-auto">

                </ul>
                <ul class="log">
                    <li>
                        <img style="width: 40px; height: 40px; border-radius: 50%;" src="../../files/photos/<?php $profile->getProfilePhoto();
                                                                                                            ?>" alt="">

                        <?php
                        $profile->getProfileUser();
                        ?>
                        <ul>
                            <li><a class="out" href="">Perfil</a></li>
                            <li><a class="out" href="../../support/account.php">Cambiar contraseña</a></li>
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
                        <h3>Propuesta de grado</h3>
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
        <div class="cont-titulo">
            <h3>Publicar un anuncio en el curso</h3>
        </div>
        <div class="publicar">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8">
                        <form action="" method="POST">
                            <div class="form-group">
                                <textarea name="txt-content" id="txt-content"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" id="btn_publicar">Publicar</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- <textarea name="" id="" cols="30" rows="9"></textarea> -->
        </div>


    </div>
    <div class="seccion_anuncios">
        <div class="cont-titulo">
            <h3>Anuncios</h3>
        </div>

        <div class="grid">
            <div class="e1"><img src="../../img/foto-sergio.jpeg" alt=""></div>
            <div class="e2">Sergio</div>
            <div class="e3">
                <p>12/05/2012</p>
            </div>
            <div class="e4">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore accusantium tenetur natus quam autem
                    odit expedita minus esse. Labore iure enim officia sed vitae. Molestiae incidunt soluta sed odit.
                    Voluptatibus perspiciatis voluptate velit sequi ducimus provident, distinctio, ipsam aut laudantium
                    impedit neque, laborum inventore dolorem veniam? Ducimus dolore praesentium sapiente?</p>
            </div>
        </div>

    </div>
    <script src="../../font/9390efa2c5.js"></script>
    <script src="../../utilities/loading/load.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous">
    </script>
    <script src="../../js/jquery-3.3.1.min.js"></script>
    <script src="../../js/popper.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/Headroom.js"></script>
    <script src="../../js/jQuery.headroom.js"></script>
    <script src="../../js/owl.carousel.min.js"></script>
    <script src="../../js/smoothscroll.js"></script>
    <script src="../../js/custom.js"></script>
    <script src="../../js/editor.js"></script>

</body>

</html>