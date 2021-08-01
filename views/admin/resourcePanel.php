<?php
require_once '../../controllers/courseController.php';
require_once '../../controllers/userController.php';
require_once '../../controllers/resourceController.php';

$userController = new UserController();
$userController->headPages('Recursos');
$courseController = new CourseController();
$resourceController = new ResourceController();
$course = $courseController->getCourseData($_GET['idCurso']);
?>

<section>
    <div class="ed-grid s-to-center column">
        <h1 class="s-pt-4 s-center">Recursos del curso</h1>
        <div class="s-center s-pt-2 " style="background: #373434; border-radius: 4px;">
            <p class="s-center">Deja recursos a tus estudiantes para permitirles comprender mejor los temas, o deja links a los ejemplos elaborados por ti en clase o de manera externa. </p>
        </div>
    </div>
</section>
<section>
    <!-- Area de la tabla -->

    <table>
        <thead>
            <th>Id</th>
            <th>Nombre</th>
            <th>Link</th>
            <th>Acciones</th>
        </thead>
        <tbody>
            <?php $resources = $resourceController->getResourceOfCourse($course->id);
            foreach ($resources as $resource) {
                // inicio de la fila
                echo "<tr>";
                echo "<td>" . $resource->id . "</td>";
                echo "<td>" . $resource->name . "</td>";
                echo "<td>" . $resource->urlResource . "</td>";
                // Botones
                echo "<td>";
                echo "<a class='button button-action blue icon-action small' href='editResource.php?idCurso=".$course->id."&idRecurso=".$resource->id."'>";
                echo '<span class="fas fa-pen"></span>';
                echo '</a>';
                echo "<a class='button button-action red icon-action small' href='deleteResource.php?idCurso=".$course->id."&idRecurso=".$resource->id."'>";
                echo '<span class="fas fa-trash"></span>';
                echo '</a>';
                echo '</span>';
                echo "</td>";
                // fin de la fila
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>


    <!-- area de los botones -->
    <div class="s-center">
        <a href="createResource.php?idCurso=<?php echo $course->id?>" class="button green button-icon icon s-mb-3"><svg class="icon" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M3.55556 32H28.4444C30.4053 32 32 30.4053 32 28.4444V8.88889C32.0002 8.6554 31.9543 8.42417 31.865 8.20848C31.7756 7.99278 31.6444 7.79687 31.4791 7.632L24.368 0.520891C24.2032 0.355482 24.0073 0.224303 23.7916 0.134907C23.5759 0.0455113 23.3446 -0.000336798 23.1111 1.86253e-06H3.55556C1.59467 1.86253e-06 0 1.59467 0 3.55556V28.4444C0 30.4053 1.59467 32 3.55556 32ZM21.3333 28.4444H10.6667V19.5556H21.3333V28.4444ZM17.7778 7.11111H14.2222V3.55556H17.7778V7.11111ZM3.55556 3.55556H7.11111V10.6667H21.3333V3.55556H22.3751L28.4444 9.62489L28.4462 28.4444H24.8889V19.5556C24.8889 17.5947 23.2942 16 21.3333 16H10.6667C8.70578 16 7.11111 17.5947 7.11111 19.5556V28.4444H3.55556V3.55556Z" fill="white" />
            </svg>Agregar</a>

        <a href="updateCourse.php?idCurso=<?php echo $course->id; ?>" class="button red button-icon icon s-mb-3">
            <svg class="icon" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M10.0186 8.3323L16 14.3137L21.9568 8.35691C22.0612 8.2458 22.1869 8.15691 22.3265 8.09558C22.4661 8.03425 22.6166 8.00174 22.7691 8C23.0955 8 23.4085 8.12967 23.6393 8.36047C23.8701 8.59128 23.9998 8.90433 23.9998 9.23074C24.0027 9.38163 23.9747 9.53152 23.9175 9.6712C23.8604 9.81088 23.7753 9.93741 23.6675 10.043L17.6492 15.9998L23.6675 22.0181C23.8703 22.2166 23.9893 22.4853 23.9998 22.7689C23.9998 23.0953 23.8701 23.4083 23.6393 23.6391C23.4085 23.8699 23.0955 23.9996 22.7691 23.9996C22.6122 24.0061 22.4557 23.9799 22.3095 23.9227C22.1633 23.8655 22.0306 23.7785 21.9199 23.6673L16 17.6859L10.0309 23.655C9.92693 23.7624 9.8027 23.8482 9.66539 23.9073C9.52809 23.9664 9.38043 23.9978 9.23094 23.9996C8.90453 23.9996 8.59148 23.8699 8.36068 23.6391C8.12987 23.4083 8.0002 23.0953 8.0002 22.7689C7.99733 22.618 8.02533 22.4681 8.08247 22.3284C8.13961 22.1887 8.2247 22.0622 8.3325 21.9566L14.3508 15.9998L8.3325 9.98149C8.12966 9.78304 8.01071 9.51432 8.0002 9.23074C8.0002 8.90433 8.12987 8.59128 8.36068 8.36047C8.59148 8.12967 8.90453 8 9.23094 8C9.52632 8.00369 9.80939 8.12307 10.0186 8.3323Z" fill="white" />
                <path fill-rule="evenodd" clip-rule="evenodd" d="M16 30C23.732 30 30 23.732 30 16C30 8.26801 23.732 2 16 2C8.26801 2 2 8.26801 2 16C2 23.732 8.26801 30 16 30ZM16 32C24.8366 32 32 24.8366 32 16C32 7.16344 24.8366 0 16 0C7.16344 0 0 7.16344 0 16C0 24.8366 7.16344 32 16 32Z" fill="white" />
            </svg>Cancelar
        </a>
    </div>
</section>
</div>


<?php
$userController->footPages();
?>