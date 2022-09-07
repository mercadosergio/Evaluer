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

    $miembro1 = $_POST['miembro1'];

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
                        $miembro1,
                        '',
                        '',
                        $fecha,
                        $_SESSION['usuario']
                    );
                } else if ($num_integrantes[$j] == 2) {
                    $miembro2 = $_POST['miembro2'];
                    $objStudent->EnviarPropuesta($titulo, $linea, $num_integrantes[$j], $tutor, $lider, $programa_id[$i], $semestre, $descripcion, $miembro1, $miembro2, '', $fecha, $_SESSION['usuario']);
                } else {
                    $miembro2 = $_POST['miembro2'];
                    $miembro3 = $_POST['miembro3'];
                    $objStudent->EnviarPropuesta($titulo, $linea, $num_integrantes[$j], $tutor, $lider, $programa_id[$i], $semestre, $descripcion, $miembro1, $miembro2, $miembro3, $fecha, $_SESSION['usuario']);
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
