<?php
include("../../model/conexion.php");
session_start();
error_reporting(0);
$variable_sesion = $_SESSION['usuario'];

if ($variable_sesion == null || $variable_sesion = '') {
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

    <title>Anteproyectos</title>

    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/unicons.css">
    <link rel="stylesheet" href="../../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../../css/owl.theme.default.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- MAIN STYLE -->
    <link rel="stylesheet" href="../../css/revision-anteproyecto.css">

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
                        <a class="navbar-brand" href=""><i class='uil uil-user'></i><?php echo $nombre_usuario;
                                                                                    ?></a>
                        <ul>
                            <li><a class="out" href="">Perfil</a></li>
                            <li><a class="out" href="">Cambiar contraseña</a></li>
                            <li><a class="out" href="../../controller/logout.php">Cerrar sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <section class="anteproyecto">
        <h3>Lista de anteproyectos</h3>
        <div class="filtro">
            <label>Programa:</label>
            <select name="programa[]">
                <?php
                $buscar_programa = "SELECT nombre FROM programas";
                $resultado = mysqli_query($conexion, $buscar_programa);

                while ($filas = mysqli_fetch_array($resultado)) {
                    echo '<option value="' . $filas['nombre'] . '">' . $filas['nombre'] . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="contenedor-titulo">
            <table class="ant">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Archivo</th>
                        <th>Comentarios</th>
                        <th>Programa</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Calificación</th>
                        <th>Acción</th>
                    </tr>
                </thead>

                <?php
                $mostrar_by_fecha = "SELECT * FROM anteproyecto a JOIN docente d ON a.programa_id = d.programa_id ORDER BY fecha";
                $result = mysqli_query($conexion, $mostrar_by_fecha);

                while ($filas = mysqli_fetch_array($result)) {
                    $id_registro = $filas['id'];
                ?>
                    <tr>
                        <td><?php echo $filas['id']; ?></td>
                        <td><a href="<?php echo $filas['documento']; ?>"><?php echo $filas['nombre']; ?></a></td>
                        <td><?php echo $filas['comentarios']; ?></td>
                        <td><?php echo $filas['programa']; ?></td>
                        <td><?php echo $filas['fecha']; ?></td>
                        <td><input type="text" name="estado" value="<?php echo $filas['estado']; ?>"></td>
                        <td><input type="text" name="nota" value="<?php echo $filas['calificacion']; ?>"></td>
                        <td>
                            <form id="resultados" action="../../controller/calificar-anteproyecto.php" method="POST">
                                <input name="getIdAnteproyecto" type="text" hidden value="<?php echo $filas['id'] ?>">
                                <input type="submit" name="evaluar" value="Evaluar" class="btn-nota">
                            </form>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </section>
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