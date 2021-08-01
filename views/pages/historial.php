<?php
require_once '../../controllers/userController.php';
require_once '../../controllers/courseController.php';
require_once '../../controllers/classController.php';
require_once '../../controllers/historicalController.php';

$userController = new UserController();
$userController->headPages('Historial');
$user = $userController->getUserData($_SESSION['user_id']);

$courseController = new CourseController();
$classController = new ClassController();
$historicalController = new HistoricalController();


?>

<main class="main">
    <section></section>
    <section class="section">
        <div class="s-center ed-grid" style="background: var(--color-bg-secondary);">
            <h1>Tu historial</h1>
            <div>
                <div class="">
                    <div class="">
                        <?php
                        $historicals = $historicalController->getHistoricalOfUser($user->id);
                        //  Sacar una por una los items del historial;
                        foreach ($historicals as $historical) {
                            // Creacion de variables
                            $class = $classController->getClass($historical->class_id);
                            $course = $courseController->getCourseData($class->course_id);
                            $asesor = $userController->getUserData($course->user_id);
                            // Llamada a la funcion
                            $historicalController->getHistoricalItems($class, $course, $asesor, $historical);
                        }
                        ?>
                    </div>
                </div>
            </div>
    </section>
</main>

<?php
$userController->footPages();
?>