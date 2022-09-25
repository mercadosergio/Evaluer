<?php
include_once("../../../model/Metodos.php");
include("../../../model/UserModel.php");
$obj = new User();
$funcion = new Metodos();

session_start();
$sesion = $_SESSION['usuario'];
$getProfile = $obj->getProfileUser();
$userP = mysqli_fetch_array($getProfile);

$getMyself = $obj->getCoordinatorProfile();
$myRole = mysqli_fetch_array($getMyself);

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

    <title>Asignar jurado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <link rel="stylesheet" href="../../../utilities/loading/carga.css">
    <link rel="stylesheet" href="../../../js/DataTable/dataTables.semanticui.min.css">
    <link rel="stylesheet" href="../../../js/DataTable/semantic.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- MAIN STYLE -->
    <link rel="stylesheet" href="../../../css/coordinador-proyectos.css">
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
    <div class="cont-titulo">
        <h3>Lista de proyectos</h3>
    </div>

    <div class="index">
        <table id="tablaProyectos" class="table table-hover shadow">
            <thead>
                <tr>
                    <th style="text-align: center;">#</th>
                    <th style="text-align: center;">Título</th>
                    <th style="text-align: center;">Programa</th>
                    <th style="text-align: center;">Semestre</th>
                    <th style="text-align: center;">Fecha y hora</th>
                    <th>Jurados</th>
                </tr>
            </thead>
            <tbody id="search">
                <?php
                $sql = "SELECT * from proyecto_grado WHERE programa_id = " . $myRole['programa_id'];
                $data = $funcion->listar($sql);
                foreach ($data as $key) {
                    $id = $key['id'];
                ?>
                    <tr class="data" style="cursor: pointer;" ondblclick="redirect(<?php echo $id ?>)">
                        <td align="center"><?php echo $key['id'] ?></td>
                        <td align="center" style="max-width: 600px;"><?php echo $key['titulo'] ?></td>
                        <td align="center"><?php echo $key['programa'] ?></td>
                        <td align="center"><?php echo $key['semestre'] ?></td>
                        <td align="center"><?php
                                            $originalDate = $key['fecha'];
                                            echo date("d/m/Y", strtotime($originalDate)) . " " . date("g:i a", strtotime($originalDate));
                                            ?></td>
                        <td>
                            <ul>
                                <?php if ($key['jurado1']) { ?><li><?php echo $key['jurado1'] ?></li><?php } ?>
                                <?php if ($key['jurado2']) { ?><li><?php echo $key['jurado2'] ?></li><?php } ?>
                                <?php if ($key['jurado3']) { ?><li><?php echo $key['jurado3'] ?></li><?php } ?>
                            </ul>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="../../../js/jquery-3.5.1.js"></script>
    <script src="../../../js/DataTable/jquery.dataTables.min.js"></script>
    <script src="../../../js/DataTable/dataTables.semanticui.min.js"></script>
    <script src="../../../js/DataTable/semantic.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-CO.json"></script>
    <script>
        $(document).ready(function() {
            $('#tablaProyectos').DataTable({
                "language": {
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "zeroRecords": "Registro no encontrado",
                    "info": "Mostrando la página _PAGE_ de _PAGES_",
                    "infoEmpty": "No records available",
                    "infoFiltered": "(filtrado de _MAX_ registros totales)",
                    "search": "Buscar:",
                    "paginate": {
                        "next": "Siguiente",
                        "previous": "Anterior",
                    }
                }
            });
            $('.dataTables_length').addClass('bs-select');
        });
    </script>
    <script>
        function redirect(id) {
            window.location = "asignar-jurado.php?id=" + id
        }
    </script>
    <script src="../../../utilities/loading/load.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>