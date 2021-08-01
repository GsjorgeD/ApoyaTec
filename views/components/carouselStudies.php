<?php
require_once '../../controllers/courseController.php';
require_once '../../controllers/sectionController.php';
require_once '../../controllers/classController.php';
require_once '../../controllers/historicalController.php';
require_once '../../controllers/userController.php';
$courseController = new CourseController();
$classController = new ClassController();
$historicalController = new HistoricalController();
$userController = new UserController();
$limit = 10;
$user = $userController->getUserData($_SESSION['user_id']);
$historicalList = $historicalController->getHistoricalOfUserByDate($limit, $user->id);

$sectionController = new SectionController();
?>

<section>
    <h3 class="s-pl-4"><?php echo $title ?></h3>
    <div class="carousel">
        <div id="carousel_<?php echo $carousel_id ?>" class="carousel__contenedor">
            <!-- Botón izquierdo -->
            <button aria-label="Anterior" class="carousel__anterior">
                <i class="fas fa-chevron-left"></i>
            </button>
            <!-- Lista de contenido del carrucel(minimo deben haber 6) -->
            <!-- El contenido puede ser cualquier card -->
            <div class="carousel__lista">
                <?php
                foreach ($historicalList as $historical) {
                    $class = $classController->getClass($historical->class_id);
                    $course = $courseController->getCourseData($class->course_id);
                    $asesor = $userController->getUserData($course->user_id);
                    $sectionId = $class->section_id;
                    $section = $sectionController->getSection($sectionId);
                    echo '<article class="carousel__elemento card-carousel-name">';
                    echo '<a href="class.php?class=' . $class->id . '">';
                    echo '    <div class="img-container s-ratio-16-9">';
                    echo '        <img class="s-radius-1" src="' . $course->picture . '"';
                    echo '            alt="card-carousel">';
                    echo '    </div>';
                    echo '    <p>' . $section->index . '.'. $class->index . ' '.$class->name.'</p>';
                    echo '</a>';
                    echo '</article>';
                }

                ?>
            </div>
            <button aria-label="Siguiente" class="carousel__siguiente">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
        <!-- Iconos que indican en que posición del scroll estas -->
        <div role="tablist" class="carousel__indicadores"></div>
    </div>
</section>

<!-- Para el uso de carrusel -->
<script src="https://cdn.jsdelivr.net/npm/glider-js@1.7.3/glider.min.js"></script>
<script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
<script src="../../assets/js/carousel.js"></script>