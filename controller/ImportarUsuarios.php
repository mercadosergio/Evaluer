<?php

include_once "../model/UserModel.php";

$role = $_POST['role'];
$file_type = $_FILES['file_send']['type'];
$file_size = $_FILES['file_send']['size'];
$filetmp = $_FILES['file_send']['tmp_name'];
$lineas = file($filetmp);

$i = 0;

foreach ($lineas as $linea) {
    $cantidad_registros = count($lineas);
    $cantidad_regist_agregados =  ($cantidad_registros - 1);

    if ($i != 0) {

        $datos = explode(";", $linea);

        $nombre                = !empty($datos[0])  ? ($datos[0]) : '';
        $p_apellido                = !empty($datos[1])  ? ($datos[1]) : '';
        $s_apellido               = !empty($datos[2])  ? ($datos[2]) : '';
        $cedula            = !empty($datos[3])  ? ($datos[3]) : '';
        $programa            = !empty($datos[4])  ? ($datos[4]) : '';

        $admin = new User();
        if (!empty($cedula)) {
            $check_duplicado = $admin->consultar("SELECT cedula FROM estudiante WHERE cedula='" . ($cedula) . "' ");
            $cant_duplicado = $check_duplicado->num_rows;
        }

        //No existe Registros Duplicados
        for ($j = 0; $j < count($role); $j++) {
            if ($cant_duplicado == 0) {

                $admin->createUser($nombre, $cedula, password_hash($cedula, PASSWORD_DEFAULT), $role[$j], $cedula);
                if ($role[$j] == 2) {
                } else if ($role[$j] == 3) {
                    $semestre                = !empty($datos[5])  ? ($datos[5]) : '';
                    $telefono              = !empty($datos[6])  ? ($datos[6]) : '';
                    $email              = !empty($datos[7])  ? ($datos[7]) : '';
                    $admin->createEstudiante($nombre, $p_apellido, $s_apellido, $cedula, $programa, $semestre, $cedula, $email, $telefono);
                } else if ($role[$j] == 4) {
                }
            }
            /**Caso Contrario actualizo el o los Registros ya existentes*/
            else {
                // $admin->editUser($nombre, $cedula, $cedula);
                if ($role[$j] == 2) {
                } else if ($role[$j] == 3) {
                    $semestre = !empty($datos[5]) ? ($datos[5]) : '';
                    $telefono = !empty($datos[6]) ? ($datos[6]) : '';
                    $email = !empty($datos[7]) ? ($datos[7]) : '';
                    // $admin->editarImportEstudiante($nombre, $p_apellido, $s_apellido, $cedula, $programa, $semestre);
                } else if ($role[$j] == 4) {
                }
            }
        }
    }

    $i++;
}
// include("../admin/index.php");

?>
<div class="saving" id="loader">
    <div class="lds-facebook loader" id="loader">
        <div></div>
        <div></div>
        <div></div>
    </div>
    Guardando...
</div>
<script>
    setTimeout(function() {
        $('#loader').fadeOut('fast');
    }, 2500); // <-- time in milliseconds
</script>