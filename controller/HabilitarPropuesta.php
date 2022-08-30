<?php

if (isset($_POST['begin'])) {
    $uses = $_POST['userr'];
    
    $asesor = new Asesor();
    $asesor->HabilitarEnvios($uses);

    include "../pages/docente/modulos/revision-propuesta.php";
    // header("Location: ../pages/docente/modulos/revision-propuesta.php");
}
?>
<div id="success" class="alert alert-success" role="alert" style="z-index: 9999999999999999; position:absolute; top:2%; left: 50%; transform: translate(-50%, 0%);">
    Usted habilitó el envío de propuestas de grado
</div>
<script>
    setTimeout(function() {
        $('#success').fadeOut('fast');
    }, 2000); // <-- time in milliseconds
</script>