<!-- Se hace referencia a la conexión a la base de datos  -->
<?php
require_once '../../controllers/userController.php';
$user = new UserController();
$user->headPages('Usuarios');
include("../../database/conect.php");
$userController = new UserController();
?>
<main class="main">
    <div class="ed-grid">
        <form action="../../scripts/createUserBD.php" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
            <div class="ed-grid">
                <div class="s-main-center">
                    <h1 style="margin-left: 35px; color: black;">Crear Usuario</h1>

                    <div class="ed-grid s-grid-2 s-mb-2">

                        <input type="text" class="input s-mb-1" name="txtNombreUsuario" id="btnControl" placeholder="Nombre" required>
                        <input type="text" class="input s-mb-1" name="txtApellido" id="btnControl" placeholder="Apellidos" required>
                        <input type="text" class="input s-mb-1" name="txtCorreo" id="txtCorreo" placeholder="Correo Electronico" required>
                        <input type="text" class="input s-mb-1" name="txtNoControl" id="btnControl" placeholder="Número de control" required>
                        <textarea type="text" name="txtSobre" id="txtAbout" cols="30" class="s-rows-3 input input-text ed-item s-mb-1" rows="10" placeholder="Acerca de ti" required></textarea>
                        <div class="btn-group" role="group" aria-label="Button group">
                            <select class="input" id="tipRol" name="cmbRol" aria-label="Default select example">
                                <option selected value=""></option>
                                <!-- Se abre la etiqueta php para insertar la consulta de la tabla Tags (Categorias) -->
                                <?php
                                $sql = 'select r.id as idRol, r.name as nameRole from roles as r';
                                $resultado = $cn->query($sql);
                                $roles = $resultado->fetchAll(PDO::FETCH_OBJ);
                                // Se recorre la consulta y se descompone en filas
                                foreach ($roles as $rol) {
                                    echo "<option value=" . $rol->idRol . ">" . $rol->nameRole . "</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <!-- Estructura para un input file personalizado -->
                        <div class="input-file ed-grid s-grid-3 s-cross-center s-py-1 row-gap s-gap-1">
                            <label class="label-input">Escoge un archivo:</label>

                            <label class="button s-cols-2">Examinar
                                <input name="imagenProducto" class="input-file-selected" onchange="showFileName()" title="Escoge tu archivo" type="file">
                            </label>

                            <div class="input-file-info s-center s-cols-3"></div>
                        </div>
                    </div>

                    <button type="submit" id="btnGuardar" class="button green s-mb-2">Crear Usuario</button>
                    <a class="button red s-mb-2" href="changeRol.php">Regresar</a>
                </div>

            </div>
        </form>
    </div>
</main>

<?php
require_once('../components/footer.php');
require_once('../includes/footPages.php');
?>