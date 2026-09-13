<?php

namespace Afpa\Gestion\Models;

use Afpa\Gestion\Database;
use PDO;

class Admin
{
    private PDO $db;

    public function __construct(?PDO $db = null)
    {
        $this->db = $db ?? Database::getInstance()->getConnection();
    }

    public function getByPseudo(string $pseudo): array|false
    {

        $query = "SELECT * FROM admin WHERE admin_pseudo=?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$pseudo]);

        return $stmt->fetch();
    }
}
