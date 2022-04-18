<?php
include("../model/conexion.php");
session_start();
error_reporting(0);

$variable_sesion = $_SESSION['usuario'];

if ($variable_sesion == null || $variable_sesion = '') {
    header("location: ../index.php");
    die();
}
// include_once  '../controller/nombre.php';
?>

<!doctype html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="../evaluer.ico">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Aministrador</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/unicons.css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../css/owl.theme.default.min.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- MAIN STYLE -->
    <link rel="stylesheet" href="css/admin.css">
    <!-- <script src="../js/action/tab.js" defer></script> -->
</head>
<style>
    .resaltar {
        background-color: yellow;
    }
</style>

<body>
    <!-- MENU -->
    <nav class="navbar navbar-expand-sm navbar-light">
        <img src="../img/aunar.png" class="aunar_logo">
        <a class="navbar-brand" href="index.php"><img class="logo" src="../img/logo_p.png"></a>
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
                    <li>
                        <a class="navbar-brand" href=""><i class='uil uil-user'></i>
                            <label><?php echo $_SESSION['usuario'];
                                    ?>
                            </label>
                        </a>
                        <ul>
                            <li><a class="out" href="">Perfil</a></li>
                            <li><a class="out" href="../support/change-password.php">Cambiar contraseña</a></li>
                            <li><a class="out" href="../controller/logout.php">Cerrar sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
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
                <div class="name"><span><?php echo $_SESSION['usuario'] ?></span></div>
            </div>
        </div>
        <!-- Items -->
        <div class="menu-items">
            <label for="radio-docente">
                <div class="item">
                    <a href="#tab2">
                        <div class="title">
                            <label for="radio-docente">Docentes</label>
                        </div>
                    </a>
                </div>
            </label>
            <div class="separator">

            </div>
            <label for="radio-estudiante">
                <div class="item">
                    <a href="#tab1">
                        <div class="title">
                            <label for="radio-estudiante">Estudiantes</label>
                        </div>
                    </a>
                </div>
            </label>
            <div class="separator">

            </div>
            <!-- <label for="radio-coordinador"> -->
            <div class="item">
                <a href="#tab3">
                    <div class="title">
                        <label for="radio-coordinador">Coordinadores</label>
                    </div>
                </a>
            </div>
            <!-- </label> -->
        </div>
    </div>


    <section class="admin-profile-usuario">
        <div class="opciones_admin">
            <div class="separation">
                <a href="">
                    <div class="option_ad">
                        <h2>Registro de usuario</h2>
                        <center><i class="fas fa-user-plus"></i></center>
                    </div>
                </a>
            </div>
            
                <div class="separation">
                    <a href="">
                        <div class="option_ad">
                            <h2>Registro de usuario</h2>
                            <center><i class="fas fa-user-plus"></i></center>
                        </div>
                    </a>
                </div>
            
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
                        <div class="contenido_general">
                            <div class="content">
                                <h3>Lista de estudiantes</h3>

                                <label>Buscar un usuario:</label>
                                <div class="search-user">
                                    <div class="contenedor">
                                        <input type="search" id="search" placeholder="Search..." />
                                        <button class="icon" name="buscar"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>

                                <div>
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
                                                    <a href="pages/modificar-estudiante.php?id=<?php echo $filas['0'] ?>&nombre=<?php echo $filas['1'] ?>&p_apellido=<?php echo $filas['2'] ?> &s_apellido=<?php echo $filas['3'] ?> &cedula=<?php echo $filas['4'] ?> &programa=<?php echo $filas['5'] ?> &semestre=<?php echo $filas['6'] ?>
                                        " name="modificarEstudiante" class="btn-editar">Modificar</a>
                                                    <form action="../controller/eliminar-usuario.php" method="POST">
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
                                <form action="../controller/controlador-admin.php" method="POST">
                                    <h3 class="registro-estudiantes">Registro de usuario - Estudiante</h3>
                                    <div id="cambiar" class="formulario-add-user">
                                        <!-- Formulario para registrar un usuario de tipo estudiante -->
                                        <div class="campos">
                                            <div class="col_registro">
                                                <label for="">Nombres:</label><input placeholder="Nombres" required type="text" class="campotexto" name="nombre">
                                                <label for="">Segundo apellido:</label><input placeholder="Segundo apellido" required type="text" class="campotexto" name="s_apellido">
                                                <div class="programa_division">
                                                    <label>Programa:</label>
                                                    <select name="programa_id[]" class="programa-s">
                                                        <option selected value="1">Seleccione...</option>
                                                        <?php
                                                        $buscar_programa = "SELECT * FROM programas";
                                                        $resultado = mysqli_query($conexion, $buscar_programa);

                                                        while ($filas = mysqli_fetch_array($resultado)) {
                                                            echo '<option value="' . $filas['identificador'] . '">' . $filas['nombre'] . '</option>';
                                                        }
                                                        ?>
                                                    </select>

                                                    <label>Semestre:</label>
                                                    <input required type="number" max="9" min="6" class="camponumero" name="semestre">
                                                </div>
                                            </div>
                                            <div class="col_registro">
                                                <label>Primer apellido:</label><input placeholder="Primer apellido" required type="text" class="campotexto" name="p_apellido">
                                                <label>Documento de identidad:</label><input placeholder="Documento de identidad" required type="text" class="campotexto" name="cedula">
                                                <label>Email:</label><input placeholder="Email" required type="text" class="campotexto" name="email">
                                            </div>
                                        </div>
                                        <input type="submit" name="agregar_e" class="btn-agregar" value="Registrar">
                                    </div>

                                </form>
                            </div>

                            <script src="../alerts/confirmar.js"></script>
                        </div>
                    </div>
                    <!--  Aqui empieza la seccion de administracion de ususarios tipo docente ---------------------------------------->
                    <input type="radio" name="radio" id="radio-docente">
                    <div class="tab2">
                        <div class="contenido_general">
                            <div class="content">
                                <h3>Lista de docentes</h3>

                                <label>Buscar un usuario:</label>
                                <div class="search-user">
                                    <div class="contenedor">
                                        <input type="search" id="search" placeholder="Search..." />
                                        <button class="icon" name="buscar"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>

                                <div>
                                    <table class="tabla_doc">
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
                                                    <a href="pages/modificar-docente.php?id=<?php echo $fila_docente['0'] ?>&nombres=<?php echo $fila_docente['1'] ?>
                                                &p_apellido=<?php echo $fila_docente['p_apellido'] ?> &s_apellido=<?php echo $fila_docente['3'] ?> &cedula=<?php echo $fila_docente['4'] ?> 
                                                &programa=<?php echo $fila_docente['5'] ?>
                                        " name="modificarDocente" class="btn-editar">Modificar</a>
                                                    <form action="../controller/eliminar-usuario.php" method="POST">
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
                                <form action="../controller/controlador-admin.php" method="POST">
                                    <h3 class="registro-estudiantes">Registro de usuario - Docente</h3>
                                    <div id="cambiar" class="formulario-add-user">

                                        <!-- Formulario para registrar un usuario de tipo docente -->
                                        <div class="campos">
                                            <div class="col_registro">
                                                <label for="">Nombre:</label><input placeholder="Nombre" required type="text" class="campotexto" name="nombre">
                                                <label for="">Segundo apellido:</label><input placeholder="Segundo apellido" required type="text" class="campotexto" name="s_apellido">
                                                <div class="programa_division">
                                                    <label>Programa:</label>
                                                    <select name="programa_id[]" class="programa-s">
                                                        <option selected value="1">Seleccione...</option>
                                                        <?php
                                                        $buscar_programa = "SELECT nombre,identificador FROM programas";
                                                        $resultado = mysqli_query($conexion, $buscar_programa);

                                                        while ($filas = mysqli_fetch_array($resultado)) {
                                                            echo '<option value="' . $filas['identificador'] . '">' . $filas['nombre'] . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col_registro">
                                                <label>Primer apellido:</label><input placeholder="Primer apellido" required type="text" class="campotexto" name="p_apellido">
                                                <label>Documento de identidad:</label><input placeholder="Documento de identidad" required type="text" class="campotexto" name="cedula">
                                                <label>Email:</label><input placeholder="Email" required type="text" class="campotexto" name="email">
                                            </div>
                                        </div>
                                        <input type="submit" name="agregar_docente" class="btn-agregar" value="Registrar">
                                    </div>
                                </form>
                            </div>

                            <script src="../alerts/confirmar.js"></script>
                        </div>
                    </div>
                    <!--  Aqui empieza la seccion de administracion de ususarios tipo coordinador ---------------------------------------->

                    <input type="radio" name="radio" id="radio-coordinador">
                    <div class="tab3">
                        <div class="contenido_general">
                            <div class="content">
                                <h3>Coordinacción académica</h3>

                                <label>Buscar un usuario:</label>
                                <div class="search-user">
                                    <div class="contenedor">
                                        <input type="search" id="search" placeholder="Search..." />
                                        <button class="icon" name="buscar"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>

                                <div>
                                    <table class="tabla_doc">
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
                                                    <a href="pages/modificar-coordinador.php?id=<?php echo $fila_coo['0'] ?>&nombres=<?php echo $fila_coo['1'] ?>
                                                &p_apellido=<?php echo $fila_coo['p_apellido'] ?> &s_apellido=<?php echo $fila_coo['3'] ?> &cedula=<?php echo $fila_coo['4'] ?>
                                                " name="modificarDocente" class="btn-editar">Modificar</a>
                                                    <form action="../controller/eliminar-usuario.php" method="POST">
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
                                <form action="../controller/controlador-admin.php" method="POST">
                                    <h3 class="registro-estudiantes">Registro de usuario - Coordinador</h3>
                                    <div id="cambiar" class="formulario-add-user">
                                        <!-- Formulario para registrar un usuario de tipo coordinador -->
                                        <div class="campos">
                                            <div class="col_registro">
                                                <label for="">Nombre:</label><input placeholder="Nombre" required type="text" class="campotexto" name="nombre">
                                                <label for="">Segundo apellido:</label><input placeholder="Segundo apellido" required type="text" class="campotexto" name="s_apellido">
                                                <label>Email:</label><input placeholder="Email" required type="text" class="campotexto" name="email">
                                            </div>
                                            <div class="col_registro">
                                                <label>Primer apellido:</label><input placeholder="Primer apellido" required type="text" class="campotexto" name="p_apellido">
                                                <label>Documento de identidad:</label><input placeholder="Documento de identidad" required type="text" class="campotexto" name="cedula">
                                            </div>
                                        </div>
                                        <input type="submit" name="agregar_coo" class="btn-agregar" value="Registrar">
                                    </div>
                                </form>
                            </div>

                            <script src="../alerts/confirmar.js"></script>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <script src="../font/9390efa2c5.js"></script>
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/Headroom.js"></script>
    <script src="../js/jQuery.headroom.js"></script>
    <script src="../js/owl.carousel.min.js"></script>
    <script src="../js/smoothscroll.js"></script>
    <script src="../js/custom.js"></script>

</body>

</html>