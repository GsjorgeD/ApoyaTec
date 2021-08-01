<?php
//Se manda a traer un controlador para el usuario
require_once '../../controllers/userController.php';
$userController = new userController();
//Se manda a traer el head de la pagina desde otro archivo para que sea más dinámico.
$userController->headPages('Herramientas Administrador');
//Se obtiene toda la información del usuario y se almacena en una variable
$userData = $userController->getUserData($_SESSION['user_id']);

if (isset($_GET["logOut"])) {
    $userController->logOut();
}

?>
<main class="main">
    <div class="ed-grid ">
        <h1 class="s-to-center">Mi perfil</h1>
        <!-- Inicio del form -->
        <form action="../../scripts/updateProfileBD.php" method="post" enctype="multipart/form-data">
            <section class="section ed-grid s-grid-3">
                <div class="s-cols-1">
                    <div class="">
                        <h3 class="s-to-center">Imagen actual</h3>
                        <!-- Se obtiene la imagen actual del usuario -->
                        <img src="<?php $userController->getImage64($userData->id) ?>" alt="">
                    </div>
                    <div class="">
                        <h3 class="s-to-center">Imagen Nueva</h3>
                        <!-- Puede poner una imagen nueva si es que asi lo desea -->
                        <input type="file" name="imagenPerfilNueva" class="input-file">
                    </div>
                </div>
                <div class="s-cols-2 ">
                    <div class="ed-grid s-grid-4">
                        <div class="s-mb-3 ">
                            <div>
                                <label class="input-label">Nombre</label>
                            </div>
                            <!-- Se obtiene el ID del usuario -->
                            <input type="hidden" name="idUser" value="<?php echo $userData->id ?>">
                            <!-- Se obtiene el nombre del usuario -->
                            <input name="txtName" class="input input-text" value="<?php echo  $userData->name; ?>" required>
                            </input>
                        </div>
                        <div class="s-mb-3 ">
                            <div>
                                <label class="input-label">Apellido</label>
                            </div>
                            <!-- Se obtiene el apellido del usuario -->
                            <input name="txtLastName" class="input input-text" value="<?php echo $userData->lastName ?>" required>
                            </input>
                        </div>

                    </div>
                    <div class="s-mb-3">
                        <div>
                            <label class="input-label">Email</label>
                        </div>
                            <!-- Se obtiene el email del usuario -->
                        <input name="txtEmail" class="input input-text" value="<?php echo $userData->email ?>" required>
                        </input>
                    </div>
                    <div class="s-mb-3">
                        <div>
                            <label class="input-label">Acerca de mi</label>
                        </div>
                            <!-- Se obtiene el "Acerca de ti" del usuario -->
                        <textarea name="txtAboutYou" class="input input-text input-tamanio" required><?php echo $userData->aboutYou ?></textarea>
                    </div>
                    <div class="s-mb-3">
                        <div>
                            <!-- Puede enviar una nueva contraseña, el campo puede quedar vacío si asi lo desea-->
                            <label class="input-label">Nueva contraseña(si es que deseas cambiarla)</label>
                        </div>
                        <input type="password" class="input input-text" value="" name="txtPassword">
                    </div>
                    <button type="submit" class="button green">Actualizar perfil</button>
                </div>
            </section>
        </form>
    </div>
</main>
<?php
//Se manda a traer el footer desde otra pagina para mayor facilidad
$userController->footPages();
?>