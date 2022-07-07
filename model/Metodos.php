<?php

include 'db.php';

class Metodos
{
    public function listar($sql)
    {
        $c = new DataBase();
        $conexion = $c->connect();

        $result = mysqli_query($conexion, $sql);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}
