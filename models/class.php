<?php

require_once '../../models/mainModel.php';

class Clase extends MainModel
{
	public int $id;
	public string $name;
    public string $urlVideo;
    public int $views;
    public string $notes;
    public int $index;
    public int $section_id;
    public int $course_id;

    public function __construct()
	{
		parent::__construct();
	}

	public function construct($data)
	{
        $this->id = $data->id;
        $this->name = $data->name;
        $this->urlVideo = $data->urlVideo;
        $this->views = $data->views;
        $this->notes = $data->notes;
        $this->index = $data->_index;
        $this->section_id = $data->section_id;
        $this->course_id = $data->course_id;
	}

	public function getClass($id)
	{
		$db = new MainModel();
		$query = "SELECT * FROM classes WHERE id =" . $id;
		return $response = $db->consultQuery($query);
	}
    # Devuelve las clases de una sección
	public function getClassesOfSection($section_id)
	{
		$db = new MainModel();
		$query = "SELECT * FROM classes WHERE section_id =" . $section_id;
		return $response = $db->consultQueryAll($query);
	}

    # Devuelve las clases de un curso
	public function getClassesOfCourse($course_id)
	{
		$db = new MainModel();
		$query = "SELECT * FROM classes WHERE course_id =" . $course_id;
		return $response = $db->consultQueryAll($query);
	}
}