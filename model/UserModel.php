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

    public function consultar($sql)
    {
        $result = $this->con->query($sql);
        return $result;
    }

    public function verificarRegistros($sql)
    {
        $result = $this->con->query($sql);
        return  $result->num_rows;
    }

    /*
        Función para agregar un usuario a la base de datos de evaluer, acción que se
        ejecuta cuando el administrador digite los datos requeridos para crear un usuario
        con datos y credenciales de sesión.
    */
    public function createUser($nombre, $usuario, $contraseña, $rol_id, $cedula)
    {
        $verify = $this->verificarRegistros("SELECT * FROM usuario WHERE cedula = '$cedula'");

        if ($verify <= 0) {
            $this->con->query("INSERT INTO usuario(nombre,usuario,contraseña,rol_id,cedula)
            VALUES ('$nombre','$usuario','$contraseña','$rol_id', '$cedula')");
        }
    }

    /*
        Función para agregar un usuario de tipo estudiante a la base de datos, este posee atributos y datos
        que le permiten interactuar con el sistema de entregas en el campo de investigación.
    */
    public function createEstudiante($nombre, $p_apellido, $s_apellido, $cedula, $programa, $semestre, $usuario, $email, $telefono)
    {
        $verify = $this->verificarRegistros("SELECT * FROM estudiante WHERE cedula = '$cedula'");
        if ($verify <= 0) {
            $this->con->query("INSERT INTO estudiante(nombre, p_apellido, s_apellido, cedula, programa, semestre,usuario,email,telefono)
         VALUES ('$nombre','$p_apellido','$s_apellido','$cedula','$programa',$semestre,'$usuario', '$email','$telefono')");

            $this->con->query("UPDATE estudiante e JOIN usuario u SET e.usuario_id = u.id WHERE e.cedula = u.cedula");
        }
    }
    /*
     
    */
    public function createCoordinador($nombre, $p_apellido, $s_apellido, $cedula, $programa, $usuario, $email, $telefono)
    {
        $verify = $this->verificarRegistros("SELECT * FROM coordinador WHERE cedula = '$cedula'");
        if ($verify <= 0) {
            $this->con->query("INSERT INTO coordinador(nombres, p_apellido, s_apellido, cedula, programa, usuario, usuario_id,email,telefono)
         SELECT '$nombre','$p_apellido','$s_apellido','$cedula','$programa','$usuario', id, '$email','$telefono' FROM usuario WHERE usuario = '$usuario'");
        }
    }
    /*
        Función para agregar un usuario de tipo asesor de investigación a la base de datos, este posee atributos y
        datos que le permiten interactuar con el rol docente o asesor de seguimiento para el cumplimiento de las
        metas realizadas.
    */
    public function createAsesor($nombre, $p_apellido, $s_apellido, $cedula, $programa, $usuario, $email, $telefono)
    {
        $verify = $this->verificarRegistros("SELECT * FROM asesor WHERE cedula = '$cedula'");
        if ($verify <= 0) {
            $this->con->query("INSERT INTO asesor(nombres, p_apellido, s_apellido, cedula, programa, usuario, usuario_id,email,telefono)
                            SELECT '$nombre','$p_apellido','$s_apellido','$cedula','$programa','$usuario', id, '$email','$telefono'
                            FROM usuario
                            WHERE usuario = '$usuario'");
        }
    }

    public function editUser($nombre,  $usuario, $cedula)
    {
        $sql = "UPDATE usuario SET nombre='$nombre', usuario='$usuario', cedula ='$cedula' WHERE cedula = '$cedula'";
        $this->con->query($sql);
    }


    public function editEstudiante($id, $nombre, $p_apellido, $s_apellido, $cedula, $programa, $semestre)
    {

        $sql = $this->con->query("UPDATE estudiante e SET e.nombre='$nombre', e.p_apellido='$p_apellido', e.s_apellido='$s_apellido', e.cedula='$cedula',
        e.programa='$programa', e.semestre='$semestre', e.usuario='$cedula' WHERE e.id = '$id'");

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
        // include("../admin/index.php");
    }

    public function editarImportEstudiante($nombre, $p_apellido, $s_apellido, $cedula, $programa, $semestre)
    {
        $this->con->query("UPDATE estudiante SET nombre='$nombre', p_apellido='$p_apellido', s_apellido='$s_apellido', cedula='$cedula',
        programa='$programa', semestre='$semestre', usuario='$cedula' WHERE cedula='$cedula'");
    }

    public function editAsesor($id, $nombre, $p_apellido, $s_apellido, $cedula, $programa_id)
    {
        $sql = "UPDATE asesor d JOIN programa p
                SET d.nombre='$nombre', d.p_apellido='$p_apellido', d.s_apellido='$s_apellido', d.cedula='$cedula',
                    d.programa_id='$programa_id', d.usuario='$cedula'
                    WHERE d.id = $id";
        $this->con->query($sql);

        $this->con->query("UPDATE asesor d JOIN programa p
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

    public function getProfileUser($session)
    {
        $result = $this->con->query("SELECT * FROM usuario WHERE usuario = " . $session);
        return $result;
    }
    public function getDocenteProfile()
    {
        $resultado = $this->con->query("SELECT * FROM asesor WHERE usuario = " . $_SESSION['usuario']);
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
        $this->con->query("DELETE FROM asesor WHERE id = '$id'") or die("Error al eliminar usuario");
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
        $unix = $this->con->query("SELECT time_password_interval FROM usuario WHERE usuario = " . $_SESSION['usuario']);
        $tiempo = mysqli_fetch_array($unix);

        if (time() > $tiempo['0']) {
            $unix = strtotime("+30 days, 12:00am", time());

            $this->con->query("UPDATE usuario SET contraseña ='$nueva_contraseña' WHERE usuario = '$usuario'");
        } else {
            echo '<div id="fail" class="alert alert-danger" role="alert" style="z-index: 9999999999999999; position:absolute; top:2%;left: 50%;transform: translate(-50%, 0%);">
            No puedes cambiar la contraseña hasta un cierto periodo
            </div>';
            echo "<script>
            setTimeout(function() {
            $('#fail').fadeOut('fast');
            }, 2000); // <-- time in milliseconds
            </script>";
        }
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

    public static function DateString($time)
    {
        global $TEMP;
        $diff = time() - $time;
        if ($diff < 1) {
            return $TEMP['#word']['now'];
        }
        $dates = array(
            31536000 => array($TEMP['#word']['year'], $TEMP['#word']['years']),
            2592000 => array($TEMP['#word']['month'], $TEMP['#word']['months']),
            86400 => array($TEMP['#word']['day'], $TEMP['#word']['days']),
            3600 => array($TEMP['#word']['hour'], $TEMP['#word']['hours']),
            60 => array($TEMP['#word']['minute'], $TEMP['#word']['minutes']),
            1 => array($TEMP['#word']['second'], $TEMP['#word']['seconds'])
        );
        foreach ($dates as $key => $value) {
            $was = $diff / $key;
            if ($was >= 1) {
                $was_int = intval($was);
                $string = $was_int > 1 ? $value[1] : $value[0];
                return "{$TEMP['#word']['does']} $was_int $string";
            }
        }
    }

    public function calcularIntervalo($createdAt, $actualDate)
    {
        $date1 = date_create($createdAt);
        $date2 = date_create($actualDate);
        $interval = date_diff($date1, $date2);

        $tiempo = array();

        foreach ($interval as $valor) {
            $tiempo[] = $valor;
        }
        if ($tiempo[5] >= 1 && $tiempo[3] < 1 && $tiempo[4] <= 0) {
            return "Ahora";
        } else if ($tiempo[4] >= 1 && $tiempo[3] <= 0) {
            return "Hace " . $tiempo[4] . " minutos";
        } else if ($tiempo[3] >= 1 && $tiempo[2] <= 0) {
            return "Hace " . $tiempo[3] . " horas";
        } else if ($tiempo[2] >= 1 && $tiempo[1] <= 0) {
            return "Hace " . $tiempo[2] . " dias";
        } else if ($tiempo[1] >= 1 && $tiempo[0] <= 0) {
            return "Hace " . $tiempo[1] . " meses";
        } else if ($tiempo[0] >= 1) {
            return "Hace " . $tiempo[0] . " años";
        }
    }
}
