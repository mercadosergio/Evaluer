<?php

include_once ("../model/user.php");
include_once ("../model/user_session.php");

$userSession = new UserSession();
$user = new User();

if(isset($_SESSION['user'])){
    //echo "Hay sesión";
    $user->setUser($userSession->getCurrentUser());
    include_once '../pages/main-estudiante.php';
}else if(isset($_POST['user']) && isset($_POST['pass'])){
    //echo "Validación de login";

    $userForm = $_POST['user'];
    $passForm = $_POST['pass'];

    if($user->estudianteExists($userForm, $passForm)){
        echo "usuario validado";
        // $userSession->setCurrentUser($userForm);
        // $user->setUser($userForm);

        // include_once '../pages/main-estudiante.php';
    }else{
        //echo "nombre de usuario y/o password incorrecto";
        $errorLogin = "Nombre de usuario y/o password es incorrecto";
        include_once '../index.php';
    }

}else{
    //echo "Login";
    include_once '../index.php';
}


?>