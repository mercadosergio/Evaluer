<?php

require_once 'db.php';

class Metodos extends DataBase
{
    /* Variables para establecer la conexión entre la clase y la base de datos*/

    /**
     *  Función para emitir cualquier consulta específica a la base de datos y recibir registros
     */
    public function listar($sql)
    {
        $result = $this->con->query($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function viewAnuncio()
    {
        $sql2 = "SELECT * FROM post";
        $result2 = $this->con->query($sql2);
        return $result2;
    }

    public function viewAnuncioSender()
    {

        // $sql = "SELECT * FROM usuario WHERE usuario = " . $_SESSION['usuario'];
        // $result = mysqli_query($conexion, $sql);
        // $arrayImg = mysqli_fetch_array($result);

        $sql2 = "SELECT * FROM post WHERE usuario = " . $_SESSION['usuario'];
        $result2 = $this->con->query($sql2);
        return $result2;
    }

    public function getProfileUser()
    {
        $consulta  = "SELECT * FROM usuario WHERE usuario = " . $_SESSION['usuario'];
        $result = $this->con->query($consulta);
        return $result;
    }
    public function getProfileAsesor()
    {
        $sql  = "SELECT * FROM asesor WHERE usuario = " . $_SESSION['usuario'];
        $resultado = $this->con->query($sql);
        return $resultado;
    }


    public function restrictPropuesta()
    {
        $time_propuesta = $this->con->query("SELECT time_propuesta FROM estudiante WHERE usuario=" . $_SESSION['usuario']);
        $tiempo = mysqli_fetch_array($time_propuesta);
        return $tiempo['0'];
    }

    public function restrictAnteproyecto()
    {
        $time_propuesta = $this->con->query("SELECT time_anteproyecto FROM estudiante WHERE usuario=" . $_SESSION['usuario']);
        $tiempo = mysqli_fetch_array($time_propuesta);
        return $tiempo['0'];
    }

    public function restrictProyecto()
    {
        $time_propuesta = $this->con->query("SELECT time_proyecto FROM estudiante WHERE usuario=" . $_SESSION['usuario']);
        $tiempo = mysqli_fetch_array($time_propuesta);
        return $tiempo['0'];
    }

    /*
    Funciones de soporte para el rol visualizador o evaluador
    */
    public function listarPropuestas()
    {
        $profile = $this->getProfileAsesor();
        $registro = mysqli_fetch_array($profile);

        $result = $this->con->query("SELECT * FROM propuesta WHERE programa_id=" . $registro['programa_id'] . " ORDER BY fecha");
        return $result;
    }

    public function revisionAnteproyectos()
    {
        $profile = $this->getProfileAsesor();
        $registro = mysqli_fetch_array($profile);

        $result = $this->con->query("SELECT * FROM anteproyecto WHERE programa_id=" . $registro['programa_id'] . " ORDER BY fecha");
        return $result;
    }

    public function revisionProyectos()
    {
        $profile = $this->getProfileAsesor();
        $registro = mysqli_fetch_array($profile);

        $result = $this->con->query("SELECT * FROM proyecto_grado WHERE programa_id=" . $registro['programa_id'] . " ORDER BY fecha");
        return $result;
    }
    public function getProyecto($id)
    {
        $result = $this->con->query("SELECT * FROM proyecto_grado WHERE id = '$id'");
        return $result;
    }
}
