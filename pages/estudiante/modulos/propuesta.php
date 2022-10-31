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
include("../../../model/Estudiante.php");

$usuario = new User();
$getProfile = $usuario->getProfileUser($_SESSION['usuario']);
$userP = mysqli_fetch_array($getProfile);

$getMyRole = $usuario->getStudentProfile();
$userE = mysqli_fetch_array($getMyRole);

$estudiante = new Student();
$myGroup = $estudiante->GroupByDi($userE['cedula']);

$row = mysqli_fetch_array($myGroup);
if ($userE['grupo_id'] <= 0) {
    header("location: ../index.php");
}

include("../../../controller/DeletePropuesta.php");
include("../../../controller/SendPropuesta.php");
date_default_timezone_set("America/Bogota");
?>
<!doctype html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="../../../evaluer.ico">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Propuesta de grado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../../utilities/loading/carga.css">
    <script src="../../../js/jquery-3.3.1.min.js"></script>
    <script src="../../../js/jquery-1.12.1.min.js"></script>
    <script src="../../../js/jquery-ui.js"></script>
    <link rel="stylesheet" href="../../../css/jquery-ui.css">
    <!-- MAIN STYLE -->
    <link rel="stylesheet" href="../../../css/propuesta.css">
    <link rel="stylesheet" href="../../../css/scrollbar.css">
    <link rel="stylesheet" href="../../../css/header.css">
    <link rel="stylesheet" href="../../../font/fontawesome-free-6.1.1-web/css/all.css">

    <script src="../../../font/fontawesome-free-6.0.0-web/js/solid.js"></script>
    <script src="../../../font/fontawesome-free-6.0.0-web/js/solid.min.js"></script>
    <script src="../../../font/fontawesome-free-6.0.0-web/js/brands.js"></script>
    <script src="../../../font/fontawesome-free-6.0.0-web/js/brands.min.js"></script>
    <script src="../../../font/9390efa2c5.js"></script>
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
    <div class="back">
        <div class="format">

            <div class="envio-f">
                <form action="" method="POST" id="envio">
                    <input type="hidden" name="id_grupo" value="<?php echo $userE['grupo_id'] ?>">
                    <div class="seccion-informacion">
                        <div class="layoutx2">
                            <?php
                            $res = new Metodos();
                            $fecha = date("Y-m-d H:i:s");
                            $getTime = $res->restrictPropuesta($userE['grupo_id']);
                            ?>

                            <input type="hidden" name="fecha" value="<?php echo $fecha; ?>">
                            <div class="cabecera">
                                <div class="subtitulo">
                                    <h3 class=""><i class="fas fa-network-wired"></i> Datos generales de la propuesta</h3>
                                </div>
                                <p class="info">
                                    Diligencie la información correspondiente a su propuesta de grado, con los datos
                                    requeridos
                                    para registrar su idea investigativa.
                                </p>
                            </div>

                            <div class="titulo">
                                <label class="lbl-titulo">Título del proyecto:</label>
                                <div id="contenedorInput">
                                    <input class="" <?php echo (time() < $getTime) ? "disabled" : ''; ?> type="text" class="campotexto" name="titulo">
                                    <i class="fa-solid fa-font"></i>
                                </div>
                            </div>

                            <div class="linea">
                                <label class="lbl-linea">Linea de investigación:</label>
                                <div id="contenedorInput">
                                    <select <?php echo (time() < $getTime) ? "disabled" : ''; ?> name="linea">
                                        <option selected value="123">Seleccione...</option>
                                        <?php
                                        $programa = $userE['programa'];
                                        $getLine = $res->listar("SELECT * FROM linea_investigacion WHERE programa = '$programa'");
                                        foreach ($getLine as $lista) {
                                        ?>
                                            <option value="<?php echo $lista['sublinea']; ?>">
                                                <?php echo $lista['linea'] . " - " . $lista['sublinea']; ?></option>
                                        <?php } ?>
                                    </select>
                                    <i class="fa-solid fa-diagram-project"></i>
                                </div>
                            </div>

                            <div class="asesor">
                                <label class="lbl-asesor">Nombre del asesor:</label>
                                <?php
                                $myself = $userE['nombre'] . " " . $userE['p_apellido'];
                                $group = $estudiante->getMyGroup($myself);
                                $valor = mysqli_fetch_array($group);
                                ?>
                                <div id="contenedorInput">
                                    <input class="" <?php echo (time() < $getTime) ? "disabled" : ''; ?> type="text" readonly id="disable" value="<?php echo $valor['nombre_asesor'] ?>" class="campotexto" name="tutor">
                                    <i class="fa-solid fa-user-tie"></i>
                                </div>
                            </div>

                            <div class="lider">
                                <label class="lbl-lider">Nombre completo del lider:</label>
                                <div id="contenedorInput">
                                    <input class="" <?php echo (time() < $getTime) ? "disabled" : ''; ?> type="text" class="campotexto" name="lider">
                                    <i class="fa-solid fa-user-pen"></i>
                                </div>
                            </div>

                            <div class="programa">
                                <label class="lbl-programa">Programa:</label>
                                <div id="contenedorInput">
                                    <select class="" name="id_programa[]">
                                        <option selected value="<?php echo $valor['programa'] ?>">
                                            <?php echo $valor['programa'] ?></option>
                                    </select>
                                    <i class="fa-solid fa-list-ol"></i>
                                </div>
                            </div>
                            <div class="semestre">
                                <label class="lbl-semsetre">Semestre:</label>
                                <div id="contenedorInput">
                                    <input class="" readonly type="number" max="9" min="1" class="camponumero" id="disable" name="semestre" value="<?php echo $valor['semestre']; ?>">
                                    <i class="fa-solid fa-layer-group"></i>
                                </div>
                            </div>
                            <div class="descripcion">
                                <label>Descripción:</label>
                                <textarea <?php echo (time() < $getTime) ? "disabled" : ''; ?> cols="30" rows="6" name="description"></textarea>
                                <i class="fa-solid fa-rectangle-list"></i>
                            </div>
                        </div>
                    </div>
                    <div class="miembros">

                        <h3><i class="bi bi-people-fill"></i> Equipo</h3>
                        <?php
                        $lista = $usuario->listar("SELECT * FROM estudiante WHERE grupo_id = " . $userE['grupo_id']);
                        $i = 0;
                        foreach ($lista as $int) {
                        ?>
                            <div class="component-miembro">
                                <div>
                                    <label class="sub">Documento de identidad:</label>
                                    <div id="contenedorInput">
                                        <input class="" <?php echo (time() < $getTime) ? "disabled" : ''; ?> type="text" value="<?php echo $int['cedula']; ?>" class="campotexto" readonly id="dni_estudiante<?php echo  $i + 2 ?>" name="dni_int<?php echo  $i + 2 ?>">
                                        <i class="fa-solid fa-user-pen"></i>
                                    </div>
                                </div>
                                <div>
                                    <label class="sub">Nombre:</label>
                                    <div id="contenedorInput">
                                        <input class="" <?php echo (time() < $getTime) ? "disabled" : ''; ?> type="text" value="<?php echo $int['nombre']; ?>" class="campotexto" readonly id="nombres_estudiante<?php echo  $i + 2 ?>" name="nombres_miembro<?php echo  $i + 2 ?>">
                                        <i class="fa-solid fa-user-pen"></i>
                                    </div>
                                </div>
                                <div>
                                    <label class="sub">Apellido:</label>
                                    <div id="contenedorInput">
                                        <input class="" <?php echo (time() < $getTime) ? "disabled" : ''; ?> type="text" value="<?php echo $int['p_apellido']; ?>" class="campotexto" readonly id="apellidos_estudiante<?php echo  $i + 2 ?>" name="apellidos_miembro<?php echo  $i + 2 ?>">
                                        <i class="fa-solid fa-user-pen"></i>
                                    </div>
                                </div>
                            </div><?php } ?>
                    </div>
                    <div id="interacion"></div>
                    <div class="contenedor-btn">
                        <input type="datetime" name="enviar" hidden value="<?php echo $fecha; ?>">
                        <button <?php echo (time() < $getTime) ? "disabled" : ''; ?> type="submit" name="send" class="btn-enviar mb-4">Enviar</button>
                    </div>
                </form>
            </div>
        </div>

        <form method="GET">
            <div class="details">
                <label><i class="fas fa-bell"></i> Notificaciones</label>

                <?php
                $listar = "SELECT * FROM propuesta WHERE grupo_id =" . $userE['grupo_id'] . " ORDER BY fecha";
                $prop = $res->listar($listar);
                if ($prop >= 1) {
                    if (time() < $getTime) {
                ?>
                        <div class="noti">
                            <div><i style="font-size: 20px;" class="bi bi-info-circle-fill"></i> Su propuesta ha sido enviada
                            </div>
                        </div>
                    <?php
                    }
                    foreach ($prop as $propuesta_state) {
                    ?>
                        <div class="notif">
                            <form method="POST">
                                <input hidden type="text" name="remitente" value="<?php echo $propuesta_state['remitente']; ?>">
                                <div> <label><?php echo $propuesta_state['titulo'] ?></label> </div>
                                <div class="action-edit">
                                    <a href=""><i class="edit fas fa-edit"></i></a>
                                </div>
                                <div class="action-delete">
                                    <button type="submit" name="del"><i class="trash fas fa-trash-alt"></i></button>
                                </div>
                                <div>
                                    <p class="<?php echo $propuesta_state['estado'] === 'aprobada' ? 'aprobada' : 'reprobada'; ?>">
                                        Estado: <?php echo $propuesta_state['estado']; ?></p>
                                </div>
                            </form>
                        </div>
                    <?php
                    }
                } else {
                    ?>
                    <div class="nothing">
                        <div><i style="font-size: 20px;" class="bi bi-info-circle-fill"></i> No hay notificaciones por el
                            momento</div>
                    </div>
                <?php
                }
                ?>
            </div>
        </form>
    </div>

    <script type="text/javascript">
        // $(document).ready(function() {
        //     // var second_select = document.getElementById('second-select').value;
        //     // $('#listaIntegrantes').val(1);
        //     recargarLista();

        //     $('#listaIntegrantes').change(function() {
        //         recargarLista();
        //     });
        // })
    </script>
    <script type="text/javascript">
        // function recargarLista() {
        //     $.ajax({
        //         type: "POST",
        //         url: "../../../utilities/datosInt.php",
        //         data: "numero=" + $('#listaIntegrantes').val() +
        //             "&programa=<?= $programa ?>&semestre=<?= $userE['semestre'] ?>",
        //         success: function(r) {
        //             $('#interacion').html(r);
        //         }
        //     });
        // }
    </script>

    <script>
        // document.getElementById("dni_int1").onchange = function() {
        //     alerta()
        // };

        // function alerta() {
        //     // Creando el objeto para hacer el request
        //     var request = new XMLHttpRequest();
        //     request.responseType = 'json';

        //     // Objeto PHP que consultaremos
        //     request.open("POST", "../../../controller/ObtenerEstudiante.php");

        //     // Definiendo el listener
        //     request.onreadystatechange = function() {
        //         // Revision si fue completada la peticion y si fue exitosa
        //         if (this.readyState === 4 && this.status === 200) {
        //             // Ingresando la respuesta obtenida del PHP
        //             document.getElementById("nombres_miembro1").value = this.response.nombres_miembro1;
        //             document.getElementById("apellidos_miembro1").value = this.response.apellidos_miembro1;
        //         }
        //     };

        //     // Recogiendo la data del HTML
        //     var myForm = document.getElementById("formSearch");
        //     var formData = new FormData(myForm);

        //     // Enviando la data al PHP
        //     request.send(formData);
        // }
    </script>
    <script>
        // document.getElementById("nombres_miembro1").addEventListener("keyup", getNombre)

        // function getNombre() {

        //     let inputCP = document.getElementById("nombres_miembro1").value
        //     let lista = document.getElementById("lista")

        //     if (inputCP.length > 0) {

        //         let url = "getNombre.php"
        //         let formData = new FormData()
        //         formData.append("nombres_miembro1", inputCP)

        //         fetch(url, {
        //                 method: "POST",
        //                 body: formData,
        //                 mode: "cors" //Default cors, no-cors, same-origin
        //             }).then(response => response.json())
        //             .then(data => {
        //                 lista.style.display = 'block'
        //                 lista.innerHTML = data
        //             })
        //             .catch(err => console.log(err))
        //     } else {
        //         lista.style.display = 'none'
        //     }
        // }

        // function mostrar(cp) {
        //     lista.style.display = 'none'
        //     alert("CP: " + cp)
        // }
    </script>
    <script>
        $(document).ready(function() {
            var items = <?= json_encode($array) ?>

            $("#dni_int1").autocomplete({
                source: items,
                select: function(event, item) {
                    console.log(item.item.value);
                    var params = {
                        estudiante: item.item.value
                    };
                    $.get("getNombre.php", params, function(response) {
                        var json = JSON.parse(response);
                        if (json.status == 200) {
                            $("#nombres_miembro1").val(json.nombre);
                            $("#apellidos_miembro1").val(json.p_apellido);
                        } else {

                        }
                    }); // ajax
                }
            });
        });
    </script>
    <script src="../../../utilities/loading/load.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
</body>

</html>