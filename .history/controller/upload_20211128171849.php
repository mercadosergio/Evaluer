<?php

include("../model/conexion.php");

if (isset($_POST['enviar'])) {
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
				include_once("../pages/main-estudiante.php");
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
				JOIN estudiante es ON a.programa_id = es.programa_id 
				SET a.programa = es.programa");

				$conexion->query("UPDATE anteproyecto p
				JOIN propuesta es ON p.remitente = es.remitente 
				SET p.titulo = es.titulo");

				$conexion->query("UPDATE estudiante SET time_anteproyecto = '$time_antepoyecto' WHERE usuario =" . $_SESSION['usuario']);

?>
				<p style="position: absolute; padding: 10px;border-radius: 10px; top: 20%; left: 650px;opacity: 1;
			text-align: center; width: 20%; background: #abff96; color: #1e9700; border: 1px #1e9700 solid;" id="success">Archivo enviado con éxito</p>
				<script>
					setTimeout(function() {
						$('#success').fadeOut('fast');
					}, 2000); // <-- time in milliseconds
				</script>
			<?php
				include_once("../pages/main-estudiante.php");
			} else {
			?>
				<p style="position: absolute; padding: 10px;border-radius: 10px; top: 20%; left: 650px;opacity: 1;
			text-align: center; width: 14%; background: rgb(255, 133, 133); color: rgb(184, 0, 0); border: 1px #1e9700 solid;" id="fail">No se envió el archivo</p>
				<script>
					setTimeout(function() {
						$('#fail').fadeOut('fast');
					}, 2000); // <-- time in milliseconds
				</script>
			<?php
			}
		} else {
			?>
			<p style="position: absolute; padding: 10px;border-radius: 10px; top: 20%; left: 650px;opacity: 1;
			text-align: center; width: 14%; background: rgb(255, 133, 133); color: rgb(184, 0, 0); border: 1px #1e9700 solid;" id="fail">No puedes enviar archivos hasta la proxima fecha</p>
			<script>
				setTimeout(function() {
					$('#fail').fadeOut('fast');
				}, 2000); // <-- time in milliseconds
			</script>
<?php
		}
	}
}
