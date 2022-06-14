<?php

class DataBase{
    private $server;
    private $user;
    private $password;
    private $db;

    public function __construct()
    {
        $this->server= 'localhost';
        $this->user= 'root';
        $this->password= '';
        $this->db= 'evaluer';
    }

    public function connect (){
        $conexion = new mysqli($this->server,$this->user,$this->password,$this->db);
        return $conexion;
    }
}
