<?php

namespace Afpa\Gestion\Models;

use Afpa\Gestion\Database;
use PDO;

class Intern 
{

    private PDO $db;

    public function __construct(?PDO $db = null)
    {
        $this->db = $db ?? Database::getInstance()->getConnection();
    }

    public function getAll(): array
    {

        $query = "SELECT * FROM intern";
        $stmt = $this->db->query($query);

        return $stmt->fetchAll();

    }

    public function getById(int $id): array|false
    {

        $query = "SELECT * FROM intern WHERE intern_id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch();

    }

    public function create(string $name, string $surname, string $birthdate): void
    {

        $query = "INSERT INTO intern (intern_name, intern_surname, intern_birthdate) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$name, $surname, $birthdate]);

    }

    public function update(string $name, string $surname, string $birthdate, int $id): void
    {

        $query = "UPDATE intern SET intern_name = ?, intern_surname = ?, intern_birthdate = ? WHERE intern_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$name, $surname, $birthdate, $id]);

    }

    public function delete(int $id): void
    {

        $query = "DELETE FROM intern WHERE intern_id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);

    }

}