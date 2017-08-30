<?php

namespace App\Services;

class BaseService
{
    /**
     *
     * @var \Doctrine\DBAL\Connection
     */
    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

}
