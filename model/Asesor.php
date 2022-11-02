<?php

require_once 'db.php';

class Asesor extends DataBase
{
    public function __construct()
    {
        parent::__construct();
    }

    public function identificarme()
    {
        $myself = $this->con->query("SELECT * FROM asesor WHERE usuario = '" . $_SESSION['usuario'] . "'");
        $array = mysqli_fetch_array($myself);
        return $array;
    }

    public function fechaLimitePropuesta($tiempo_limite)
    {
        $myRol = $this->identificarme();
        $this->con->query("UPDATE grupo SET time_propuesta = 0, time_limit_propuesta = $tiempo_limite WHERE asesor_id = " . $myRol['id']);
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
        $this->con->query("INSERT INTO post(contenido,fecha,programa,nombre_usuario,usuario,docente_id) VALUES ('$contenido','$fecha','$programa','$nombre','$usuario', $id)");
    }

    public function deleteAnuncio()
    {
        $id_a = $_POST['id'];

        $this->con->query("DELETE FROM post WHERE id = '$id_a'");
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
