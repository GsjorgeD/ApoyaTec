<?php
require_once '../../controllers/userController.php';
require_once '../../controllers/adController.php';
require_once '../../controllers/courseController.php';

$userController = new UserController();
$userController->headPages('Home');

$adController = new AdController();
$courseController = new CourseController();
?>

<main class="main">

    <?php
    $ad = $adController->getFirstAd();
    $adController->bannerAds($ad->title, $ad->description, 'Ver más', $ad->url, $ad->picture);

    $courseController->corousel('🎉Cursos nuevos', 0, 1);

    $courseController->corousel('⭐ Los mejores cursos', 0, 2);
    ?>

    <hr class="divitions-line">

    <section class="section-container">
        <h1>Cursos</h1>
        <div class="ed-grid s-grid-1 m-grid-2 lg-grid-4">
            <?php
            $courses = $courseController->getAllCourses();
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