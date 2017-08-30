<?php

namespace App\Services;

class CoursesService extends BaseService
{
    
    private $queryBuilder;

    public function getOne($id)
    {
        return $this->db->fetchAssoc("SELECT * FROM courses WHERE id=?", [(int) $id]);
    }

    public function getAll()
    {
        return $this->db->fetchAll("SELECT * FROM courses");
    }
    
    public function getPaginated(int $limit, int $offset)
    {
        $this->queryBuilder = $this->db->createQueryBuilder();
        $result = $this->queryBuilder
            ->select('c.id')
            ->from('courses', 'c')
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->execute();
        return $result->fetchAll();
//        return $this->db->executeQuery("SELECT id FROM courses WHERE ORDER BY id LIMIT ? OFFSET ?", [$limit, $offset]);
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
