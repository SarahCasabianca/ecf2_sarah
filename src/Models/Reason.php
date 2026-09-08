<?php

namespace Afpa\Gestion\Models;

use Afpa\Gestion\Database;
use PDO;

class Reason 
{

    private PDO $db;

    public function __construct(?PDO $db = null)
    {
        $this->db = $db ?? Database::getInstance()->getConnection();
    }

    public function getAll(): array
    {
        $query = "SELECT * FROM reason";
        $stmt = $this->db->query($query);

        return $stmt->fetchAll();
    }

}