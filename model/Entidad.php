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
    public function getProfilePhoto()
    {
        $consulta  = "SELECT * FROM usuarios WHERE usuario = " . $_SESSION['usuario'];
        $result = $this->connect()->query($consulta);
        $filas = mysqli_fetch_array($result);

        if ($filas['foto'] == null || $filas['foto'] == null) {
            echo 'default.png';
        } else {

            echo $filas['foto'];
        }
    }
}
