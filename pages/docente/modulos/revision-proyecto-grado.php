<?php
include("../../../model/conexion.php");
include("../../../model/Metodos.php");
$obj = new Metodos();

session_start();
error_reporting(0);
$sesion = $_SESSION['usuario'];
$getProfile = $obj->getProfileUser();
$userP = mysqli_fetch_array($getProfile);

if ($sesion == null || $sesion = '') {
    header("location: ../../../index.php");
    die();
}
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

    <link rel="stylesheet" href="../../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../css/unicons.css">
    <link rel="stylesheet" href="../../../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../../../css/owl.theme.default.min.css">
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
            <h3>DOCENTE</h3>
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
                        <li><a class="dropdown-item" href="../../../support/account.php">Cambiar contraseña</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="../../../controller/logout.php">Cerrar sesión</a></li>
                    </ul>
                </li>
            </ul>
        </div>

    </nav>
    <div class="proyectos">
        <div class="cont-titulo">
            <h3>Historial de proyectos de grado</h3>
        </div>
        <div class="box">
            <i class="fa fa-search"></i>
            <input type="search" id="search" placeholder="Search..." />
        </div>
        <div class="contenedor-titulo">
            <table id="tabla" class="ent shadow p-3 mb-5 rounded">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Título</th>
                        <th>Archivo</th>
                        <th hidden>Programa</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Calificación</th>
                        <th>Observaciones</th>
                        <th hidden>Acción</th>
                    </tr>
                </thead>
                <tbody id="info">
                    <?php
                    $buscar = "SELECT * FROM docente WHERE usuario =" . $_SESSION['usuario'];
                    $dato = mysqli_query($conexion, $buscar);
                    $registro = mysqli_fetch_array($dato);
                    ?>
                    <?php
                    $mostrar_by_fecha = "SELECT * FROM proyecto_grado WHERE asesor_user=" . $registro['usuario'] . " ORDER BY fecha";
                    $result = mysqli_query($conexion, $mostrar_by_fecha);

                    while ($filas = mysqli_fetch_array($result)) {
                        $id_registro = $filas['0'];
                    ?>
                        <tr>
                            <form action="../../../controller/evaluate-proyecto.php" method="POST">
                                <td><?php echo $filas['0']; ?></td>
                                <td><?php echo $filas['titulo']; ?></td>
                                <td><a href="<?php echo $filas['documento']; ?>"><?php echo $filas['nombre']; ?></a></td>
                                <td hidden><?php echo $filas['programa']; ?></td>
                                <td><?php echo $filas['fecha']; ?></td>
                                <td><input type="text" name="estado" value="<?php echo $filas['estado'] ?>" style="text-transform:uppercase;"></td>
                                <td><input type="text" name="nota" value="<?php echo $filas['calificacion'] ?>"></td>
                                <td>
                                    <ul class="o" style="color: black; background: white;">
                                        <li>
                                            <label for="#radio_d" style="width: 100px; height: 20px; text-overflow: ellipsis; overflow: hidden;
                                            white-space: nowrap;"><?php echo $filas['observaciones']; ?></label>
                                            <input id="radio_d" type="radio">
                                            <ul class="texto_o">
                                                <li><textarea placeholder="Escriba aquí" name="observacion" id="" cols="30" rows="10"><?php echo $filas['observaciones']; ?></textarea></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </td>
                                <td hidden>
                                    <input name="getIdProyecto" type="text" hidden value="<?php echo $filas['0'] ?>">
                                    <input type="submit" name="evaluar" value="Evaluar" class="btn-nota">

                                    <script>
                                        // $("#tabla").click(function() {
                                        //     $("#resultados").submit();
                                        // });
                                    </script>
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
    <script src="../../../font/9390efa2c5.js"></script>
    <script src="../../../js/jquery-3.3.1.min.js"></script>


</body>

</html>