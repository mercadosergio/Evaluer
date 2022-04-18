<?php
include("../../model/conexion.php");
session_start();
error_reporting(0);
$variable_sesion = $_SESSION['usuario'];

if ($variable_sesion == null || $variable_sesion = '') {
    // echo "NO TIENE AUTORIZACIÓN";
    header("location: ../../index.php");
    die();
}
include_once  '../../controller/nombre.php';
?>
<!doctype html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="../../evaluer.ico">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Propuestas</title>

    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/unicons.css">
    <link rel="stylesheet" href="../../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../../css/owl.theme.default.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- MAIN STYLE -->
    <link rel="stylesheet" href="../../css/revision-propuesta.css">

</head>

<body>
    <!-- MENU -->
    <nav class="navbar navbar-expand-sm navbar-light">
        <img src="../../img/aunar.png" class="aunar_logo">
        <a class="navbar-brand" href="../main-docente.php"><img class="logo" src="../../img/logo_p.png"></a>
        <div class="container">


            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <h3>DOCENTE</h3>
                <ul class="navbar-nav mx-auto">

                </ul>
                <ul class="log">
                    <li>
                        <a class="navbar-brand" href=""><i class='uil uil-user'></i>
                            <?php echo $nombre_usuario;
                            ?></a>
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
    <section class="lista-propuestas">
        <h3>Propuestas de grado</h3>
        <div class="filtro">

        </div>
        <div class="contenedor-titulo">
            <table class="">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th hidden>Linea de investigación</th>
                        <th>No. integrantes</th>
                        <th hidden>Asesor</th>
                        <th hidden>Lider</th>
                        <th>Programa</th>
                        <th>Semestre</th>
                        <th hidden>Descripción</th>
                        <th>Fecha y hora</th>
                        <th>Calificación</th>
                        <th>Acción</th>
                        <th hidden>Programa_id</th>
                    </tr>
                </thead>
                <?php
                $buscar = "SELECT * FROM docente WHERE usuario =" . $_SESSION['usuario'];
                $dato = mysqli_query($conexion, $buscar);
                $registro = mysqli_fetch_array($dato);
                ?>

                <?php
                $mostrar_by_fecha = "SELECT * FROM propuesta WHERE programa_id=" . $registro['programa_id'] . " ORDER BY fecha";
                $result = mysqli_query($conexion, $mostrar_by_fecha);

                while ($filas = mysqli_fetch_array($result)) {
                    $id_registro = $filas['id'];
                ?>
                    <tr>
                        <td style="max-width: 600px;"><?php echo $filas['titulo'] ?></td>
                        <td hidden><?php echo $filas['linea'] ?></td>
                        <td style="text-align: center;"><?php echo $filas['integrantes'] ?></td>
                        <td hidden><?php echo $filas['tutor'] ?></td>
                        <td hidden><?php echo $filas['lider'] ?></td>
                        <td><?php echo $filas['programa'] ?></td>
                        <td style="text-align: center;"><?php echo $filas['semestre'] ?></td>
                        <td hidden><?php echo $filas['descripcion'] ?></td>
                        <td hidden><?php echo $filas['grupo'] ?></td>
                        <td><?php echo $filas['fecha'] ?></td>
                        <form action="../../controller/calificar-propuesta.php" method="POST">
                            <td id="celdaCalif">
                                <input type="text" name="getIdPropuesta" hidden value="<?php echo $filas['id'] ?>">
                                <input type="text" class="estado" name="estado" style="text-transform:uppercase;" value="<?php echo $filas['estado'] ?>">
                            </td>
                            <td>
                                <input name="id_p" type="text" hidden value="<?php echo $filas['id'] ?>">

                                <button class="editbtn" type="button" data-target="#panel-propuesta">
                                    <label for="btn-panel" class="lbl-panel">
                                        Ver
                                    </label>
                                </button>
                                |
                                <input type="submit" name="calificar" value="Calificar" class="btn-estado" id="calificarN">
                            </td>
                        </form>
                        <td hidden><?php echo $filas['programa_id'] ?></td>
                    </tr>
                <?php
                }
                ?>

            </table>
        </div>
    </section>
    <input type="checkbox" id="btn-panel">
    <!-- Panel de vistas de propuestas -->
    <div class="modal">
        <div id="panel-propuesta" class="contenido_propuesta">
            <div class="header">

            </div>
            <label class="cerrar" for="btn-panel"><img src="https://img.icons8.com/color/50/000000/close-window.png" /></label>
            <div class="contenido">


                <input class="titulo" type="text" readonly id="titulo_id">

                <label>Linea de investigación:</label><input readonly id="linea" type="text" value="">

                <label class="lbl-programa">Programa:</label>
                <input readonly id="program" type="text">
                <label>Semestre:</label>
                <input readonly id="semestre" type="text">
                <label>Número de integrantes:</label>
                <input readonly id="num" class="texto-numero" type="text">
                <label>Nombre del tutor:</label>
                <input readonly id="tutor" type="text">
                <label>Nombre del lider:</label>
                <input readonly id="lid" type="text">

                <div class="descripcion">
                    <label>Descripción:</label>
                    <textarea name="lider" readonly id="descrip" cols="30" rows="4" name="description" value=""></textarea>
                </div>

                <label>Nombre de los integrantes:</label>
                <input style="width: 700px;" readonly id="n_integrantes" type="text">
                <label class="fecha">Fecha y hora:</label>
                <input type="text" id="time">

            </div>
        </div>
    </div>
    <script>
        // var nota = document.getElementById('estadoI');
        // if (nota.disabled = true) {
        //     document.getElementById('celdaCalif').addEventListener('click', function(e) {
        //         console.log('Vamos a habilitar el input text');
        //         nota.disabled = false;
        //     });
        // } else if (nota.disabled = false) {
        //     document.getElementById('calificarN').addEventListener('click', function(e) {
        //         console.log('Vamos a deshabilitar el input text');
        //         nota.disabled = true;
        //     });
        // }
    </script>
    <script>
        $('.editbtn').on('click', function() {
            $tr = $(this).closest('tr');
            var datos = $tr.children("td").map(function() {
                return $(this).text();
            });
            $('#titulo_id').val(datos[0]);
            $('#linea').val(datos[1]);
            $('#num').val(datos[2]);
            $('#tutor').val(datos[3]);
            $('#lid').val(datos[4]);
            $('#program').val(datos[5]);
            $('#semestre').val(datos[6]);
            $('#descrip').val(datos[7]);
            $('#n_integrantes').val(datos[8]);
            $('#time').val(datos[9]);

        });
    </script>
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