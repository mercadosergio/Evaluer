<?php

if (isset($_POST['enviar'])) {
	$fecha = $_POST['fecha'];
	$comentario = $_POST['coment'];
	$nombre = $_FILES['archivo']['name'];
	$save_file = $_FILES['archivo']['tmp_name'];
	$usuario = $_POST['user'];
	$programa = $_POST['programa'];
	$id_grupo = $_POST['id_grupo'];

	$nombre_final =  date("d-m-y") . "-" . date("H-m-s") . "-" . $nombre;
	$ruta = "../../files/anteproyectos/" . $nombre_final;

	if (!file_exists('../../files/anteproyectos')) {
		mkdir('../../files/anteproyectos', 0777, true);
		if (file_exists('../../files/anteproyectos')) {
			if (move_uploaded_file($save_file, '../../files/anteproyectos/' . $nombre_final)) {
				include_once("../pages/estudiante/index.php");
			} else {
				echo "Archivo no se pudo guardar";
			}
		}
	} else {

		if (move_uploaded_file($save_file, '../../files/anteproyectos/' . $nombre_final)) {

			$objStudent = new Student();
			$objStudent->EnviarAnteproyecto($nombre, $ruta, $comentario, $usuario, $fecha, $programa, $id_grupo);
?>
			<div id="success" class="alert alert-success" role="alert" style="z-index: 9999999999999999; position:absolute; top:2%;left: 50%;transform: translate(-50%, 0%);">
				Entregable enviado con éxito
			</div>

			<script>
				setTimeout(function() {
					$('#success').fadeOut('fast');
				}, 2000); // <-- time in milliseconds
			</script>
		<?php
			// include("../pages/estudiante/index.php");
			// header("Location: ../index.php");
		} else {
		?>
			<div id="fail" class="alert alert-danger" role="alert" style="z-index: 9999999999999999; position:absolute; top:2%;left: 50%;transform: translate(-50%, 0%);">
				No se envió el entregable
			</div>
			<script>
				setTimeout(function() {
					$('#fail').fadeOut('fast');
				}, 2000); // <-- time in milliseconds
			</script>
<?php
		}
	}
}
