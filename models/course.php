<?php
require_once '../../models/mainModel.php';

class Course extends MainModel
{

    public int $id;
    public string $name;
    public string $description;
    public $score;
    public int $level;
    public int $type;
    public string $picture;
    public string $objective;
    public string $knowledge;
    public string $target;
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
        $this->name = $data->name;
        $this->description = $data->description;
        $this->score = $data->score;
        $this->level = $data->level;
        $this->type = $data->type;
        $this->picture = $data->picture;
        $this->objective = $data->objective;
        $this->knowledge = $data->knowledge;
        $this->target = $data->target;
        $this->user_id = $data->user_id;
        $this->created_at = $data->created_at;
        $this->updated_at = $data->updated_at;
    }

    function getName()
    {
        return $this->name;
    }
    function getDescription()
    {
        return $this->description;
    }
    function getScore()
    {
        return $this->score;
    }
    function getLevel()
    {
        return $this->level;
    }
    function getType()
    {
        return $this->type;
    }
    function getObjective()
    {
        return $this->objective;
    }
    function getKnowledge()
    {
        return $this->knowledge;
    }
    function getTarget()
    {
        return $this->target;
    }
    function getUserId()
    {
        return $this->type;
    }

    function setId($id)
    {
        $this->id = $id;
    }
    function setName($name)
    {
        $this->name = $name;
    }
    function setDescription($description)
    {
        $this->description = $description;
    }
    function setScore($score)
    {
        $this->score = $score;
    }
    function setLevel($level)
    {
        $this->level = $level;
    }
    function setType($type)
    {
        $this->type = $type;
    }
    function setObjective($objective)
    {
        $this->objective = $objective;
    }
    function setKnowledge($knowledge)
    {
        $this->knowledge = $knowledge;
    }
    function setTarget($target)
    {
        $this->target = $target;
    }
    function setUserId($user_id)
    {
        $this->type = $user_id;
    }

    public function getPicture(int $id)
    {
        $db = new MainModel();
        $query = "SELECT picture FROM courses WHERE id =" . $id;
        return $response = $db->consultQuery($query);
    }

    public function getCourse(int $id)
    {
        $db = new MainModel();
        $query = "SELECT * FROM courses WHERE id =" . $id;
        return $response = $db->consultQuery($query);
    }

    public function getCoursesAll()
    {
        $db = new MainModel();
        $query = "SELECT * FROM courses";
        return $response = $db->consultQueryAll($query);
    }

    public function getCourseByDate(int $limit)
    {
        $db = new MainModel();
        $query = "SELECT * FROM courses ORDER by created_at DESC LIMIT " . $limit;
        return $response = $db->consultQueryAll($query);
    }

    public function getCoursesByScore(int $limit)
    {
        $db = new MainModel();
        $query = "SELECT * FROM courses ORDER by score DESC LIMIT " . $limit;
        return $response = $db->consultQueryAll($query);
    }

    public function getCourseByUpdateDate(int $limit)
    {
        $db = new MainModel();
        $query = "SELECT * FROM courses ORDER by updated_at DESC LIMIT " . $limit;
        return $response = $db->consultQueryAll($query);
    }

    public function getCourseByMainTag(int $mainTag_id)
    {
        $db = new MainModel();
        $query = "SELECT DISTINCT courses.*
        FROM courses
        INNER JOIN course_tag
        ON courses.id = course_tag.course_id
        INNER JOIN tags
        ON course_tag.tag_id = tags.id
        INNER JOIN maintags
        ON tags.mainTag_id = maintags.id
        WHERE maintags.id =" . $mainTag_id;
        return $response = $db->consultQueryAll($query);
    }

    public function getCourseByTag(int $tag_id)
    {
        $db = new MainModel();
        $query = "SELECT DISTINCT courses.*
        FROM courses
        INNER JOIN course_tag
        ON courses.id = course_tag.course_id
        INNER JOIN tags
        ON course_tag.tag_id = tags.id
        WHERE tags.id = " . $tag_id;
        return $response = $db->consultQueryAll($query);
    }

    public function getCourseByLevel(int $level)
    {
        $db = new MainModel();
        $query = "SELECT * FROM courses WHERE level = " . $level;
        return $response = $db->consultQueryAll($query);
    }

    public function getCourseByType(int $type)
    {
        $db = new MainModel();
        $query = "SELECT * FROM courses WHERE type = " . $type;
        return $response = $db->consultQueryAll($query);
    }

    // ! Checa que sirva consults
    public function getCoursesByTag($categoria)
    {
        $db = new MainModel();
        $query = "select c.id as idCurso, c.name as nombreCurso, c.picture as imagen, CONCAT(u.name,  ' ',u.lastname) as nombreAsesor,
        mt.name as subcategoria from course_tag as ct inner join courses as c on ct.course_id = c.id inner join users as u on c.user_id =  u.id 
        inner join tags as t on ct.tag_id = t.id inner join maintags as mt on t.mainTag_id = mt.id WHERE mt.id =" . $categoria;
        return $response = $db->consultQueryAll($query);
    }

    public function getAllCourseJoin()
    {
        $db = new MainModel();
        $query = "select c.id as idCurso, c.name as nombreCurso, c.picture as imagen, CONCAT(u.name,  ' ',u.lastname) as nombreAsesor,
        mt.name as subcategoria from course_tag as ct inner join courses as c on ct.course_id = c.id inner join users as u on c.user_id =  u.id 
        inner join tags as t on ct.tag_id = t.id inner join maintags as mt on t.mainTag_id = mt.id;";
        return $response = $db->consultQueryAll($query);
    }

    // ? Este que hace aqui??
    public function getRoles(){
        $db = new MainModel();
        $query = "SELECT r.id as idRol, r.name as nameRol from roles as r";
        return $response = $db->consultQueryAll($query);
    }

}
