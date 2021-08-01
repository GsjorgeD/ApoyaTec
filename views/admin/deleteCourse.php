<?php
require_once '../../controllers/userController.php';
require_once '../../controllers/courseController.php';
$user = new UserController();
$user->headPages('Cursos');
include("../../database/conect.php");
$courseController = new CourseController();
// Se prepara una cadena que contenga la consulta de la tabla maintags (Categorías) y se manda a la inyección SQL
$sql = 'select id as idMain, name as nameMain from maintags';
$resultado = $cn->query($sql);
$categorias = $resultado->fetchAll(PDO::FETCH_OBJ);
?>

<main class="main">
    <div class="container">
        <div class="ed-grid">
            <form method="get" action="deleteCourse.php" class="needs-validation" novalidate>
                <div class="" id="lista">
                    <h1 style="color: --color-text;">Lista de Cursos</h1>
                    <p>Aquí puedes crear, actualizar y ver todos los cursos disponibles para los estudiantes.</p>
                </div>
                <div class="ed-grid s-grid-5">
                    <select name='cmbCategoria' required class="input">
                        <option value="0" selected required>Escoja una categoría</option>
                        <?php
                        // Se recorren los resultado y se dividen
                         foreach ($categorias as $categoria) {
                             echo "<option required value='" . $categoria->idMain . "'>$categoria->nameMain</option>";
                        }
                        ?>
                    </select>
                    <div>
                        <button type="submit" class="button yellow">Buscar</button>
                    </div>
                </div>
            </form>
            <div class="ed-grid s-grid-2 ">
                <div style="overflow-y: scroll; height: 400px; width: 650px;">
                    <form action="../../scripts/deleteCourseBD.php" method="post">
                        <table class="">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Curso</th>
                                    <th scope="col">Imagen</th>
                                    <th scope="col">Asesor</th>
                                    <th scope="col">Subcategoría</th>
                                    <th scope="col" class="s-center">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                // Se realiza la condición necesaria para que se muestren todos los cursos cuando el usuario entra por primera vez
                                // a la página
                                if (!isset($_GET['cmbCategoria'])) {
                                    // Se prepara la inyección SQL con la cadena de la consulta de la unión de las tablas courses (Cursos), 
                                    // tags (SubCategorías), maintags (Categorías) y la tabla de users (Usuarios)
                                    $courseList = $courseController->getCoursesAllJoin();
                                    // Se dividen los resultados
                                    foreach ($courseList as $curso) {
                                        // Se escribe código HTML en PHP para poder tener un fragmento de código html dependiente de los resultados
                                        echo "<tr>";
                                        echo "<td>$curso->nombreCurso</td>";
                                        ?>
                                        <td><img src="<?php echo $courseController->getImage64($curso->idCurso) ?>" width='75' 
                                        height='50' style='border-radius: 150px;'></td>
                                        <?php
                                        echo "<td>$curso->nombreAsesor</td>";
                                        echo "<td><input class='check1' type='radio' name='flexRadioDefault' value='" . $curso->idCurso . "'>
                                        $curso->subcategoria</td>";
                                        echo "<td>
                                        <div class='btn-group' role='group' aria-label='Button group'>
                                        <a href='updateCourse.php?idCurso=" . $curso->idCurso . "' class='btn btn-outline-info btn-sm' 
                                        id='btnAcciones'><i class='fas fa-edit'></i></a>
                                        <button type='submit' class='btn btn-outline-warning btn-sm' id='btnAcciones'>
                                                    <i class='far fa-trash-alt'></i>
                                                    </button>
                                                    </div>
                                                    </td>";
                                        echo "</tr>";
                                    }
                                    // Se realiza la condición necesaria para que se muestren todos los cursos dependiendo de la categoría 
                                } else if ($_GET['cmbCategoria'] >= 1) {
                                    $categoria = $_GET['cmbCategoria'];
                                    // Se prepara la inyección SQL con la cadena de la consulta de la unión de las tablas courses (Cursos), 
                                    // tags (SubCategorías), maintags (Categorías) y la tabla de users (Usuarios)
                                    $courseList = $courseController->getCoursesTag($categoria);
                                    // Se dividen los resultados
                                    foreach ($courseList as $curso) {
                                        // Se escribe código HTML en PHP para poder tener un fragmento de código html dependiente de los resultados
                                        echo "<tr>";
                                        echo "<td>$curso->nombreCurso</td>";
                                        ?>
                                        <td><img src="<?php echo $courseController->getImage64($curso->idCurso) ?>" width='75' 
                                        height='50' style='border-radius: 150px;'></td>
                                        <?php
                                        echo "<td>$curso->nombreAsesor</td>";
                                        echo "<td><input class='check1' type='radio' name='flexRadioDefault' value='" . $curso->idCurso . "'>
                                                 $curso->subcategoria</td>";
                                        echo "<td>
                                                 <div class='btn-group' role='group' aria-label='Button group'>
                                                 <a href='updateCourse.php?idCurso=" . $curso->idCurso . "' class='btn btn-outline-info btn-sm' 
                                                 id='btnAcciones'><i class='fas fa-edit'></i>
                                                 </a>
                                                 <button type='submit' class='btn btn-outline-warning btn-sm' id='btnAcciones'>
                                                 <i class='far fa-trash-alt'></i>
                                                 </button>
                                                 </div>
                                                 </td>";
                                        echo "</tr>";
                                    }
                                    // Se realiza la condición necesaria para que se muestren todos los cursos cuando el usuario escoje ver todos 
                                } else if ($_GET['cmbCategoria'] == 0) {
                                    // Se prepara la inyección SQL con la cadena de la consulta de la unión de las tablas courses (Cursos), 
                                    // tags (SubCategorías), maintags (Categorías) y la tabla de users (Usuarios)
                                    $courseList = $courseController->getCoursesAllJoin();
                                    // Se dividen los resultados
                                    foreach ($courseList as $curso) {
                                        // Se escribe código HTML en PHP para poder tener un fragmento de código html dependiente de los resultados
                                        echo "<tr>";
                                        echo "<td>$curso->nombreCurso</td>";
                                        ?>
                                        <td><img src="<?php echo $courseController->getImage64($curso->idCurso) ?>" width='75' 
                                        height='50' style='border-radius: 150px;'></td>
                                        <?php
                                        echo "<td>$curso->nombreAsesor</td>";
                                        echo "<td><input class='check1' type='radio' name='flexRadioDefault' value='" . $curso->idCurso . "'> $curso->subcategoria</td>";
                                        echo "<td>
                                        <div class='btn-group' role='group' aria-label='Button group'>
                                        <a href='updateCourse.php?idCurso=" . $curso->idCurso . "' class='btn btn-outline-info btn-sm' id='btnAcciones'><i class='fas fa-edit'></i></a>
                                        <button type='submit' class='btn btn-outline-warning btn-sm' id='btnAcciones'><i class='far fa-trash-alt'></i></button>
                                        </div>
                                        </td>";
                                        echo "</tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                </div>
                <div class="ed-grid s-main-center  ">
                    <div class="s-center">
                        <img src="../../assets/svg/mapi.svg" width="300" height="00">
                    </div>
                    <div class="s-center">
                        <a href="createCourse.php" class="button blue button-icon" id="btnActualizar">Crear Curso
                            <svg class="" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect width="32" height="32" rx="8" fill="--color-blue" />
                                <path d="M16 6C21.523 6 26 10.477 26 16C26 21.523 21.523 26 16 26C10.477 26 6 21.523 6 16C6 10.477 10.477 6 16 6ZM16 7.5C13.7457 7.5 11.5837 8.39553 9.98959 9.98959C8.39553 11.5837 7.5 13.7457 7.5 16C7.5 18.2543 8.39553 20.4163 9.98959 22.0104C11.5837 23.6045 13.7457 24.5 16 24.5C18.2543 24.5 20.4163 23.6045 22.0104 22.0104C23.6045 20.4163 24.5 18.2543 24.5 16C24.5 13.7457 23.6045 11.5837 22.0104 9.98959C20.4163 8.39553 18.2543 7.5 16 7.5ZM16 11C16.1989 11 16.3897 11.079 16.5303 11.2197C16.671 11.3603 16.75 11.5511 16.75 11.75V15.25H20.25C20.4489 15.25 20.6397 15.329 20.7803 15.4697C20.921 15.6103 21 15.8011 21 16C21 16.1989 20.921 16.3897 20.7803 16.5303C20.6397 16.671 20.4489 16.75 20.25 16.75H16.75V20.25C16.75 20.4489 16.671 20.6397 16.5303 20.7803C16.3897 20.921 16.1989 21 16 21C15.8011 21 15.6103 20.921 15.4697 20.7803C15.329 20.6397 15.25 20.4489 15.25 20.25V16.75H11.75C11.5511 16.75 11.3603 16.671 11.2197 16.5303C11.079 16.3897 11 16.1989 11 16C11 15.8011 11.079 15.6103 11.2197 15.4697C11.3603 15.329 11.5511 15.25 11.75 15.25H15.25V11.75C15.25 11.5511 15.329 11.3603 15.4697 11.2197C15.6103 11.079 15.8011 11 16 11Z" fill="white" />
                            </svg>
                        </a>
                    </div>
                    <div class="s-center">
                        <a href="adminPage.php" class="button red button-icon" id="btnActualizar">Regresar
                            <svg class="icon" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.0186 8.3323L16 14.3137L21.9568 8.35691C22.0612 8.2458 22.1869 8.15691 22.3265 8.09558C22.4661 8.03425 22.6166 8.00174 22.7691 8C23.0955 8 23.4085 8.12967 23.6393 8.36047C23.8701 8.59128 23.9998 8.90433 23.9998 9.23074C24.0027 9.38163 23.9747 9.53152 23.9175 9.6712C23.8604 9.81088 23.7753 9.93741 23.6675 10.043L17.6492 15.9998L23.6675 22.0181C23.8703 22.2166 23.9893 22.4853 23.9998 22.7689C23.9998 23.0953 23.8701 23.4083 23.6393 23.6391C23.4085 23.8699 23.0955 23.9996 22.7691 23.9996C22.6122 24.0061 22.4557 23.9799 22.3095 23.9227C22.1633 23.8655 22.0306 23.7785 21.9199 23.6673L16 17.6859L10.0309 23.655C9.92693 23.7624 9.8027 23.8482 9.66539 23.9073C9.52809 23.9664 9.38043 23.9978 9.23094 23.9996C8.90453 23.9996 8.59148 23.8699 8.36068 23.6391C8.12987 23.4083 8.0002 23.0953 8.0002 22.7689C7.99733 22.618 8.02533 22.4681 8.08247 22.3284C8.13961 22.1887 8.2247 22.0622 8.3325 21.9566L14.3508 15.9998L8.3325 9.98149C8.12966 9.78304 8.01071 9.51432 8.0002 9.23074C8.0002 8.90433 8.12987 8.59128 8.36068 8.36047C8.59148 8.12967 8.90453 8 9.23094 8C9.52632 8.00369 9.80939 8.12307 10.0186 8.3323Z" fill="black" />
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M16 30C23.732 30 30 23.732 30 16C30 8.26801 23.732 2 16 2C8.26801 2 2 8.26801 2 16C2 23.732 8.26801 30 16 30ZM16 32C24.8366 32 32 24.8366 32 16C32 7.16344 24.8366 0 16 0C7.16344 0 0 7.16344 0 16C0 24.8366 7.16344 32 16 32Z" fill="black" />
                            </svg>

                        </a>
                    </div>
                    <!-- </form> -->
                </div>
            </div>
        </div>
    </div>
</main>


<?php
require_once('../components/footer.php');
require_once('../includes/footPages.php');
?>