<?php
require_once '../../controllers/userController.php';
$user = new UserController();
$user->headPages('Eliminar sección');

include("../../database/conect.php");
$idCurso = $_GET['idCurso'];
$idSeccion = $_GET['idSeccion'];
$sql = 'select * from sections where id =' . $idSeccion;
$resultado = $cn->query($sql);
$datosSeccion = $resultado->fetch(PDO::FETCH_OBJ);


?>

<main class="main">
    <section class="section">
        <form action="../../scripts/deleteSectionBD.php" method="POST">
            <div class="ed-grid s-center">
                <input type="hidden" name="txtIdSeccion" value="<?php echo $datosSeccion->id;?>">
                <input type="hidden" name="txtIdCurso" value="<?php echo $idCurso?>">
                <h1>¿Estás seguro de eliminar la seccion "<?php echo $datosSeccion->name; ?>"?</h1>
                <div>
                    <button type="submit" class="button blue big">Sí, seguro</button>
                    <a class="button red big" href="temary.php?idCurso=<?php echo $idCurso; ?>">Regresar</a>
                </div>
            </div>
        </form>
    </section>

</main>
<br><br><br><br><br><br><br><br><br><br>
<?php
require_once('../components/footer.php');
require_once('../includes/footPages.php');
?>