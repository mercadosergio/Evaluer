<?php

include("../../model/Metodos.php");
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
    <link rel="stylesheet" href="../../utilities/loading/carga.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- MAIN STYLE -->
    <link rel="stylesheet" href="../css/control-usuarios.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
</head>

<body>
    <!-- Pantalla de carga -->
    <div id="contenedor_carga">
        <div id="carga"></div>
    </div>
    <!-- MENU -->
    <nav class="navbar navbar-expand-sm navbar-light">
        <img src="../../img/aunar.png" class="aunar_logo">
        <a class="navbar-brand" href="../index.php"><img class="logo" src="../../img/logo_p.png"></a>
        <div class="container">

            <div class="collapse navbar-collapse" id="navbarNav">
                <h3>ADMINISTRADOR</h3>
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                    </li>
                </ul>

                <ul class="log">
                    <li class="">

                        <ul>
                            <li><a class="out" href="">Perfil</a></li>
                            <li><a class="out" href="../../support/account.php">Cambiar contraseña</a></li>
                            <li><a class="out" href="../../controller/logout.php">Cerrar sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div>
        <div class="tabs-container">
            <div class="box">
                <i class="fa fa-search"></i>
                <input type="search" id="search" placeholder="Search..." />
            </div>
            <ul class="tabs">
                <li class="active">
                    <a href="">Estudiantes</a>
                </li>
                <li>
                    <a href="">Asesores</a>
                </li>
                <li>
                    <a href="">Coordinadores</a>
                </li>
            </ul>
            <div class="tabs-content">
                <div class="tabs-panel active" data-index="0">
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
                        <tbody id="userInfo">
                            <?php

                            $obj = new Metodos();
                            $sql = "SELECT id,nombre,p_apellido,s_apellido,cedula,programa,semestre,usuario FROM estudiante ORDER BY id";
                            $datos = $obj->listar($sql);

                            foreach ($datos as $key) {
                            ?>
                                <tr class="valores">
                                    <td><?php echo $key['id'] ?></td>
                                    <td><?php echo $key['nombre'] ?></td>
                                    <td><?php echo $key['p_apellido'] ?></td>
                                    <td><?php echo $key['s_apellido'] ?></td>
                                    <td><?php echo $key['cedula'] ?></td>
                                    <td><?php echo $key['programa'] ?></td>
                                    <td style="text-align: center;"><?php echo $key['semestre'] ?></td>
                                    <td class="botones_tabla">
                                        <a href="modificar-estudiante.php?id=<?php echo $key['id'] ?>&nombre=<?php echo $key['nombre'] ?>&p_apellido=<?php echo $key['p_apellido'] ?> &s_apellido=<?php echo $key['s_apellido'] ?> &cedula=<?php echo $key['cedula'] ?> &programa=<?php echo $key['programa'] ?> &semestre=<?php echo $key['semestre'] ?>
                                        " name="modificarEstudiante" class="btn-editar">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <form action="../../controller/eliminar-usuario.php" method="POST">
                                            <input hidden type="text" name="user" readonly value="<?php echo $key['usuario'] ?>">
                                            <input hidden type="text" name="getIdU" readonly value="<?php echo $key['id'] ?>">
                                            <button type="submit" value="Eliminar" name="eliminar" class="btn-eliminar"><i class="bi bi-trash-fill"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="tabs-panel" data-index="1">
                    <table class="tabla-est">
                        <thead>
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
                        <tbody id="userInfo">
                            <?php
                            $sql2 = "SELECT * FROM docente ORDER BY id";
                            $datos_docente = $obj->listar($sql2);

                            foreach ($datos_docente as $key_d) {
                                $id_registro_d = $key_d['id'];
                            ?>
                                <tr>
                                    <td><?php echo $key_d['id'] ?></td>
                                    <td><?php echo $key_d['nombres'] ?></td>
                                    <td><?php echo $key_d['p_apellido'] ?></td>
                                    <td><?php echo $key_d['s_apellido'] ?></td>
                                    <td><?php echo $key_d['cedula'] ?></td>
                                    <td><?php echo $key_d['programa'] ?></td>
                                    <td class="botones_tabla">
                                        <a href="modificar-docente.php?id=<?php echo $key_d['id'] ?>&nombres=<?php echo $key_d['nombres'] ?>
                                                &p_apellido=<?php echo $key_d['p_apellido'] ?> &s_apellido=<?php echo $key_d['s_apellido'] ?> &cedula=<?php echo $key_d['cedula'] ?> 
                                                &programa=<?php echo $key_d['programa'] ?>
                                        " name="modificarDocente" class="btn-editar"> <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <form action="../../controller/eliminar-usuario.php" method="POST">
                                            <input type="text" name="user" hidden readonly value="<?php echo $key_d['usuario'] ?>">
                                            <input type="text" name="getIdU" hidden readonly value="<?php echo $key_d['id'] ?>">
                                            <button type="submit" value="Eliminar" name="eliminar" class="btn-eliminar"><i class="bi bi-trash-fill"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="tabs-panel" data-index="2">
                    <table class="tabla-est">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombres</th>
                                <th>Primer apellido</th>
                                <th>Segundo apellido</th>
                                <th>Documento de identidad</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody id="userInfo">
                            <?php
                            $sql3 = "SELECT * FROM coordinador ORDER BY id";
                            $datos_c = $obj->listar($sql3);

                            foreach ($datos_c as $key_c) {
                                $id_registro_d = $key_c['id'];
                            ?>
                                <tr>
                                    <td><?php echo $key_c['id'] ?></td>
                                    <td><?php echo $key_c['nombres'] ?></td>
                                    <td><?php echo $key_c['p_apellido'] ?></td>
                                    <td><?php echo $key_c['s_apellido'] ?></td>
                                    <td><?php echo $key_c['cedula'] ?></td>
                                    <td class="botones_tabla">
                                        <a href="modificar-coordinador.php?id=<?php echo $key_c['id'] ?>&nombres=<?php echo $key_c['nombres'] ?>
                                                &p_apellido=<?php echo $key_c['p_apellido'] ?> &s_apellido=<?php echo $key_c['s_apellido'] ?> &cedula=<?php echo $key_c['cedula'] ?>
                                                " name="modificarDocente" class="btn-editar"> <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <form action="../../controller/eliminar-usuario.php" method="POST">
                                            <input type="text" name="user" hidden readonly value="<?php echo $key_c['usuario'] ?>">
                                            <input type="text" name="getIdU" hidden readonly value="<?php echo $key_c['id'] ?>">
                                            <button type="submit" value="Eliminar" name="eliminar" class="btn-eliminar"><i class="bi bi-trash-fill"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#search").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#userInfo tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
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
    <script>

    </script>
    <script src="../../utilities/loading/load.js"></script>
    <script src="../../font/9390efa2c5.js"></script>
    <script src="../../js/jquery-3.3.1.min.js"></script>
</body>

</html>