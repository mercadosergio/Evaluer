<?php
include("../model/conexion.php");
session_start();
error_reporting(0);

$fecha = $_POST['fecha'];
$comentario = $_POST['coment'];
$nombre = $_FILES['archivo']['name'];
$guardado = $_FILES['archivo']['tmp_name'];

$nombre_final =  date("d-m-y") . "-" . date("H-m-s") . "-" . $nombre;
$ruta = "../files/anteproyectos/" . $nombre_final;

$time_antepoyecto = $conexion->query("SELECT time_anteproyecto FROM estudiante WHERE usuario=" . $_SESSION['usuario']);
$tiempo = mysqli_fetch_array($time_antepoyecto);

if (!file_exists('../files/anteproyectos')) {
	mkdir('../files/anteproyectos', 0777, true);
	if (file_exists('../files/anteproyectos')) {
		if (move_uploaded_file($guardado, '../files/anteproyectos/' . $nombre_final)) {
			include_once("../pages/estudiante/index.php");
		} else {
			echo "Archivo no se pudo guardar";
		}
	}
} else {
	if (time() > $tiempo['0']) {
		$time_antepoyecto = strtotime("+15 days, 12:00am", time());

		if (move_uploaded_file($guardado, '../files/anteproyectos/' . $nombre_final)) {
			// Se inserta la dirección y detalles del archivo enviado
			$conexion->query("INSERT INTO anteproyecto(nombre,documento,comentarios,remitente,fecha) VALUES('$nombre','$ruta','$comentario','" . $_SESSION['usuario'] . "','$fecha')");

			$conexion->query("UPDATE anteproyecto a
			JOIN estudiante es ON a.remitente = es.usuario
			SET a.programa_id = es.programa_id");

			$conexion->query("UPDATE anteproyecto a
				JOIN estudiante e ON a.programa_id = e.programa_id 
				JOIN propuesta p ON a.remitente = p.remitente
				SET a.programa = e.programa, a.titulo = p.titulo");

			$conexion->query("UPDATE estudiante SET time_anteproyecto = '$time_antepoyecto' WHERE usuario =" . $_SESSION['usuario']);

?>
			<div id="success" class="alert alert-success" role="alert" style="z-index: 9999999999999999; position:absolute; top:2%;
  				left: 50%;
  				transform: translate(-50%, 0%);">
				Documento enviado con éxito
			</div>

			<script>
				setTimeout(function() {
					$('#success').fadeOut('fast');
				}, 2000); // <-- time in milliseconds
			</script>
		<?php
			include_once("../pages/estudiante/index.php");
		} else {
		?>
			<div id="fail" class="alert alert-danger" role="alert" style="z-index: 9999999999999999; position:absolute; top:2%;
  				left: 50%;
  				transform: translate(-50%, 0%);">
				No se envió la entrega del documento
			</div>
			<script>
				setTimeout(function() {
					$('#fail').fadeOut('fast');
				}, 2000); // <-- time in milliseconds
			</script>
		<?php
		}
	} else {
		?>
		<div id="fail" class="alert alert-danger" role="alert" style="z-index: 9999999999999999; position:absolute; top:2%;
  				left: 50%;
  				transform: translate(-50%, 0%);">
			No puedes realizar otra entrega hasta la proxima fecha
		</div>
		<script>
			setTimeout(function() {
				$('#fail').fadeOut('fast');
			}, 2000); // <-- time in milliseconds
		</script>
<?php
	}
}
