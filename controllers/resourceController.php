<?php
require_once '../../models/resource.php';
class ResourceController{
    
    public function getResourceData($id){
        $resource = new Recurso();
        $response = $resource->getResource($id);
        if ($response != false) {
            $response = $response->fetch(PDO::FETCH_OBJ);
            $resource->construct($response);
            return $resource;
        }
    }

    public function castResource($classesObj)
    {
        # Creo un listado donde iran los rescursos casteados a la clase Course
        $resources = array();
        foreach ($classesObj as $item) {
            $resource = new Recurso();
            $resource->construct($item);
            array_push($resources, $resource);
        }
        return $resources;
    }

    public function getResourceOfCourse($course_id)
    {
        $resource = new Recurso();
        $response = $resource->getResourceOfCourse($course_id);
        if ($response != false) {
            $response = $response->fetchAll(PDO::FETCH_OBJ);

            $controller = new ResourceController();
            $resources = $controller->castResource($response);
            return $resources;
        }
    }



}
?>