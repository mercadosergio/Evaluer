<?php

class User extends DataBase
{
    //Atributos
    private $id;
    private $nombre;
    private $p_apellido;
    private $s_apellido;
    private $cedula;
    private $programa;
    private $semestre;
    private $email;
    private $usuario;

    private $con;

    //Obtener usuario para inicio de sesión
    public function getUser($username, $password)
    {
        $sql = "SELECT * FROM usuarios WHERE usuario = '$username' AND contraseña = '$password'";
        $result = $this->connect()->query($sql);
        $numrows = $result->num_rows;

        if ($numrows == 1) {
            $array = mysqli_fetch_array($result);
            if ($array) {
                // Condición para iniciar sesión con los diferentes roles de la plataforma
                if ($array['id_rol'] == 1) { //Administrador
                    header("location: admin/index.php");
                } else if ($array['id_rol'] == 2) { //Coordinador
                    header("location: pages/coordinador/index.php");
                } else if ($array['id_rol'] == 3) { //Estudiante
                    header("location: pages/estudiante/index.php");
                } else if ($array['id_rol'] == 4) { //Docente
                    header("location: pages/docente/index.php");
                } else {
                    header("index.php");
                }
            } else {
                echo '<div id="alerta" class="alert alert-danger" role="alert" style="z-index: 9999999999999999; position:absolute; top:2%;
            left: 50%;transform: translate(-50%, 0%);">
                Usuario no existe
            </div>';
                include_once 'index.php';
            }
            return true;
        } else {
            return false;
        }
    }
    /*
    Función para agregar un usuario a la base de datos de evaluer, acción que se
    ejecuta cuando el administrador digite los datos requeridos para crear un usuario
    con datos y credenciales de sesión.
    */
    public function createUser($nombre, $email, $usuario, $contraseña, $id_rol)
    {
        $new_user = "INSERT INTO usuarios(nombre,email,usuario,contraseña,id_rol)
        VALUES ('$nombre','$email','$usuario','$contraseña','$id_rol')";
        $this->connect()->query($new_user);

        mysqli_close($this->connect());

        return true;
    }

    /*
    Función para agregar un usuario de tipo estudiante a la base de datos, este posee atributos y datos
    que le permiten interactuar con el sistema de entregas en el campo de investigación.
    */
    // public function crearEstudiante()
    // {
    //     $new_student = "INSERT INTO estudiante(nombre,p_apellido,s_apellido,cedula,programa_id,semestre,usuario,time_propuesta, time_anteproyecto, time_proyecto)
    //             VALUES ('{$this->nombre}','{$this->p_apellido}','{$this->s_apellido}','{$this->cedula}','{$this->programa}','{$this->semestre}','{$this->usuario}','100000000','100000000','100000000')";
    //     $this->connect()->query($new_student);
    // }
    public function createEstudiante($nombre, $p_apellido, $s_apellido, $cedula, $programa_id, $semestre, $usuario)
    {

        $new_student = "INSERT INTO estudiante(nombre,p_apellido,s_apellido,cedula,programa_id,semestre,usuario,time_propuesta, time_anteproyecto, time_proyecto)
            VALUES ('$nombre','$p_apellido','$s_apellido','$cedula','$programa_id','$semestre','$usuario','100000000','100000000','100000000')";
        $this->connect()->query($new_student);


        $this->connect()->query("UPDATE estudiante e
        JOIN programas p ON e.programa_id = p.identificador
        SET e.programa = p.nombre");

        $this->connect()->query("UPDATE estudiante e
        JOIN usuarios u ON e.usuario = u.usuario
        SET e.id_usuario = u.id");
        mysqli_close($this->connect());
        return true;
    }
    /*
     Función para agregar un usuario de tipo asesor de investigación a la base de datos, este posee atributos y
     datos que le permiten interactuar con el rol docente o asesor de seguimiento para el cumplimiento de las
     metas realizadas.
    */
    public function createCoordinador($nombre, $p_apellido, $s_apellido, $cedula, $programa_id, $usuario)
    {
        $coordinator = "INSERT INTO coordinador(nombres,p_apellido,s_apellido,cedula,programa_id,usuario)
                VALUES ('$nombre','$p_apellido','$s_apellido','$cedula','$programa_id','$usuario')";
        $this->connect()->query($coordinator);

        $this->connect()->query("UPDATE coordinador cr JOIN programas p
        ON cr.programa_id = p.identificador
        SET cr.programa = p.nombre");

        $this->connect()->query("UPDATE coordinador cr
        JOIN usuarios u ON cr.usuario = u.usuario
        SET cr.id_usuario = u.id");

        mysqli_close($this->connect());
        return true;
    }
    /*


    */
    public function createAsesor($nombre, $p_apellido, $s_apellido, $cedula, $programa_id, $usuario)
    {
        $new_tutor = "INSERT INTO docente(nombres,p_apellido,s_apellido,cedula,programa_id,usuario)
                VALUES ('$nombre','$p_apellido','$s_apellido','$cedula','$programa_id','$usuario')";
        $this->connect()->query($new_tutor);

        $this->connect()->query("UPDATE docente e JOIN programas p
        ON e.programa_id = p.identificador
        SET e.programa = p.nombre");

        $this->connect()->query("UPDATE docente e
        JOIN usuarios u ON e.usuario = u.usuario
        SET e.id_usuario = u.id");

        mysqli_close($this->connect());
        return true;
    }


    public function establecerLimitePropuesta($programa_id)
    {
        $this->connect()->query("UPDATE estudiante SET time_propuesta = 0 WHERE programa_id ='$programa_id'");
    }

    public function deleteUser()
    {
        $del = "DELETE FROM estudiante WHERE usuario = '{$this->usuario}";
    }

    public function showEstudiantes()
    {
        $mostrar_by_id = "SELECT id,nombre,p_apellido,s_apellido,cedula,programa,semestre,usuario FROM estudiante ORDER BY id";
        $result = $this->connect()->query($mostrar_by_id);
        $row = mysqli_fetch_array($result);

        $this->id = $row['id'];
        $this->nombre = $row['nombre'];
        $this->p_apellido = $row['p_apellido'];
        $this->s_apellido = $row['s_apellido'];
        $this->cedula = $row['cedula'];
        $this->programa = $row['programa'];
        $this->semestre = $row['semestre'];
        $this->usuario = $row['usuario FROM'];
    }
}
