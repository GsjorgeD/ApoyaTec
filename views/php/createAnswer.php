<?php
session_start();
// require_once '../models/question.php';
require_once '../../controllers/answerController.php';
// require_once '../models/mainModel.php';

$answerController = new AnswerController();

$answer = array(
    // 'title'     =>  $_GET['title'],
    'content'   =>  $_GET['content'],
    'likes'     =>  $_GET['likes'],
    'dislikes'  =>  $_GET['dislike'],
    'question_id'  =>  $_GET['question_id'],
    'user_id'   =>  $_GET['user_id']
);

var_dump( $answerController->insertAnswer($answer));
?>
