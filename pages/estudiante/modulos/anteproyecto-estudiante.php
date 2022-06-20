<?php
include("../../../model/conexion.php");
include("../../../model/Entidad.php");

session_start();
error_reporting(0);
$variable_sesion = $_SESSION['usuario'];

if ($variable_sesion == null || $variable_sesion = '') {
    // echo "NO TIENE AUTORIZACIÓN";
    header("location: ../../../index.php");
    die();
}

$profile = new Entidad;
?>
<!doctype html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="../../../evaluer.ico">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Subir Anteproyecto</title>

    <link rel="stylesheet" href="../../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../css/unicons.css">
    <link rel="stylesheet" href="../../../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../../../css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../../../utilities/loading/carga.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <!-- MAIN STYLE -->
    <link rel="stylesheet" href="../../../css/anteproyecto-estudiante.css">

</head>

<body>
    <!-- Pantalla de carga -->
    <div id="contenedor_carga">
        <div id="carga"></div>
    </div>
    <!-- MENU -->
    <nav class="navbar navbar-expand-sm navbar-light">
        <img src="../../../img/aunar.png" class="aunar_logo">
        <a class="navbar-brand" href="../index.php"><img class="logo" src="../../../img/logo_p.png"></a>
        <div class="container">

            <div class="collapse navbar-collapse" id="navbarNav">
                <h3>ESTUDIANTE</h3>
                <ul class="navbar-nav mx-auto">
                    <li class="principal">
                        <a href="../index.php" class="nav-link"><span data-hover="Principal">Principal</span></a>
                    </li>
                    <li class="fecha">

                    </li>
                </ul>

                <ul class="log">
                    <li>
                        <img style="width: 40px; height: 40px; border-radius: 50%;" src="../../../files/photos/<?php $profile->getProfilePhoto();
                                                                                                                ?>" alt="">

                        <?php
                        $profile->getProfileUser();
                        ?>
                        <ul>
                            <li><a class="out" href="">Perfil</a></li>
                            <li><a class="out" href="../../../support/account.php">Cambiar contraseña</a></li>
                            <li><a class="out" href="../../../controller/logout.php">Cerrar sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <form action="../../../controller/upload_anteproyecto.php" name="envio_archivo" method="POST" enctype="multipart/form-data">
        <div class="cont-titulo">
            <h3>Subir anteproyecto</h3>
        </div>
        <div class="seccion-anteproyecto">
            <?php
            $fecha = date("Y-m-d H:i:s");

            ?>
            <div class="archivo">
                <div class="container-input">
                    <?php
                    $time_antepoyecto = $conexion->query("SELECT time_anteproyecto FROM estudiante WHERE usuario=" . $_SESSION['usuario']);
                    $tiempo = mysqli_fetch_array($time_antepoyecto);


                    ?>
                    <input type="file" name="archivo" <?php echo (time() < $tiempo['0']) ? "disabled" : ''; ?> id="file-5" class="inputfile inputfile-5" data-multiple-caption="{count} archivos seleccionados" multiple />
                    <label for="file-5">
                        <figure>
                            <svg xmlns="http://www.w3.org/2000/svg" class="iborrainputfile" width="20" height="17" viewBox="0 0 20 17">
                                <path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path>
                            </svg>
                        </figure>
                        <span class="iborrainputfile">Seleccionar archivo</span>
                    </label>

                </div>
                <input type="datetime" name="fecha" hidden value="<?php echo $fecha; ?>">
                <input type="submit" <?php echo (time() < $tiempo['0']) ? "disabled" : ''; ?> value="Enviar" id="enviar" name="enviar" class="btn-enviar">
            </div>

            <div class="comentario">
                <label for="">Comentarios:</label>
                <div class="marco-textarea">
                    <!-- <span class="glyphicon glyphicon-align-left"></span> -->
                    <i class="bi bi-chat-left-dots"></i>
                    <textarea style="background: #fff;" <?php echo (time() < $tiempo['0']) ? "disabled" : ''; ?> name="coment" id="" cols="30" rows="10"></textarea>
                </div>
            </div>
        </div>
        <div class="cont-titulo">
            <h3>Entregas</h3>
        </div>

        <div class="historial">
            <?php
            $listar = "SELECT * FROM anteproyecto WHERE remitente =" . $_SESSION['usuario'] . " ORDER BY fecha";
            $q = mysqli_query($conexion, $listar);
            while ($contenido = mysqli_fetch_array($q)) {
            ?>
                <div class="cont-entregas">
                    <div class="detalle_entrega">
                        <i class="fas fa-file-alt"></i>
                        <div class="datos">
                            <a href="<?php echo $contenido['documento'] ?>" download="<?php echo $contenido['nombre'] ?>"><?php echo $contenido['nombre'] ?></a>
                            <label for="">Estado: <?php echo $contenido['estado'] ?></label>
                            <label for="">Observaciones:</label>

                            <label>Fecha: <?php echo $contenido['fecha'] ?></label>
                            <label for="">Calificación: <?php echo $contenido['calificacion'] ?></label>
                            <div style="overflow:auto;" name="" id="">
                                <?php echo $contenido['observaciones']; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
        <div class="guia_arbol">
            <ul>
                <li>
                    <i class="fas fa-folder" style="margin-right: 3px;"></i><label>Guia de investigación</label>
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
                            <a href="../../../guide/guia_ing.pdf" download="Guia_proyecto_inv_ing.pdf">Proyecto de grado</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </form>

    <script>
        'use strict';;
        (function(document, window, index) {
            var inputs = document.querySelectorAll('.inputfile');
            Array.prototype.forEach.call(inputs, function(input) {
                var label = input.nextElementSibling,
                    labelVal = label.innerHTML;

                input.addEventListener('change', function(e) {
                    var fileName = '';
                    if (this.files && this.files.length > 1)
                        fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
                    else
                        fileName = e.target.value.split('\\').pop();

                    if (fileName)
                        label.querySelector('span').innerHTML = fileName;
                    else
                        label.innerHTML = labelVal;
                });
            });
        }(document, window, 0));
    </script>
    <script>
        function confirmEnviar() {
            envio.archivo.disabled = true;
            envio.archivo.value = "Enviando...";
            setTimeout(function() {
                envio.archivo.disabled = false;
                envio.archivo.value = "Enviar";
            }, 10000);
            return false;
        }
        envio.enviar.addEventListener("click", function() {
            return confirmEnviar();
        }, false);
    </script>

    <?php
    if (time() < $tiempo['0']) {
    ?>
        <div id="fail" class="alert alert-danger" role="alert" style="z-index: 9999999999999999; position:absolute; top:2%;
  				left: 50%;
  				transform: translate(-50%, 0%);">
            No puedes enviar archivos hasta la proxima fecha, en 15 días
        </div>
        <script>
            setTimeout(function() {
                $('#fail').fadeOut('fast');
            }, 7000); // <-- time in milliseconds
        </script>
    <?php
    }
    ?>
    <script src="../../../utilities/loading/load.js"></script>
    <script src="../../../font/9390efa2c5.js"></script>
    <script src="../../../js/jquery-3.3.1.min.js"></script>
    <script src="../../../js/popper.min.js"></script>
    <script src="../../../js/bootstrap.min.js"></script>
    <script src="../../../js/Headroom.js"></script>
    <script src="../../../js/jQuery.headroom.js"></script>
    <script src="../../../js/owl.carousel.min.js"></script>
    <script src="../../../js/smoothscroll.js"></script>
    <script src="../../../js/custom.js"></script>

</body>

</html>