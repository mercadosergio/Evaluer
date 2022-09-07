<?php
require_once 'db.php';
class User extends DataBase
{
    public function __construct()
    {
        parent::__construct();
    }

    //Obtener usuario para inicio de sesión
    public function getUser($username, $password)
    {
        $sql = "SELECT * FROM usuario WHERE usuario = '$username'";
        $result = $this->con->query($sql);

        $numrows = $result->num_rows;

        // $contador = 0;
        $array = mysqli_fetch_array($result);

        if (($numrows == 1) && (password_verify($password, $array['contraseña']))) {
            if ($array) {
                // Condición para iniciar sesión con los diferentes roles de la plataforma
                if ($array['rol_id'] == 1) { //Administrador
                    header("location: admin/index.php");
                } else if ($array['rol_id'] == 2) { //Coordinador
                    header("location: pages/coordinador/index.php");
                } else if ($array['rol_id'] == 3) { //Estudiante
                    header("location: pages/estudiante/index.php");
                } else if ($array['rol_id'] == 4) { //Docente
                    header("location: pages/docente/index.php");
                } else {
                    header("index.php");
                }
            } else {
                echo '<div id="alerta" class="alert alert-danger" role="alert" style="z-index: 9999999999999999; position:absolute; top:2%;
             left: 50%;transform: translate(-50%, 0%);">
                 Usuario no existe
             </div>';
            }
            return true;
        } else {
            return false;
        }
    }

    public function getStudents()
    {
        $result = $this->con->query("SELECT * FROM estudiante");
        $listaStudent = $result->fetch_all(MYSQLI_ASSOC);
        return $listaStudent;
    }
    public function listar($sql)
    {
        $result = $this->con->query($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    /*
        Función para agregar un usuario a la base de datos de evaluer, acción que se
        ejecuta cuando el administrador digite los datos requeridos para crear un usuario
        con datos y credenciales de sesión.
    */
    public function createUser($nombre, $email, $usuario, $contraseña, $rol_id)
    {
        $this->con->query("INSERT INTO usuario(nombre,email,usuario,contraseña,rol_id)
        VALUES ('$nombre','$email','$usuario','$contraseña','$rol_id')");
    }

    /*
        Función para agregar un usuario de tipo estudiante a la base de datos, este posee atributos y datos
        que le permiten interactuar con el sistema de entregas en el campo de investigación.
    */
    public function agregarEstudiante($nombre, $p_apellido, $s_apellido, $cedula, $programa_id, $semestre, $usuario)
    {
        $this->con->query("INSERT INTO estudiante(nombre, p_apellido, s_apellido, cedula, programa_id, semestre,usuario, time_propuesta, time_anteproyecto, time_proyecto, usuario_id,programa)
         SELECT '$nombre','$p_apellido','$s_apellido','$cedula','$programa_id',$semestre,'$usuario',100000000,100000000,100000000, u.id, p.nombre
         FROM usuario u
         JOIN programa p
         ON u.usuario = '$usuario' AND p.identificador = '$programa_id'");
    }
    /*
     
    */
    public function createCoordinador($nombre, $p_apellido, $s_apellido, $cedula, $programa_id, $usuario)
    {
        $this->con->query("INSERT INTO coordinador(nombres, p_apellido, s_apellido, cedula, programa_id, usuario, usuario_id, programa)
         SELECT '$nombre','$p_apellido','$s_apellido','$cedula','$programa_id','$usuario', u.id, p.nombre
         FROM usuario u
         JOIN programa p
         ON u.usuario = '$usuario' AND p.identificador = '$programa_id'");
    }
    /*
        Función para agregar un usuario de tipo asesor de investigación a la base de datos, este posee atributos y
        datos que le permiten interactuar con el rol docente o asesor de seguimiento para el cumplimiento de las
        metas realizadas.
    */
    public function createAsesor($nombre, $p_apellido, $s_apellido, $cedula, $programa_id, $usuario)
    {
        $this->con->query("INSERT INTO docente(nombres, p_apellido, s_apellido, cedula, programa_id, usuario, usuario_id, programa)
                            SELECT '$nombre','$p_apellido','$s_apellido','$cedula','$programa_id','$usuario', u.id, p.nombre
                            FROM usuario u
                            JOIN programa p
                            ON u.usuario = '$usuario' AND p.identificador = '$programa_id'");
    }



    public function editUser($nombre,  $usuario, $id)
    {
        $sql = "UPDATE usuario SET nombre='$nombre', usuario='$usuario' WHERE id = '$id'";
        $this->con->query($sql);
    }

    public function editEstudiante($id, $nombre, $p_apellido, $s_apellido, $cedula, $programa_id, $semestre)
    {
        $sql = "UPDATE estudiante e SET e.nombre='$nombre', e.p_apellido='$p_apellido', e.s_apellido='$s_apellido', e.cedula='$cedula',
        e.programa_id='$programa_id', e.semestre='$semestre', e.usuario='$cedula' WHERE e.id = '$id'";
        $this->con->query($sql);

        $this->con->query("UPDATE estudiante e JOIN programa p
                            ON p.identificador = '$programa_id'
                            SET e.programa = p.nombre");

        if (!$sql) {
            echo '<div id="fail" class="alert alert-danger" role="alert" style="z-index: 9999999999999999; position:absolute; top:2%;left: 50%;transform: translate(-50%, 0%);">
                      No se guardaron los cambios
                  </div>';
            echo "<script>
            setTimeout(function() {
                $('#fail').fadeOut('fast');
            }, 2000); // <-- time in milliseconds
            </script>";
        } else {
            echo '<div id="success" class="alert alert-success" role="alert" style="z-index: 9999999999999999; position:absolute; top:2%; left: 50%; transform: translate(-50%, 0%);">
            Cambios guardados con éxito
            </div>';
            echo "<script>
            setTimeout(function() {
                $('#success').fadeOut('fast');
            }, 2000); // <-- time in milliseconds
        </script>";
        }
        mysqli_close($this->con);
    }

    public function editAsesor($id, $nombre, $p_apellido, $s_apellido, $cedula, $programa_id)
    {
        $sql = "UPDATE docente d JOIN programa p
                SET d.nombre='$nombre', d.p_apellido='$p_apellido', d.s_apellido='$s_apellido', d.cedula='$cedula',
                    d.programa_id='$programa_id', d.usuario='$cedula'
                    WHERE d.id = $id";
        $this->con->query($sql);

        $this->con->query("UPDATE docente d JOIN programa p
        p.identificador = '$programa_id'
        SET d.programa = p.nombre");

        if (!$sql) {
            echo '<div id="fail" class="alert alert-danger" role="alert" style="z-index: 9999999999999999; position:absolute; top:2%;left: 50%;transform: translate(-50%, 0%);">
                      No se guardaron los cambios
                  </div>';
            echo "<script>
            setTimeout(function() {
                $('#fail').fadeOut('fast');
            }, 2000); // <-- time in milliseconds
            </script>";
        } else {
            echo '<div id="success" class="alert alert-success" role="alert" style="z-index: 9999999999999999; position:absolute; top:2%; left: 50%; transform: translate(-50%, 0%);">
            Cambios guardados con éxito
            </div>';
            echo "<script>
            setTimeout(function() {
                $('#success').fadeOut('fast');
            }, 2000); // <-- time in milliseconds
        </script>";
        }
        mysqli_close($this->con);
    }
    public function editCoordinador($id, $nombre, $p_apellido, $s_apellido, $cedula, $programa_id)
    {
        $sql = "UPDATE coordinador c JOIN programa p
                SET c.nombre='$nombre', c.p_apellido='$p_apellido', c.s_apellido='$s_apellido', c.cedula='$cedula',
                    c.programa_id='$programa_id', c.usuario='$cedula'
                    WHERE c.id = $id";
        $this->con->query($sql);

        $this->con->query("UPDATE coordinador c JOIN programa p
        p.identificador = '$programa_id'
        SET c.programa = p.nombre");

        if (!$sql) {
            echo '<div id="fail" class="alert alert-danger" role="alert" style="z-index: 9999999999999999; position:absolute; top:2%;left: 50%;transform: translate(-50%, 0%);">
                      No se guardaron los cambios
                  </div>';
            echo "<script>
            setTimeout(function() {
                $('#fail').fadeOut('fast');
            }, 2000); // <-- time in milliseconds
            </script>";
        } else {
            echo '<div id="success" class="alert alert-success" role="alert" style="z-index: 9999999999999999; position:absolute; top:2%; left: 50%; transform: translate(-50%, 0%);">
            Cambios guardados con éxito
            </div>';
            echo "<script>
            setTimeout(function() {
                $('#success').fadeOut('fast');
            }, 2000); // <-- time in milliseconds
        </script>";
        }
        mysqli_close($this->con);
    }
    /*
        Metodos para obtener datos de los usuario y roles que iniciaron sesión
    */

    public function getProfileUser()
    {
        $result = $this->con->query("SELECT * FROM usuario WHERE usuario = " . $_SESSION['usuario']);
        return $result;
    }
    public function getDocenteProfile()
    {
        $resultado = $this->con->query("SELECT * FROM docente WHERE usuario = " . $_SESSION['usuario']);
        return $resultado;
    }
    public function getStudentProfile()
    {
        $resultado = $this->con->query("SELECT * FROM estudiante WHERE usuario = " . $_SESSION['usuario']);
        return $resultado;
    }
    public function getCoordinatorProfile()
    {
        $resultado = $this->con->query("SELECT * FROM coordinador WHERE usuario = " . $_SESSION['usuario']);
        return $resultado;
    }

    public function deleteEstudiante($id)
    {
        $this->con->query("DELETE FROM estudiante WHERE id = '$id'") or die("Error al eliminar usuario");
        $this->con->query("CALL reset_increment()");
    }
    public function deleteAsesor($id)
    {
        $this->con->query("DELETE FROM docente WHERE id = '$id'") or die("Error al eliminar usuario");
        $this->con->query("CALL reset_increment()");
    }

    public function deleteCoordinador($id)
    {
        $this->con->query("DELETE FROM coordinador WHERE id = '$id'") or die("Error al eliminar usuario");
        $this->con->query("CALL reset_increment()");
    }

    public function deleteUser($usuario)
    {
        $this->con->query("DELETE FROM usuario WHERE usuario = '$usuario'") or die("Error al eliminar usuario");
        $this->con->query("CALL reset_increment()");
    }

    public function ChangePassword($nueva_contraseña, $usuario)
    {
        $this->con->query("UPDATE usuario SET contraseña ='$nueva_contraseña' WHERE usuario = '$usuario'");
    }

    public function ChangeProfilePhoto($photo, $usuario)
    {
        $this->con->query("UPDATE usuario SET foto = '$photo' WHERE usuario = '$usuario'");
    }
    /* 
        Cerrar sesión
    */
    public function cerrarSesion()
    {
        @session_start();
        session_destroy();
        header("location: ../index.php");
        exit();
    }
}
