<?php
include("../model/conexion.php");

// session_start();
if (isset($_POST['agregar_e'])) {
    $nombre = $_POST['nombre'];
    $p_apellido = $_POST['p_apellido'];
    $s_apellido = $_POST['s_apellido'];
    $id_n = $_POST['cedula'];
    $programa_id = $_POST['programa_id'];
    $semestre = $_POST['semestre'];
    $email = $_POST['email'];


    if ($programa_id == '1') {
?>
        <p style="position: absolute; padding: 10px;border-radius: 10px; top: 20%; left: 650px;opacity: 1;
		text-align: center; width: 14%; background: rgb(255, 133, 133); color: rgb(184, 0, 0); border: 1px #1e9700 solid;" id="fail">Seleccione un programa académico</p>
        <script>
            setTimeout(function() {
                $('#fail').fadeOut('fast');
            }, 2000); // <-- time in milliseconds
        </script>
    <?php
    } else {
        // Se inserta un nuevo usuario con rol estudiante
        $conexion->query("INSERT INTO usuarios(nombre,email,usuario,contraseña,id_rol) 
            VALUES ('$nombre','$email','$id_n','$id_n','3')");

        $json = json_encode($programa_id, true);
        // Se insertan los datos del estudiante 

        for ($i = 0; $i < count($programa_id); $i++) {
            $conexion->query("INSERT INTO estudiante(nombre,p_apellido,s_apellido,cedula,programa_id,semestre,usuario) 
            VALUES ('$nombre','$p_apellido','$s_apellido','$id_n','$programa_id[$i]','$semestre','$id_n')");

            $conexion->query("UPDATE estudiante e
            JOIN programas p ON e.programa_id = p.identificador
            SET e.programa = p.nombre");

            $conexion->query("UPDATE estudiante e
            JOIN usuarios u ON e.usuario = u.usuario
            SET e.id_usuario = u.id");
        }
        header("location: ../admin/index.php");
        mysqli_close($conexion);
    }
} else if (isset($_POST['agregar_docente'])) {
    $nombre = $_POST['nombre'];
    $p_apellido = $_POST['p_apellido'];
    $s_apellido = $_POST['s_apellido'];
    $id_n = $_POST['cedula'];
    $programa_id = $_POST['programa_id'];
    $email = $_POST['email'];


    if ($programa_id == '1') {
    ?>
        <p style="position: absolute; padding: 10px;border-radius: 10px; top: 20%; left: 650px;opacity: 1;
		text-align: center; width: 14%; background: rgb(255, 133, 133); color: rgb(184, 0, 0); border: 1px #1e9700 solid;" id="fail">Seleccione un programa académico</p>
        <script>
            setTimeout(function() {
                $('#fail').fadeOut('fast');
            }, 2000); // <-- time in milliseconds
        </script>
<?php
    } else {
        // Se inserta un nuevo usuario con rol estudiante
        $conexion->query("INSERT INTO usuarios(nombre,email,usuario,contraseña,id_rol) 
            VALUES ('$nombre','$email','$id_n','$id_n','4')");

        $json = json_encode($programa_id, true);
        // Se insertan los datos del estudiante 

        for ($i = 0; $i < count($programa_id); $i++) {
            $conexion->query("INSERT INTO docente(nombres,p_apellido,s_apellido,cedula,programa_id,usuario) 
            VALUES ('$nombre','$p_apellido','$s_apellido','$id_n','$programa_id[$i]','$id_n')");

            $conexion->query("UPDATE docente e JOIN programas p 
            ON e.programa_id = p.identificador
            SET e.programa = p.nombre");

            $conexion->query("UPDATE docente e
            JOIN usuarios u ON e.usuario = u.usuario
            SET e.id_usuario = u.id");
        }
        header("location: ../admin/index.php");
        mysqli_close($conexion);
    }
} else if (isset($_POST['agregar_coo'])) {
    $nombre = $_POST['nombre'];
    $p_apellido = $_POST['p_apellido'];
    $s_apellido = $_POST['s_apellido'];
    $id_n = $_POST['cedula'];
    $programa_id = $_POST['programa_id'];
    $email = $_POST['email'];

    // Se inserta un nuevo usuario con rol estudiante
    $conexion->query("INSERT INTO usuarios(nombre,email,usuario,contraseña,id_rol) 
            VALUES ('$nombre','$email','$id_n','$id_n','2')");

    // $json = json_encode($programa_id, true);
    // Se insertan los datos del estudiante 


    $conexion->query("INSERT INTO coordinador(nombres,p_apellido,s_apellido,cedula,programa_id,usuario) 
            VALUES ('$nombre','$p_apellido','$s_apellido','$id_n','$id_n')");

    $conexion->query("UPDATE coordinador cr JOIN programas p 
            ON cr.programa_id = p.identificador
            SET cr.programa = p.nombre");

    $conexion->query("UPDATE coordinador cr
            JOIN usuarios u ON cr.usuario = u.usuario
            SET cr.id_usuario = u.id");

    header("location: ../admin/index.php");
    mysqli_close($conexion);
}
