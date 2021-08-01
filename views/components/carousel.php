<?php
require_once '../../controllers/courseController.php';
$courseController = new CourseController();

if ($carousel_id == 1) {
    $courseList = $courseController->getNewCourses(10);
}elseif ($carousel_id == 2) {
    $courseList = $courseController->getScoreCourses(10);
}

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
                    if ($cardType == 1) {
                        foreach ($courseList as $course) {
                            echo '<article class="carousel__elemento card-carousel-name">';
                            echo '<a href="course.php?id=' . $course->id . '">';
                            echo '    <div class="img-container s-ratio-16-9">';
                            echo '        <img class="s-radius-1" src="' . $course->picture . '"';
                            echo '            alt="card-carousel">';
                            echo '    </div>';
                            echo '    <p>'. $course->name .'</p>';
                            echo '</a>';
                            echo '</article>';
                        }
                    } else {
                        foreach ($courseList as $course) {
                            echo '<article class="carousel__elemento card-carousel">';
                            echo '<a href="course.php?id=' . $course->id . '">';
                            echo '    <div class="img-container s-ratio-16-9">';
                            echo '        <img class="s-radius-1" src="' . $course->picture . '"';
                            echo '            alt="card-carousel">';
                            echo '    </div>';
                            echo '</a>';
                            echo '</article>';
                        }
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