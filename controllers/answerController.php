<?php
require_once '../../models/answer.php';

class AnswerController
{
    public function answerItem($answer)
    {
        require('../components/answerItem.php');
    }

    public function insertAnswer($answer)
    {
        $answerModel = new Answer();
        $response = $answerModel->insertAnswer($answer);
        // $response = $response->fetch(PDO::FETCH_OBJ);
        return $response;
    }

    # Devuelve las respuestas de una pregunta
    public function getAnswers($question_id)
    {
        $answer = new Answer();
        $response = $answer->getAnswerOfQuestion($question_id);
        if ($response != false) {
            $response = $response->fetchAll(PDO::FETCH_OBJ);
            // TODO: Castearlo a una clase
            // $controller = new QuestionController();
            // $questions = $controller->castQuestion($response);
            return $response;
        }
    }
}
