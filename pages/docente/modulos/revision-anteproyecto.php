<?php
include("../../../model/conexion.php");
session_start();
error_reporting(0);
$variable_sesion = $_SESSION['usuario'];

if ($variable_sesion == null || $variable_sesion = '') {
    header("location: ../../../index.php");
    die();
}

include_once  '../../../controller/nombre.php';
?>
<!doctype html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="../../../evaluer.ico">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Anteproyectos</title>

    <link rel="stylesheet" href="../../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../css/unicons.css">
    <link rel="stylesheet" href="../../../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../../../css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../../../utilities/loading/carga.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <!-- MAIN STYLE -->
    <link rel="stylesheet" href="../../../css/revision-anteproyecto.css">

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
        <div class="container">

            <div class="collapse navbar-collapse" id="navbarNav">
                <h3>DOCENTE</h3>
                <ul class="navbar-nav mx-auto">

                </ul>
                <ul class="log">
                    <li>
                        <a class="navbar-brand" href=""><i class='uil uil-user'></i><?php echo $nombre_usuario;
                                                                                    ?></a>
                        <ul>
                            <li><a class="out" href="">Perfil</a></li>
                            <li><a class="out" href="../../../support/account.php">Cambiar contraseña</a></li>
                            <li><a class="out" href="../../../controller/logout.php">Cerrar sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="anteproyecto">
        <h3>Historial de anteproyectos</h3>
        <label>Filtro de busqueda:</label>
        <div class="search-registro">
            <div class="contenedor">
                <input type="search" id="search" placeholder="Search..." />
                <button class="icon" name="buscar"><i class="fa fa-search"></i></button>
            </div>
        </div>
        <div class="contenedor-titulo">
            <table id="tabla" class="ant">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Título</th>
                        <th>Archivo</th>
                        <th>Comentarios</th>
                        <th hidden>Programa</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Calificación</th>
                        <th>Observaciones</th>
                        <th hidden>Acción</th>
                    </tr>
                </thead>
                <tbody id="contenido_tabla">
                    <?php
                    $buscar = "SELECT * FROM docente WHERE usuario =" . $_SESSION['usuario'];
                    $dato = mysqli_query($conexion, $buscar);
                    $registro = mysqli_fetch_array($dato);
                    ?>
                    <?php
                    $mostrar_by_fecha = "SELECT * FROM anteproyecto WHERE programa_id=" . $registro['programa_id'] . " ORDER BY fecha";
                    $result = mysqli_query($conexion, $mostrar_by_fecha);

                    while ($filas = mysqli_fetch_array($result)) {
                        $id_registro = $filas['0'];
                    ?>
                        <tr>
                            <form action="../../../controller/evaluate-anteproyecto.php" method="POST">
                                <td><?php echo $filas['0']; ?></td>
                                <td><?php echo $filas['titulo']; ?></td>
                                <td><a href="<?php echo $filas['documento']; ?>"><?php echo $filas['nombre']; ?></a></td>
                                <td><?php echo $filas['comentarios']; ?></td>
                                <td hidden><?php echo $filas['programa']; ?></td>
                                <td><?php echo $filas['fecha']; ?></td>
                                <td><input type="text" name="estado" value="<?php echo $filas['estado'] ?>" style="text-transform:uppercase;"></td>
                                <td><input type="text" name="nota" value="<?php echo $filas['calificacion'] ?>"></td>
                                <td>
                                    <!-- <button type="button" class="btn btn-secondary" data-bs-toggle="popover" title="Popover title" data-bs-content="<textarea placeholder=" Escriba aquí" name="observacion" id="" cols="30" rows="10"><?php echo $filas['observaciones']; ?></textarea>" data-placement="bottom">Click to toggle popover</button> -->
                                    <ul class="o" style="color: black; background: white;">
                                        <li>
                                            <label for="#radio_d" style="width: 100px; height: 20px; text-overflow: ellipsis; overflow: hidden;
                                            white-space: nowrap;"><?php echo $filas['observaciones']; ?></label>
                                            <input id="radio_d" type="radio">
                                            <ul class="texto_o">
                                                <li>
                                                    <textarea placeholder="Escriba aquí" name="observacion" id="" cols="30" rows="10"><?php echo $filas['observaciones']; ?>
                                                </textarea>

                                                </li>
                                                <input name="getIdAnteproyecto" type="text" hidden value="<?php echo $filas['0'] ?>">
                                                <button type="submit" name="evaluar" class="btn-nota btn btn-primary">Guardar</button>
                                                <!-- <input type="submit" name="evaluar" value="Evaluar" class="btn-nota"> -->
                                            </ul>
                                        </li>
                                    </ul>
                                </td>
                                <td hidden>

                                    <script>
                                        // $("#tabla").click(function() {
                                        //     $("#resultados").submit();
                                        // });
                                    </script>
                                </td>
                            </form>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        // const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
        // const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
        $(function() {
            $('[data-bs-toggle="popover"]').popover();
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#search").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#contenido_tabla tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>

    <script>
        var nota = document.getElementById('notaI');
        if (nota.disabled = true) {
            document.getElementById('celdaNota').addEventListener('click', function(e) {
                console.log('Vamos a habilitar el input text');
                nota.disabled = false;
            });
        } else if (nota.disabled = false) {
            document.getElementById('calificarN').addEventListener('click', function(e) {
                console.log('Vamos a deshabilitar el input text');
                nota.disabled = true;
            });
        }
    </script>
    <script>
        // const popover = new bootstrap.Popover('.example-popover', {
        //     container: 'body'
        // })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>

    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous"> -->
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

</body>

</html>