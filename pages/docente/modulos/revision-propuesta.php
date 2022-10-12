<?php

include_once("../../../model/Metodos.php");
include("../../../model/UserModel.php");
$obj = new User();
$funcion = new Metodos();

include("../../../model/Asesor.php");
session_start();
// error_reporting(0);
$sesion = $_SESSION['usuario'];
$getProfile = $obj->getProfileUser();
$userP = mysqli_fetch_array($getProfile);

if ($sesion == null || $sesion = '') {
    header("location: ../../../index.php");
    die();
}

include "../../../controller/RatePropuesta.php";
?>
<!doctype html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="../../../evaluer.ico">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Propuestas</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <link rel="stylesheet" href="../../../utilities/loading/carga.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <!-- MAIN STYLE -->
    <link rel="stylesheet" href="../../../css/revision-propuesta.css">
    <link rel="stylesheet" href="../../../css/header.css">
    <link rel="stylesheet" href="../../../css/scrollbar.css">
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
            <h3>ASESOR DE INVESTIGACIÓN</h3>
            <ul class="navbar-nav mx-auto">

            </ul>
            <ul class="">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img style="width: 40px; height: 40px; border-radius: 50%;" src="../../../files/photos/<?php echo $userP['foto'] == null ? 'default.png' :  $userP['foto']; ?>" alt="">
                        <?php echo $userP['nombre']; ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Perfil</a></li>
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
    <div class="general_content">
        <fieldset class="acciones">
            <div class="cont-titulo">
                <h3>Acciones</h3>
            </div>
            <form action="" method="POST">
                <?php
                include '../../../controller/HabilitarPropuesta.php';
                ?>
                <input type="text" hidden value="<?php echo $_SESSION['usuario']; ?>" name="userr">
                <button name="begin" type="submit" class="btn btn-success"><i class="bi bi-plus-lg"></i>Habilitar
                    entregas</button>
            </form>
        </fieldset>
        <div class="lista-propuestas">
            <div class="cont-titulo">
                <i class="bi bi-list-ul"></i>
                <h3>Propuestas de grado</h3>
            </div>
            <!-- <label>Filtro de busqueda:</label> -->
            <div class="box">
                <i class="fa fa-search"></i>
                <input type="search" id="search" placeholder="Search..." />
            </div>


            <div class="contenedor-tabla">
                <table class="tabla-propuestas shadow">
                    <thead>
                        <tr>
                            <th>#</th>
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
                    <tbody id="contenido_tabla">
                        <?php
                        $mostrar = $funcion->listarPropuestas();

                        foreach ($mostrar as $value) {
                            $id_registro = $value['id'];
                        ?>
                            <tr>
                                <td><?php echo $value['id'] ?></td>
                                <td style="max-width: 600px;"><?php echo $value['titulo'] ?></td>
                                <td hidden><?php echo $value['linea'] ?></td>
                                <td><?php echo $value['integrantes'] ?></td>
                                <td hidden><?php echo $value['tutor'] ?></td>
                                <td hidden><?php echo $value['lider'] ?></td>
                                <td><?php echo $value['programa'] ?></td>
                                <td><?php echo $value['semestre'] ?></td>
                                <td hidden><?php echo $value['descripcion'] ?></td>
                                <td><?php
                                    $originalDate = $value['fecha'];
                                    echo date("d/m/Y", strtotime($originalDate)) . " " . date("g:i a", strtotime($originalDate));
                                    ?></td>
                                <td hidden><?php echo $value['miembro1'] ?></td>
                                <td hidden><?php echo $value['miembro2'] ?></td>
                                <td hidden><?php echo $value['miembro3'] ?></td>
                                <td hidden><?php echo $value['id'] ?></td>
                                <form action="" method="POST">
                                    <td id="celdaCalif">
                                        <input type="text" name="getIdPropuesta" hidden value="<?php echo $value['id'] ?>">
                                        <input type="text" class="estado" name="estado" style="text-transform:uppercase;" value="<?php echo $value['estado'] ?>">
                                    </td>
                                    <td>
                                        <input name="id_p" type="text" hidden value="<?php echo $value['id'] ?>">

                                        <button type="button" class="watch btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            <i class="bi bi-eye-fill"></i>
                                        </button>
                                        <!-- Modal -->
                                        <input hidden type="submit" name="submit" value="Calificar" class="btn-estado" id="calificarN">
                                    </td>
                                </form>
                                <td hidden><?php echo $value['programa_id'] ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table>
                        <tr>
                            <td><img src="../../../img/aunar2s.png" alt="" width="200"></td>
                            <td align="center">CORPORACION UNIVERSITARIA AUTONOMA DE NARIÑO EXTENSIÓN CARTAGENA</td>
                        </tr>
                        <tr>
                            <td align="center" colspan="2">PROPUESTA DE GRADO</td>
                        </tr>
                    </table>

                    <table>
                        <tr>
                            <td style="background: #e7e6e6;" colspan="1"><label for="">Título:</label> </td>
                            <td colspan="3">
                                <p class="modal-title" id="title"></p>
                            </td>
                        </tr>
                        <tr>
                            <td style="background: #e7e6e6;" colspan="1"><label for="">Línea de investigación:</label> </td>
                            <td colspan="3">
                                <p id="linea"></p>
                            </td>
                        </tr>
                        <tr>
                            <td style="background: #e7e6e6;"><label for="">Programa:</label> </td>
                            <td>
                                <p id="program"></p>
                            </td>
                            <td style="background: #e7e6e6;"><label for="">Semestre:</label> </td>
                            <td align="center">
                                <p id="semestre"></p>
                            </td>
                        </tr>
                        <tr>
                            <td style="background: #e7e6e6;" align="center" colspan="4"><label for="">Descripción</label></td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <p style="text-align: justify;" id="descrip" name="description"></p>
                            </td>
                        </tr>
                        <tr>
                            <td style="background: #e7e6e6;"><label for="">Nombre del asesor:</label> </td>
                            <td>
                                <p id="tutor"></p>
                            </td>
                            <td style="background: #e7e6e6;"><label for="">Nombre del lider:</label> </td>
                            <td>
                                <p id="lid"></p>
                            </td>
                        </tr>
                        <tr>
                        </tr>
                        <tr>
                            <td style="background: #e7e6e6;" colspan="1"><label for="">Número de integrantes</label></td>
                            <td style="background: #e7e6e6;" align="center" colspan="3"><label for="">Integrantes</label></td>
                        </tr>
                        <tr>
                            <td align="center" colspan="1">
                                <p id="num"></p>
                            </td>
                            <td colspan="3">
                                <ul>
                                    <li id="int1"></li>
                                    <li id="int2"></li>
                                    <li id="int3"></li>
                                </ul>
                            </td>
                        </tr>
                    </table>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- | -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>



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
        $('.watch').on('click', function() {
            $tr = $(this).closest('tr');
            var datos = $tr.children("td").map(function() {
                return $(this).text();
            });
            $('#title').html(datos[1]);
            $('#linea').html(datos[2]);
            $('#num').html(datos[3]);
            $('#tutor').html(datos[4]);
            $('#lid').html(datos[5]);
            $('#program').html(datos[6]);
            $('#semestre').html(datos[7]);
            $('#descrip').html(datos[8]);
            $('#time').html(datos[9]);
            if (datos[10] != "") {
                $('#int1').html(datos[10]);
            }
            if (datos[11] != "") {
                $('#int2').html(datos[11]);
            }
            if (datos[12] != "") {
                $('#int3').html(datos[12]);
            }
        });
    </script>
    <script src="../../../utilities/loading/load.js"></script>
    <script src="../../../font/9390efa2c5.js"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous">
    </script>

    <script src="../../../js/jquery-3.3.1.min.js"></script>
</body>

</html>