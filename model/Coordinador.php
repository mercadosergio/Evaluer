<?php

require_once 'db.php';

class Coordinator extends DataBase
{
    public function __construct()
    {
        parent::__construct();
    }

    public function AssignCoach($id_asesor, $id)
    {
        $this->con->query("UPDATE grupo SET asesor_id = $id_asesor WHERE id = $id");

        $this->con->query("UPDATE grupo e JOIN asesor d
        ON e.asesor_id = d.id
        SET e.nombre_asesor = concat(d.nombres,' ',d.p_apellido)");
    }
    public function AssignJudge($jurado1, $jurado2, $jurado3, $id)
    {
        $this->con->query("UPDATE proyecto_grado SET jurado1 = '$jurado1', jurado2 = '$jurado2', jurado3 = '$jurado3' WHERE id = $id");

        $this->con->query("UPDATE proyecto_grado e JOIN asesor d
        ON e.asesor_id = d.id
        SET e.asesor = concat(d.nombres,' ',d.p_apellido)");
    }
}
