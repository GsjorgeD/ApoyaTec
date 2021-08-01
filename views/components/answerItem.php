<?php
$userController = new UserController();

$user =  $userController->getUserData($answer->user_id);
?>

<div class="answer-container">
    <div class="answer-title-container">
        <div class="s-center">
            <div class="profile-img">
                <div class="circle img-container">
                    <img src="<?php echo $user->picture ?>" alt="">
                </div>
            </div>
        </div>
        <p class="s-mb-0 ellipsis"><?php echo $user->name . " " . $user->lastName?></p>
    </div>

    <div>
        <p class="answer-content">
            <?php echo $answer->content ?>
        </p>
    </div>
</div>