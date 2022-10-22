<?php
if (isset($_POST['id']) && isset($_POST['id_asesor'])) {
    $id = $_POST['id'];
    $id_asesor = $_POST['id_asesor'];


    for ($i = 0; $i < count($id_asesor); $i++) {
        $obj = new Coordinator();
        $obj->AssignCoach($id_asesor[$i], $id);
    }
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

<script>
    // window.location = "../pages/coordinador/modulos/asignar-asesor.php";
</script>