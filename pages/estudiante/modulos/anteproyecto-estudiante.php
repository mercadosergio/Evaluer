<?php
session_start();
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

$getProfile = $usuario->getProfileUser();
$userP = mysqli_fetch_array($getProfile);

$getMyRole = $usuario->getStudentProfile();
$userE = mysqli_fetch_array($getMyRole);

include '../../../controller/UploadA.php';
?>
<!doctype html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="../../../evaluer.ico">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Actividad Anteproyecto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../../utilities/loading/carga.css">
    <!-- MAIN STYLE -->
    <link rel="stylesheet" href="../../../css/anteproyecto-estudiante.css">
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

            <ul>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img style="width: 40px; height: 40px; border-radius: 50%;" src="../../../files/photos/<?php echo $userP['foto'] == null ? 'default.png' :  $userP['foto']; ?>" alt="">
                        <?php echo $userP['nombre']; ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Perfil</a></li>
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

    <form name="envio_archivo" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_grupo" value="<?php echo $userE['grupo_id'] ?>">

        <div class="format">
            <?php
            $fecha = date("Y-m-d H:i:s");
            $getTime = $res->restrictAnteproyecto($userE['grupo_id']);
            ?>
            <div class="form <?php echo (time() < $getTime) ? "non" : ''; ?>">
                <div class="cont-titulo">
                    <h3>Enviar anteproyecto</h3>
                </div>
                <?php
                $findP = $estudiante->getMyPropuesta($userE['grupo_id']);
                if ($findP == false) {
                ?>
                    <div class="paso_propuesta">
                        <p><i class="bi bi-exclamation-triangle"></i> ADVERTENCIA: No envió su propuesta, puede hacerlo ingresando <a href="propuesta.php">aquí</a>.</p>
                    </div>
                <?php
                }
                ?>
                <div class="seccion-anteproyecto">
                    <?php
                    if (time() < $getTime) {
                    ?>
                        <div class="aviso">
                            <p>Espacio no disponible hasta la proxima entrega</p>
                        </div>
                    <?php
                    }
                    ?>

                    <div class="archivo <?php echo (time() < $getTime) ? "none" : ''; ?>">
                        <div class="container-input">
                            <input type="text" hidden name="user" value="<?php echo $_SESSION['usuario'] ?>">
                            <input type="text" hidden name="programa_id" value="<?php echo $userE['programa_id'] ?>">
                            <input type="text" hidden name="programa_n" value="<?php echo $userE['programa'] ?>">
                            <input type="file" name="archivo" <?php echo (time() < $getTime) ? "disabled" : ''; ?> id="file-5" class="inputfile inputfile-5" data-multiple-caption="{count} archivos seleccionados" multiple />
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
                    </div>

                    <div class="comentario <?php echo (time() < $getTime) ? "none" : ''; ?>">
                        <label for="">Comentarios:</label>
                        <div class="marco-textarea">
                            <i class="bi bi-chat-left-dots"></i>
                            <textarea style="background: #fff;" <?php echo (time() < $getTime) ? "disabled" : ''; ?> name="coment" id="" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="button">
                        <button type="submit" <?php echo (time() < $getTime) ? "disabled" : ''; ?> id="enviar" name="enviar" class="btn-enviar">Enviar</button>
                    </div>
                </div>
            </div>
            <div class="cont-titulo">
                <h3>Entregas</h3>
            </div>
            <div class="historial">
                <?php
                $listarA = "SELECT * FROM anteproyecto WHERE remitente =" . $_SESSION['usuario'] . " ORDER BY fecha";
                $data = $res->listar($listarA);
                foreach ($data as $archivados) {
                ?>

                    <div class="detalle_entrega">
                        <div class="datos">
                            <div class="icon-file">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <div class="download_file">
                                <a href="<?php echo $archivados['documento'] ?>" target="_blank"><?php echo $archivados['nombre'] ?></a>
                            </div>
                            <label class="state <?php echo $archivados['estado'] ?>" for=""><?php echo $archivados['estado'] ?></label>
                            <div class="calif">
                                <label for="">Calificación: <?php echo $archivados['calificacion'] ?></label>
                            </div>

                            <div class="fechaD">
                                <label>Fecha: <?php
                                                $originalDate = $archivados['fecha'];
                                                echo date("d/m/Y", strtotime($originalDate)) . " " . date("g:i a", strtotime($originalDate));
                                                ?></label>
                            </div>
                        </div>
                        <div class="observ" style="overflow:auto;" name="" id="">
                            <label for="">Observaciones:</label>
                            <p>
                                <?php echo $archivados['observaciones']; ?>
                            </p>
                        </div>
                    </div>

                <?php
                }
                ?>
            </div>

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
        // function confirmEnviar() {
        //     envio.archivo.disabled = true;
        //     envio.archivo.value = "Enviando...";
        //     setTimeout(function() {
        //         envio.archivo.disabled = false;
        //         envio.archivo.value = "Enviar";
        //     }, 10000);
        //     return false;
        // }
        // envio.enviar.addEventListener("click", function() {
        //     return confirmEnviar();
        // }, false);
    </script>
    <script>
        'use strict'

        const bloque = document.querySelectorAll('.detalle_entrega')
        const title = document.querySelectorAll('.datos')


        title.forEach((cadaH2, i) => {
            title[i].addEventListener('click', () => {

                // Recorrer TODOS los bloques
                bloque.forEach((cadaBloque, i) => {
                    // Quitamos la clase activo de TODOS los bloques
                    bloque[i].classList.remove('active')
                })
                // Añadiendo la clase activo al bloque cuya posición sea igual al del h2
                // (Línea número 12)
                bloque[i].classList.add('active')

            })
        })
    </script>
    <script src="../../../utilities/loading/load.js"></script>
    <script src="../../../font/9390efa2c5.js"></script>
    <script src="../../../js/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
</body>

</html>