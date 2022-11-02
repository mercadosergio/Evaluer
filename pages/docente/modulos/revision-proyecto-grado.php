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
include("../../../model/Asesor.php");
include("../../../controller/evaluate-proyecto.php");
?>
<!doctype html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="../../../evaluer.ico">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Proyectos de grado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">

    <link rel="stylesheet" href="../../../utilities/loading/carga.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- MAIN STYLE -->
    <link rel="stylesheet" href="../../../css/revision-proyecto.css">
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
                        <li><a class="dropdown-item" href="pqrA.php">Solicitud de PQR</a></li>
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
    <div class="proyectos">
        <div class="cont-titulo">
            <i class="bi bi-list-ul"></i>

            <h3>Historial de proyectos de grado</h3>
        </div>
        <div class="box">
            <i class="fa fa-search"></i>
            <input type="search" id="search" placeholder="Search..." />
        </div>
        <div class="contenedor-titulo">
            <table id="tabla" class="tabla shadow p-3 mb-5 rounded table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Título</th>
                        <th hidden>Programa</th>
                        <th>Fecha</th>
                        <th>Calificación</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="info">
                    <?php
                    $mostrar = $funcion->revisionProyectos();
                    foreach ($mostrar as $value) {
                    ?>
                        <tr>
                            <form action="" method="POST">
                                <td><?php echo $value['id']; ?></td>
                                <td><?php echo $value['titulo']; ?></td>
                                <td hidden><?php echo $value['programa']; ?></td>
                                <td style="min-width: 200px;"><?php
                                                                $originalDate = $value['fecha'];
                                                                echo date("d/m/Y", strtotime($originalDate)) . " " . date("g:i a", strtotime($originalDate));
                                                                ?></td>
                                <td><?php echo $value['calificacion'] ?></td>
                                <td style="min-width: 150px;"><input type="text" name="estado" hidden value="<?php echo $value['estado'] ?>" style="text-transform:uppercase;">
                                    <label for="" class="<?php echo $value['estado'] ?> valoracion"><?php echo $value['estado'] ?></label>
                                </td>
                                <td style="justify-content: center; align-items: center; height: 100%;">

                                    <a href="gestion-actividad-proyecto-grado.php?id=<?php echo $value['id'] ?>" class="btn-go"><i class="bi bi-eye-fill"></i></a>

                                    <a class="download" href="<?php echo $value['documento']; ?>" target="_blank"><i class="fa-solid fa-download"></i></a>
                                </td>
                            </form>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#search").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#info tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

    <script src="../../../utilities/loading/load.js"></script>
    <script src="../../../font/d029bf1c92.js"></script>
    <script src="../../../js/jquery-3.3.1.min.js"></script>


</body>

</html>