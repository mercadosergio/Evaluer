<?php

include '../model/UserModel.php';


class ControladorEstudiante
{
    private $estudiante;

    public function __construct()
    {
        $this->estudiante = new User;
    }

    public function crear($nombre, $p_apellido, $s_apellido, $cedula, $programa, $semestre, $usuario)
    {
        $this->estudiante->set("nombre", $nombre);
        $this->estudiante->set("p_apellido", $p_apellido);
        $this->estudiante->set("s_apellido", $s_apellido);
        $this->estudiante->set("cedula", $cedula);
        $this->estudiante->set("programa", $programa);
        $this->estudiante->set("semestre", $semestre);
        $this->estudiante->set("usuario", $usuario);

        $resultado = $this->estudiante->crearEstudiante();
        return $resultado;
    }
}
