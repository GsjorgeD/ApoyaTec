<?php
require_once '../../controllers/userController.php';
$userController = new UserController();
$userProfile = $userController->getUserData($user_id);
?>

<style>
    .profile-container {
        background-color: var(--color-bg-light);
        border-top-left-radius: var(--border-radius);
        border-top-right-radius: var(--border-radius);

        border-bottom: 6px solid var(--color-primary);
        width: 16rem;
    }

    .profile-img {
        padding: 2rem 3.5rem 0.5rem 3.5rem;
    }

    .profile-data h3 {
        color: var(--color-green);
        margin-bottom: 0;
    }

    .profile-data p {
        font-size: var(--font-size-smaller);
        color: var(--color-icon);
        margin-bottom: 2rem;
    }
    .profile-data form {
        margin-bottom: 0rem;
    }

    .just-title {
        padding: 1.5rem 0 0.5rem;
        font-size: var(--font-size-h2);
    }
    .profile-data h4 {
        color: var(--color-primary);
        text-decoration-line: underline;
    }
</style>
<div class="profile-container s-center">
    <div class="profile-img">
        <div class="circle img-container">
            <img src="<?php echo $userProfile->picture ?>" alt="imagen de perfil">
        </div>
    </div>
    <div class="profile-data s-px-2">
        <?php
        if ($type == 1) {
            echo '<h3 class="s-center ellipsis">' . $userProfile->name . '</h3>';
            echo '<p class="s-center block-ellipsis-2">' . $userProfile->aboutYou . '</p>';
            // echo '<a class="button small s-center s-mb-1" href="profile.php">Ver perfil</a>';
            echo '<form action="profile.php" method="post">';
            echo '    <input type="hidden" name="user_id" value="' . $userProfile->id . '">';
            echo '    <button class="button small s-center s-mb-1" type="submit">Ver perfil</button>';
            echo '</form>';
        } else if ($type == 2) {
            echo '<h3 class="just-title s-center ellipsis">' . $userProfile->name . '</h3>';
            if ($userProfile->rol_id==2) {
                echo '<h4>Asesor oficial</h4>';
            }
            if ($userProfile->rol_id==3) {
                echo '<h4>Administrador</h4>';
            }
        }
        ?>


    </div>
</div>