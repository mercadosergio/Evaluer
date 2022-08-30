<?php

if(isset($_POST['del'])){

    $remitente = $_GET['remitente'];
    
    $state= new Student();
    $state->DeletePropuesta($remitente);
    
    header("location: ../pages/estudiante/modulos/propuesta.php");
}
