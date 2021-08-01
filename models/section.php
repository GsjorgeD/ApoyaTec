<?php

require_once '../../models/mainModel.php';

class Section extends MainModel
{
	public int $id;
	public string $name;
    public string $description;
    public int $index;
    public int $course_id;

    public function __construct()
	{
		parent::__construct();
	}

	public function construct($data)
	{
        $this->id = $data->id;
        $this->name = $data->name;
        $this->description = $data->description;
        $this->index = $data->index;
        $this->course_id = $data->course_id;
	}

	public function getSection($id)
	{
		$db = new MainModel();
		$query = "SELECT * FROM sections WHERE id =" . $id;
		return $response = $db->consultQuery($query);
	}

	public function getSections($course_id)
	{
		$db = new MainModel();
		$query = "SELECT * FROM sections WHERE course_id =" . $course_id;
		return $response = $db->consultQueryAll($query);
	}
}