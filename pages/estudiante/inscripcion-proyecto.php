<?php
include("../../model/conexion.php");
session_start();
error_reporting(0);
$variable_sesion = $_SESSION['usuario'];

if ($variable_sesion == null || $variable_sesion = '') {
    header("location: ../../index.php");
    die();
}
include("../../controller/nombre.php");
?>
<!doctype html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="../../evaluer.ico">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Propuesta de grado</title>

    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/unicons.css">
    <link rel="stylesheet" href="../../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../../css/owl.theme.default.min.css">

    <!-- MAIN STYLE -->
    <link rel="stylesheet" href="../../css/inscripcion-styles.css">
    <link rel="stylesheet" href="../../css/scrollbar.css">
    <link rel="stylesheet" href="../../font/fontawesome-free-6.1.1-web/css/all.css">

    <script src="../../font/fontawesome-free-6.0.0-web/js/solid.js"></script>
    <script src="../../font/fontawesome-free-6.0.0-web/js/solid.min.js"></script>
    <script src="../../font/fontawesome-free-6.0.0-web/js/brands.js"></script>
    <script src="../../font/fontawesome-free-6.0.0-web/js/brands.min.js"></script>
    <script src="../../font/9390efa2c5.js"></script>

</head>

<body>
    <!-- MENU -->
    <nav class="navbar navbar-expand-sm navbar-light">
        <img src="../../img/aunar.png" class="aunar_logo">
        <a class="navbar-brand" href="../main-estudiante.php"><img class="logo" src="../../img/logo_p.png"></a>
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
                        <a href="../main-estudiante.php" class="nav-link"><span data-hover="Principal">Principal</span></a>
                    </li>

                    </li>
                </ul>

                <ul class="log">
                    <li>
                        <a class="navbar-brand" href=""><i class='uil uil-user'></i>
                            <label>
                                <?php echo $nombre_usuario;
                                ?>
                            </label>
                        </a>
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

    <div class="grid-view">
        <div class="seccion-inscripcion">
            <?php
            include("../../controller/controlador-propuesta.php");
            ?>
            <form method="POST" id="envio">
                <div class="grid-form">
                    <?php
                    $fecha = date("Y-m-d H:i:s");
                    $time_propuesta = $conexion->query("SELECT time_propuesta FROM estudiante WHERE usuario=" . $_SESSION['usuario']);
                    $tiempo = mysqli_fetch_array($time_propuesta);
                    ?>

                    <div class="subtitulo">
                        <i class="fas fa-network-wired"></i>
                        <h3 class="">Propuesta de grado</h3>
                    </div>
                    <p class="info">
                        Diligencie la información correspondiente a su propuesta de grado, con los datos requeridos para evaluar un anteproyecto.
                    </p>

                    <label class="lbl-titulo">Título del proyecto:</label>
                    <div class="titulo" id="contenedorInput">
                        <input class="" <?php echo (time() < $tiempo['0']) ? "disabled" : ''; ?> type="text" class="campotexto" name="titulo">
                        <i class="fa-solid fa-font"></i>
                    </div>

                    <label class="lbl-linea">Linea de investigación:</label>
                    <div class="linea" id="contenedorInput">
                        <input class="" <?php echo (time() < $tiempo['0']) ? "disabled" : ''; ?> type="text" class="campotexto" name="linea">
                        <i class="fa-solid fa-diagram-project"></i>
                    </div>

                    <label class="lbl-integrantes">Número de integrantes:</label>
                    <div class="integrantes" id="contenedorInput">
                        <input class="" <?php echo (time() < $tiempo['0']) ? "disabled" : ''; ?> type="number" max="3" min="1" class="camponumero" name="integrantes">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <label class="lbl-asesor">Nombre del asesor:</label>
                    <div class="asesor" id="contenedorInput">
                        <input class="" disabled <?php echo (time() < $tiempo['0']) ? "disabled" : ''; ?> type="text" class="campotexto" name="tutor">
                        <i class="fa-solid fa-user-tie"></i>
                    </div>

                    <label class="lbl-lider">Nombre del lider:</label>
                    <div class="lider" id="contenedorInput">
                        <input class="" <?php echo (time() < $tiempo['0']) ? "disabled" : ''; ?> type="text" class="campotexto" name="lider">
                        <i class="fa-solid fa-user-pen"></i>
                    </div>

                    <label class="lbl-programa">Programa:</label>
                    <div class="programa" id="contenedorInput">
                        <select class="" name="id_programa[]">
                            <?php
                            $buscar_programa = "SELECT programa,programa_id,semestre FROM estudiante WHERE usuario =" . $_SESSION['usuario'];
                            $resultado = mysqli_query($conexion, $buscar_programa);

                            $filas = mysqli_fetch_array($resultado);
                            echo '<option selected value="' . $filas['identificador'] . '">' . $filas['programa'] . '</option>';
                            ?>
                        </select>
                        <i class="fa-solid fa-list-ol"></i>
                    </div>
                    <label class="lbl-semsetre">Semestre:</label>
                    <div class="semestre" id="contenedorInput">
                        <input class="" readonly type="number" max="9" min="1" class="camponumero" id="disable" name="semestre" value="<?php echo $filas['semestre']; ?>">
                        <i class="fa-solid fa-layer-group"></i>
                    </div>
                    <div class="descripcion">
                        <label>Descripción:</label>
                        <textarea <?php echo (time() < $tiempo['0']) ? "disabled" : ''; ?> cols="30" rows="6" name="description"></textarea>
                        <i class="fa-solid fa-rectangle-list"></i>
                    </div>

                    <label class="lbl-equipo">Nombres de los integrantes:</label>
                    <div class="equipo" id="contenedorInput">
                        <input class="" <?php echo (time() < $tiempo['0']) ? "disabled" : ''; ?> placeholder="Separar por ','" type="text" class="campotexto" id="campo_integrantes" name="grupo">
                        <i class="fa-solid fa-people-group"></i>
                    </div>
                </div>
                <div class="contenedor-btn">
                    <input type="datetime" name="fecha" hidden value="<?php echo $fecha; ?>">
                    <input <?php echo (time() < $tiempo['0']) ? "disabled" : ''; ?> type="submit" name="send" value="Enviar" class="btn-enviar">
                </div>
            </form>
        </div>
        <form method="GET">
            <div class="details">
                <label><i class="fas fa-bell"></i> Detalles y notificaciones</label>
                <?php

                $listar = "SELECT * FROM propuesta WHERE remitente =" . $_SESSION['usuario'] . " ORDER BY fecha";
                $q = mysqli_query($conexion, $listar);
                while ($contenido = mysqli_fetch_array($q)) {

                ?>
                    <div class="notif">
                        <input hidden type="text" name="remitente" value="<?php echo $contenido['remitente']; ?>">
                        <label><?php echo $contenido['titulo'] ?></label>
                        <a href=""><i class="edit fas fa-edit"></i></a>
                        <a href="../../controller/eliminar-propuesta.php?remitente=<?php echo $contenido['remitente'] ?>"><i class="trash fas fa-trash-alt"></i></a>
                    </div>

                <?php
                }
                ?>
            </div>
        </form>
    </div>


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