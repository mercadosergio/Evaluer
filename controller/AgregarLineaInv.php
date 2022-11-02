<?php
if (isset($_POST['save'])) {
    $linea = $_POST['linea'];
    $sublinea = $_POST['sublinea'];
    $objetivos = $_POST['objetivos'];
    $programa = $_POST['programa'];

    require "../../../model/Coordinador.php";
    $coordinador = new Coordinator();
    $coordinador->addLineaInvestigacion($linea, $sublinea, $objetivos, $programa);

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
        }, 3000); // <-- time in milliseconds
    </script>
<?php
}
?>