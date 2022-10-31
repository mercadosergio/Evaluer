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
include("../../../model/Coordinador.php");

$usuario = new User();
$funcion = new Metodos();
$getProfile = $usuario->getProfileUser($_SESSION['usuario']);

$userP = mysqli_fetch_array($getProfile);

$getMyself = $usuario->getCoordinatorProfile();
$myRole = mysqli_fetch_array($getMyself);

include('../../../controller/AsignarJurado.php');
$idProyecto = $_GET['id'];
?>

<!doctype html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="../../../evaluer.ico">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Asignar jurado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <link rel="stylesheet" href="../../../utilities/loading/carga.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- MAIN STYLE -->
    <link rel="stylesheet" href="../../../css/asignar-jurado.css">
    <link rel="stylesheet" href="../../../css/header.css">
    <link rel="stylesheet" href="../../../css/scrollbar.css">
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
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
            <h3>COORDINADOR</h3>
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
                        <li><a class="dropdown-item" href="pqrC.php">Solicitud PQR</a></li>

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
    <div class="wall">
        <div class="cont-titulo">
            <h3>Asignar jurado</h3>
        </div>
        <div class="divider">
            <?php
            $getProyecto = $funcion->getProyecto($idProyecto);
            $findData = mysqli_fetch_array($getProyecto);
            ?>
            <div class="info">
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
            </div>
            <div class="accion">
                <label class="subtitle">Seleccione un jurado para cada puesto disponible.</label>
                <form method="POST">
                    <input type="text" hidden name="id" value="<?php echo $idProyecto; ?>">
                    <div class="opcion">
                        <label for="">Primer jurado:</label>
                        <?php echo ($findData['jurado1'] != '') ? '' : '<strong>*</strong>'; ?>
                        <select class="form-select" name="jurado1[]" id="jurado">
                            <?php
                            if ($findData['jurado1'] != '') {
                            ?>
                                <option selected value="<?php echo $findData['jurado1']; ?>"><?php echo $findData['jurado1']; ?><i class="bi bi-circle-fill"></i></option>
                            <?php
                            }
                            ?>
                            <option value="0">Seleccione...</option>
                            <?php
                            $sql1 = "SELECT * FROM asesor WHERE programa_id = " . $myRole['programa_id'];
                            $jurado1 = $funcion->listar($sql1);

                            foreach ($jurado1 as $d) {
                                echo '<option value="' . $d['nombres'] . " " . $d['p_apellido']  . '">' . $d['nombres'] . " " . $d['p_apellido']  . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="opcion">
                        <label for="">Segundo jurado:</label>
                        <?php echo ($findData['jurado2'] != '') ? '' : '<strong>*</strong>'; ?>
                        <select class="form-select" name="jurado2[]">
                            <?php
                            if ($findData['jurado2'] != '') {
                            ?>
                                <option selected value="<?php echo $findData['jurado2']; ?>"><?php echo $findData['jurado2']; ?><i class="bi bi-circle-fill"></i></option>
                            <?php
                            }
                            ?>
                            <option value="0">Seleccione...</option>
                            <?php
                            $sql2 = "SELECT * FROM asesor WHERE programa_id = " . $myRole['programa_id'];
                            $jurado2 = $funcion->listar($sql2);

                            foreach ($jurado2 as $d) {
                                echo '<option value="' . $d['nombres'] . " " . $d['p_apellido']  . '">' . $d['nombres'] . " " . $d['p_apellido']  . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="opcion">
                        <label for="">Tercer jurado:</label>
                        <?php echo ($findData['jurado3'] != '') ? '' : '<strong>*</strong>'; ?>
                        <select class="form-select" name="jurado3[]">
                            <?php
                            if ($findData['jurado3'] != '') {
                            ?>
                                <option selected value="<?php echo $findData['jurado3']; ?>"><?php echo $findData['jurado3']; ?><i class="bi bi-circle-fill"></i></option>
                            <?php
                            }
                            ?>
                            <option value="0">Seleccione...</option>
                            <?php
                            $sql3 = "SELECT * FROM asesor WHERE programa_id = " . $myRole['programa_id'];
                            $jurado3 = $funcion->listar($sql3);

                            foreach ($jurado3 as $d) {
                                echo '<option value="' . $d['nombres'] . " " . $d['p_apellido'] . '">' . $d['nombres'] . " " . $d['p_apellido']  . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Asignar</button>
                </form>
            </div>
        </div>
    </div>
    <script src="../../../utilities/loading/load.js"></script>
    <script src="../../../js/jquery-3.3.1.min.js"></script>
    <script>
        $("select#jurado").change(function() {
            if ($("select#jurado option:selected").length > 2) {
                Swal.fire({
                    icon: 'error',
                    title: '',
                    text: 'Something went wrong!'
                })
            }
        });
    </script>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
    <script src="../../../font/d029bf1c92.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>