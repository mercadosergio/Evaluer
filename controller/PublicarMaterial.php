<?php

if (isset($_POST['save'])) {
    $titulo = $_POST['titulo'];
    $filename = $_FILES['archivo']['name'];
    $file = $_FILES['archivo']['tmp_name'];
    $asesor_id = $_POST['asesor_id'];

    $ruta = "../../material/" . $filename;

    if (!file_exists('../../../material')) {
        mkdir('../../../material', 0777, true);
        if (file_exists('../../../material')) {
            if (move_uploaded_file($file, '../../../material/' . $filename)) {
                include("../index.php");
            } else {
                echo "Archivo no se pudo guardar";
            }
        }
    } else {
        if (move_uploaded_file($file, '../../../material/' . $filename)) {
            $asesor = new Metodos();
            $asesor->publicarMaterial($asesor_id, $titulo, $ruta);
            ?>
            <div id="success" class="alert alert-success" role="alert" style="z-index: 9999999999999999; position:absolute; top:2%;left: 50%;transform: translate(-50%, 0%);">
				Material publicado con éxito
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
