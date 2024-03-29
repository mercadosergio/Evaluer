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
        if ($result) {
        }
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


    public function restrictPropuesta($id_grupo)
    {
        $time_propuesta = $this->con->query("SELECT time_propuesta FROM grupo WHERE id= $id_grupo");
        $tiempo = mysqli_fetch_array($time_propuesta);
        return $tiempo['0'];
    }

    public function restrictAnteproyecto($id_grupo)
    {
        $time_propuesta = $this->con->query("SELECT time_anteproyecto FROM grupo WHERE id= $id_grupo");
        $tiempo = mysqli_fetch_array($time_propuesta);
        return $tiempo['0'];
    }

    public function restrictProyecto($id_grupo)
    {
        $time_propuesta = $this->con->query("SELECT time_proyecto FROM grupo WHERE id= $id_grupo");
        $tiempo = mysqli_fetch_array($time_propuesta);
        return $tiempo['0'];
    }

    /*
    Funciones de soporte para el rol visualizador o evaluador
    */
    public function listarPropuestas($asesor_id)
    {
        $group = parent::consultar("SELECT * FROM grupo WHERE asesor_id = '$asesor_id'");
        $registro = mysqli_fetch_array($group);

        $result = $this->con->query("SELECT * FROM propuesta WHERE grupo_id='" . $registro['id'] . "' ORDER BY fecha");
        return $result;
    }

    public function revisionAnteproyectos()
    {
        $profile = $this->getProfileAsesor();
        $registro = mysqli_fetch_array($profile);

        $result = $this->con->query("SELECT * FROM anteproyecto WHERE programa='" . $registro['programa'] . "' ORDER BY fecha");
        return $result;
    }

    public function revisionProyectos()
    {
        $profile = $this->getProfileAsesor();
        $registro = mysqli_fetch_array($profile);

        $result = $this->con->query("SELECT * FROM proyecto_grado WHERE programa='" . $registro['programa'] . "' ORDER BY fecha");
        return $result;
    }
    public function getProyecto($id)
    {
        $result = $this->con->query("SELECT * FROM proyecto_grado WHERE id = '$id'");
        return $result;
    }


    public function getPqr()
    {
        $resultado = $this->con->query("SELECT * FROM pqr");
        $cantidad = $resultado->num_rows;
        if ($cantidad >= 1) {
            return true;
        } else {
            return false;
        }
    }

    public function publicarMaterial($asesor_id, $nombre, $ruta)
    {
        $this->con->query("INSERT INTO material_academico(nombre,ruta,asesor_id) VALUES ('$nombre', '$ruta','$asesor_id')");
    }
    public function getMaterial($id)
    {
        $result = $this->con->query("SELECT * FROM material_academico WHERE asesor_id = $id");
        return  $result;
    }
}
