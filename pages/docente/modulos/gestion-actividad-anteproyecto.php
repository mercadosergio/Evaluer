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

$usuario = new User();
$funcion = new Metodos();
$getProfile = $usuario->getProfileUser($_SESSION['usuario']);
$userP = mysqli_fetch_array($getProfile);
if ($userP['rol_id'] != 4) {
    header("location: ../../../index.php");
    die();
}
include("../../../model/Asesor.php");
$docente = new Asesor();

include("../../../controller/evaluate-anteproyecto.php");
$idAnteproyecto = $_GET['id'];
?>
<!doctype html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="../../../evaluer.ico">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Revisión de Anteproyecto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <link rel="stylesheet" href="../../../utilities/loading/carga.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- MAIN STYLE -->
    <link rel="stylesheet" href="../../../css/actividad-proyecto.css">
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
            <h3>ASESOR DE INVESTIGACIÓN</h3>
            <ul class="navbar-nav mx-auto">

            </ul>
            <ul class="">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img style="width: 40px; height: 40px; border-radius: 50%;" src="../../../files/photos/<?php echo $userP['foto'] == null ? 'default.png' :  $userP['foto']; ?>" alt="">
                        <?php echo $userP['nombre']; ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Perfil</a></li>
                        <li><a class="dropdown-item" href="../../../support/pqrE.php">Solicitud PQR</a></li>
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

    <div class="format-3">
        <div class="cont-titulo">
            <h3>Información del anteproyecto</h3>
        </div>
        <?php
        $getAnteproyecto = $docente->getAnteproyecto($idAnteproyecto);
        $findData = mysqli_fetch_array($getAnteproyecto);
        ?>
        <div class="data">
            <div class="row_"><label for="">Titulo: </label>
                <p><?php echo $findData['titulo'] ?></p>
            </div>
            <div class="row_"><label for="">Fecha de envío: </label>
                <p><?php
                    $originalDate = $findData['fecha'];
                    echo date("d/m/Y", strtotime($originalDate)) . " " . date("g:i a", strtotime($originalDate));
                    ?></p>
            </div>
            <div class="row_"><label for="">Archivo: </label>
                <a class="file_container" href="<?php echo $findData['documento'] ?>" target="_blank"><i class="fas fa-file-alt"></i>
                    <p><?php echo " " . $findData['nombre'] ?></p>
                </a>
            </div>
            <div class="row_"><label for="">Comentarios del grupo: </label>
                <p><?php echo $findData['comentarios'] ?></p>
            </div>
        </div>

        <div class="cont-titulo">
            <h3>Acciones</h3>
        </div>
        <form method="POST">
            <input type="text" hidden name="id_anteproyecto" value="<?php echo $idAnteproyecto ?>">
            <div class="acciones">
                <div class="">
                    <label for="">Observaciones:</label>
                    <textarea class="form-control" name="observacion" id="" cols="" rows=""><?php echo $findData['observaciones'] ?></textarea>
                </div>
                <div class="control">
                    <label for="">Estado:</label>
                    <select class="form-select" name="estado[]" id="">
                        <option selected value="<?php echo $findData['estado'] ?>"><?php echo $findData['estado'] ?></option>
                        <option value="--">SELECCIONE...</option>
                        <option value="APROBADO">APROBADO</option>
                        <option value="REPROBADO">REPROBADO</option>
                        <option value="EN REVISION">EN REVISIÓN</option>
                        <option value="APLAZADO">APLAZADO</option>
                    </select>
                </div>
                <div class="control">
                    <label for="">Calificación:</label>
                    <input class="form-control number" name="nota" type="text" value="<?php echo $findData['calificacion'] ?>">
                </div>
                <div class="button-container">
                    <button type="submit" class="btn" name="enviar">Aceptar</button>
                </div>
            </div>
        </form>
    </div>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

    <script src="../../../utilities/loading/load.js"></script>
    <script src="../../../font/9390efa2c5.js"></script>
    <script src="../../../js/jquery-3.3.1.min.js"></script>


</body>

</html>