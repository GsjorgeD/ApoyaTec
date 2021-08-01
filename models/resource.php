<?php
require_once('../../models/mainModel.php');

class Recurso extends MainModel{
    
    public int $id;
    public string $name;
    public string $urlResource;
    public int $course_id;
    public $created_at;
    public $updated_at;

    public function __construct()
    {
        parent::__construct();
    }

    public function construct($data)
    {        
        $this->id = $data->id;
        $this->name = $data->name;
        $this->urlResource = $data->urlResource;
        $this->course_id = $data->course_id;
        $this->created_at = $data->created_at;
        $this->updated_at = $data->updated_at;
    }

    public function getResource($id){
        $db = new MainModel();
		$query = "SELECT * FROM resources WHERE id =" . $id;
		return $response = $db->consultQuery($query);
    }

    public function getResourceOfCourse($course_id){
        $db = new MainModel();
		$query = "SELECT * FROM resources WHERE course_id =" . $course_id;
		return $response = $db->consultQueryAll($query);
    }

}

?>