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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/unicons.css">
    <link rel="stylesheet" href="../../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../../css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../../utilities/loading/carga.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- MAIN STYLE -->
    <link rel="stylesheet" href="../css/control-usuarios.css">
    <link rel="stylesheet" href="../../css/header.css">

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
                            $sql = "SELECT * FROM estudiante ORDER BY id";
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
                                        <button type="button" class="editbtn btn-editar" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            <i class="fa-solid fa-user-pen"></i>
                                        </button>
                                        <form action="../../controller/eliminar-usuario.php" method="POST">
                                            <input hidden type="text" name="user" readonly value="<?php echo $key['usuario'] ?>">
                                            <input hidden type="text" name="getIdU" readonly value="<?php echo $key['id'] ?>">
                                            <button type="submit" value="Eliminar" name="eliminar" class="btn-eliminar"><i class="bi bi-trash-fill"></i></button>
                                        </form>
                                        <!-- Modal component -->
                                        <div class="modal fade" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Editar usuario</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <label class="lbl-nombre">Nombre:</label>
                                                        <input type="text" class="nombre form-control" name="nombre" value="">
                                                        <label class="lbl-p-apellido">Primer apellido:</label>
                                                        <input type="text" class="p-apellido form-control" name="p_apellido" value="">
                                                        <label class="lbl-s-apellido">Segundo apellido:</label>
                                                        <input type="text" class="s-apellido form-control" name="s_apellido" value="">
                                                        <label class="lbl-cedula">Documento de identidad:</label>
                                                        <input type="text" class="cedula form-control" name="cedula" value="">
                                                        <label class="lbl-programa">Programa:</label>

                                                        <select name="programa_id[]" class="programa form-select">

                                                            <option class="programa_selected" selected value="<?php echo $key['programa_id']; ?>"></option>

                                                            <option value="1">Seleccione...</option>
                                                            <?php
                                                            $non_selected = "SELECT * FROM programas";
                                                            $options = $obj->listar($non_selected);

                                                            foreach ($options as $pro) {
                                                                echo '<option value="' . $pro['identificador'] . '">' . $pro['nombre'] . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                        <label class="lbl-semestre">Semestre:</label>
                                                        <input type="number" max="9" min="6" class="semestre form-control" name="semestre" value="">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                                        <button type="button" class="btn btn-primary">Guardar cambios</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End modal component -->
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
    <script src="../../js/jquery-3.3.1.min.js"></script>
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
        $('.editbtn').on('click', function() {
            $tr = $(this).closest('tr');
            var datos = $tr.children('td').map(function() {
                return $(this).text();
            });
            $('.nombre').val(datos[1]);
            $('.p-apellido').val(datos[2]);
            $('.s-apellido').val(datos[3]);
            $('.cedula').val(datos[4]);
            $('.programa_selected').html(datos[5]);
            $('.semestre').val(datos[6]);
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
    <script src="../../font/d029bf1c92.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>

</html>