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
        $consulta  = "SELECT * FROM usuarioS WHERE usuario = " . $_SESSION['usuario'];
        $result = $this->connect()->query($consulta);
        $filas = mysqli_fetch_array($result);
        echo '<img src="../files/photos' . $filas['foto'] . '">';
        echo '<label class="cl">' . $filas['nombre'] . '</label>';
    }
}
