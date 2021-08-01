<?php
$userController = new UserController();
$answerController = new AnswerController();

$userQuestion = $userController->getUserData($question->user_id);
?>

<div class="questions-container">
    <div class="s-pxy-2">
        <h3 class="s-mb-1 ellipsis"><?php echo $question->title ?></h3>
        <div class="question-title-container">
            <div class="s-center">
                <div class="profile-img">
                    <div class="circle img-container">
                        <img src="<?php echo $userController->getImage64($userQuestion->id) ?>" alt="">
                    </div>
                </div>
            </div>
            <p class="s-mb-0 ellipsis"><?php echo $userQuestion->name . " " . $userQuestion->lastName ?></p>
        </div>
        <div>
            <p><?php echo $question->content ?></p>
        </div>
        <div id="sectionAnswer_<?php echo $question->id ?>" class="section-answers">
            <?php
            $answers = $answerController->getAnswers($question->id);
            foreach ($answers as $answer) {
                $answerController->answerItem($answer);
            }
            ?>
        </div>
        <hr>
        <form id="answerForm_<?php echo $question->id ?>" class="answer-form" action="">
            <div class="question-title-container">
                <div class="s-center">
                    <div class="profile-img">
                        <div class="circle img-container">
                            <img src="<?php echo $userController->getImage64($_SESSION['user_id']) ?>" alt="">
                        </div>
                    </div>
                </div>
                <textarea name="answerContent" required class="input input-text s-mr-1" placeholder="Escribe tu respuesta" cols="60" rows="2"></textarea>
                <div class="s-right">
                    <button type="submit" class="button">Responder</button>
                </div>
            </div>
        </form>
    </div>
</div>