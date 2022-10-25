<?php

require_once 'db.php';

class Student extends DataBase
{
    public function __construct()
    {
        parent::__construct();
    }


    public function EnviarPropuesta($titulo, $linea, $integrantes, $tutor, $lider, $programa_id, $semestre, $descripcion, $miembro1, $miembro2, $miembro3, $fecha, $usuario, $id_grupo)
    {
        $time_propuesta = $this->con->query("SELECT time_propuesta FROM grupo WHERE id = $id_grupo");
        $tiempo = mysqli_fetch_array($time_propuesta);
        if (time() > $tiempo['0']) {
            $time_propuesta = strtotime("+365 days, 12:00am", time());

            $this->con->query("INSERT INTO propuesta(titulo, linea, integrantes, tutor, lider, programa_id, semestre, descripcion, miembro1, miembro2, miembro3, fecha, remitente, programa, estudiante_id, grupo_id)
                                             SELECT '$titulo','$linea','$integrantes','$tutor','$lider','$programa_id','$semestre','$descripcion','$miembro1','$miembro2','$miembro3','$fecha', '$usuario', p.nombre, es.id, $id_grupo
                                             FROM programa p
                                             JOIN estudiante es
                                             ON p.identificador = '$programa_id' AND es.usuario = '$usuario'");

            $this->con->query("UPDATE grupo SET time_propuesta = '$time_propuesta' WHERE id= $id_grupo");
        }
    }

    public function EnviarAnteproyecto($nombre, $ruta, $comentario, $usuario, $fecha, $programa_id, $programa, $id_grupo)
    {
        $time_anteproyecto = $this->con->query("SELECT time_anteproyecto FROM grupo WHERE id = $id_grupo");
        $tiempo = mysqli_fetch_array($time_anteproyecto);

        if (time() > $tiempo['0']) {
            $time_anteproyecto = strtotime("+15 days, 12:00am", time());

            $this->con->query("INSERT INTO anteproyecto(nombre,documento,comentarios,remitente,fecha, programa_id, programa, titulo, estudiante_id, grupo_id) 
                            SELECT '$nombre','$ruta','$comentario','$usuario','$fecha', '$programa_id', '$programa', pro.titulo, es.id, $id_grupo
                            FROM propuesta pro
                            JOIN estudiante es
                            ON pro.remitente = '$usuario' AND es.usuario = '$usuario'");

            $this->con->query("UPDATE grupo SET time_anteproyecto = '$time_anteproyecto' WHERE id = $id_grupo");
        } else {
            echo '<div id="fail" class="alert alert-danger" role="alert" style="z-index: 9999999999999999; position:absolute; top:2%;left: 50%;transform: translate(-50%, 0%);">
			            No puedes entregar hasta la proxima fecha
		        </div>';
            echo "<script>
                    setTimeout(function() {
                    $('#fail').fadeOut('fast');
                    }, 2000); // <-- time in milliseconds
                </script>";
        }
    }

    public function ProyectoFinal($nombre, $ruta, $usuario, $fecha, $programa_id, $programa, $id_grupo)
    {
        $time_proyecto = $this->con->query("SELECT time_proyecto FROM grupo WHERE id = $id_grupo");
        $tiempo = mysqli_fetch_array($time_proyecto);

        if (time() > $tiempo['0']) {
            $time_proyecto = strtotime("+15 days, 12:00am", time());

            $this->con->query("INSERT INTO proyecto_grado(nombre,documento,remitente,fecha, programa_id, programa, titulo, estudiante_id, semestre, grupo_id) 
                            SELECT '$nombre','$ruta','$usuario','$fecha', '$programa_id', '$programa', pro.titulo, es.id, es.semestre, $id_grupo
                            FROM propuesta pro
                            JOIN estudiante es
                            ON pro.remitente = '$usuario' AND es.usuario = '$usuario'");

            $this->con->query("UPDATE grupo SET time_proyecto = '$time_proyecto' WHERE id = $id_grupo");
        } else {
            echo '<div id="fail" class="alert alert-danger" role="alert" style="z-index: 9999999999999999; position:absolute; top:2%;left: 50%;transform: translate(-50%, 0%);">
			            No puedes entregar hasta la proxima fecha
		        </div>';
            echo "<script>
                    setTimeout(function() {
                    $('#fail').fadeOut('fast');
                    }, 2000); // <-- time in milliseconds
                </script>";
        }
    }

    public function DeletePropuesta($usuario)
    {
        $this->con->query("DELETE FROM propuesta WHERE remitente = '$usuario'");
        $this->con->query("UPDATE estudiante SET time_propuesta = 0 WHERE usuario = '$usuario'");
    }

    public function getMyPropuesta($id_grupo)
    {
        $resultado = $this->con->query("SELECT * FROM propuesta WHERE grupo_id = $id_grupo");
        return $resultado;
    }

    public function getMyAnteproyecto($id_grupo)
    {
        $resultado = $this->con->query("SELECT * FROM anteproyecto WHERE grupo_id=$id_grupo");
        return $resultado;
    }

    public function getMyGroup($myself)
    {
        $resultado = $this->con->query("SELECT * FROM grupo WHERE nombre_integrante1 = '$myself' OR nombre_integrante2 = '$myself' OR nombre_integrante3 = '$myself'");
        return $resultado;
    }

    public function getByDi($cedula)
    {
        // $resultado = $this->con->query("SELECT * FROM estudiante WHERE cedula = '$cedula'");
        $resultado = $this->con->query("SELECT * FROM estudiante WHERE cedula LIKE '%{$cedula}%'");
        return $resultado;
    }

    public function GroupByDi($cedula)
    {
        $resultado = $this->con->query("SELECT * FROM grupo WHERE di_integrante1 = '$cedula' OR di_integrante2 = '$cedula' OR di_integrante3 = '$cedula'");
        return $resultado;
    }

    public function asignarGrupo($integrantes, $cedula1, $cedula2, $cedula3, $name1, $name2, $name3, $programa, $semestre, $periodo)
    {
        $this->con->query("INSERT INTO grupo(n_integrantes,di_integrante1, nombre_integrante1,di_integrante2, nombre_integrante2,di_integrante3, nombre_integrante3, programa, semestre,periodo)
        VALUES ('$integrantes','$cedula1','$name1','$cedula2','$name2','$cedula3','$name3','$programa','$semestre','$periodo')");

        $this->con->query("UPDATE estudiante e JOIN grupo g 
        ON e.cedula = g.di_integrante1 OR
        e.cedula = g.di_integrante2 OR
        e.cedula = g.di_integrante3
        SET e.grupo_id = g.id");
    }
}
