<?php
require_once '../../controllers/userController.php';
require_once '../../controllers/courseController.php';
require_once '../../controllers/tagController.php';
$courseController = new CourseController();
$tagController = new TagController();
// Objeto generico
$filter = new stdClass;
if (isset($_GET['mainTag'])) {
    $filter = $tagController->getMainTag($_GET['mainTag']);
    $courses = $courseController->getMainTagCourses($_GET['mainTag']);
} elseif (isset($_GET['tag'])) {
    $filter = $tagController->getTag($_GET['tag']);
    $courses = $courseController->getTagCourses($_GET['tag']);
} elseif (isset($_GET['level'])) {
    switch ($_GET['type']) {
        case 1:
            $filter->name = 'Cursos';
            break;
        case 2:
            $filter->name = 'Cursos';
            break;
        case 3:
            $filter->name = 'Cursos';
            break;
        default:
            header('location: home.php');
            break;
    }
    $courses = $courseController->getLevelCourses($_GET['level']);
} elseif (isset($_GET['type'])) {
    switch ($_GET['type']) {
        case 0:
            $filter->name = 'Cursos';
            break;
        case 1:
            $filter->name = 'Talleres';
            break;
        default:
            header('location: home.php');
            break;
    }
    $courses = $courseController->getTypeCourses($_GET['type']);
} else {
    $filter->name = 'Cursos';
    $courses = $courseController->getAllCourses();
}

$userController = new UserController();
$userController->headPages('Home');
?>

<main class="main">

    <div class="s-pt-4">
        <?php
        // $courseController->corousel('🎉Cursos nuevos', 0, 1);
        ?>
    </div>

    <hr class="divitions-line">

    <section class="section-container">
        <h1><?php echo $filter->name ?></h1>

        <?php
        $courseController->showFilters();
        ?>

        <div class="ed-grid s-grid-1 m-grid-2 lg-grid-4">
            <?php
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