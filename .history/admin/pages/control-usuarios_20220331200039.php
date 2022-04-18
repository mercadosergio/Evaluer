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

    <title>Administración de usuarios</title>

    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/unicons.css">
    <link rel="stylesheet" href="../../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../../css/owl.theme.default.min.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- MAIN STYLE -->
    <link rel="stylesheet" href="../css/control-usuarios.css">
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

    <nav class="vistas_usuarios">
        <ul>
            <li><label class="panel-student" for="radio-estudiante">Estudiantes</label></li>
            <li><label class="panel-docente" for="radio-docente">Docentes</label></li>
            <li><label class="panel-coo" for="radio-coordinador">Coordinadores</label></li>
        </ul>
    </nav>

    <div id="tab" class="tab">
        <div class="secciones">
            <!--  Aqui empieza la seccion de administracion de ususarios tipo estudiantes -------------------------------------->
            <input type="radio" name="radio" checked id="radio-estudiante">
            <div class="tab1">
                <div class="container-tabla">
                    <table class="tabla-est">
                        <thead>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Primer apellido</th>
                            <th>Segundo apellido</th>
                            <th>Documento de identidad</th>
                            <th>Programa</th>
                            <th>Semestre</th>
                            <th>Acción</th>
                        </thead>

                        <?php
                        // $mostrar = "SELECT * FROM estudiante";
                        // $mostrar = "SELECT id,nombre,p_apellido,s_apellido,cedula,programa,semestre FROM estudiante ORDER BY id desc";
                        $mostrar_by_id = "SELECT id,nombre,p_apellido,s_apellido,cedula,programa,semestre FROM estudiante ORDER BY id";
                        $result = mysqli_query($conexion, $mostrar_by_id);

                        while ($filas = mysqli_fetch_array($result)) {
                            $id_registro = $filas['id'];
                        ?>
                            <tr class="valores">
                                <td><?php echo $filas['id'] ?></td>
                                <td><?php echo $filas['nombre'] ?></td>
                                <td><?php echo $filas['p_apellido'] ?></td>
                                <td><?php echo $filas['s_apellido'] ?></td>
                                <td><?php echo $filas['cedula'] ?></td>
                                <td><?php echo $filas['programa'] ?></td>
                                <td style="text-align: center;"><?php echo $filas['semestre'] ?></td>
                                <td class="botones_tabla">
                                    <a href="modificar-estudiante.php?id=<?php echo $filas['0'] ?>&nombre=<?php echo $filas['1'] ?>&p_apellido=<?php echo $filas['2'] ?> &s_apellido=<?php echo $filas['3'] ?> &cedula=<?php echo $filas['4'] ?> &programa=<?php echo $filas['5'] ?> &semestre=<?php echo $filas['6'] ?>
                                        " name="modificarEstudiante" class="btn-editar">Modificar</a>
                                    <form action="../../controller/eliminar-usuario.php" method="POST">
                                        <input type="text" name="user" hidden readonly value="<?php echo $filas['usuario'] ?>">
                                        <input type="text" name="getIdU" hidden readonly value="<?php echo $filas['id'] ?>">
                                        <input type="submit" value="Eliminar" name="eliminar" class="btn-eliminar">
                                    </form>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                </div>
            </div>

            <!--  Aqui empieza la seccion de administracion de ususarios tipo docente ---------------------------------------->
            <input type="radio" name="radio" id="radio-docente">
            <div class="tab2">
                <div class="container-tabla">
                    <table class="tabla-est">
                        <thead>
                            <!-- Encabezado de tabla -->
                            <tr>
                                <th>#</th>
                                <th>Nombres</th>
                                <th>Primer apellido</th>
                                <th>Segundo apellido</th>
                                <th>Documento de identidad</th>
                                <th>Programa</th>
                                <th>Acción</th>
                            </tr>
                        </thead>

                        <?php
                        $mostrar_docente_by_id = "SELECT id,nombres,p_apellido,s_apellido,cedula,programa FROM docente ORDER BY id";
                        $result = mysqli_query($conexion, $mostrar_docente_by_id);

                        while ($fila_docente = mysqli_fetch_array($result)) {
                            $id_registro_d = $fila_docente['id'];
                        ?>
                            <!-- Valores de la tabla -->
                            <tr>
                                <td><?php echo $fila_docente['id'] ?></td>
                                <td><?php echo $fila_docente['nombres'] ?></td>
                                <td><?php echo $fila_docente['p_apellido'] ?></td>
                                <td><?php echo $fila_docente['s_apellido'] ?></td>
                                <td><?php echo $fila_docente['cedula'] ?></td>
                                <td><?php echo $fila_docente['programa'] ?></td>
                                <td class="botones_tabla">
                                    <a href="modificar-docente.php?id=<?php echo $fila_docente['0'] ?>&nombres=<?php echo $fila_docente['1'] ?>
                                                &p_apellido=<?php echo $fila_docente['p_apellido'] ?> &s_apellido=<?php echo $fila_docente['3'] ?> &cedula=<?php echo $fila_docente['4'] ?> 
                                                &programa=<?php echo $fila_docente['5'] ?>
                                        " name="modificarDocente" class="btn-editar">Modificar</a>
                                    <form action="../../controller/eliminar-usuario.php" method="POST">
                                        <input type="text" name="user" hidden readonly value="<?php echo $fila_docente['usuario'] ?>">
                                        <input type="text" name="getIdU" hidden readonly value="<?php echo $fila_docente['id'] ?>">
                                        <input type="submit" value="Eliminar" name="eliminar_docente" class="btn-eliminar">
                                    </form>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                </div>
            </div>

            <!--  Aqui empieza la seccion de administracion de ususarios tipo coordinador ---------------------------------------->

            <input type="radio" name="radio" id="radio-coordinador">
            <div class="tab3">
                <div class="container-tabla">
                    <table class="tabla-est">
                        <thead>
                            <!-- Encabezado de tabla -->
                            <tr>
                                <th>#</th>
                                <th>Nombres</th>
                                <th>Primer apellido</th>
                                <th>Segundo apellido</th>
                                <th>Documento de identidad</th>
                                <th>Acción</th>
                            </tr>
                        </thead>

                        <?php
                        $mostrar_coo_by_id = "SELECT * FROM coordinador ORDER BY id";
                        $resultd = mysqli_query($conexion, $mostrar_coo_by_id);

                        while ($fila_coo = mysqli_fetch_array($resultd)) {
                            $id_registro_d = $fila_coo['id'];
                        ?>
                            <!-- Valores de la tabla -->
                            <tr>
                                <td><?php echo $fila_coo['id'] ?></td>
                                <td><?php echo $fila_coo['nombres'] ?></td>
                                <td><?php echo $fila_coo['p_apellido'] ?></td>
                                <td><?php echo $fila_coo['s_apellido'] ?></td>
                                <td><?php echo $fila_coo['cedula'] ?></td>
                                <td class="botones_tabla">
                                    <a href="modificar-coordinador.php?id=<?php echo $fila_coo['0'] ?>&nombres=<?php echo $fila_coo['1'] ?>
                                                &p_apellido=<?php echo $fila_coo['p_apellido'] ?> &s_apellido=<?php echo $fila_coo['3'] ?> &cedula=<?php echo $fila_coo['4'] ?>
                                                " name="modificarDocente" class="btn-editar">Modificar</a>
                                    <form action="../../controller/eliminar-usuario.php" method="POST">
                                        <input type="text" name="user" hidden readonly value="<?php echo $fila_coo['usuario'] ?>">
                                        <input type="text" name="getIdU" hidden readonly value="<?php echo $fila_coo['id'] ?>">
                                        <input type="submit" value="Eliminar" name="eliminar_docente" class="btn-eliminar">
                                    </form>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

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