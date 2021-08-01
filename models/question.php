<?php

require_once '../../models/mainModel.php';

class Question extends MainModel
{
    public int $id;
    public string $title;
    public string $content;
    public int $likes;
    public int $dislikes;
    public int $class_id;
    public int $user_id;
    public $created_at;
    public $updated_at;

    public function __construct()
    {
        parent::__construct();
    }

    public function construct($data)
    {
        $this->id = $data->id;
        $this->title = $data->title;
        $this->content = $data->content;
        $this->likes = $data->likes;
        $this->dislikes = $data->dislikes;
        $this->class_id = $data->class_id;
        $this->user_id = $data->user_id;
        $this->created_at = $data->created_at;
        $this->updated_at = $data->updated_at;
    }
    // devuelve una pregunta con respecto a su id
    public function getQuestion($id)
	{
		$db = new MainModel();
		$query = "SELECT * FROM questions WHERE id =" . $id;
		return $response = $db->consultQuery($query);
	}
    // Devuelve las preguntas de una clase
	public function getQuestionsOfClasses($class_id)
	{
		$db = new MainModel();
		$query = "SELECT * FROM questions WHERE class_id =" . $class_id . " ORDER by created_at DESC";
		return $response = $db->consultQueryAll($query);
	}

    public function insertQuestion($question)
    {
        $db = new MainModel();
		$insertar = $db->insert('questions', $question);
		if ($insertar == true) {
			$_SESSION['mensaje'] = 'Registro exitoso';
		}

        $query = "SELECT * FROM questions ORDER by created_at DESC LIMIT 1";
		return $response = $db->consultQuery($query);
    }
}
