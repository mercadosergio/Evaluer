<?php

include("../model/UserModel.php");
$obj = new User();

session_start();
error_reporting(0);
$sesion = $_SESSION['usuario'];
$getProfile = $obj->getProfileUser();
$userP = mysqli_fetch_array($getProfile);

if ($sesion == null || $sesion = '') {
    header("location: ../index.php");
    die();
}

?>

<!doctype html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="../evaluer.ico">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Aministrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <link rel="stylesheet" href="../utilities/loading/carga.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">

    <!-- MAIN STYLE -->
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="../css/header.css">
</head>


<body>

    <!-- Pantalla de carga -->
    <div id="contenedor_carga">
        <div id="carga"></div>
    </div>
    <!-- MENU -->
    <nav class="navbar navbar-expand-sm navbar-light">
        <img src="../img/aunar.png" class="aunar_logo">
        <a class="navbar-brand" href="index.php"><img class="logo" src="../img/logo_p.png"></a>


        <div class="collapse navbar-collapse" id="navbarNav">
            <h3>ADMINISTRADOR</h3>
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                </li>
            </ul>
            <ul class="">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img style="width: 40px; height: 40px; border-radius: 50%;" src="../files/photos/<?php echo $userP['foto'] == null ? 'default.png' :  $userP['foto']; ?>" alt="">
                        <?php echo $userP['nombre']; ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Perfil</a></li>
                        <li><a class="dropdown-item" href="../support/account.php">Cambiar contraseña</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="../controller/Logout.php">Cerrar sesión</a></li>
                    </ul>
                </li>
            </ul>
    </nav>


    <div id="sidemenu" class="menu-collapsed">
        <!-- Header -->
        <div class="header">
            <div class="btn-hamburguer"></div>
            <div class="btn-hamburguer"></div>
            <div class="btn-hamburguer"></div>
        </div>
        <!-- Perfil -->
        <div class="profile">
            <div class="foto">
                <img class="perfil" src="../img/perfil.png" alt="">
                <div class="name"><span><?php echo $userP['nombre']; ?></span></div>
            </div>
        </div>
        <!-- Items -->
        <div class="menu-items">
            <div class="item">
                <a href="pages/agregar-usuario.php">
                    <div class="title">
                        <i class="fas fa-user-plus"></i>
                        <label>Registro de usuario</label>
                    </div>
                </a>
            </div>
            <div class="separator">
            </div>
            <div class="item">
                <a href="pages/control-usuarios.php">
                    <div class="title">
                        <i class="fas fa-search"></i>
                        <label>Gestión de usuarios</label>
                    </div>
                </a>
            </div>
            <div class="separator">
            </div>
            <div class="item">
                <a href="pages/notas.php">
                    <div class="title">
                        <i class="fa-solid fa-clipboard"></i>
                        <label>Notas de proyectos de grado</label>
                    </div>
                </a>
            </div>
            <div class="separator">
            </div>
            <div class="item">
                <a href="pages/gestion-academica.php">
                    <div class="title">
                        <i class="fa-regular fa-id-card"></i>
                        <label>Gestión académica</label>
                    </div>
                </a>
            </div>
        </div>
    </div>


    <div class="admin-profile-usuario">

        <div class="grid-template">
            <div class="separation">
                <a href="pages/agregar-usuario.php">
                    <div class="option_ad">
                        <h2>Registro de usuario</h2>
                        <center><i class="fas fa-user-plus"></i></center>
                    </div>
                </a>
            </div>

            <div class="separation">
                <a href="pages/control-usuarios.php">
                    <div class="option_ad">
                        <h2>Gestión de usuarios</h2>
                        <center><i class="fas fa-search"></i></center>
                    </div>
                </a>
            </div>
            <div class="separation">
                <a href="pages/notas.php">
                    <div class="option_ad">
                        <h2>Notas de proyectos de grado</h2>
                        <center><i class="fa-solid fa-clipboard"></i></center>
                    </div>
                </a>
            </div>
            <div class="separation">
                <a href="pages/gestion-academica.php">
                    <div class="option_ad">
                        <h2>Gestión académica</h2>
                        <center><i class="fa-regular fa-id-card"></i></center>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="mobile_alert">
        <div><i class="bi bi-exclamation-octagon-fill"></i>
            <img src="../img/logo_p.png" alt="">
            <p>Lo sentimos, esta sección es sólo para uso de escritorio</p>
        </div>
    </div>
    <script src="../utilities/loading/load.js"></script>
    <script src="../font/d029bf1c92.js"></script>
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
</body>

</html>