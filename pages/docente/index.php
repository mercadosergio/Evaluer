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
include("../../model/Asesor.php");

$usuario = new User();
$getProfile = $usuario->getProfileUser($_SESSION['usuario']);
$userP = mysqli_fetch_array($getProfile);
if ($userP['rol_id'] != 4) {
    header("location: ../../index.php");
    die();
}
$getAsesor = $usuario->getDocenteProfile();
$userD = mysqli_fetch_array($getAsesor);

include("../../controller/PublicarAnuncio.php");
?>

<!doctype html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="../../evaluer.ico">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Asesor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <link rel="stylesheet" href="../../utilities/loading/carga.css">

    <!-- MAIN STYLE -->
    <link rel="stylesheet" href="../../css/docente-styles.css">
    <link rel="stylesheet" href="../../css/header.css">
    <link rel="stylesheet" href="../../css/scrollbar.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
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
        <div class="collapse navbar-collapse" id="navbarNav">
            <h3>ASESOR DE INVESTIGACIÓN</h3>
            <ul class="navbar-nav mx-auto">

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
                        <li><a class="dropdown-item" href="modulos/material.php">Material académico</a></li>
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

    <div class="wall">
        <div class="docente-profile">
            <div class="cont-titulo">
                <i class="bi bi-columns-gap"></i>
                <h3>Módulos de revisión y evaluación</h3>
            </div>
            <div class="fila">
                <a href="../docente/modulos/revision-propuesta.php">
                    <div class="seleccion">
                        <div>
                            <h3>Propuesta de grado</h3>
                            <div>
                                <img src="../../img/propuesta-asesor.png" alt="">
                            </div>

                        </div>
                    </div>
                </a>
                <a href="../docente/modulos/revision-anteproyecto.php">
                    <div class="seleccion">
                        <div>
                            <h3>Anteproyectos</h3>
                            <div>
                            <img src="../../img/lista-de-verificacion.png" alt="">

                            </div>
                        </div>
                    </div>
                </a>
                <a href="../docente/modulos/revision-proyecto-grado.php">
                    <div class="seleccion">
                        <div>
                            <h3>Proyectos de grado</h3>
                            <div>
                            <img src="../../img/lista-de-verificacion.png" alt="">

                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="seccion_anuncios">
                <div class="cont-titulo-anuncios">
                    <h3><i class="bi bi-card-heading"></i> Actividad</h3>
                </div>

                <div class="action">
                    <button class="btn_anuncio btn btn-primary" id="btn_form">Publicar un anuncio</button>
                    <form class="post_form" id="post_form" action="" method="POST">
                        <div class="form-group">
                            <textarea require name="txt-content" class="ckeditor" id="ckeditor"></textarea>
                        </div>
                        <input hidden type="text" name="nombre" value="<?php echo $userD['nombres'] . ' ' . $userD['p_apellido']; ?>">
                        <input hidden type="text" name="programa" value="<?php echo $userD['programa'] ?>">
                        <input hidden type="text" name="docente_id" value="<?php echo $userD['id'] ?>">
                        <input hidden type="datetime" name="datetime" value="<?php
                                                                                date_default_timezone_set('America/Bogota');
                                                                                $fecha = date("Y-m-d H:i:s");
                                                                                echo $fecha; ?>">
                        <button type="submit" class="guardar" name="submit" id="btn_publicar">Publicar</button>
                    </form>
                </div>
                <form action="../../controller/EliminarAnuncio.php" method="POST">
                    <?php
                    $recurso = new Metodos();
                    $getA = $recurso->viewAnuncioSender();
                    $listA = mysqli_fetch_array($getA);

                    foreach ($getA as $key) {
                    ?>
                        <div class="card_layout">
                            <button class="drop-menu" type="button" data-bs-toggle="dropdown" aria-expanded="false"">
                                <i class=" bi bi-three-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><button class="dropdown-item delete" href="#"><i class="bi bi-trash-fill"></i> Eliminar</button></li>
                            </ul>
                            <input hidden type="text" name="id" value="<?php echo $key['id'] ?>">
                            <div class="e1"><img src="../../files/photos/default.png"></div>
                            <div class="e2"><?php echo $key['nombre_usuario']; ?></div>
                            <div class="e3">
                                <p><?php
                                    $originalDate = $key['fecha'];
                                    echo date("d/m/Y", strtotime($originalDate)) . " " . date("g:i a", strtotime($originalDate));
                                    ?></p>
                            </div>
                            <div class="e4">
                                <p><?php echo $key['contenido']; ?></p>
                            </div>
                        </div>
                    <?php } ?>
                </form>

            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
        $(document).ready(() => {
            $('#post_form').hide();

            $('#btn_form').click(function() {
                $('#post_form').show();
                $('#btn_form').hide();
            });
            $('#btn_publicar').click(function() {
                $('#post_form').hide();
                $('#btn_form').show();
            });
        });
    </script>
    <script src="../../font/d029bf1c92.js"></script>
    <script src="../../utilities/loading/load.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>

    <script type="text/javascript" src="../../js/ckeditor/ckeditor.js"></script>
</body>

</html>