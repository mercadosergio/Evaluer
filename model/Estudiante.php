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

            $this->con->query("INSERT INTO propuesta(titulo, linea, integrantes, tutor, lider, programa_id, semestre, descripcion, miembro1, miembro2, miembro3, fecha, remitente, programa, estudiante_id)
                                             SELECT '$titulo','$linea','$integrantes','$tutor','$lider','$programa_id','$semestre','$descripcion','$miembro1','$miembro2','$miembro3','$fecha', '$usuario', p.nombre, es.id
                                             FROM programa p
                                             JOIN estudiante es
                                             ON p.identificador = '$programa_id' AND es.usuario = '$usuario'");

            $this->con->query("UPDATE estudiante SET time_propuesta = '$time_propuesta' WHERE usuario =" . $_SESSION['usuario']);
        }
    }

    public function EnviarAnteproyecto($nombre, $ruta, $comentario, $usuario, $fecha, $programa_id, $programa)
    {
        $time_anteproyecto = $this->con->query("SELECT time_anteproyecto FROM estudiante WHERE usuario = " . $_SESSION['usuario']);
        $tiempo = mysqli_fetch_array($time_anteproyecto);

        if (time() > $tiempo['0']) {
            $time_anteproyecto = strtotime("+15 days, 12:00am", time());

            $this->con->query("INSERT INTO anteproyecto(nombre,documento,comentarios,remitente,fecha, programa_id, programa, titulo, estudiante_id) 
                            SELECT '$nombre','$ruta','$comentario','$usuario','$fecha', '$programa_id', '$programa', pro.titulo, es.id
                            FROM propuesta pro
                            JOIN estudiante es
                            ON pro.remitente = '$usuario' AND es.usuario = '$usuario'");

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

    public function ProyectoFinal($nombre, $ruta, $usuario, $fecha, $programa_id, $programa)
    {
        $time_proyecto = $this->con->query("SELECT time_proyecto FROM estudiante WHERE usuario = " . $_SESSION['usuario']);
        $tiempo = mysqli_fetch_array($time_proyecto);

        if (time() > $tiempo['0']) {
            $time_proyecto = strtotime("+15 days, 12:00am", time());

            $this->con->query("INSERT INTO proyecto_grado(nombre,documento,remitente,fecha, programa_id, programa, titulo, estudiante_id, semestre) 
                            SELECT '$nombre','$ruta','$usuario','$fecha', '$programa_id', '$programa', pro.titulo, es.id, es.semestre
                            FROM propuesta pro
                            JOIN estudiante es
                            ON pro.remitente = '$usuario' AND es.usuario = '$usuario'");

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

    public function getMyPropuesta()
    {
        $resultado = $this->con->query("SELECT * FROM propuesta WHERE remitente = " . $_SESSION['usuario']);
        $cantidad = $resultado->num_rows;
        if ($cantidad >= 1) {
            return true;
        } else {

            return false;
        }
    }

    public function getMyAnteproyecto()
    {
        $resultado = $this->con->query("SELECT * FROM anteproyecto WHERE remitente = " . $_SESSION['usuario']);
        $cantidad = $resultado->num_rows;
        if ($cantidad >= 1) {
            return true;
        } else {

            return false;
        }
    }
}
