<?php

date_default_timezone_set("America/Bogota");

if (isset($_POST['save'])) {
    $numE = $_POST['numIntegrantes'];
    $year = date("Y");
    $programa = $_POST['programa'];
    $semestre = $_POST['semestre'];

    if (date("m") > 6) {
        // Periodo 2 del año lectivo
        $periodo = $year . " - 2";
    } else {
        // Periodo 1 del año lectivo
        $periodo = $year . " - 1";
    }

    $dni1 = $_POST['dni_int1'];
    $nombre1 = $_POST['nombres_miembro1'];
    $apellido1 = $_POST['apellidos_miembro1'];

    if (isset($_POST['dni_int2'])) {
        $dni2 = $_POST['dni_int2'];
        $nombre2 = $_POST['nombres_miembro2'];
        $apellido2 = $_POST['apellidos_miembro2'];
    } else {
        $dni2 = "N/A2";
        $nombre2 = "";
        $apellido2 = "";
    }
    if (isset($_POST['dni_int3'])) {
        $dni3 = $_POST['dni_int3'];
        $nombre3 = $_POST['nombres_miembro3'];
        $apellido3 = $_POST['apellidos_miembro3'];
    } else {
        $dni3 = "N/A3";
        $nombre3 = "";
        $apellido3 = "";
    }

    if (empty($dni1)) {
?>
        <div id="fail" class="alert alert-danger" role="alert" style="z-index: 9999999999999999; position:absolute; top:2%;left: 50%;transform: translate(-50%, 0%);">
            Hay uno o más campos vacíos
        </div>
        <?php

    } else {
        if ($dni1 == $dni2 || $dni1 == $dni3 || $dni2 == $dni3) {
        ?>
            <div id="fail" class="alert alert-danger" role="alert" style="z-index: 9999999999999999; position:absolute; top:2%;left: 50%;transform: translate(-50%, 0%);">
                Los documentos de identidad no se deben repetir
            </div>
            <script>
                setTimeout(function() {
                    $('#fail').fadeOut('fast');
                }, 2000); // <-- time in milliseconds
            </script>
        <?php
        } else {
            $estudiante = new Student();
            for ($i = 0; $i < count($numE); $i++) {
                $estudiante->asignarGrupo($numE[$i], $dni1, $dni2, $dni3, $nombre1 . " " . $apellido1, $nombre2 . " " . $apellido2, $nombre3 . " " . $apellido3, $programa, $semestre, $periodo);
            } ?>
            <div id="success" class="alert alert-success" role="alert" style="z-index: 9999999999999999; position:absolute; top:2%; left: 50%; transform: translate(-50%, 0%);">
                Se registró con éxito su equipo de trabajo
            </div>
            <script>
                setTimeout(function() {
                    $('#success').fadeOut('fast');
                }, 2000); // <-- time in milliseconds
            </script>
<?php
        }
    }
}
