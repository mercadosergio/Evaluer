<?php

if (!isset($_SESSION)) {
    session_start();
}
$sesion = $_SESSION['usuario'];

if ($sesion == null || $sesion = '') {
    header("location: ../../../index.php");
    die();
}
include_once("../../../model/Metodos.php");
include("../../../model/UserModel.php");

$usuario = new User();
$getProfile = $usuario->getProfileUser($_SESSION['usuario']);
$userP = mysqli_fetch_array($getProfile);

include("../../../model/Estudiante.php");
$getMyRole = $usuario->getStudentProfile();
$userE = mysqli_fetch_array($getMyRole);

$estudiante = new Student();
$myGroup = $estudiante->GroupByDi($userE['cedula']);

date_default_timezone_set("America/Bogota");
require("../../../controller/AsignarTeam.php");
?>
<!doctype html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="../../../evaluer.ico">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Equipo de trabajo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <link rel="stylesheet" href="../../../utilities/loading/carga.css">
    <!-- MAIN STYLE -->
    <link rel="stylesheet" href="../../../css/team.css">
    <link rel="stylesheet" href="../../../css/scrollbar.css">
    <link rel="stylesheet" href="../../../css/header.css">

    <script src="../../../js/jquery-3.3.1.min.js"></script>
    <script src="../../../js/jquery-1.12.1.min.js"></script>
    <script src="../../../js/jquery-ui.js"></script>
    <link rel="stylesheet" href="../../../css/jquery-ui.css">
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
            <h3>ESTUDIANTE</h3>
            <ul class="navbar-nav mx-auto">
                <li class="principal">
                    <a href="../index.php" class="nav-link"><span data-hover="Principal"><label for="">Principal</label></a>
                </li>
            </ul>

            <ul class="">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img style="width: 40px; height: 40px; border-radius: 50%;" src="../../../files/photos/<?php echo $userP['foto'] == null ? 'default.png' :  $userP['foto']; ?>" alt="">
                        <?php echo $userP['nombre']; ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Perfil</a></li>
                        <li><a class="dropdown-item" href="pqrE.php">Solicitud PQR</a></li>
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
    <div class="format">
        <?php
        if ($myGroup->num_rows > 0 && $userE['grupo_id'] != 1) {
            $row = mysqli_fetch_array($myGroup);
        ?>
            <div class="info">
                <div class="title">
                    <h3><i class="bi bi-people-fill"></i>Mi grupo</h3>
                </div>
                <div class="adicional">
                    <div>
                        <label for="">Programa: </label>
                        <p><?php echo $row['programa'] ?></p>
                    </div>
                    <div>
                        <label for="">Semestre: </label>
                        <p><?php echo $row['semestre'] ?></p>
                    </div>
                    <div>
                        <label for="">Periodo: </label>
                        <p><?php echo $row['periodo'] ?></p>
                    </div>

                    <div>
                        <label for="">Nombre del asesor: </label>
                        <p><?php echo $row['nombre_asesor'] ?></p>
                    </div>
                </div>
                <h3>Integrantes</h3>
                <?php
                $lista = $usuario->listar("SELECT * FROM estudiante WHERE grupo_id = " . $userE['grupo_id']);
                $i = 0;
                foreach ($lista as $int) {
                    if ($row['di_integrante1'] != 0) {
                ?>
                        <div>
                            <div class="ref">
                                <i class="fa-solid fa-<?php echo $i += 1; ?>"></i>
                                <label>Nombre:</label>
                                <p><?php echo $int['nombre'] ?></p>
                            </div>
                            <div class="ref">
                                <label>Apellidos:</label>
                                <p><?php echo $int['p_apellido'] . " " . $int['s_apellido'] ?></p>
                            </div>
                            <div class="ref">
                                <label>Documento de identidad:</label>
                                <p><?php echo $int['cedula'] ?></p>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>

            </div>
        <?php
        } else {

        ?>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="form" method="POST">
                <h3 class="text-center">Grupo de trabajo</h3>
                <!-- Progress bar -->
                <div class="progressbar">
                    <div class="progress" id="progress"></div>
                    <div class="progress-step progress-step-active" data-title="Introducción"></div>
                    <div class="progress-step" data-title="Número de integrantes"></div>
                    <div class="progress-step" data-title="Información"></div>
                </div>

                <!-- Steps -->
                <div class="form-step form-step-active">
                    <div class="content">
                        <div class="intro">
                            <img src="../../../img/team1.png" alt="">
                            Registre su grupo de trabajo para este curso de investigación y proyectos
                        </div>
                    </div>
                    <div class="">
                        <a href="#" class="btn btn-next width-50 ml-auto">Siguiente<i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
                <!-- Step 2 -->
                <div class="form-step">
                    <div class="content">
                        <div class="container-selector">
                            <label>Número de integrantes:</label>
                            <div id="contenedorInput" class="selector">
                                <select id="listaCantidad" name="numIntegrantes[]">
                                    <option selected value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                                <i class="fa-solid fa-users"></i>
                            </div>
                        </div>
                    </div>
                    <div class="btns-group">
                        <a href="#" class="btn btn-prev"><i class="bi bi-arrow-left"></i></i>Atrás</a>
                        <a href="#" class="btn btn-next">Siguiente<i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
                <!-- Step 3 -->
                <div class="form-step">
                    <input type="text" hidden value="<?php echo $userE['programa'] ?>" name="programa">
                    <input type="text" hidden value="<?php echo $userE['semestre'] ?>" name="semestre">
                    <div class="content">
                        <div id="ciclo"></div>
                    </div>
                    <div class="btns-group">
                        <a href="#" class="btn btn-prev"><i class="bi bi-arrow-left"></i></i>Atrás</a>
                        <button type="submit" class="btn" name="save">Aceptar</button>
                    </div>
                </div>
            </form>
        <?php
        }

        ?>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            reloadList();

            $('#listaCantidad').change(function() {
                reloadList();
            });
        })
    </script>
    <script type="text/javascript">
        function reloadList() {
            $.ajax({
                type: "POST",
                url: "../../../utilities/generarForm.php",
                data: "numero=" + $('#listaCantidad').val(),
                success: function(r) {
                    $('#ciclo').html(r);
                }
            });
        }
    </script>


    <script>
        const prevBtns = document.querySelectorAll(".btn-prev");
        const nextBtns = document.querySelectorAll(".btn-next");
        const progress = document.getElementById("progress");
        const formSteps = document.querySelectorAll(".form-step");
        const progressSteps = document.querySelectorAll(".progress-step");

        let formStepsNum = 0;

        nextBtns.forEach((btn) => {
            btn.addEventListener("click", () => {
                formStepsNum++;
                updateFormSteps();
                updateProgressbar();
            });
        });

        prevBtns.forEach((btn) => {
            btn.addEventListener("click", () => {
                formStepsNum--;
                updateFormSteps();
                updateProgressbar();
            });
        });

        function updateFormSteps() {
            formSteps.forEach((formStep) => {
                formStep.classList.contains("form-step-active") &&
                    formStep.classList.remove("form-step-active");
            });

            formSteps[formStepsNum].classList.add("form-step-active");
        }

        function updateProgressbar() {
            progressSteps.forEach((progressStep, idx) => {
                if (idx < formStepsNum + 1) {
                    progressStep.classList.add("progress-step-active");
                } else {
                    progressStep.classList.remove("progress-step-active");
                }
            });

            const progressActive = document.querySelectorAll(".progress-step-active");

            progress.style.width =
                ((progressActive.length - 1) / (progressSteps.length - 1)) * 100 + "%";
        }
    </script>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
    <script src="../../../font/d029bf1c92.js"></script>
    <script src="../../../utilities/loading/load.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
</body>

</html>