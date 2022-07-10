<?php

session_start();
error_reporting(0);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="../evaluer.ico">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página no encontrada</title>
</head>
<style>
    @import url("https://fonts.googleapis.com/css?family=Maven+Pro:400,700");

    * {
        font-family: "Maven Pro", sans-serif;
    }

    body {
        padding: 0;
        margin: 0;
        background: #f5f5f5;
        display: flex;
        flex-direction: column;
    }

    .header {
        display: flex;
        width: 100%;
        height: 95px;
        background: #0269ad;
        padding: 7px;
    }

    a {
        display: flex;
        align-items: center;
        text-align: center;
    }

    .header img {
        width: 200px;
        border-radius: 10px;
    }

    .content {
        margin-top: 70px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 30px 0;
    }

    body>label {
        text-align: center;
        margin: auto;
        font-size: 20px;
    }

    body>a {
        font-weight: bold;
        font-size: 17px;
        background: #0269ad;
        border-radius: 5px;
        padding: 15px;
        color: #fff;
        text-decoration: none;
        text-align: center;
        margin: 30px auto;
    }
</style>

<body>
    <div class="header">
        <a href="../index.php">
            <img src="../img/logo_p.png" alt=""></a>
    </div>

    <div class="content">
        <img src="../img//not-found.png" alt="">
    </div>
    <label>Esta página no existe. Es posible que el enlace sea incorrecto o o se haya eliminado.</label>
    <a href="../index.php">Ir a la página principal</a>
</body>

</html>