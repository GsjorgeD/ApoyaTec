<?php

require_once '../../models/mainModel.php';

class Answer extends MainModel
{
    public int $id;
    // public string $title;
    public string $content;
    public int $likes;
    public int $dislikes;
    public int $question_id;
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
        // $this->title = $data->title;
        $this->content = $data->content;
        $this->likes = $data->likes;
        $this->dislikes = $data->dislikes;
        $this->question_id = $data->question_id;
        $this->user_id = $data->user_id;
        $this->created_at = $data->created_at;
        $this->updated_at = $data->updated_at;
    }
    # devuelve una pregunta con respecto a su id
    public function getAnswer($id)
	{
		$db = new MainModel();
		$query = "SELECT * FROM questions WHERE id =" . $id;
		return $response = $db->consultQuery($query);
	}
    # Devuelve las respuestas de una pregunta
	public function getAnswerOfQuestion($question_id)
	{
		$db = new MainModel();
		$query = "SELECT * FROM answers WHERE question_id =" . $question_id . " ORDER by created_at ASC";
		return $response = $db->consultQueryAll($query);
	}

    public function insertAnswer($answer)
    {
        $db = new MainModel();
        var_dump($answer);
		$insertar = $db->insert('answers', $answer);
		if ($insertar == true) {
			$_SESSION['mensaje'] = 'Registro exitoso';
            return 'todo bien';
		}else {
            return 'algo mal';
        }
        // $query = "SELECT * FROM  courses ORDER by created_at DESC LIMIT 1";
		// return $response = $db->consultQuery($query);
    }
}
