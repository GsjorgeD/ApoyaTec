<?php

require_once '../../models/class.php';

class ClassController
{
    # Devuelve los datos de una clase por su id.
    public function getClass($id)
    {
        $class = new Clase();
        $response = $class->getClass($id);
        if ($response != false) {
            $response = $response->fetch(PDO::FETCH_OBJ);
            $class->construct($response);
            return $class;
        }
    }

    public function castClass($classesObj)
    {
        # Creo un listado donde iran los cursos casteados a la clase Course
        $classes = array();
        foreach ($classesObj as $item) {
            $class = new Clase();
            $class->construct($item);
            array_push($classes, $class);
        }
        return $classes;
    }

    # Devuelve las clases de un curso
    public function getClassesCourse($course_id)
    {
        $class = new Clase();
        $response = $class->getClassesOfCourse($course_id);
        if ($response != false) {
            $response = $response->fetchAll(PDO::FETCH_OBJ);

            $controller = new ClassController();
            $classes = $controller->castClass($response);
            return $classes;
        }
    }

    # Devuelve las clases de una section
    public function getClassesSection($section_id)
    {
        $class = new Clase();
        $response = $class->getClassesOfSection($section_id);
        if ($response != false) {
            $response = $response->fetchAll(PDO::FETCH_OBJ);

            $controller = new ClassController();
            $classes = $controller->castClass($response);
            return $classes;
        }
    }
}
