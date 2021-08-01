<!-- Se hace referencia a la conexión a la base de datos  -->
<?php
require_once '../../controllers/userController.php';
$user = new UserController();
$user->headPages('Actualizar usuario');

include("../../database/conect.php");
$idCurso = $_GET['idUser'];
$sql = 'select*from users where id =' . $idCurso;
$resultado = $cn->query($sql);
$datosUsuario = $resultado->fetch(PDO::FETCH_OBJ);
// Se recorre la consulta y se descompone en filas

$userController = new UserController();

?>
<link rel="stylesheet" href="../../assets/css/styles/updateUser.css">
<main class="main">
    <div class="ed-grid">
        <h1 class="s-to-center column">Actualizar Usuario</h1>
        <section class="section">
            <form action="../../scripts/updateUser.php" method="post" enctype="multipart/form-data" novalidate>
                <div class="ed-grid s-grid-2" id="divCrear">
                    <!--Lado izquierdo-->
                    <div class="">
                        <div class="" role="group">
                            <div class="" role="group">
                            <label>Imagen Anterior</label>
                            <br>
                                <img src="<?php echo $userController->getImage64($datosUsuario->id) ?>" class="imageUserBefore" width="180px">
                            </div>
                            <div class="s-pt-4" style="width: 250px;">
                                <label class="drop-zone__prompt">Imagen Nueva</label>
                                <input type="file" name="imagenProducto" class="input-file files">
                            </div>
                        </div>
                        <input type="hidden" name="idUser" value="<?php echo $datosUsuario->id; ?>">

                    </div>
                    <!--Lado derecho-->
                    <div class="">
                        <div class="ed-grid s-mb-4" role="group">
                            <div class="ed-grid s-grid-1">
                                <label class="label-input">Nombre(s)</label>
                                <div class="ed-grid s-grid-2">
                                    <input type="text" class="input input-text" name="txtNombreUsuario" id="btnControl" value="<?php echo $datosUsuario->name; ?>" required>
                                </div>
                            </div>
                            <div class="ed-grid s-grid-1 ">
                                <label class="label-input">Apellidos</label>
                                <div class="ed-grid s-grid-2">
                                    <input type=" text " class="input input-text " name="txtApellido" id="btnControl" value="<?php echo $datosUsuario->lastname; ?>" required>
                                </div>
                            </div>
                            <div class="ed-grid s-grid-1 ">
                                <label class="label-input">Correo electronico</label>
                                <div class="ed-grid s-grid-2">
                                    <input type="text" class="input input-text" name="txtCorreo" id="txtCorreo" value="<?php echo $datosUsuario->email; ?>" required>
                                </div>
                            </div>
                            <div class="ed-grid s-grid-1 ">
                                <label class="label-input">Acerca de mi</label>
                                <div class="ed-grid s-grid-2">
                                    <textarea type="text" name="txtSobre" id="txtAbout" cols="30" class="input input-text input-tamanio" rows="10" required> <?php echo $datosUsuario->aboutYou ?> </textarea>
                                </div>
                            </div>
                            <div>
                                <label class="label-input">Rol</label>
                                <select class="input btnNombre" id="tipRol" name="cmbRol" aria-label="Default select example">
                                    <option selected value=""></option>
                                    <!-- Se abre la etiqueta php para insertar la consulta de la tabla Tags (Categorias) -->
                                    <?php
                                    $sql = 'select r.id as idRol, r.name as nameRole from roles as r';
                                    $resultado = $cn->query($sql);
                                    $roles = $resultado->fetchAll(PDO::FETCH_OBJ);
                                    // Se recorre la consulta y se descompone en filas
                                    foreach ($roles as $rol) {
                                        if ($datosUsuario->rol_id == $rol->idRol) {
                                            echo "<option selected value='" . $rol->idRol . "'>" . $rol->nameRole . "</option>";
                                        } else {
                                            echo "<option value=" . $rol->idRol . ">" . $rol->nameRole . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div>
                                <label class="label-input">Numero de control</label>
                                <input type="text" class="input input-text" name="txtNoControl" id="btnControl" value="<?php echo $datosUsuario->controlNumber; ?>" required readonly>
                            </div>
                        </div>
                        <button type="submit" id="btnGuardar" class="button green button-icon">Actualizar Usuario
                            <svg class="" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect width="32" height="32" rx="8" fill="--color-green" />
                                <path d="M7 21.25V25H10.75L21.81 13.94L18.06 10.19L7 21.25ZM24.71 11.04C24.8027 10.9475 24.8762 10.8376 24.9264 10.7166C24.9766 10.5957 25.0024 10.466 25.0024 10.335C25.0024 10.204 24.9766 10.0744 24.9264 9.95338C24.8762 9.83241 24.8027 9.72252 24.71 9.63L22.37 7.29C22.2775 7.1973 22.1676 7.12375 22.0466 7.07357C21.9257 7.02339 21.796 6.99756 21.665 6.99756C21.534 6.99756 21.4043 7.02339 21.2834 7.07357C21.1624 7.12375 21.0525 7.1973 20.96 7.29L19.13 9.12L22.88 12.87L24.71 11.04Z" fill="white" />
                            </svg>

                            </button>
                        <a href="changeRol.php" class="button" id="btnReturn" style="width: 170px;">Regresar <i class="fas fa-undo-alt"></i></a>
                    </div>
                </div>
            </form>
        </section>
    </div>
</main>


<?php
require_once('../components/footer.php');
require_once('../includes/footPages.php');
?>