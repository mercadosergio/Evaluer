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
        $myself = $this->con->query("SELECT * FROM docente WHERE usuario = '$usuario'");
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

    public function publicarAnuncio($contenido, $fecha, $programa, $nombre, $usuario)
    {
        $this->con->query("INSERT INTO anuncios(contenido,fecha,programa_id,nombre_usuario,usuario) VALUES ('$contenido','$fecha','$programa','$nombre','$usuario')");
    }

    public function deleteAnuncio()
    {
        $id_a = $_POST['id'];

        $this->con->query("DELETE FROM anuncios WHERE id = '$id_a'");
    }
}
