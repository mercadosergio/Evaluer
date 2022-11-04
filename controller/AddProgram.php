<?php

if (isset($_POST['add'])) {
    $nombre = $_POST['nombre'];
    $snies = $_POST['snies'];
    $duracion = $_POST['duracion'];
    $modalidad = $_POST['modalidad'];

    $data = new User();
    $data->addProgram($nombre, $snies, $duracion, $modalidad);

?>
    <div id="success" class="alert alert-success" role="alert" style="z-index: 9999999999999999; position:absolute; top:2%;left: 50%;transform: translate(-50%, 0%);">
        Guardado exitoso
    </div>

    <script>
        setTimeout(function() {
            $('#success').fadeOut('fast');
        }, 2000); // <-- time in milliseconds
    </script>
<?php
}
