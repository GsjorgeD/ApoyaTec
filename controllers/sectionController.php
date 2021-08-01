<?php

require_once '../../models/section.php';

class SectionController
{
    public function accordionItem(Section $section, Course $course)
    {
        require('../components/accordionItem.php');
    }

    public function getSection($id)
    {
        $section = new Section();
        $response = $section->getSection($id);
        if ($response != false) {
            $response = $response->fetch(PDO::FETCH_OBJ);
            $section->construct($response);
            return $section;
        }
    }

    public function getAllSection($course_id)
    {
        $section = new Section();
        $response = $section->getSections($course_id);
        if ($response != false) {
            $response = $response->fetchAll(PDO::FETCH_OBJ);

            $sections = array();
            foreach ($response as $item) {
                $section = new Section();
                $section->construct($item);
                array_push($sections, $section);
            }
            return $sections;
        }
    }
}
