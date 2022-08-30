<?php

require_once 'db.php';

class Coordinator extends DataBase
{
    public function __construct()
    {
        parent::__construct();
    }

    public function AssignCoach($asesor, $id_proyecto)
    {
        $this->con->query("UPDATE proyecto_grado SET asesor_user = '$asesor' WHERE id = '$id_proyecto'");

        $this->con->query("UPDATE proyecto_grado p JOIN docente d
        ON p.asesor_user = d.usuario
        SET p.nombre_asesor = concat(d.nombres, d.p_apellido)");
    }
}
