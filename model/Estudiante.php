<?php

require_once 'db.php';

class Student extends DataBase
{
    public function __construct()
    {
        parent::__construct();
    }


    public function EnviarPropuesta($titulo, $linea, $integrantes, $tutor, $lider, $programa_id, $semestre, $descripcion, $miembro1, $miembro2, $miembro3, $fecha, $usuario)
    {
        $time_propuesta = $this->con->query("SELECT time_propuesta FROM estudiante WHERE usuario=" . $_SESSION['usuario']);
        $tiempo = mysqli_fetch_array($time_propuesta);
        if (time() > $tiempo['0']) {
            $time_propuesta = strtotime("+365 days, 12:00am", time());

            $this->con->query("INSERT INTO propuesta(titulo, linea, integrantes, tutor, lider, programa_id, semestre, descripcion, miembro1, miembro2, miembro3, fecha, remitente)
                                             VALUES ('$titulo','$linea','$integrantes','$tutor','$lider','$programa_id','$semestre','$descripcion','$miembro1','$miembro2','$miembro3','$fecha', '$usuario')");

            $this->con->query("UPDATE propuesta a
            JOIN estudiante es ON a.remitente = es.usuario
            SET a.programa_id = es.programa_id");

            $this->con->query("UPDATE propuesta a
            JOIN estudiante es ON a.remitente = es.usuario
            JOIN programa p ON a.programa_id = p.identificador
            SET a.programa = p.nombre, a.estudiante_id = es.id");

            $this->con->query("UPDATE estudiante SET time_propuesta = '$time_propuesta' WHERE usuario =" . $_SESSION['usuario']);
        }
    }

    public function EnviarAnteproyecto($nombre, $ruta, $comentario, $usuario, $fecha)
    {
        $time_anteproyecto = $this->con->query("SELECT time_anteproyecto FROM estudiante WHERE usuario = " . $_SESSION['usuario']);
        $tiempo = mysqli_fetch_array($time_anteproyecto);

        if (time() > $tiempo['0']) {
            $time_anteproyecto = strtotime("+15 days, 12:00am", time());

            $this->con->query("INSERT INTO anteproyecto(nombre,documento,comentarios,remitente,fecha) VALUES('$nombre','$ruta','$comentario','$usuario','$fecha')");

            $this->con->query("UPDATE anteproyecto a
			JOIN estudiante es ON a.remitente = es.usuario
			SET a.programa_id = es.programa_id");

            $this->con->query("UPDATE anteproyecto a
				JOIN estudiante e ON a.programa_id = e.programa_id 
				JOIN propuesta p ON a.remitente = p.remitente
				SET a.programa = e.programa, a.titulo = p.titulo");

            $this->con->query("UPDATE estudiante SET time_anteproyecto = '$time_anteproyecto' WHERE usuario = " . $_SESSION['usuario']);
        } else {
            echo '<div id="fail" class="alert alert-danger" role="alert" style="z-index: 9999999999999999; position:absolute; top:2%;left: 50%;transform: translate(-50%, 0%);">
			            No puedes entregar hasta la proxima fecha
		        </div>';
            echo "<script>
                    setTimeout(function() {
                    $('#fail').fadeOut('fast');
                    }, 2000); // <-- time in milliseconds
                </script>";
        }
    }
    public function ProyectoFinal($nombre, $ruta, $usuario, $fecha)
    {
        $time_proyecto = $this->con->query("SELECT time_proyecto FROM estudiante WHERE usuario = " . $_SESSION['usuario']);
        $tiempo = mysqli_fetch_array($time_proyecto);

        if (time() > $tiempo['0']) {
            $time_proyecto = strtotime("+15 days, 12:00am", time());

            $this->con->query("INSERT INTO proyecto_grado(nombre,documento,remitente,fecha) VALUES('$nombre','$ruta','$usuario','$fecha')");

            $this->con->query("UPDATE proyecto_grado p
            JOIN estudiante es ON p.remitente = es.usuario 
            JOIN estudiante e ON p.programa_id = e.programa_id
            JOIN propuesta prop ON p.remitente = prop.remitente
            JOIN propuesta ps ON p.remitente = prop.remitente
            SET p.programa_id = es.programa_id, p.programa = e.programa, p.titulo = prop.titulo, p.semestre = ps.semestre");

            $this->con->query("UPDATE estudiante SET time_proyecto = '$time_proyecto' WHERE usuario = " . $_SESSION['usuario']);
        } else {
            echo '<div id="fail" class="alert alert-danger" role="alert" style="z-index: 9999999999999999; position:absolute; top:2%;left: 50%;transform: translate(-50%, 0%);">
			            No puedes entregar hasta la proxima fecha
		        </div>';
            echo "<script>
                    setTimeout(function() {
                    $('#fail').fadeOut('fast');
                    }, 2000); // <-- time in milliseconds
                </script>";
        }
    }

    public function DeletePropuesta($usuario)
    {
        $this->con->query("DELETE FROM propuesta WHERE remitente = '$usuario'");
        $this->con->query("UPDATE estudiante SET time_propuesta = 0 WHERE usuario = '$usuario'");
    }
}
