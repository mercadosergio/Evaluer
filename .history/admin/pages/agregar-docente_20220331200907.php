<?php
include("../../model/conexion.php");
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

    <title>Registrar asesor</title>

    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/unicons.css">
    <link rel="stylesheet" href="../../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../../css/owl.theme.default.min.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- MAIN STYLE -->
    <link rel="stylesheet" href="../css/agregar-estudiante.css">
    <!-- <script src="../js/action/tab.js" defer></script> -->
</head>

<body>
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
    
    <div class="tabs-container">
        <ul class="tabs">
            <li class="active">
                <a href="">Part 1</a>
            </li>
            <li>
                <a href="">Part 2</a>
            </li>
            <li>
                <a href="">Part 3</a>
            </li>
        </ul>
        <div class="tabs-content">
            <div class="tabs-panel active" data-index="0">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra erat at dui dictum, ac semper ante blandit. Suspendisse eleifend felis augue, et egestas odio tempor sed. Quisque sed justo eget arcu viverra sodales. Suspendisse a venenatis
                    augue, imperdiet elementum lorem. Donec neque dui, fringilla vitae ultricies vel, scelerisque non ante. Aliquam erat volutpat. Donec erat velit, finibus at lobortis nec, venenatis ac ipsum. Proin blandit urna turpis, quis euismod dui elementum
                    quis. Vestibulum hendrerit eget est ornare sollicitudin. Cras sit amet mi ut dui venenatis maximus. Donec blandit libero risus, non cursus mauris dignissim a. Donec vitae risus condimentum, rhoncus nibh in, scelerisque massa. Vivamus semper laoreet
                    neque at molestie. Integer nulla nisl, accumsan convallis bibendum ac, suscipit ac leo. Nunc at odio interdum, interdum arcu eu, ullamcorper felis.</p>
                <div style="position:relative;height:0;padding-bottom:56.21%"><iframe width="560" height="315" src="https://www.youtube.com/embed/sUI-XUD6WUY" style="position:absolute;width:100%;height:100%;left:0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe></div>
            </div>
            <div class="tabs-panel" data-index="1">
                <p>Nam auctor orci nec consectetur lacinia. Fusce finibus efficitur hendrerit. Maecenas sit amet turpis eget velit feugiat luctus. Quisque eu tristique urna, at rhoncus lectus. Nullam non leo quis urna euismod convallis at a nibh. Etiam et bibendum
                    sapien. Suspendisse potenti. Nulla et mauris lacinia tortor facilisis dapibus a id dolor. Fusce luctus sapien ac varius mattis. Interdum et malesuada fames ac ante ipsum primis in faucibus. Mauris posuere ipsum nibh, at scelerisque diam feugiat
                    eget.
                </p>
            </div>
            <div class="tabs-panel" data-index="2">
                <p>Mauris id justo accumsan, semper metus non, aliquam purus. Mauris nunc libero, dignissim sit amet est in, egestas molestie nunc. Mauris gravida vel tellus sit amet consequat. Maecenas malesuada varius nibh, vel feugiat enim convallis vitae. Suspendisse
                    et pharetra velit. Vestibulum in ex est. Vestibulum tempor interdum metus et malesuada. Nullam ornare mi elit, id scelerisque ante dictum in. Nullam id mauris erat. Nunc non imperdiet dui. Ut pellentesque ultrices tincidunt. Nulla ac diam id dolor
                    semper malesuada nec eu massa. Nam tortor magna, luctus a blandit vitae, aliquam et arcu. Aenean non vestibulum leo, in pellentesque odio.</p>
            </div>
        </div>
    </div>

    <script>
        const tabLinks = document.querySelectorAll(".tabs a");
        const tabPanels = document.querySelectorAll(".tabs-panel");

        for (let el of tabLinks) {
            el.addEventListener("click", e => {
                e.preventDefault();

                document.querySelector(".tabs li.active").classList.remove("active");
                document.querySelector(".tabs-panel.active").classList.remove("active");

                const parentListItem = el.parentElement;
                parentListItem.classList.add("active");
                const index = [...parentListItem.parentElement.children].indexOf(parentListItem);

                const panel = [...tabPanels].filter(el => el.getAttribute("data-index") == index);
                panel[0].classList.add("active");
            });
        }
    </script>

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