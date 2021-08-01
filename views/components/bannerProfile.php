<!-- Banner de perfil -->
<section class="banner l-section s-py-4">
    <!-- Separación del contenido en columnas -->
    <div class="banner-content ed-grid s-grid-1 lg-grid-3 row-gap s-gap-2 m-gap-4">
        <!-- Contenido de la columna 1 -->
        <div class="s-main-center s-order-2 lg-order-1 lg-py-4">
            <div>
                <?php
                require_once '../../controllers/userController.php';
                $userController = new userController();
                $userController->cardProfile($user->id, 2);
                ?>
            </div>
        </div>

        <!-- Contenido de la columna 2 -->
        <div class="m-cols-2 lg-order-2">
            <div class="s-column s-main-center lg-main-start lg-cross-start s-center lg-left">
                <h1 class="banner-title">Mi perfil</h1>
                <p class="banner-description">Nombre: <di><?php echo $user->name . ' ' . $user->lastName ?></di>
                </p>
                <p class="banner-description">Email: <span><?php echo $user->email ?></span></p>
                <p class="banner-description">Acerca de mí: <span><?php echo $user->aboutYou ?></span></p>
                <!-- Botones -->
                <div class="s-py-2 s-center">
                    <a class="button green m-mb-0" href="editProfile.php?id=<?php echo $user->id ?>">Editar perfil</a>
                </div>
            </div>
        </div>
    </div>
</section>