<?php
require_once '../../controllers/userController.php';
require_once '../../controllers/courseController.php';
require_once '../../controllers/classController.php';
require_once '../../controllers/historicalController.php';

$userController = new UserController();
$userController->headPages('Tus estudios');
$user = $_SESSION['user_id'];

$courseController = new CourseController();
$classController = new ClassController();
$historicalController = new HistoricalController();


?>

<main class="main">
    <section class="section s-pt-2">
        <div class=" s-center ed-grid" style="background: var(--color-bg-secondary);">
        </div>
    </section>
    <?php
    $historicalController->corousel('⭐Tus estudios', 0, 4);
    ?>

    <section class="section-container">
        <h1>Cursos</h1>
        <div class="ed-grid s-grid-1 m-grid-2 lg-grid-4">
            <?php
            $courses = $historicalController->getCourseOfHistoricalUser($_SESSION['user_id']);
            foreach ($courses as $c) {
                $courseController->cardCourse($c);
            }
            ?>
        </div>
    </section>
</main>

<?php
$userController->footPages();
?>