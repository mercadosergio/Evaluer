<?php
// include("../model/Estudiante.php");
// session_start();

if (isset($_POST['enviar'])) {
    $titulo = $_POST['titulo'];
    $linea = $_POST['linea'];
    $num_integrantes = $_POST['numIntegrantes'];
    $tutor = $_POST['tutor'];
    $lider = $_POST['lider'];
    $semestre = $_POST['semestre'];
    $descripcion = $_POST['description']; // TEXTAREA
    $fecha = $_POST['fecha'];

    $nombre_miembro1 = $_POST['nombres_miembro1'];
    $apellido_miembro1 = $_POST['apellidos_miembro1'];

    $programa_id = $_POST['id_programa'];


    if ($descripcion == null || $descripcion == '') {
?>
        <div id="fail" class="alert alert-danger" role="alert" style="z-index: 9999999999999999; position:absolute; top:2%;left: 50%;transform: translate(-50%, 0%);">
            Falta un campo por llenar
        </div>
        <script>
            setTimeout(function() {
                $('#fail').fadeOut('fast');
            }, 2000); // <-- time in milliseconds
        </script>
    <?php
    } else {
        $objStudent = new Student();
        for ($j = 0; $j < count($num_integrantes); $j++) {
            for ($i = 0; $i < count($programa_id); $i++) {
                if ($num_integrantes[$j] == 1) {
                    $objStudent->EnviarPropuesta(
                        $titulo,
                        $linea,
                        $num_integrantes[$j],
                        $tutor,
                        $lider,
                        $programa_id[$i],
                        $semestre,
                        $descripcion,
                        $nombre_miembro1 + ' ' + $apellido_miembro1,
                        '',
                        '',
                        $fecha,
                        $_SESSION['usuario']
                    );
                } else if ($num_integrantes[$j] == 2) {
                    $nombre_miembro2 = $_POST['nombres_miembro2'];
                    $apellido_miembro2 = $_POST['apellidos_miembro2'];
                    $objStudent->EnviarPropuesta($titulo, $linea, $num_integrantes[$j], $tutor, $lider, $programa_id[$i], $semestre, $descripcion, $nombre_miembro1 + ' ' + $apellido_miembro1, $nombre_miembro2 + ' ' + $apellido_miembro2, '', $fecha, $_SESSION['usuario']);
                } else {
                    $nombre_miembro2 = $_POST['nombres_miembro2'];
                    $apellido_miembro2 = $_POST['apellidos_miembro2'];
                    $nombre_miembro3 = $_POST['nombres_miembro3'];
                    $apellido_miembro3 = $_POST['apellidos_miembro3'];
                    $objStudent->EnviarPropuesta($titulo, $linea, $num_integrantes[$j], $tutor, $lider, $programa_id[$i], $semestre, $descripcion, $nombre_miembro1 + ' ' + $apellido_miembro1, $nombre_miembro2 + ' ' + $apellido_miembro2, $nombre_miembro3 + ' ' + $apellido_miembro3, $fecha, $_SESSION['usuario']);
                }
            }
        }
        // include("../pages/estudiante/index.php");

    ?>
        <div id="success" class="alert alert-success" role="alert" style="z-index: 9999999999999999; position:absolute; top:2%;left: 50%;transform: translate(-50%, 0%);">
            Propuesta enviada con éxito
        </div>
        <script>
            setTimeout(function() {
                $('#success').fadeOut('fast');
            }, 2000); // <-- time in milliseconds
        </script>
<?php
    }
}
