<?php
include("../model/conexion.php");
session_start();
error_reporting(0);
$variable_sesion = $_SESSION['usuario'];

if ($variable_sesion == null || $variable_sesion = '') {
    header("location: ../index.php");
    die();
}
include("../controller/nombre.php");
?>
<!doctype html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="../evaluer.ico">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Estudiante</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/unicons.css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../css/owl.theme.default.min.css">

    <!-- MAIN STYLE -->
    <link rel="stylesheet" href="../css/estudiante-styles.css">
</head>


<body>
    <!-- MENU -->
    <nav class="navbar navbar-expand-sm navbar-light">
        <img src="../img/aunar.png" class="aunar_logo">
        <a class="navbar-brand" href="main-estudiante.php"><img class="logo" src="../img/logo_p.png"></a>
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <h3>ESTUDIANTE</h3>

                <ul class="navbar-nav mx-auto">
                    <li class="principal">
                        <a href="main-estudiante.php" class="nav-link"><span data-hover="Principal">Principal</span></a>
                    </li>
                    <li class="fecha">
                        
                    </li>
                </ul>
                <ul class="log">
                    <li>
                        <a class="navbar-brand" href=""><i class='uil uil-user'></i>
                            <label class="cl">
                                <?php echo $nombre_usuario;
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

    <section class="student-profile">
        <h3>Módulos académicos</h3>
        <div class="container">
            <a href="estudiante/inscripcion-proyecto.php">
                <div class="seleccion">
                    <img src="../img/propuesta-e.png" alt="">
                    <p>Propuesta de grado</p>
                </div>
            </a>
        </div>
        <div class="container">
            <a href="estudiante/anteproyecto-estudiante.php">
                <div class="seleccion">
                    <img src="../img/anteproyecto.png" alt="">
                    <p>Anteproyecto</p>
                </div>
            </a>
        </div>
        <div class="container">
            <a href="estudiante/proyecto-final-estudiante.php">
                <div class="seleccion">
                    <img src="../img/proyectof.png" alt="">
                    <p>Proyecto de grado</p>
                </div>
            </a>
        </div>

        <div class="guia_arbol">
            <ul>
                <li>
                    <i class="fas fa-folder" style="margin-right: 3px;"></i><label>Guia de investigación</label>
                    <ul>
                        <li>
                            <!-- <iframe src="../guide/guia_ing.docx" frameborder="0"> -->
                            <i class="fas fa-file-alt"></i>
                            <a href="">Propuesta de grado</a>
                            <!-- </iframe> -->
                        </li>
                        <li>
                            <i class="fas fa-file-alt"></i>
                            <a href="">Anteproyecto</a>
                        </li>
                        <li>
                        <i class="fa-solid fa-user-plus"></i>
                            <a href="../guide/guia_ing.pdf" download="Guia_proyecto_inv_ing.pdf">Proyecto de grado</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </section>
    <?php
    $buscar = "SELECT * FROM estudiante WHERE usuario =" . $_SESSION['usuario'];
    $dato = mysqli_query($conexion, $buscar);
    $registro = mysqli_fetch_array($dato);
    ?>

    <div class="estado_propuesta">
        <h3>Estado</h3>
        <label>
            <?php
            $estado = "SELECT estado FROM propuesta WHERE remitente =" . $_SESSION['usuario'];
            $dato2 = mysqli_query($conexion, $estado);
            $r = mysqli_fetch_array($dato2);
            echo $r['0'];
            ?>
        </label>
    </div>

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