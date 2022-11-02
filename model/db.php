<?php

class DataBase
{
    private $server = 'localhost';
    private $user = 'root';
    private $password = '';
    private $db = 'evaluer';
    protected $con;

    public function __construct()
    {
        $this->con = new mysqli($this->server, $this->user, $this->password, $this->db);
        if ($this->con->connect_errno) {
            return "Error en conexión de bd";
        }
    }

    public function consultar($query){
        $result = $this->con->query($query);
        return $result;
    }
}
