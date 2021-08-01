<?php
require_once '../../controllers/userController.php';
$user = new UserController();
$user->headPages('Actualizar curso');

include("../../database/conect.php");
$idCurso = $_GET['idCurso'];
$sql = 'select*from courses where id =' . $idCurso;
$resultado = $cn->query($sql);
$datosCurso = $resultado->fetch(PDO::FETCH_OBJ);
// Se recorre la consulta y se descompone en filas
$userController = new UserController();
?>

<main class="main">
    <div class="ed-grid ">
        <form action="../../scripts/updateCourse.php" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
            <h1>Actualizar el Curso</h1>
            <div>
                <a href="deleteCourse.php" class="button " id="btnReturn">Regresar <i class="fas fa-undo-alt"></i></a>
            </div>

            <input type="hidden" name="idCurso" value="<?php echo $datosCurso->id; ?>">
            <div class="ed-grid s-grid-2">
                <div class="">
                    <label class="label-input">Nombre del curso</label>
                    <input type="txt" class="input" placeholder="Html de 0 a experto" name="txtNombreCurso" id="txtNombreCurso" value="<?php echo $datosCurso->name; ?>" required>
                    <!-- <div class="invalid-feedback">
                            <p class="validacionNombreF">Inserte el nombre del curso</p>
                        </div> -->

                    <label class="label-input">Descripción</label>
                    <textarea type="text" class="input input-text input-tamanio s-mb-2" placeholder="Curso donde..." name="txtDescripcion" id="txtDescripcion" required><?php echo $datosCurso->description; ?></textarea>
                    <!-- <div class="invalid-feedback">
                        <p class="validacionNombreF">Inserte alguna descripción</p>
                    </div> -->


                    <label class="input-label">Nivel: </label>
                    <input type="number" class="input" placeholder="1" name="txtNivel" id="txtNivel" value="<?php echo $datosCurso->level ?>" required>


                    <label class=" label-input">Aprendizajes Esperados</label>
                    <textarea type="text" class="input input-text input-tamanio" placeholder="Se espera..." name="txtAEsperados" id="txtAEsperados" required><?php echo $datosCurso->objective; ?></textarea>
                    <!-- <div class="invalid-feedback">
                        <p class="validacionNombreF">Inserte los Aprendizajez Esperados</p>
                    </div> -->

                    <label class="label-input">Conocimientos previos necesarios</label>
                    <textarea type="text" class="input input-txt input-tamanio s-mb-3" placeholder="Ninguno" name="txtCPNecesarios" id="txtCPNecesarios" required><?php echo $datosCurso->knowledge; ?></textarea>
                    <!-- <div class="invalid-feedback"><label class="validacionNombreF">Inserte los Conocimientos previos necesarios</label></div> -->

                    <button type="submit" class="button green" id="btnCurso">Actualizar curso <i class="fas fa-video"></i></button>
                    <!--Ir al temario del curso-->
                    <a href="temary.php?idCurso=<?php echo $idCurso; ?>" class="button blue">Ir al temario</a>
                    <a href="resourcePanel.php?idCurso=<?php echo $idCurso; ?>" class="button">Subir recursos</a>



                </div>
                <div class="s-to-center column ">
                    <div>
                        <label class="label-input">Inserte la imagen</label>
                        <input type="file" name="imagenProducto" class="input input-file-selected" onchange="showFileName()" required>
                    </div>
                    <div>
                        <label class="label-input" id="txtTarget">Para alumnos que:</label>
                        <textarea type="text" class="input input-text input-tamanio" name="txtTarget" id="txtTarget" required><?php echo $datosCurso->target; ?></textarea>
                    </div>

                    <div>
                        <label class="label-input">Asesor encargado:</label>
                        <!-- <input type="search" id="input-search" class="input" placeholder="Buscar aquí"> -->
                        <!-- <div class="content-search">
                            <div class="content-table"> -->
                        <table class="table" id="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Asesor</th>
                                    <th scope="col">Escoger</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $userList = $userController->getUsersRol(2);
                                //$id = $datosCurso->user_id;
                                foreach ($userList as $asesor) {
                                    if ($asesor->id == $datosCurso->user_id) {
                                        echo "<tr>";
                                        echo "<td>";
                                        echo "<a'>$asesor->name" . ' ' . $asesor->lastname . "</a>";
                                        echo "</td>";
                                        echo "<td>";
                                        echo "<input required class='check1' type='radio' name='flexRadioDefault' value='" . $asesor->id . "' checked>";
                                        echo "</td>";
                                        echo "</tr>";
                                    } else {

                                        echo "<tr>";
                                        echo "<td>";
                                        echo "<a'>$asesor->name" . ' ' . $asesor->lastname . "</a>";
                                        echo "</td>";
                                        echo "<td>";
                                        echo "<input required class='check1' type='radio' name='flexRadioDefault' value='" . $asesor->id . "'>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                        <!-- </div>
                        </div> -->
                    </div>
                </div>
        </form>
    </div>
</main>


<?php

require_once('../components/footer.php');
require_once('../includes/footPages.php');
?>