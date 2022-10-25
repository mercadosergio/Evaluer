<?php

if (isset($_POST['enviar'])) {
    $fecha = $_POST['fecha'];
    $nombre = $_FILES['archivo']['name'];
    $file_save = $_FILES['archivo']['tmp_name'];
	$programa_id = $_POST['programa_id'];
	$programa = $_POST['programa_n'];
    $id_grupo = $_POST['id_grupo'];

    $nombre_final =  date("d-m-y") . "-" . date("H-m-s") . "-" . $nombre;
    $ruta = "../../files/proyectos_de_grado/" . $nombre_final;

    if (!file_exists('../files/proyectos_de_grado')) {
        mkdir('../files/proyectos_de_grado', 0777, true);
        if (file_exists('../files/proyectos_de_grado')) {
            if (move_uploaded_file($file_save, '../../files/proyectos_de_grado/' . $nombre_final)) {
                include("../index.php");
            } else {
                echo "Archivo no se pudo guardar";
            }
        }
    } else {

        if (move_uploaded_file($file_save, '../../files/proyectos_de_grado/' . $nombre_final)) {
            $submit = new Student();
			$submit->ProyectoFinal($nombre, $ruta, $_SESSION['usuario'], $fecha, $programa_id, $programa,$id_grupo);

            // include("../pages/estudiante/index.php");
?>
            <div id="success" class="alert alert-success" role="alert" style="z-index: 9999999999999999; position:absolute; top:2%;left: 50%;transform: translate(-50%, 0%);">
				Entregable final enviado con éxito
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

?>