<?php

if (isset($_POST['submit'])) {
    $coordinador = new Coordinator();
    $id = $_POST['id'];
    $jurado1 = $_POST['jurado1'];
    $jurado2 = $_POST['jurado2'];
    $jurado3 = $_POST['jurado3'];

    for ($i = 0; $i < count($jurado1); $i++) {
        for ($j = 0; $j < count($jurado2); $j++) {
            for ($k = 0; $k < count($jurado3); $k++) {
                if ($jurado1[$i] != $jurado2[$j] && $jurado1[$i] != $jurado3[$k] && $jurado2[$j] != $jurado3[$k]) {
                    $coordinador->AssignJudge($jurado1[$i], $jurado2[$j], $jurado3[$k], $id);
                } else {
                    echo 'debe seleccionar 3 diferentes';
                }
            }
        }
    }
}
