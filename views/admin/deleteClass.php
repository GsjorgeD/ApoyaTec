<?php
require_once '../../controllers/userController.php';
$user = new UserController();
$user->headPages('Eliminar clase');

include("../../database/conect.php");
$idCurso = $_GET['idCurso'];
$idSeccion = $_GET['idSeccion'];
$idClase = $_GET['idClase'];

$sql = 'select * from classes where id =' . $idClase;
$resultado = $cn->query($sql);
$datosClase = $resultado->fetch(PDO::FETCH_OBJ);
?>

<main class="main">
    <form action="../../scripts/deleteClassBD.php" method="POST">
        <div class="ed-grid s-center">
            <input type="hidden" value="<?php echo $idCurso; ?>" name="txtIdCurso">
            <input type="hidden" value="<?php echo $idSeccion; ?>" name="txtIdSeccion">
            <input type="hidden" value="<?php echo $idClase; ?>" name="txtIdClase">
            <h1>¿Estás seguro de eliminar la clase "<?php echo $datosClase->name ?>"?</h1>
        </div>
        <div class="s-center">
            <button type="submit" class="button blue big">Sí, seguro</button>
            <a class="button red big" href="temary.php?idCurso=<?php echo $idCurso; ?>">Regresar</a>
        </div>
    </form>
</main>
<br><br><br><br><br><br><br><br><br><br>

<?php
require_once('../components/footer.php');
require_once('../includes/footPages.php');
?>