<?php

include("../model/conexion.php");

if (isset($_POST['cambiar'])) {
    $usuario = $_POST['user'];
    $clave_actual = $_POST['c_actual'];
    $nueva = $_POST['clave'];
    $repetir_nueva = $_POST['clave2'];

    if ($nueva == $repetir_nueva) {
        $conexion->query("UPDATE usuarios SET contraseña ='$nueva' WHERE usuario = '$usuario'");
?>
        <p style="position: absolute; padding: 10px;border-radius: 10px; top: 20%; left: 650px;opacity: 1;
		text-align: center; width: 20%; background: #abff96; color: #1e9700; border: 1px #1e9700 solid;" id="success">Cambios guardados con éxito</p>
        <script>
            setTimeout(function() {
                $('#success').fadeOut('fast');
            }, 2000); // <-- time in milliseconds
        </script>
        <?php
        $consulta_rol = $conexion->query("SELECT * FROM usuarios WHERE usuario = '$usuario'");
        $tupla = mysqli_fetch_array($consulta_rol);

        // Dependiendo del rol que tenga ese usuario que cambio la contraseña redirigir a su pargina principal
        if ($tupla['id_rol'] == 1) {
            header("location: ../admin/index.php");
        } else if ($tupla['id_rol'] == 2) {
            header("location: ../pages/main-coordinador.php");
        } else if ($tupla['id_rol'] == 3) {
            header("location: ../pages/main-estudiante.php");
        } else if ($tupla['id_rol'] == 4) {
            header("location: ../pages/main-docente.php");
        }
        mysqli_close($conexion);
    } else {
        ?>
        <p style="position: absolute; padding: 10px;border-radius: 10px; top: 20%; left: 650px;opacity: 1;
		text-align: center; width: 14%; background: rgb(255, 133, 133); color: rgb(184, 0, 0); border: 1px #1e9700 solid;" id="fail">La confirmación de contraseña no coinciden</p>
        <script>
            setTimeout(function() {
                $('#fail').fadeOut('fast');
            }, 2000); // <-- time in milliseconds
        </script>
<?php
        include("../support/change-password");
    }
}

?>