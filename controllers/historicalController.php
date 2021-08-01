<?php

require_once '../../models/historical.php';
require_once '../../controllers/courseController.php';

class HistoricalController
{

    public function corousel(string $title, int $cardType = 0, int $carousel_id)
    {
        include('../components/carouselStudies.php');
    }

    # Devuelve los datos de una historical por su id.
    public function getHistorical($id)
    {
        $historical = new Historial();
        $response = $historical->getHistorical($id);
        if ($response != false) {
            $response = $response->fetch(PDO::FETCH_OBJ);
            $historical->construct($response);
            return $historical;
        }
    }

    public function castHistorical($historicalObj)
    {
        # Creo un listado donde iran los historical casteados a la clase historial
        $historicals = array();
        foreach ($historicalObj as $item) {
            $historical = new Historial();
            $historical->construct($item);
            array_push($historicals, $historical);
        }
        return $historicals;
    }

    # Devuelve las historical de un user
    public function getHistoricalOfUser($user_id)
    {
        $historical = new Historial();
        $response = $historical->getHistoricalOfUser($user_id);
        if ($response != false) {
            $response = $response->fetchAll(PDO::FETCH_OBJ);

            $controller = new HistoricalController();
            $historical = $controller->castHistorical($response);
            return $historical;
        }
    }

    // Crear la lista del historial
    public function getHistoricalItems(Clase $class, Course $course, User $asesor, Historial $historical)
    {
        require('../components/historical_Item.php');
    }

    public function getHistoricalOfUserByDate(int $limit, int $user)
    {
        $historical = new Historial();
        $response = $historical->getHistoricalOfUserByDate($limit, $user);
        if ($response != false) {
            $historicals = $response->fetchAll(PDO::FETCH_OBJ);
            $controller = new HistoricalController();
            return $controller->castHistorical($historicals);
        }
    }

    # Devuelve los ultimos cursos actualizados
    public function getCourseOfHistoricalUser(int $user_id)
    {
        $historicalModel = new Historial();
        $response = $historicalModel->getHistoricalCourses($user_id);
        if ($response != false) {
            $courses = $response->fetchAll(PDO::FETCH_OBJ);
            $controller = new CourseController();
            return $controller->castCourses($courses);
        }
    }
}
