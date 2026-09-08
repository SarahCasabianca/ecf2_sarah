<?php

namespace Afpa\Gestion\Models;

use Afpa\Gestion\Database;
use PDO;

class Absence 
{

    private PDO $db;

    public function __construct(?PDO $db = null)
    {
        $this->db = $db ?? Database::getInstance()->getConnection();
    }

    public function getAll(): array
    {
        $query = "SELECT 
            absence.absence_id,
            absence.absence_date,
            absence.absence_document,
            intern.intern_id,
            intern.intern_name,
            intern.intern_surname,
            reason.reason_id,
            reason.reason_name
        FROM absence
        JOIN intern ON absence.intern_id = intern.intern_id
        JOIN reason ON absence.reason_id = reason.reason_id";

        $stmt = $this->db->query($query);
        return $stmt->fetchAll();
    }

    public function getById(int $id): array|false
    {
        $query = "SELECT * FROM absence WHERE absence_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);

        return $stmt->fetch();
    }

    public function create(string $date, ?string $document, int $reasonId, int $internId): void
    {
        $query = "INSERT INTO absence (absence_date, absence_document, reason_id, intern_id) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$date, $document, $reasonId, $internId]);
    }

    public function update(string $date, ?string $document, int $reasonId, int $internId, int $id): void
    {
        $query = "UPDATE absence SET absence_date = ?, absence_document = ?, reason_id = ?, intern_id = ? WHERE absence_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$date, $document, $reasonId, $internId, $id]);
    }

    public function delete(int $id): void
    {
        $query = "DELETE FROM absence WHERE absence_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
    }

    public function countAllPerIntern(): array
    {
        $query = "SELECT 
        intern.intern_id,
        intern.intern_name,
        intern.intern_surname,
        COUNT(absence.absence_id) AS nb_absences
        FROM intern
        JOIN absence ON absence.intern_id = intern.intern_id
        GROUP BY intern.intern_id
        ORDER BY nb_absences DESC";
        
        $stmt = $this->db->query($query);
        return $stmt->fetchAll();
}

    public function countByReasonPerIntern(string $reasonName): array
    {

        $query = "SELECT absence.intern_id, COUNT(*) AS nb_absences
            FROM absence
            JOIN reason ON absence.reason_id = reason.reason_id
            WHERE reason.reason_name = ?
            GROUP BY absence.intern_id";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$reasonName]);
        return $stmt->fetchAll();

    }

    public function GetInternsRed(): array
    {

        $query = "SELECT intern_id, COUNT(*) AS nb
                FROM absence
                JOIN reason ON absence.reason_id = reason.reason_id
                WHERE reason.reason_name = 'sans motif'
                GROUP BY intern_id
                HAVING COUNT(*) > 5";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll();

    }

}