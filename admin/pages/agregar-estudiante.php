<?php
include("../../model/db.php");
include("../../model/UserModel.php");
include '../../model/Entidad.php';
include("../../controller/AddUserController.php");

session_start();
error_reporting(0);

$variable_sesion = $_SESSION['usuario'];

if ($variable_sesion == null || $variable_sesion = '') {
    header("location: ../index.php");
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
    <link rel="stylesheet" href="../../css/unicons.css">
    <link rel="stylesheet" href="../../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../../css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../../utilities/loading/carga.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- MAIN STYLE -->
    <link rel="stylesheet" href="../css/agregar-estudiante.css">
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
        <div class="container">


            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <h3>ADMINISTRADOR</h3>
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                    </li>
                </ul>

                <ul class="log">
                    <li class="">
                        <a class="navbar-brand" href=""><i class='uil uil-user'></i><?php echo $_SESSION['usuario'] ?></a>
                        <ul>
                            <li><a class="out" href="">Perfil</a></li>
                            <li><a class="out" href="../../support/change-password.php">Cambiar contraseña</a></li>
                            <li><a class="out" href="../../controller/logout.php">Cerrar sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <form action="" method="POST">
        <div class="content shadow p-3 mb-5 bg-white rounded">
            <div class="roles">
                <h5>Seleccione el rol de usuario:</h5>
                <select name="role[]" id="role" class="role form-select" onchange="cambiarRol()">
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

                <input type="text" name="nombre" class="campo-nombre" placeholder="Nombres">
                <input type="text" name="p_apellido" class="campo-primer-apellido" placeholder="Primer apellido">
                <input type="text" name="s_apellido" class="campo-segundo-apellido" placeholder="Segundo apellido">
                <input type="text" name="cedula" class="campo-cedula" placeholder="No. documento de identidad">

                <div class="programa">
                    <label>Programa:</label>
                    <select name="programa_id[]" class="programa-s form-select">
                        <option selected value="1">Seleccione...</option>
                        <?php
                        $entidad = new Entidad;
                        $entidad->getPrograma();
                        ?>
                    </select>
                </div>
                <input type="number" min="6" max="9" name="semestre" class="cammpo-semestre" placeholder="Semestre" id="semestre">
                <input type="text" name="email" class="campo-email" placeholder="Email">
                <input type="submit" name="agregar" class="btn-agregar" value="Registrar">

            </div>
        </div>
    </form>
    <script type="text/javascript">
        function cambiarRol() {
            const selectElement = document.getElementById('role');

            selectElement.addEventListener('change', (event) => {
                let input = document.getElementById("semestre");
                if (document.getElementById("role").value === '2') {
                    input.disabled = true;
                    // input.style = 'display:none';
                    $('#stitle').html("Información del coordinador");
                } else if (document.getElementById("role").value === '3') {
                    input.disabled = false;
                    // input.style = 'display:flex';
                    $('#stitle').html("Información del estudiante");
                } else if (document.getElementById("role").value === '4') {
                    input.disabled = false;
                    $('#stitle').html("Información del asesor");
                }
            });
        }
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>

    <script src="../../utilities/loading/load.js"></script>
    <script src="../../font/9390efa2c5.js"></script>
    <script src="../../js/jquery-3.3.1.min.js"></script>
    <script src="../../js/popper.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/Headroom.js"></script>
    <script src="../../js/jQuery.headroom.js"></script>
    <script src="../../js/owl.carousel.min.js"></script>
    <script src="../../js/smoothscroll.js"></script>
    <script src="../../js/custom.js"></script>

</body>

</html>