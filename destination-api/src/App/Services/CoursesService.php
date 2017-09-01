<?php

namespace App\Services;

class CoursesService extends BaseService
{

    function save($course)
    {
        $this->db->insert("courses", $course);
        return $this->db->lastInsertId();
    }

}
