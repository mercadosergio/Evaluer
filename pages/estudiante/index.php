<?php
include("../../model/conexion.php");
include("../../model/Entidad.php");

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

    <title>Estudiante</title>

    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/unicons.css">
    <link rel="stylesheet" href="../../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../../css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../../utilities/loading/carga.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">

    <!-- MAIN STYLE -->
    <link rel="stylesheet" href="../../css/estudiante-styles.css">
    <link rel="stylesheet" href="../../css/header.css">
    <link rel="stylesheet" href="../../css/scrollbar.css">
</head>


<body>

    <div class="fondo">
        <!-- Pantalla de carga -->
        <div id="contenedor_carga">
            <div id="carga"></div>
        </div>

        <!-- Side menu -->
        <div id="menu-side" class="menu-side">
            <button onclick="cerrar()" class="close_menu">
                <i class="bi bi-x"></i>
            </button>
            <div class="usuario">
                <?php
                $profile = new Entidad;
                $profile->getProfileUser();
                ?>
            </div>
            <ul class="menu-opciones">
                <li><a href=""><i class="bi bi-person-circle"></i> Perfil</a></li>
                <li><a href="../../support/account.php"><i class="bi bi-key-fill"></i> Cambiar contraseña</a>
                </li>
                <li><a href="../../controller/logout.php"><i class="bi bi-box-arrow-left"></i> Cerrar sesión</a></li>
            </ul>
        </div>
        <!-- MENU -->
        <nav class="navbar navbar-expand-sm navbar-light">
            <button onclick="activar()" class="hamburger">
                <i class="bi bi-list"></i>
            </button>
            <img src="../../img/aunar.png" class="aunar_logo">
            <a class="navbar-brand" href="../../pages/estudiante/index.php"><img class="logo" src="../../img/logo_p.png"></a>

            <div class="collapse navbar-collapse" id="navbarNav">
                <h3>ESTUDIANTE</h3>

                <ul class="navbar-nav mx-auto">
                    <li class="principal">
                        <a href="../../pages/estudiante/index.php" class="nav-link"><span data-hover="Principal"><label for="">Principal</label></a>
                    </li>
                    <li class="fecha">

                    </li>
                </ul>
                <ul class="log">
                    <li>
                        <img style="width: 40px; height: 40px; border-radius: 50%;" src="../../files/photos/<?php $profile->getProfilePhoto();
                                                                                                            ?>" alt="">

                        <?php
                        $profile->getProfileUser();
                        ?>
                        <ul>
                            <li><a class="out" href="">Perfil</a></li>
                            <li><a class="out" href="../../support/account.php">Cambiar contraseña</a></li>
                            <li><a class="out" href="../../controller/logout.php">Cerrar sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

        </nav>

        <div class="secciones">
            <div class="anouncement_card">
                <div>
                    <span><i class="bi bi-info-circle-fill"></i> Anuncios del curso</span>
                </div>
                <div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi iste nesciunt tempore deserunt, eius amet?
                    Perspiciatis, hic alias! Cum laborum, nihil magnam esse quasi officiis ipsam adipisci dolorem. Debitis amet
                    in perferendis eos laboriosam itaque natus repellendus ut voluptas sequi mollitia eveniet ipsam impedit,
                    beatae reprehenderit est laudantium magni odit recusandae. Id adipisci non eveniet vitae, saepe veniam
                    excepturi vero possimus dolorem nostrum ea quia debitis laudantium molestiae impedit qui. Itaque molestias,
                    quod ea consequuntur quibusdam rerum ducimus, cum officiis deserunt consequatur, enim neque. Quam illo
                    suscipit commodi. Beatae nulla officia iure, mollitia et sit est quod neque, similique voluptate
                    accusantium, ad eaque illo odit nihil. Nobis sint aspernatur at repellat voluptatem facilis hic ab error aut
                    maxime! Earum, quidem quis perspiciatis quasi atque animi eligendi laborum dolorum cumque, aspernatur, sit
                    tempore maxime. Nulla sint eaque, eligendi adipisci cumque unde distinctio? Molestiae velit, dolore magni
                    pariatur consectetur adipisci sed impedit exercitationem! Repellendus repellat laudantium obcaecati
                    inventore possimus doloribus delectus pariatur? Eveniet temporibus esse officia facere repudiandae, saepe
                    possimus perferendis earum velit error aliquam laborum vero expedita magnam obcaecati dolorem non ab quo
                    enim quibusdam inventore aperiam exercitationem recusandae sed. Accusamus voluptatum architecto velit eum,
                    labore nisi sit cumque cupiditate dolorum minus aut ut, dolorem magni vitae. Dignissimos facere, nisi
                    accusamus sapiente autem vel esse, ipsam earum illum facilis ratione, enim nesciunt praesentium officia ad
                    quos! Nobis voluptatibus temporibus nesciunt ullam maxime recusandae amet dolores voluptas nulla aliquid
                    quam error corporis vel, fugit tenetur magnam delectus culpa ducimus nihil totam qui minus ratione
                    reprehenderit quis. Mollitia quasi fugit tenetur nam sunt laborum quae et iusto! Magnam similique
                    accusantium, explicabo alias necessitatibus expedita quis illum, vel nostrum laboriosam exercitationem eos
                    perferendis modi facere facilis, sed itaque. Ratione mollitia a amet quia rerum magnam, sunt culpa quo
                    repudiandae, atque, quos quam optio consequatur iste aperiam molestias rem perspiciatis. Culpa mollitia,
                    numquam cumque totam adipisci blanditiis eius accusamus qui labore! Impedit modi assumenda dolores aliquid
                    quaerat dolor iste adipisci inventore, ipsa labore culpa accusamus sed, a fugit ex! Dolores libero et sit
                    unde repudiandae consequuntur debitis magnam fuga, odio veniam fugit, ut, quae eius dignissimos. Quibusdam
                    optio accusantium deleniti corrupti rerum, expedita unde animi omnis tenetur ullam recusandae aliquam velit
                    placeat repudiandae ut minus neque esse ab ex exercitationem molestias dignissimos. Dicta provident aliquid
                    maiores. Porro explicabo harum velit consequuntur nesciunt, iste rem optio a eum vitae quos animi dolores
                    voluptatibus incidunt error aliquid adipisci. Voluptates possimus fugiat dicta iste hic doloremque similique
                    repellendus corporis veniam, magnam voluptatum temporibus ipsa tenetur a, veritatis sequi amet minus autem
                    aperiam officiis aspernatur, odit deleniti! Reiciendis necessitatibus et dolorum reprehenderit placeat
                    libero consequuntur earum laborum magnam ipsa ut at ex iure similique ad doloribus accusamus eligendi
                    aliquam natus soluta, omnis odit culpa dolorem rerum! Quibusdam recusandae odio velit ab earum enim eum
                    minima. Minus harum odio ratione iusto magni optio, accusamus alias quam veniam nisi, ex sequi sint tempore
                    officia iure tenetur! Iure corrupti vero itaque repudiandae! Totam, omnis illum. Architecto aliquam suscipit
                    esse quos dignissimos! Esse dolor fugit dolorem ad quod eum minima excepturi officia consequatur? Accusamus
                    magnam expedita at mollitia dolore amet, asperiores esse quis labore obcaecati adipisci, voluptates
                    reprehenderit odit perferendis ipsa sequi natus voluptatem ducimus aspernatur placeat voluptas? Maiores,
                    asperiores. Totam voluptate laudantium id. Necessitatibus maiores aperiam at consequuntur illum ullam velit
                    placeat blanditiis, reiciendis molestiae eveniet porro voluptate. Vero repudiandae deleniti iure
                    praesentium, explicabo quidem, ipsam officia fugiat, beatae error nesciunt neque. Laborum tempora debitis
                    mollitia libero vitae tenetur labore magni quas nemo, alias aut saepe blanditiis impedit maiores ipsa
                    assumenda voluptatibus error sit eligendi voluptatum accusamus esse enim nostrum? Laudantium, cum!</div>
            </div>
            <div class="student-module">
                <h3>Módulos del curso</h3>
                <div class="container">
                    <a href="../../pages/estudiante/modulos/inscripcion-proyecto.php">
                        <div class="seleccion">
                            <img src="../../img/propuesta-e.png" alt="">
                            <p>Propuesta de grado</p>
                        </div>
                    </a>
                </div>
                <div class="container">
                    <a href="../../pages/estudiante/modulos/anteproyecto-estudiante.php">
                        <div class="seleccion">
                            <img src="../../img/anteproyecto.png" alt="">
                            <p>Anteproyecto</p>
                        </div>
                    </a>
                </div>
                <div class="container">
                    <a href="../../pages/estudiante/modulos/proyecto-final-estudiante.php">
                        <div class="seleccion">
                            <img src="../../img/proyectof.png" alt="">
                            <p>Proyecto de grado</p>
                        </div>
                    </a>
                </div>
            </div>

            <div class="guia_arbol">
                <ul>
                    <li>
                        <i class="fas fa-folder" style="margin-right: 3px;"></i>
                        <label>Guia de investigación</label>
                        <ul>
                            <li>
                                <i class="fas fa-file-alt"></i>
                                <a href="">Propuesta de grado</a>
                            </li>
                            <li>
                                <i class="fas fa-file-alt"></i>
                                <a href="">Anteproyecto</a>
                            </li>
                            <li>
                                <i class="fas fa-file-alt"></i>
                                <a href="../../guide/guia_ing.pdf" download="Guia_proyecto_inv_ing.pdf">Proyecto de
                                    grado</a>
                            </li>
                        </ul>
                        <i class="bi bi-bell-fill" style="margin-right: 3px;"></i>
                        <label>Anuncios</label>
                        <ul>

                        </ul>
                    </li>
                </ul>
            </div>

        </div>
        <?php
        $buscar = "SELECT * FROM estudiante WHERE usuario =" . $_SESSION['usuario'];
        $dato = mysqli_query($conexion, $buscar);
        $registro = mysqli_fetch_array($dato);
        ?>

        <div class="estado_propuesta">
            <h3>Estado de su proyecto</h3>
            <label>
                <?php
                $estado = "SELECT estado FROM propuesta WHERE remitente =" . $_SESSION['usuario'];
                $dato2 = mysqli_query($conexion, $estado);
                $r = mysqli_fetch_array($dato2);
                echo $r['0'];
                ?>
            </label>
        </div>
    </div>
    <script>
        function activar() {
            // document.getElementById("menu-side").style.width = "50%";
            // document.getElementById("menu-side").style.transform = "translate-x(-0%)";
            document.getElementById("menu-side").style.left = "60%";
        }

        function cerrar() {
            document.getElementById("menu-side").style.left = "0%";
        }
    </script>

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