<?php
if (!isset($_SESSION)) {
    session_start();
}
$sesion = $_SESSION['usuario'];

if ($sesion == null || $sesion = '') {
    header("location: ../../../index.php");
    die();
}

include_once("../../../model/Metodos.php");
include("../../../model/UserModel.php");
include_once("../../../model/Estudiante.php");

$usuario = new User();
$res = new Metodos();
$estudiante = new Student();

$getProfile = $usuario->getProfileUser($_SESSION['usuario']);
$userP = mysqli_fetch_array($getProfile);

$getMyRole = $usuario->getStudentProfile();
$userE = mysqli_fetch_array($getMyRole);

$findP = $estudiante->getMyPropuesta($userE['grupo_id']);
$findA = $estudiante->getMyAnteproyecto($userE['grupo_id']);

if ($userE['grupo_id'] <= 0 || $findP->num_rows < 1 || $findA->num_rows < 1) {
    header("location: ../index.php");
}

include("../../../controller/upload_proyecto.php");
?>
<!doctype html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="../../../evaluer.ico">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Actividad Proyecto de Grado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../../utilities/loading/carga.css">
    <!-- MAIN STYLE -->
    <link rel="stylesheet" href="../../../css/proyecto-estudiante.css">
    <link rel="stylesheet" href="../../../css/header.css">
    <link rel="stylesheet" href="../../../css/scrollbar.css">
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

        <div class="collapse navbar-collapse" id="navbarNav">
            <h3>ESTUDIANTE</h3>
            <ul class="navbar-nav mx-auto">
                <li class="principal">
                    <a href="../index.php" class="nav-link"><span data-hover="Principal"><label for="">Principal</label></a>
                </li>
                <li class="fecha">

                </li>
            </ul>

            <ul class="">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img style="width: 40px; height: 40px; border-radius: 50%;" src="../../../files/photos/<?php echo $userP['foto'] == null ? 'default.png' :  $userP['foto']; ?>" alt="">
                        <?php echo $userP['nombre']; ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Perfil</a></li>
                        <li><a class="dropdown-item" href="pqrE.php">Solicitud PQR</a></li>
                        <li><a class="dropdown-item" href="../../../support/account.php">Cambiar contraseña</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="../../../controller/Logout.php">Cerrar sesión</a></li>
                    </ul>
                </li>
            </ul>
        </div>

    </nav>

    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_grupo" value="<?php echo $userE['grupo_id'] ?>">

        <div class="format">
            <div class="cont-titulo">
                <h3 class="titulo1">Enviar proyecto de grado</h3>
            </div>
            <div class="seccion-proyecto">
                <div>
                    <div class="detalles">
                        <div style="display: flex;">
                            <p><i class="activity bi bi-person-workspace"></i> Adjuntar el entregable del proyecto de grado en este espacio.</p>
                        </div>
                        <label for="">Descripción:</label>
                        <label for="">Fecha de entrega:</label>
                    </div>
                    <div class="archivo">
                        <div class="container-input">
                            <?php

                            date_default_timezone_set('America/Bogota');

                            $fecha = date("Y-m-d H:i:s");
                            $getTime = $res->restrictProyecto($userE['grupo_id']);
                            ?>
                            <div class="mb-3">
                                <input type="text" hidden name="programa_id" value="<?php echo $userE['programa_id'] ?>">
                                <input type="text" hidden name="programa_n" value="<?php echo $userE['programa'] ?>">
                                <input class="form-control" type="file" id="formFile" name="archivo" <?php echo (time() < $getTime) ? "disabled" : ''; ?>>
                            </div>
                        </div>
                        <input type="datetime" hidden name="fecha" value="<?php echo $fecha; ?>">
                        <input type="submit" <?php echo (time() < $getTime) ? "disabled" : ''; ?> value="Enviar" name="enviar" class="btn-enviar">
                    </div>
                </div>
            </div>
            <div class="cont-titulo">
                <h3 class="titulo2">Entregas</h3>
            </div>
            <div class="historial">
                <?php
                $listarP = "SELECT * FROM proyecto_grado WHERE remitente =" . $_SESSION['usuario'] . " ORDER BY fecha";
                $data = $res->listar($listarP);
                foreach ($data as $archivados) {
                ?>
                    <div class="cont-entregas">
                        <div class="detalle_entrega">
                            <i class="fas fa-file-alt"></i>
                            <div class="datos">
                                <a href="<?php echo $archivados['documento'] ?>" download="<?php echo $archivados['nombre'] ?>"><?php echo $archivados['nombre'] ?></a>
                                <label>Fecha: <?php
                                                $originalDate = $archivados['fecha'];
                                                echo date("d/m/Y", strtotime($originalDate)) . " " . date("g:i a", strtotime($originalDate));
                                                ?></label>
                            </div>
                            <div class="evaluacion">
                                <label for="">Estado: <?php echo $archivados['estado'] ?></label>
                                <label for="">Calificación: <?php echo $archivados['calificacion'] ?></label>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
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
                                    <a href="../../../guide/guia_ing.pdf" download="Guia_proyecto_inv_ing.pdf">Proyecto de grado</a>
                                </p>
                            </div>
                        </details>
                        <details>
                            <summary>img</summary>
                            <div class="folder">
                                <p>banner.png</p>
                                <p>foo.png</p>
                            </div>
                        </details>
                    </div>
                </details>
                <div class="folder">
                    <p><i class="bi bi-bell-fill" style="margin-right: 3px;"></i><a href="">Anuncios</a></p>
                </div>
            </div>
        </div>
    </form>
    <script>
        'use strict';

        ;
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
    <?php
    if (time() < $getTime) {
    ?>
        <div id="fail" class="alert alert-danger" role="alert" style="z-index: 9999999999999999; position:absolute; top:2%;left: 50%;transform: translate(-50%, 0%);">
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
     <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
    <script src="../../../utilities/loading/load.js"></script>
    <script src="../../../font/9390efa2c5.js"></script>
    <script src="../../../js/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
</body>

</html>