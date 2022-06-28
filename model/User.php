<?php

// include_once 'db.php';
class Usuario extends DataBase
{

    //Atributos
    private $id;
    private $nombre;
    private $p_apellido;
    private $s_apellido;
    private $cedula;
    private $id_programa;
    private $semestre;
    private $email;
    private $usuario;

    private $con;

    public function __construct()
    {
        $this->con = new DataBase;
    }

    public function set($atributo, $contenido)
    {
        $this->$atributo = $contenido;
    }
    public function get($atributo)
    {
        return $this->$atributo;
    }

    public function crear()
    {
        $sql = "SELECT * FROM estudiante WHERE cedula = '{$this->cedula}'";
        $result = $this->connect()->query($sql);
        $num = mysqli_num_rows($result);

        if ($num != 0) {
            return false;
        } else {
            $new_student = "INSERT INTO estudiante(nombre,p_apellido,s_apellido,cedula,programa_id,semestre,usuario,time_propuesta, time_anteproyecto, time_proyecto)
            VALUES ('{$this->nombre}','{$this->p_apellido}','{$this->s_apellido}','{$this->cedula}','{$this->id_programa}','{$this->semestre}','{$this->usuario}','100000000','100000000','100000000')";
            $this->connect()->query($new_student);
            return true;
        }
    }

    public function eliminar()
    {
        $sql = "DELETE FROM estudiante WHERE usuario = '{$this->usuario}'";
        $this->connect()->query($sql);
    }

    public function ver()
    {
        $sql = "SELECT * FROM estudiante WHERE usuario = '{$this->usuario}' LIMIT 1";
        $result = $this->connect()->query($sql);
        $row = mysqli_fetch_array($result);

        $this->id = $row['id'];
        $this->nombre = $row['nombre'];
        $this->p_apellido = $row['p_apellido'];
        $this->s_apellido = $row['cedula'];
        $this->id_programa = $row['id_programa'];
        $this->semestre = $row['semestre'];
        $this->usuario = $row['usuario'];
    }

    public function editar()
    {
        $sql = "UPDATE estudiante SET nombre='{$this->nombre}', p_apellido='{$this->p_apellido}', s_apellido='{$this->s_apellido}', cedula='{$this->cedula}',
        programa_id='{$this->id_programa}',semestre='{$this->semestre}',usuario='{$this->usuario}' WHERE id = '{$this->id}'";
        $this->connect()->query($sql);
    }

    public function listar()
    {
        $sql = "SELECT * FROM estudiante";
        $resultado = $this->connect()->query($sql);
        return $resultado;
    }
}
