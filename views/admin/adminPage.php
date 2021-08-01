<?php
// session_start()
require_once '../../controllers/userController.php';
$user = new UserController();
$user->headPages('Herramientas Administrador');

?>

<main class="main">
    <div class="ed-grid s-pt-4 s-px-4 s-mb-4">
        <div class="ed-grid s-grid-1 m-grid-2 s-main-center">
            <a href="deleteCourse.php" class="button big" id="btnCursos">
                <div class="">
                    <img src="../../assets/svg/icons/Video_Tutorial.svg" width="250">
                </div>
                <label>Cursos</label>
            </a>
            <a href="changeRol.php" class="button big" id="btnUsuarios">
                <div class="">
                    <img src="../../assets/svg/icons/Id Card.svg" width="250">
                </div>
                <label>Usuarios</label>
            </a>
        </div>
    </div>

</main>

<?php
$user->footPages();
?>