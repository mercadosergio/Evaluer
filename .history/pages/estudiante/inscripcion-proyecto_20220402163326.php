<?php
include("../../model/conexion.php");
session_start();
error_reporting(0);
$variable_sesion = $_SESSION['usuario'];

if ($variable_sesion == null || $variable_sesion = '') {
    header("location: ../../index.php");
    die();
}
include("../../controller/nombre.php");
?>
<!doctype html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="../../evaluer.ico">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Propuesta de grado</title>

    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/unicons.css">
    <link rel="stylesheet" href="../../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../../css/owl.theme.default.min.css">

    <!-- MAIN STYLE -->
    <link rel="stylesheet" href="../../css/inscripcion-styles.css">
    <link rel="stylesheet" href="../../css/scrollbar.css">

</head>

<body>
    <!-- MENU -->
    <nav class="navbar navbar-expand-sm navbar-light">
        <img src="../../img/aunar.png" class="aunar_logo">
        <a class="navbar-brand" href="../main-estudiante.php"><img class="logo" src="../../img/logo_p.png"></a>
        <div class="container">


            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <h3>ESTUDIANTE</h3>
                <ul class="navbar-nav mx-auto">
                    <li class="principal">
                        <a href="../main-estudiante.php" class="nav-link"><span data-hover="Principal">Principal</span></a>
                    </li>
                    
                    </li>
                </ul>

                <ul class="log">
                    <li>
                        <a class="navbar-brand" href=""><i class='uil uil-user'></i>
                            <label>
                                <?php echo $nombre_usuario;
                                ?>
                            </label>
                        </a>
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
    <section class="seccion-inscripcion">
        <div class="barra-titulo">
            <h3>A continuación diligencie los datos para la inscripción de su proyecto</h3>
        </div>
        <?php
        include("../../controller/controlador-propuesta.php");
        ?>
        <form method="POST" id="envio">
            <div class="formulario">
                <?php
                $fecha = date("Y-m-d H:i:s");
                ?>
                <table>
                <?php
                    $time_propuesta = $conexion->query("SELECT time_propuesta FROM estudiante WHERE usuario=" . $_SESSION['usuario']);
                    $tiempo = mysqli_fetch_array($time_propuesta);
                    ?>
                    <label>Título del proyecto:</label>
                    <input <?php echo (time() < $tiempo['0']) ? "disabled" : ''; ?> type="text" class="campotexto" name="titulo">
                    <label>Linea de investigación:</label><input <?php echo (time() < $tiempo['0']) ? "disabled" : ''; ?> type="text" class="campotexto" name="linea"></td>
               
                  
                        <td><label>Número de integrantes:</label><input <?php echo (time() < $tiempo['0']) ? "disabled" : ''; ?> type="number" max="3" min="1" class="camponumero" name="integrantes"></td>
                        <td><label>Nombre del asesor:</label><input disabled <?php echo (time() < $tiempo['0']) ? "disabled" : ''; ?> type="text" class="campotexto" name="tutor"></td>
                        <td style="margin-left: 30px;"><label>Nombre del lider:</label><input <?php echo (time() < $tiempo['0']) ? "disabled" : ''; ?> type="text" class="campotexto" name="lider"></td>
                    
                    <tr class="fila3">
                        <td><label>Programa:</label>
                            <select name="id_programa[]">
                                <?php
                                $buscar_programa = "SELECT programa,programa_id,semestre FROM estudiante WHERE usuario =" . $_SESSION['usuario'];
                                $resultado = mysqli_query($conexion, $buscar_programa);

                                $filas = mysqli_fetch_array($resultado);
                                echo '<option selected value="' . $filas['identificador'] . '">' . $filas['programa'] . '</option>';
                                ?>
                            </select>
                        </td>
                        <td colspan="2" style="width: 300px; margin-left: 30px;">
                            <label>Semestre:</label><input readonly type="number" max="9" min="1" class="camponumero" id="disable" name="semestre" value="<?php echo $filas['semestre']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <div class="descripcion">
                                <label>Descripción:</label><textarea <?php echo (time() < $tiempo['0']) ? "disabled" : ''; ?> cols="30" rows="6" name="description"></textarea>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"><label class="int">Nombres de los integrantes:</label><input <?php echo (time() < $tiempo['0']) ? "disabled" : ''; ?> placeholder="Separar por ','" type="text" class="campotexto" id="campo_integrantes" name="grupo">
                        </td>
                    </tr>
                </table>
                <div class="contenedor-btn">
                    <input type="datetime" name="fecha" hidden value="<?php echo $fecha; ?>">
                    <input <?php echo (time() < $tiempo['0']) ? "disabled" : ''; ?> type="submit" name="send" value="Enviar" class="btn-enviar">
                </div>

            

                <?php
                $fecha = date("Y-m-d H:i:s");
                ?>
                <table>
                <?php
                    $time_propuesta = $conexion->query("SELECT time_propuesta FROM estudiante WHERE usuario=" . $_SESSION['usuario']);
                    $tiempo = mysqli_fetch_array($time_propuesta);
                    ?>
                    <tr>
                        <td colspan="3"><label>Título del proyecto:</label><input <?php echo (time() < $tiempo['0']) ? "disabled" : ''; ?> type="text" class="campotexto" name="titulo"></td>
                    </tr>
                    <tr>
                        <td colspan="3"><label>Linea de investigación:</label><input <?php echo (time() < $tiempo['0']) ? "disabled" : ''; ?> type="text" class="campotexto" name="linea"></td>
                    </tr>
                    <tr class="fila3">
                        <td><label>Número de integrantes:</label><input <?php echo (time() < $tiempo['0']) ? "disabled" : ''; ?> type="number" max="3" min="1" class="camponumero" name="integrantes"></td>
                        <td><label>Nombre del asesor:</label><input disabled <?php echo (time() < $tiempo['0']) ? "disabled" : ''; ?> type="text" class="campotexto" name="tutor"></td>
                        <td style="margin-left: 30px;"><label>Nombre del lider:</label><input <?php echo (time() < $tiempo['0']) ? "disabled" : ''; ?> type="text" class="campotexto" name="lider"></td>
                    </tr>
                    <tr class="fila3">
                        <td><label>Programa:</label>
                            <select name="id_programa[]">
                                <?php
                                $buscar_programa = "SELECT programa,programa_id,semestre FROM estudiante WHERE usuario =" . $_SESSION['usuario'];
                                $resultado = mysqli_query($conexion, $buscar_programa);

                                $filas = mysqli_fetch_array($resultado);
                                echo '<option selected value="' . $filas['identificador'] . '">' . $filas['programa'] . '</option>';
                                ?>
                            </select>
                        </td>
                        <td colspan="2" style="width: 300px; margin-left: 30px;">
                            <label>Semestre:</label><input readonly type="number" max="9" min="1" class="camponumero" id="disable" name="semestre" value="<?php echo $filas['semestre']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <div class="descripcion">
                                <label>Descripción:</label><textarea <?php echo (time() < $tiempo['0']) ? "disabled" : ''; ?> cols="30" rows="6" name="description"></textarea>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"><label class="int">Nombres de los integrantes:</label><input <?php echo (time() < $tiempo['0']) ? "disabled" : ''; ?> placeholder="Separar por ','" type="text" class="campotexto" id="campo_integrantes" name="grupo">
                        </td>
                    </tr>
                </table>
                <div class="contenedor-btn">
                    <input type="datetime" name="fecha" hidden value="<?php echo $fecha; ?>">
                    <input <?php echo (time() < $tiempo['0']) ? "disabled" : ''; ?> type="submit" name="send" value="Enviar" class="btn-enviar">
                </div>

            </div>
        </form>
    </section>
    <section class="Evaluacion">

    </section>

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