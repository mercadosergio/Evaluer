<?php
include_once '../../model/Metodos.php';
include("../../model/UserModel.php");

$data = new User();
include '../../controller/AddUserController.php';

session_start();
error_reporting(0);
$sesion = $_SESSION['usuario'];
$getProfile = $data->getProfileUser();
$userP = mysqli_fetch_array($getProfile);

if ($sesion == null || $sesion = '') {
    header("location: ../../index.php");
    die();
}
?>

<!doctype html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="../../evaluer.ico">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Registrar estudiante</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../utilities/loading/carga.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- MAIN STYLE -->
    <link rel="stylesheet" href="../css/agregar-usuario.css">
    <link rel="stylesheet" href="../../css/header.css">
</head>

<body>
    <!-- Pantalla de carga -->
    <div id="contenedor_carga">
        <div id="carga"></div>
    </div>
    <!-- MENU -->
    <nav class="navbar navbar-expand-sm navbar-light">
        <img src="../../img/aunar.png" class="aunar_logo">
        <a class="navbar-brand" href="../index.php"><img class="logo" src="../../img/logo_p.png"></a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <h3>ADMINISTRADOR</h3>
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                </li>
            </ul>
            <ul class="">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img style="width: 40px; height: 40px; border-radius: 50%;" src="../../files/photos/<?php echo $userP['foto'] == null ? 'default.png' :  $userP['foto']; ?>" alt="">
                        <?php echo $userP['nombre']; ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Perfil</a></li>
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
    <form method="POST">
        <div class="content shadow p-3 mb-5 bg-white rounded">
            <div class="roles">
                <h5>Seleccione el rol de usuario:</h5>
                <select name="role[]" id="role" class="role form-select">
                    <option class="coo" value="2">Coordinador</option>
                    <option class="other" value="3" selected>Estudiante</option>
                    <option class="other" value="4">Docente</option>
                </select>
            </div>

            <div class="form-add-user">
                <div class="cont-title">
                    <i class="fas fa-user"></i>
                    <h3 class="title" id="stitle">Información del usuario</h3>
                </div>

                <input type="text" name="nombre" class="campo-nombre form-control" placeholder="Nombres">
                <input type="text" name="p_apellido" class="campo-primer-apellido form-control" placeholder="Primer apellido">
                <input type="text" name="s_apellido" class="campo-segundo-apellido form-control" placeholder="Segundo apellido">
                <input type="text" name="cedula" class="campo-cedula form-control" placeholder="No. documento de identidad">

                <div class="programa">
                    <label>Programa:</label>
                    <select name="programa_id[]" class="programa-s form-select">
                        <option selected value="1">Seleccione...</option>
                        <?php
                        $sql = "SELECT * FROM programas";
                        $datos = $data->listar($sql);
                        foreach ($datos as $key) {
                            echo '<option value="' . $key['identificador'] . '">' . $key['nombre'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <input type="number" min="6" max="9" name="semestre" class="cammpo-semestre form-control" placeholder="Semestre" id="semestre">
                <input type="text" name="email" class="campo-email form-control" placeholder="Email">
                <input type="submit" name="agregar" class="btn-agregar form-control" value="Registrar">

            </div>
        </div>
    </form>
    <script src="../../js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            cambiarRol();
            $('#role').change(function() {
                cambiarRol();
            });
        })
    </script>
    <script type="text/javascript">
        function cambiarRol() {
            let input = document.getElementById("semestre");
            if ($('#role').val() == 3) {
                input.style = 'display:flex';
                $('#stitle').html("Información del estudiante");
            } else if ($('#role').val() == 4) {
                input.style = 'display:none';
                $('#stitle').html("Información del asesor");
            } else {
                input.style = 'display:none';
                $('#stitle').html("Información del coordinador");
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

    <script src="../../utilities/loading/load.js"></script>
    <script src="../../font/9390efa2c5.js"></script>
</body>

</html>