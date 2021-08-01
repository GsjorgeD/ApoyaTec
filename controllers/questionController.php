<?php
require_once '../../models/question.php';

class QuestionController
{
    public function questionItem(Question $question)
    {
        require('../components/questionItem.php');
    }
    
    public function insertQuestion($question)
    {
        $questionModel = new Question();
        $response = $questionModel->insertQuestion($question);
        $response = $response->fetch(PDO::FETCH_OBJ);
        return $response->id;
    }

    # Devuelve los datos de una pregunta por su id.
    public function getQuestion($id)
    {
        $question = new Question();
        $response = $question->getQuestion($id);
        if ($response != false) {
            $response = $response->fetch(PDO::FETCH_OBJ);
            $question->construct($response);
            return $question;
        }
    }

    public function castQuestion($classesObj)
    {
        # Creo un listado donde iran las questions casteados a la clase Pregunta
        $questions = array();
        foreach ($classesObj as $item) {
            $question = new Question();
            $question->construct($item);
            array_push($questions, $question);
        }
        return $questions;
    }

    # Devuelve las preguntas de una clase
    public function getQuestionsOfClasses($class_id)
    {
        $question = new Question();
        $response = $question->getQuestionsOfClasses($class_id);
        if ($response != false) {
            $response = $response->fetchAll(PDO::FETCH_OBJ);

            $controller = new QuestionController();
            $questions = $controller->castQuestion($response);
            return $questions;
        }
    }


}
