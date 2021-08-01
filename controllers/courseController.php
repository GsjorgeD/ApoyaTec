<?php

require_once '../../models/course.php';

class CourseController
{
    # Devuelve un corousel personalizable
    public function corousel(string $title, int $cardType = 0, int $carousel_id)
    {
        include('../components/carousel.php');
    }

    public function cardCourse(Course $course)
    {
        include('../components/cardCourse.php');
    }

    public function bannerCourse(Course $course)
    {
        require('../components/bannerCourse.php');
    }

    public function showFilters()
    {
        require('../components/filters.php');
    }

    # Obtiene el valor de un curso en concreto por id
    public function getCourseData($id)
    {
        $course = new Course();
        $response = $course->getCourse($id);
        if ($response != false) {
            $response = $response->fetch(PDO::FETCH_OBJ);
            $response->picture = 'data:image/jpeg;base64,' . base64_encode($response->picture);
            $course->construct($response);
            return $course;
        }
    }

    # Devuelve la imagen de un curso, mediante su id
    public function getImage64($id)
    {
        $course = new Course();
        $response = $course->getPicture($id);
        if ($response != false) {
            $response = $response->fetch(PDO::FETCH_OBJ);
            // devuelve el valor a colocar en el atributo src de <img>
            echo 'data:image/jpeg;base64,' . base64_encode($response->picture);
        }
    }

    # Metodo para pasar clases genericas a clases Course
    public function castCourses($coursesObj)
    {
        # Creo un listado donde iran los cursos casteados a la clase Course
        $listCourses = array();
        foreach ($coursesObj as $c) {
            # Le asigno la cabecera de la imagen a cada curso
            $c->picture = 'data:image/jpeg;base64,' . base64_encode($c->picture);
            $course = new Course();
            $course->construct($c);
            # inserto el curso en el array
            array_push($listCourses, $course);
        }
        return $listCourses;
    }

    # Devuelve todos los cursos
    public function getAllCourses()
    {
        $course = new Course();
        $response = $course->getCoursesAll();
        if ($response != false) {
            $courses = $response->fetchAll(PDO::FETCH_OBJ);
            $controller = new CourseController();
            return $controller->castCourses($courses);
        }
    }

    # Devuelve los ultimos cursos subidos
    public function getNewCourses(int $limit)
    {
        $course = new Course();
        $response = $course->getCourseByDate($limit);
        if ($response != false) {
            $courses = $response->fetchAll(PDO::FETCH_OBJ);
            $controller = new CourseController();
            return $controller->castCourses($courses);
        }
    }

    # Devuelve los ultimos cursos actualizados
    public function getUpdateCourses(int $limit)
    {
        $course = new Course();
        $response = $course->getCourseByUpdateDate($limit);
        if ($response != false) {
            $courses = $response->fetchAll(PDO::FETCH_OBJ);

            $controller = new CourseController();
            return $controller->castCourses($courses);
        }
    }

    # Devuelve los cursos con mejor puntaje
    public function getScoreCourses(int $limit)
    {
        $course = new Course();
        $response = $course->getCoursesByScore($limit);
        if ($response != false) {
            $courses = $response->fetchAll(PDO::FETCH_OBJ);

            $controller = new CourseController();
            return $controller->castCourses($courses);
        }
    }

    public function getMainTagCourses(int $mainTag_id)
    {
        $course = new Course();
        $response = $course->getCourseByMainTag($mainTag_id);
        if ($response != false) {
            $courses = $response->fetchAll(PDO::FETCH_OBJ);
            $controller = new CourseController();
            return $controller->castCourses($courses);
        }
    }

    public function getTagCourses(int $tag_id)
    {
        $course = new Course();
        $response = $course->getCourseByTag($tag_id);
        if ($response != false) {
            $courses = $response->fetchAll(PDO::FETCH_OBJ);
            $controller = new CourseController();
            return $controller->castCourses($courses);
        }
    }

    public function getLevelCourses(int $level)
    {
        $course = new Course();
        $response = $course->getCourseByLevel($level);
        if ($response != false) {
            $courses = $response->fetchAll(PDO::FETCH_OBJ);
            $controller = new CourseController();
            return $controller->castCourses($courses);
        }
    }

    public function getTypeCourses(int $type)
    {
        $course = new Course();
        $response = $course->getCourseByType($type);
        if ($response != false) {
            $courses = $response->fetchAll(PDO::FETCH_OBJ);
            $controller = new CourseController();
            return $controller->castCourses($courses);
        }
    }

    // ! comprobar si funcionan
    public function getCoursesTag($categoria)
    {
        $course = new Course();
        $response = $course->getCoursesByTag($categoria);
        if ($response != false) {
            return $courses = $response->fetchAll(PDO::FETCH_OBJ);
        }
    }

    public function getCoursesAllJoin()
    {
        $course = new Course();
        $response = $course->getAllCourseJoin();
        if ($response != false) {
            return $courses = $response->fetchAll(PDO::FETCH_OBJ);
        }
    }
}
