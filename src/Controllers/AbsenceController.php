<?php

namespace Afpa\Gestion\Controllers;

use Afpa\Gestion\Models\Absence;
use Afpa\Gestion\Models\Reason;
use Afpa\Gestion\Models\Intern;

class AbsenceController {

    public function stats() : void 
    {
        $absence = new Absence();
        $rankings = $absence->countAllPerIntern();

        require __DIR__ . '/../Views/absence/stats.php';

    }

    public function index() : void 
    {
        $absence = new Absence();
        $absences = $absence->getAll();

        require __DIR__ . '/../Views/absence/index.php';
    }

    public function create() : void 
    {
        $reason = new Reason();
        $reasons = $reason->getAll();

        $intern = new Intern();
        $interns = $intern->getAll();

        require __DIR__ . '/../Views/absence/create.php';
    }

    public function store() : void 
    {
        $postData = $_POST;

        if (
            empty($postData['absence_date']) ||
            empty($postData['reason_id']) ||
            empty($postData['intern_id'])
        ) {
            header('Location: index.php?page=add-absence');
            exit;
        }
        
        $date = $postData['absence_date'];
        $document = null;
        $reasonId = (int) $postData['reason_id'];
        $internId = (int) $postData['intern_id'];

        $absence = new Absence();
        $absence->create($date, $document, $reasonId, $internId);

        header('Location: index.php?page=home');
        exit;
    }

    public function edit(int $id) : void 
    {
        $absences = new Absence();
        $absence = $absences->getById($id);

        $reason = new Reason();
        $reasons = $reason->getAll();

        $intern = new Intern();
        $interns = $intern->getAll();
        
        require __DIR__ . '/../Views/absence/edit.php';
    }

    public function update(int $id) : void 
    {
        $postData = $_POST;

        if (
            empty($postData['absence_date']) ||
            empty($postData['reason_id']) ||
            empty($postData['intern_id'])
        ) {
            header('Location: index.php?page=edit-absence&id=' . $id);
            exit;
        }
        
        $date = $postData['absence_date'];
        $document = null;
        $reasonId = (int) $postData['reason_id'];
        $internId = (int) $postData['intern_id'];

        $absence = new Absence();
        $absence->update($date, $document, $reasonId, $internId, $id);

        header('Location: index.php?page=home');
        exit;
    }

    public function delete(int $id) : void 
    {
        $absence = new Absence();
        $absence->delete($id);

        header('Location: index.php?page=home');
        exit;
    }

}