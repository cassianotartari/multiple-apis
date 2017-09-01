<?php

namespace App\Services;

class CoursesService extends BaseService
{

    function save($course)
    {
        $this->db->insert("courses", $course);
        return $this->db->lastInsertId();
    }
    
    public function getAll()
    {
        return $this->db->fetchAll("SELECT * FROM courses");
    }

}
