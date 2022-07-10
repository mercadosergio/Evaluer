<?php

include 'db.php';

class Metodos
{
    public $db;
    private $conexion;

    public function listar($sql)
    {
        $this->db = new DataBase();
        $this->conexion = $this->db->connect();
        $result = mysqli_query($this->conexion, $sql);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function viewAnuncio()
    {
        $c = new DataBase();
        $conexion = $c->connect();

        $sql2 = "SELECT * FROM anuncios";
        $result2 = mysqli_query($conexion, $sql2);
        // $row = mysqli_fetch_array($result2);
        // $contenido = $row['contenido'];
        return $result2;
    }

    public function getProfileUser()
    {
        $this->db = new DataBase();
        $this->conexion = $this->db->connect();
        $consulta  = "SELECT * FROM usuarios WHERE usuario = " . $_SESSION['usuario'];
        $result = mysqli_query($this->conexion, $consulta);
        return $result;
    }
}
