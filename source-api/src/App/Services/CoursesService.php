<?php

namespace App\Services;

class CoursesService extends BaseService
{

    public function getOne($id)
    {
        return $this->db->fetchAssoc("SELECT * FROM courses WHERE id=?", [(int) $id]);
    }

    public function getAll()
    {
        return $this->db->fetchAll("SELECT * FROM courses");
    }

    function save($note)
    {
        $this->db->insert("courses", $note);
        return $this->db->lastInsertId();
    }

    function update($id, $note)
    {
        return $this->db->update('courses', $note, ['id' => $id]);
    }

    function delete($id)
    {
        return $this->db->delete("courses", array("id" => $id));
    }

}
