<?php
require_once '../../models/mainModel.php';

class Historial extends MainModel
{
    public int $id;
    public int $user_id;
    public int $class_id;
    public $created_at;
    public $updated_at;

    public function __construct()
    {
        parent::__construct();
    }

    public function construct($data)
    {
        $this->id = $data->id;
        $this->user_id = $data->user_id;
        $this->class_id = $data->class_id;
        $this->created_at = $data->created_at;
        $this->updated_at = $data->updated_at;
    }
    // Obtener un valor de acuerdo a su id
    public function getHistorical(int $id)
    {
        $db = new MainModel();
        $query = "SELECT * FROM historical WHERE id =" . $id;
        return $response = $db->consultQuery($query);
    }
    // obtener los ocurrencias de acuerdo al id de la user
    public function getHistoricalOfUser($user_id)
	{
		$db = new MainModel();
		$query = "SELECT * FROM historical WHERE user_id =" . $user_id." order by created_at desc";
		return $response = $db->consultQueryAll($query);
	}

    public function getHistoricalOfUserByDate(int $limit, int $user)
    {
        $db = new MainModel();
        $query = "SELECT * FROM historical" . " WHERE user_id=".$user. " ORDER by created_at DESC LIMIT " . $limit;
        return $response = $db->consultQueryAll($query);
    }

    public function getHistoricalCourses(int $user_id)
    {
        $db = new MainModel();
        $query = "SELECT DISTINCT courses.*
        FROM courses
        INNER JOIN classes
        ON courses.id = classes.course_id
        INNER JOIN historical
        ON classes.id = historical.class_id
        WHERE historical.user_id = $user_id;";
        return $response = $db->consultQueryAll($query);
    }
}
