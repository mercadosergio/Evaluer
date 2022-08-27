<?php
include 'db.php';
class Entidad extends DataBase
{

    /* Esta función devuelve una lista de los probramas alojados en la base de datos, que
    a su vez pertenecen al PEI institucional */
    public function getPrograma()
    {
        $consulta = "SELECT * FROM programas";
        $result = $this->connect()->query($consulta);

        while ($filas = mysqli_fetch_array($result)) {
            echo '<option value="' . $filas['identificador'] . '">' . $filas['nombre'] . '</option>';
        }
    }

    public function getProfileUser()
    {
        $consulta  = "SELECT * FROM usuarios WHERE usuario = " . $_SESSION['usuario'];
        $result = $this->connect()->query($consulta);
        $filas = mysqli_fetch_array($result);
        echo '<label class="cl">' . $filas['nombre'] . '</label>';
    }

    public function getProfileName()
    {
        $consulta  = "SELECT * FROM docente WHERE usuario = " . $_SESSION['usuario'];
        $result = $this->connect()->query($consulta);
        $filas = mysqli_fetch_array($result);
        echo $filas['nombres'] . ' ' . $filas['p_apellido'];
    }
    public function getProfileProgram()
    {
        $consulta  = "SELECT * FROM docente WHERE usuario = " . $_SESSION['usuario'];
        $result = $this->connect()->query($consulta);
        $filas = mysqli_fetch_array($result);
        echo $filas['programa_id'];
    }
    public function getProfilePhoto()
    {
        $consulta  = "SELECT * FROM usuarios WHERE usuario = " . $_SESSION['usuario'];
        $result = $this->connect()->query($consulta);
        $filas = mysqli_fetch_array($result);

        if ($filas['foto'] == null || $filas['foto'] == '') {
            echo 'default.png';
        } else {

            echo $filas['foto'];
        }
    }

    public function publicarAnuncio($contenido, $fecha, $programa, $nombre, $usuario)
    {
        $this->connect()->query("INSERT INTO anuncios(contenido,fecha,programa_id,nombre_usuario,usuario) VALUES ('$contenido','$fecha','$programa','$nombre','$usuario')");
    }

    public function getAnuncios()
    {
        $consulta  = "SELECT * FROM usuarios WHERE usuario = " . $_SESSION['usuario'];
        $result = $this->connect()->query($consulta);
        $arrayImg = mysqli_fetch_array($result);


        $sql = $this->connect()->query("SELECT * FROM anuncios WHERE usuario = " . $_SESSION['usuario']);
        while ($filas = mysqli_fetch_array($sql)) {

            if ($arrayImg['foto'] == null || $arrayImg['foto'] == null) {

                echo '<div class="grid">
                <input hidden type="text" name="id" value="' . $filas['id'] . '">
                    <div class="e1"><img src="../../files/photos/default.png"></div>
                    <div class="e2">' . $filas['nombre_user'] . '</div>
                    <div class="e3">
                        <p>' . $filas['fecha'] . '</p>
                    </div>
                    <div class="e4">
                        <p>' . $filas['contenido'] . '</p>
                    </div>
                    <button type="submit" class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                </div>';
            } else {
                echo '<div class="grid">
                    <div class="e1"><img src="../../files/photos/' . $arrayImg['foto'] . '"></div>
                    <div class="e2">' . $filas['nombre_user'] . '</div>
                    <div class="e3">
                        <p>' . $filas['fecha'] . '</p>
                    </div>
                    <div class="e4">
                        <p>' . $filas['contenido'] . '</p>
                    </div>
                    <button type="submit" class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                </div>';
            }
        }
    }

    public function deleteAnuncio()
    {
        $id_a = $_POST['id'];

        $this->connect()->query("DELETE FROM anuncios WHERE id = '$id_a'");
    }
}
