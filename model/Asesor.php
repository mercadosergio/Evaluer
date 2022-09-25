<?php

require_once 'db.php';

class Asesor extends DataBase
{
    public function __construct()
    {
        parent::__construct();
    }

    public function HabilitarEnvios($usuario)
    {
        $myself = $this->con->query("SELECT * FROM asesor WHERE usuario = '$usuario'");
        $array = mysqli_fetch_array($myself);

        $this->con->query("UPDATE estudiante SET time_propuesta = 0 WHERE programa_id = " . $array['programa_id']);
    }

    public function EvaluarPropuesta($estado, $id)
    {
        $this->con->query("UPDATE propuesta SET estado = '$estado' WHERE id = '$id'");
    }

    public function EvaluarAnteproyecto($estado, $nota, $observaciones, $id)
    {
        $this->con->query("UPDATE anteproyecto SET estado = '$estado', calificacion='$nota', observaciones='$observaciones' WHERE id = '$id'");
    }

    public function EvaluarProyecto($estado, $nota, $observaciones, $id)
    {
        $this->con->query("UPDATE proyecto_grado SET estado = '$estado', calificacion='$nota', observaciones='$observaciones' WHERE id = '$id'");
    }

    public function publicarAnuncio($contenido, $fecha, $programa, $nombre, $usuario, $id)
    {
        $this->con->query("INSERT INTO anuncio(contenido,fecha,programa_id,nombre_usuario,usuario,docente_id) VALUES ('$contenido','$fecha','$programa','$nombre','$usuario', $id)");
    }

    public function deleteAnuncio()
    {
        $id_a = $_POST['id'];

        $this->con->query("DELETE FROM anuncio WHERE id = '$id_a'");
    }

    public function getProyecto($id)
    {
        $result = $this->con->query("SELECT * FROM proyecto_grado WHERE id = '$id'");
        return $result;
    }
    public function getAnteproyecto($id)
    {
        $result = $this->con->query("SELECT * FROM anteproyecto WHERE id = '$id'");
        return $result;
    }
}
