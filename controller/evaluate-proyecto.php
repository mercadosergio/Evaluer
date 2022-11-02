<?php

if (isset($_POST['enviar'])) {

    $estado = $_POST['estado'];
    $nota = $_POST['nota'];
    $id = $_POST['id_proyecto'];
    $observaciones = $_POST['observacion'];

    for ($i = 0; $i < count($estado); $i++) {
        $a = new Asesor();
        $a->EvaluarProyecto($estado[$i], $nota, $observaciones, $id);
    }
?>
    <div id="success" class="alert alert-success" role="alert" style="z-index: 9999999999999999; position:absolute; top:2%; left: 50%; transform: translate(-50%, 0%);">
        Evaluación correcta
    </div>
    <script>
        setTimeout(function() {
            $('#success').fadeOut('fast');
        }, 2000); // <-- time in milliseconds
    </script>
<?php
    // header("location: ../pages/docente/modulos/revision-proyecto-grado.php");
}
