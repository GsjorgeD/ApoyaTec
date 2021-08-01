<?php
session_start();
// require_once '../models/question.php';
require_once '../../controllers/questionController.php';
// require_once '../models/mainModel.php';

$questionController = new QuestionController();

$question = array(
    'title'     =>  $_GET['title'],
    'content'   =>  $_GET['content'],
    'likes'     =>  $_GET['likes'],
    'dislikes'  =>  $_GET['dislike'],
    'class_id'  =>  $_GET['class_id'],
    'user_id'   =>  $_GET['user_id']
);

var_dump( $questionController->insertQuestion($question));
?>
