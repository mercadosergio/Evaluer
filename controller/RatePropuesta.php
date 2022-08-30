<?php


if (isset($_POST['submit'])) {

    $estado = $_POST['estado'];
    $id = $_POST['getIdPropuesta'];

    $asesor=new Asesor();
    $asesor->EvaluarPropuesta($estado, $id);
?>
  <div id="success" class="alert alert-success" role="alert" style="z-index: 9999999999999999; position:absolute; top:2%;left: 50%;transform: translate(-50%, 0%);">
  Calificación exitosa
    </div>
    <script>
        setTimeout(function() {
            $('#success').fadeOut('fast');
        }, 2000); // <-- time in milliseconds
    </script>

<?php
    // header("location: ../pages/docente/revision-propuesta.php");
}
