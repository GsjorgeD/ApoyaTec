<!-- Banner -->
<section class="banner l-section s-py-4">
    <!-- Separación del contenido en columnas -->
    <div class="banner-content ed-grid lg-grid-2 row-gap s-gap-2 m-gap-4">
        <!-- Contenido de la columna 1 -->
        <div class="s-column s-main-center lg-main-start lg-cross-start s-center lg-left">
            <h1 class="banner-title"><?php echo $course->name ?></h1>
            <p class="banner-description"><?php echo $course->description ?></p>
            <ul class="banner-list">
                <li class="banner-list-item">📅Fecha: <?php echo substr($course->created_at, 0, 10) ?> </li>
                <li class="banner-list-item">⭐Puntaje: <?php echo $course->score ?> </li>
                <li class="banner-list-item">📊Nivel:
                    <?php
                    switch ($course->level) {
                        case '1':
                            echo 'Principiante';
                            break;
                        case '2':
                            echo 'Medio';
                            break;
                        case '3':
                            echo 'Avanzado';
                            break;
                        default:
                            echo 'Por analizar';
                            break;
                    }
                    ?>
                </li>
                <li class="banner-list-item">📚Tipo:
                    <?php
                    if ($course->type == 0) {
                        echo 'Curso';
                    } elseif ($course->type == 1) {
                        echo 'Taller';
                    }
                    ?>
                </li>
                <!-- TODO: fucnión que calcule la duración de un curso -->
                <!-- <li class="banner-list-item">⏰Duración:</li> -->
            </ul>
            <!-- Botones -->
            <div class="s-main-center">
                <a class="button s-mr-2 s-mb-2 m-mb-0" href="#">Iniciar curso</a>
                <?php
                if ($_SESSION['rol_id'] == 3 || $_SESSION['user_id'] == $course->user_id) {
                    echo '<a class="button blue s-mb-2 m-mb-0" href="#">Editar curso</a>';
                }
                ?>
            </div>
        </div>
        <!-- Contenido de la columna 2 -->
        <div class="s-cross-center">
            <div class="img-container s-ratio-16-9">
                <img class="s-radius-1" src="<?php echo $course->picture ?>">
            </div>
        </div>
    </div>
</section>