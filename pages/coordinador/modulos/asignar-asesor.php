<?php
include("../../../model/conexion.php");
session_start();
error_reporting(0);
$variable_sesion = $_SESSION['usuario'];

if ($variable_sesion == null || $variable_sesion = '') {
    header("location: ../index.php");
    die();
}
include("../../../controller/nombre.php");
?>

<!doctype html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="../../../evaluer.ico">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Asignar asesor</title>

    <link rel="stylesheet" href="../../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../css/unicons.css">
    <link rel="stylesheet" href="../../../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../../../css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../../../utilities/loading/carga.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- MAIN STYLE -->
    <link rel="stylesheet" href="../../../css/asignar-asesor.css">

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
                <h3>COORDINADOR</h3>
                <ul class="navbar-nav mx-auto">

                </ul>
                <ul class="log">
                    <li>
                        <a class="navbar-brand" href=""><i class='uil uil-user'></i><label for=""><?php echo $nombre_usuario ?></label></a>
                        <ul>
                            <li><a class="out" href="">Perfil</a></li>
                            <li><a class="out" href="../../../support/change-password.php">Cambiar contraseña</a></li>
                            <li><a class="out" href="../../../controller/logout.php">Cerrar sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="main_section">
        <h3 class="title">Asignar asesor</h3>

        <div class="search-registro">
            <div class="contenedor">
                <input type="search" id="search" placeholder="Search..." />
                <button class="icon" name="buscar"><i class="fa fa-search"></i></button>
            </div>
        </div>
        <table class="tabla_asesor">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Título</th>
                    <th>Documento</th>
                    <th>Programa</th>
                    <th>Semestre</th>
                    <th>Fecha y hora</th>
                    <th>Asesor de proyecto</th>
                </tr>
            </thead>
            <tbody id="search">
                <?php
                // include("../../../controller/asignar-docente.php");
                ?>
                <form id="form" action="../../../controller/asignar-docente.php" name="sub" method="POST">
                    <?php
                    $sql = "SELECT * from proyecto_grado";
                    $result = mysqli_query($conexion, $sql);


                    while ($mostrar = mysqli_fetch_array($result)) {
                    ?>
                        <tr>
                            <td><?php echo $mostrar['0'] ?></td>
                            <td style="max-width: 600px;"><?php echo $mostrar['titulo'] ?></td>
                            <td><a href="<?php echo $mostrar['documento']; ?>"><?php echo $mostrar['nombre']; ?></a></td>
                            <td><?php echo $mostrar['programa'] ?></td>
                            <td style="text-align:center;"><?php echo $mostrar['semestre'] ?></td>
                            <td><?php echo $mostrar['fecha'] ?></td>

                            <td>
                                <select name="asesor[]" id="asesor" onchange="seleccionarDocente()">
                                    <option selected value="<?php echo $mostrar['asesor_user']; ?>"><?php echo $mostrar['nombre_asesor']; ?></option>
                                    <option value="1">Seleccione...</option>
                                    <?php
                                    $buscar_docente = "SELECT * FROM docente";
                                    $resultado = mysqli_query($conexion, $buscar_docente);

                                    while ($filas = mysqli_fetch_array($resultado)) {
                                        echo '<option value="' . $filas['usuario'] . '">' . $filas['nombres'] . " " . $filas['p_apellido']  . '</option>';
                                    }
                                    ?>
                                </select>
                            </td>
                            <td hidden>
                                <input type="text" hidden id="id_proyecto" name="id_proyecto" value="<?php echo $mostrar['0'] ?>">
                                <input class="asignar" name="asignar_d" value="Guardar" type="submit">
                            </td>
                        </tr>

                    <?php
                    }
                    ?>
                </form>
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function() {
            $("#search").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#info tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>

    <script type="text/javascript">
        function seleccionarDocente() {

            let id = document.getElementById('id_proyecto').value;
            let asesor = document.getElementById('asesor');
            let variables = asesor.value;

            const formulario = document.getElementById("asesor");


            formulario.addEventListener("submit", (e) => {
                e.preventDefault();
                const request = new XMLHttpRequest();

                request.open("post", "../../../controller/asignar-docente.php");
                request.onload = function() {
                    console.log(request.responseText);
                }
                request.send(new FormData(formulario));
            });

            document.sub.submit();
            // alert(id);
            // alert(variables);
            // document.sub.submit();

        }
    </script>


    <script>
        // var cod = document.getElementById("asesor").value;
        // // alert(cod);

        // /* Para obtener el texto */
        // var combo = document.getElementById("asesor");
        // var selected = combo.options[combo.selectedIndex].text;
        // // alert(selected);

        // const $form = document.querySelector('#form')
        // $form.addEventListener('submit', handleSubmit)

        // function handleSubmit(event) {
        //     event.preventDefault()
        //     const form = new FormData(this)
        //     console.log(cod)
        // }
    </script>
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