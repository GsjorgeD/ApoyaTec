<?php

require_once '../../models/tag.php';

class TagController
{
    public function getTag($id)
    {
        $tagModel = new Tag();
        $response = $tagModel->getTag($id);
        if ($response != false) {
            $response = $response->fetch(PDO::FETCH_OBJ);
            return $response;
        }
    }

    public function getAllTags()
    {
        $tagModel = new Tag();
        $response = $tagModel->getTags();
        if ($response != false) {
            $response = $response->fetchAll(PDO::FETCH_OBJ);
            return $response;
        }
    }

    public function getMainTag($id)
    {
        $tagModel = new Tag();
        $response = $tagModel->getMainTag($id);
        if ($response != false) {
            $response = $response->fetch(PDO::FETCH_OBJ);
            return $response;
        }
    }
}
