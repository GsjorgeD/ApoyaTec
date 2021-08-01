<?php
require_once '../../models/mainModel.php';

class Ad extends MainModel
{

    public int $id;
    public string $title;
    public string $description;
    public string $picture;
    public string $url;

    public function __construct()
    {
        parent::__construct();
    }

    public function construct($data)
    {
        $this->id = $data->id;
        $this->title = $data->title;
        $this->description = $data->description;
        $this->picture = $data->picture;
        $this->url = $data->url;
    }

    public function getLastAd()
    {
        $db = new MainModel();
        $query = "SELECT * FROM ads ORDER by updated_at ASC LIMIT 1";
        return $response = $db->consultQuery($query);
    }
    public function getFirstAd()
    {
        $db = new MainModel();
        $query = "SELECT * FROM ads ORDER by updated_at DESC LIMIT 1";
        return $response = $db->consultQuery($query);
    }

    public function getAds()
    {
        $db = new MainModel();
        $query = "SELECT * FROM ads";
        return $response = $db->consultQueryAll($query);
    }
}
