<?php
include_once("../../../model/Metodos.php");
include("../../../model/UserModel.php");
$obj = new User();
$funcion = new Metodos();

session_start();
// error_reporting(0);
$sesion = $_SESSION['usuario'];
$getProfile = $obj->getProfileUser();
$userP = mysqli_fetch_array($getProfile);

$getMyself = $obj->getCoordinatorProfile();
$myProfile = mysqli_fetch_array($getMyself);

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

    <title>Asignar asesor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <link rel="stylesheet" href="../../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../css/unicons.css">
    <link rel="stylesheet" href="../../../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../../../css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../../../utilities/loading/carga.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- MAIN STYLE -->
    <link rel="stylesheet" href="../../../css/asignar-asesor.css">
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

    <div class="main_section">
        <div class="cont-titulo">
            <h3>Asignar asesor</h3>
        </div>

        <div class="box">
            <i class="fa fa-search"></i>
            <input type="search" id="search" placeholder="Search..." />
        </div>

        <table class="tabla_asign shadow">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Título</th>
                    <th>Documento</th>
                    <th>Programa</th>
                    <th>Semestre</th>
                    <th>Fecha y hora</th>
                    <th>Asesor de proyecto</th>
                </tr>
            </thead>
            <tbody id="search">

                <form id="form" action="../../../controller/AsignarDocente.php" name="sub" method="POST">
                    <?php
                    $sql = "SELECT * from proyecto_grado WHERE programa_id = " . $myProfile['programa_id'];
                    $data = $funcion->listar($sql);
                    foreach ($data as $key) {
                    ?>
                        <tr>
                            <td><?php echo $key['id'] ?></td>
                            <td style="max-width: 600px;"><?php echo $key['titulo'] ?></td>
                            <td><a href="<?php echo $key['documento']; ?>"><?php echo $key['nombre']; ?></a></td>
                            <td><?php echo $key['programa'] ?></td>
                            <td style="text-align:center;"><?php echo $key['semestre'] ?></td>
                            <td><?php echo $key['fecha'] ?></td>

                            <td>
                                <select name="asesor[]" id="asesor" onchange="seleccionarDocente()">
                                    <option selected value="<?php echo $key['asesor_user']; ?>"><?php echo $key['nombre_asesor']; ?></option>
                                    <option value="1">Seleccione...</option>
                                    <?php
                                    $sql2 = "SELECT * FROM docente";
                                    $coach = $funcion->listar($sql2);

                                    foreach ($coach as $d) {
                                        echo '<option value="' . $d['usuario'] . '">' . $d['nombres'] . " " . $d['p_apellido']  . '</option>';
                                    }
                                    ?>
                                </select>
                            </td>
                            <td hidden>
                                <input type="text" hidden id="id_proyecto" name="id_proyecto" value="<?php echo $key['id'] ?>">
                                <input class="asignar" name="asignar_d" value="Guardar" type="submit">
                            </td>
                        </tr>

                    <?php
                    }
                    ?>
                </form>
            </tbody>
        </table>
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

    <script type="text/javascript">
        function seleccionarDocente() {

            let id = document.getElementById('id_proyecto').value;
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

            document.sub.submit();
            // alert(id);
            // alert(variables);
            // document.sub.submit();

        }
    </script>


    <script>
        // var cod = document.getElementById("asesor").value;
        // // alert(cod);

        // /* Para obtener el texto */
        // var combo = document.getElementById("asesor");
        // var selected = combo.options[combo.selectedIndex].text;
        // // alert(selected);

        // const $form = document.querySelector('#form')
        // $form.addEventListener('submit', handleSubmit)

        // function handleSubmit(event) {
        //     event.preventDefault()
        //     const form = new FormData(this)
        //     console.log(cod)
        // }
    </script>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

</body>

</html>