<?php

session_start();
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
$getProfile = $usuario->getProfileUser();
$userP = mysqli_fetch_array($getProfile);

$getMyself = $usuario->getCoordinatorProfile();
$myRole = mysqli_fetch_array($getMyself);

?>

<!doctype html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="../../../evaluer.ico">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Asignar asesor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <link rel="stylesheet" href="../../../utilities/loading/carga.css">
    <!-- MAIN STYLE -->
    <link rel="stylesheet" href="../../../css/asignar-asesor.css">
    <link rel="stylesheet" href="../../../css/header.css">
    <link rel="stylesheet" href="../../../css/scrollbar.css">

</head>

<body>
    <!-- Guardando... -->
    <!-- <div class="saving">
        <div class="lds-facebook loader" id="loader">
            <div></div>
            <div></div>
            <div></div>
        </div>
        Guardando...
    </div> -->
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

    <div class="main_section">
        <div class="cont-titulo">
            <h3>Asignar asesor</h3>
        </div>

        <div class="box">
            <i class="fa fa-search"></i>
            <input type="search" id="search" placeholder="Search..." />
        </div>

        <table class="tabla table table-bordered shadow">
            <thead>
                <th>#</th>
                <th>Periodo</th>
                <th>Programa</th>
                <th>Semestre</th>
                <th>Titulo de proyecto</th>
                <th>No. integrantes</th>
                <th>Integrantes</th>
                <th>Asesor</th>
            </thead>
            <tbody id="info">
                <?php
                include("../../../controller/AsignarDocente.php");
                $programa = $myRole['programa'];
                $sql = "SELECT * FROM grupo WHERE programa = '$programa'";
                $datos = $usuario->listar($sql);

                foreach ($datos as $key) {
                ?>
                    <tr class="valores">
                        <form id="form" action="" name="sub" method="POST">
                            <td><?php echo $key['id'] ?></td>
                            <td><?php echo $key['periodo'] ?></td>
                            <td><?php echo $key['programa'] ?></td>
                            <td><?php echo $key['semestre'] ?></td>
                            <td><?php echo $key['project_name'] ?></td>
                            <td><?php echo $key['n_integrantes'] ?></td>
                            <td>
                                <ul>
                                    <li><?php echo $key['nombre_integrante1'] ?></li>
                                    <li><?php echo $key['nombre_integrante2'] ?></li>
                                    <li><?php echo $key['nombre_integrante3'] ?></li>
                                </ul>
                            </td>
                            <td>

                                <select class="form-select" name="id_asesor[]" id="asesor" onchange="this.form.submit()">
                                    <?php
                                    if ($key['asesor_id'] != 0) {
                                    ?>
                                        <option selected value="<?php echo $key['asesor_id']; ?>"><?php echo $key['nombre_asesor']; ?><i class="bi bi-circle-fill"></i></option>
                                    <?php
                                    }
                                    ?>
                                    <option value="0">Seleccione...</option>
                                    <?php
                                    $programa_grupos = $key['programa'];
                                    $sql2 = "SELECT * FROM asesor WHERE programa = '$programa_grupos'";
                                    $coach = $funcion->listar($sql2);

                                    foreach ($coach as $d) {
                                        echo '<option value="' . $d['id'] . '">' . $d['nombres'] . " " . $d['p_apellido']  . '</option>';
                                    }
                                    ?>
                                </select>
                                <input hidden type="text" id="id" name="id" value="<?php echo $key['id'] ?>">
                                <input hidden class="asignar" name="asign" value="Guardar" type="submit">

                            </td>
                        </form>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="../../../js/jquery-3.3.1.min.js"></script>
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

    <script type="text/javascript">
        function seleccionarDocente() {

            let id = document.getElementById('id').value;
            let asesor = document.getElementById('asesor');
            let variables = asesor.value;

            const formulario = document.getElementById("asesor");

            formulario.addEventListener("submit", (e) => {
                e.preventDefault();
                const request = new XMLHttpRequest();

                request.open("post", "../../../controller/AsignarDocente.php");
                request.onload = function() {
                    console.log(request.responseText);
                }
                request.send(new FormData(formulario));
            });

            // alert(variables);
            console.log(variables);
            document.sub.submit();
            // document.sub.submit();
        }
    </script>


    <script src="../../../utilities/loading/load.js"></script>
    <script src="../../../font/9390efa2c5.js"></script>
    <script src="../../../js/Headroom.js"></script>
    <script src="../../../js/jQuery.headroom.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

</body>

</html>