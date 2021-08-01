<?php
require_once '../../controllers/userController.php';
$userController = new userController();
$userController->headPages('Mi pefil');

// Con este solo sirve para ver tu perfil
// $userData = $userController->getUserData($_SESSION['user_id']);

if (isset($_POST['user_id'])) {
    $userData = $userController->getUserData($_POST['user_id']);
}else{
    $userData = $userController->getUserData($_SESSION['user_id']);
}

?>
<main class="main">

    <?php
        $userController->bannerProfile($userData);
    ?>

    <section class="section-container">
        <h2>Tus cursos terminados(Proximamente)</h2>
    </section>

    <?php
        if ($userData->rol_id == 2) {
            echo '<h2>Tus cursos subidos(Proximamente)</h2>';
        }
    ?>
</main>

<?php
$userController->footPages();
?>