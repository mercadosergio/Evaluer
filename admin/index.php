<?php

if (!isset($_SESSION)) {
    session_start();
}
$sesion = $_SESSION['usuario'];

if ($sesion == null || $sesion = '') {
    header("location: ../index.php");
    die();
}
include_once '../model/UserModel.php';
$usuario = new User();
$getProfile = $usuario->getProfileUser($_SESSION['usuario']);
$userP = mysqli_fetch_array($getProfile);
if ($userP['rol_id'] != 1) {
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

    <title>Administrador</title>
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
                        <p>Registro de usuario</p>
                    </div>
                </a>
            </div>
            <div class="separator">
            </div>
            <div class="item">
                <a href="pages/control-usuarios.php">
                    <div class="title">
                        <i class="fas fa-search"></i>
                        <p>Gestión de usuarios</p>
                    </div>
                </a>
            </div>
            <div class="separator">
            </div>
            <div class="item">
                <a href="pages/notas.php">
                    <div class="title">
                        <i class="fa-solid fa-clipboard"></i>
                        <p>Notas</p>
                    </div>
                </a>
            </div>
            <div class="separator">
            </div>
            <div class="item">
                <a href="pages/programas.php">
                    <div class="title">
                        <i class="fa-regular fa-id-card"></i>
                        <p>Programas</p>
                    </div>
                </a>
            </div>
            <div class="separator">
            </div>
            <div class="item">
                <a href="pages/pqr.php">
                    <div class="title">
                        <i class="fa-solid fa-envelopes-bulk"></i>
                        <p>Peticiones</p>
                    </div>
                </a>
            </div>
        </div>
    </div>


    <div class="admin-profile-usuario">
        <div class="cont-titulo">
            <i class="bi bi-columns-gap"></i>
            <h3>Módulos de administración</h3>
        </div>

        <div class="layout">
            <a href="pages/agregar-usuario.php">
                <div class="module shadow">
                    <h2>Registro de usuario</h2>
                    <img src="../img/add-user.png" alt="">
                </div>
            </a>
            <a href="pages/control-usuarios.php">
                <div class="module shadow">
                    <h2>Gestión de usuarios</h2>
                    <img src="../img/control-user.png" alt="">
                </div>
            </a>
            <a href="pages/notas.php">
                <div class="module shadow">
                    <h2>Notas</h2>
                    <img src="../img/notas.png" alt="">

                </div>
            </a>
            <a href="pages/programas.php">
                <div class="module shadow">
                    <h2>Programas</h2>
                    <img src="../img/programas.png" alt="">

                </div>
            </a>
            <a href="pages/pqr.php">
                <div class="module shadow">
                    <h2>Peticiones</h2>
                    <img src="../img/request.png" alt="">
                </div>
            </a>
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