<?php
require_once '../../controllers/userController.php';
$user = new UserController();
$user->headPages('Crear curso');

include("../../database/conect.php");
$userController = new UserController();
?>


<main class="main">
    <div class="ed-grid ">
        <h1>Crear Curso</h1>
        <div>
            <a href="deleteCourse.php" class="button " id="btnReturn">Regresar <i class="fas fa-undo-alt"></i></a>
        </div>

        <form action="../../scripts/createCourseBD.php" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>

            <div class="ed-grid s-grid-2">
                <div class="">
                    <label class="label-input">Nombre del curso</label>
                    <input type="txt" class="input" placeholder="Html de 0 a experto" name="txtNombreCurso" id="txtNombreCurso" required>

                    <label class="label-input">Descripción</label>
                    <textarea type="text" class="input input-text input-tamanio s-mb-2" placeholder="Curso donde..." name="txtDescripcion" id="txtDescripcion" required></textarea>


                    <label class="input-label">Nivel: </label>
                    <input type="number" class="input " placeholder="1" name="txtNivel" id="txtNivel" required>


                    <label class="label-input">Aprendizajes Esperados</label>
                    <textarea type="text" class="input input-text input-tamanio" placeholder="Se espera..." name="txtAEsperados" id="txtAEsperados" required></textarea>

                    <label class="label-input">Conocimientos previos necesarios</label>
                    <textarea type="text" class="input input-txt input-tamanio s-mb-3" placeholder="Ninguno" name="txtCPNecesarios" id="txtCPNecesarios" required></textarea>

                    <button type="submit" class="button green" id="btnCurso">Crear Curso <i class="fas fa-video"></i></button>


                </div>
                <div class="s-to-center column ">
                    <div>
                        <label class="label-input">Inserte la imagen</label>
                        <input type="file" name="imagenProducto" class="input input-file-selected" onchange="showFileName()" required>
                    </div>
                    <div>
                        <label class="label-input" id="txtTarget">Para alumnos que:</label>
                        <textarea type="text" class="input input-text input-tamanio" name="txtTarget" id="txtTarget" required></textarea>
                    </div>
                    <div>
                        <label class="label-input" id="lblCategoria">Categoría</label>
                        <select class="input " id="cmbCategoria" name="cmbCategoria" required>
                            <!-- Se pone un espacio en blanco para la selección de una categoría-->
                            <option selected value=""></option>
                            <!-- Se abre la etiqueta php para insertar la consulta de la tabla Tags (Categorias) -->
                            <?php
                            $sql = 'select id, name from tags';
                            $resultado = $cn->query($sql);
                            $categorias = $resultado->fetchAll(PDO::FETCH_OBJ);
                            // Se recorre la consulta y se descompone en filas
                            foreach ($categorias as $categoria) {
                                echo "<option value=" . $categoria->id . ">" . $categoria->name . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div>
                        <label class="label-input">Asesor encargado:</label>

                        <table class="table" id="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Asesor</th>
                                    <th scope="col">Escoger</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Se abre la etiqueta php para insertar la consulta de la tabla Users
                                $userList = $userController->getUsersRol(2);
                                // Se recorre la consulta y se descompone en filas
                                foreach ($userList as $asesor) {
                                    echo "<tr>";
                                    echo "<td>";
                                    echo "<a'>$asesor->name" . ' ' . $asesor->lastname . "</a>";
                                    echo "</td>";
                                    echo "<td>";
                                    echo "<input class='' type='radio' name='flexRadioDefault' value='" . $asesor->id . "' required>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
        </form>
    </div>
</main>


<?php
require_once('../components/footer.php');
require_once('../includes/footPages.php');
?>