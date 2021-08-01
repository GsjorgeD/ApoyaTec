<?php
require_once '../../models/mainModel.php';

class Tag extends MainModel
{
    public $id;
    public $name;
    public $mainTag_id;

    public function getTag(int $id)
    {
        $db = new MainModel();
        $query = "SELECT * FROM tags WHERE id =" . $id;
        return $response = $db->consultQuery($query);
    }

    public function getTags()
    {
        $db = new MainModel();
        $query = "SELECT * FROM tags";
        return $response = $db->consultQueryAll($query);
    }

    public function getMainTag(int $id)
    {
        $db = new MainModel();
        $query = "SELECT * FROM maintags WHERE id =" . $id;
        return $response = $db->consultQuery($query);
    }
}
