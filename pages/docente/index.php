<?php
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
    <link rel="stylesheet" href="../../css/editor.css">
    <link rel="stylesheet" href="../../utilities/loading/carga.css">

    <!-- <script src="https://cdn.ckeditor.com/ckeditor5/18.0.0/classic/ckeditor.js"></script> -->
    <script type="text/javascript" src="../../js/ckeditor/ckeditor.js"></script>
    <!-- MAIN STYLE -->
    <link rel="stylesheet" href="../../css/docente-styles.css">
    <link rel="stylesheet" href="../../css/header.css">
    <link rel="stylesheet" href="../../css/scrollbar.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <script>
        // $(document).ready(function() {
        //     $('txt-content').Editor();
        //     $('guardar').click(function(e) {
        //         e.preventDefault();
        //         var texto = $('txt-content').Editor('getText');

        //     });
        // });
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
            <form action="../../controller/PublicarAnuncio.php" method="POST">
                <div class="form-group">
                    <textarea require name="txt-content" class="ckeditor" id="ckeditor"></textarea>
                </div>
                <input hidden type="text" name="nombre" value="<?php $profile->getProfileName() ?>">

                <input hidden type="text" name="programa_id" value="<?php $profile->getProfileProgram() ?>">
                <input hidden type="datetime" name="datetime" value="<?php
                                                                        date_default_timezone_set('America/Bogota');
                                                                        $fecha = date("Y-m-d H:i:s");
                                                                        echo $fecha; ?>">
                <button type="submit" class="guardar btn btn-primary" id="btn_publicar">Publicar</button>
            </form>
        </div>


    </div>
    <div class="seccion_anuncios">
        <div class="cont-titulo">
            <h3>Anuncios</h3>
        </div>
        <form action="../../controller/EliminarAnuncio.php" method="POST">
            <?php
            $data = new Entidad;
            $data->getAnuncios();
            ?>

        </form>

    </div>
    <script>
        ClassicEditor
            .create(document.querySelector('#txt-content'))
            .catch(error => {
                console.error(error);
            });
    </script>

    <script src="../../font/9390efa2c5.js"></script>
    <script src="../../utilities/loading/load.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous">
    </script>


    <script src="../../js/jquery-3.3.1.min.js"></script>
    <script src="../../js/jquery-1.11.0.js"></script>
    <script src="../../js/jquery-1.12.0.jss"></script>
    <script src="../../js/popper.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/Headroom.js"></script>
    <script src="../../js/jQuery.headroom.js"></script>
    <script src="../../js/owl.carousel.min.js"></script>
    <script src="../../js/smoothscroll.js"></script>
    <script src="../../js/custom.js"></script>
    <script src="../../js/editor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>

</body>

</html>