<?php

namespace Afpa\Gestion\Controllers;

use Afpa\Gestion\Models\Absence;
use Afpa\Gestion\Models\Reason;
use Afpa\Gestion\Models\Intern;

class AbsenceController extends Controller {

    public function stats() : void 
    {
        $absence = new Absence();
        $rankings = $absence->countAllPerIntern();

        $this->render('absence/stats', ['rankings' => $rankings]);
    }

    public function index() : void 
    {
        $absence = new Absence();
        $absences = $absence->getAll();

        $this->render('absence/index', ['absences' => $absences]);
    }

    public function create() : void 
    {
        $reason = new Reason();
        $reasons = $reason->getAll();

        $intern = new Intern();
        $interns = $intern->getAll();

        $this->render('absence/create', ['reasons' => $reasons, 'interns' => $interns]);
    }

    public function store() : void 
    {
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?page=home');
            exit;
        }

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
        $reasonId = (int) $postData['reason_id'];
        $internId = (int) $postData['intern_id'];

        $documentFilename = null;

        if ($_FILES['absence_document']['error'] !== UPLOAD_ERR_NO_FILE) {

            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $realMimeType = finfo_file($finfo, $_FILES['absence_document']['tmp_name']);
            finfo_close($finfo);

            if ($realMimeType !== 'application/pdf') {
                header('Location: index.php?page=add-absence');
                exit;
            }

            $documentFilename = uniqid('absence_', true) . '.pdf';

            move_uploaded_file($_FILES['absence_document']['tmp_name'], __DIR__ . '/../../public/assets/documents/' . $documentFilename);
        }

        $absence = new Absence();
        $absence->create($date, $documentFilename, $reasonId, $internId);

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
        
        $this->render('absence/edit', ['absence' => $absence, 'reasons' => $reasons, 'interns' => $interns]);
    }

    public function update(int $id) : void 
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?page=home');
            exit;
        }  
    
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
        $reasonId = (int) $postData['reason_id'];
        $internId = (int) $postData['intern_id'];
    
        $absence = new Absence();
    
        $currentAbsence = $absence->getById($id);
        $documentFilename = $currentAbsence['absence_document'];
    
        if ($_FILES['absence_document']['error'] !== UPLOAD_ERR_NO_FILE) {
    
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $realMimeType = finfo_file($finfo, $_FILES['absence_document']['tmp_name']);
            finfo_close($finfo);
    
            if ($realMimeType !== 'application/pdf') {
                header('Location: index.php?page=edit-absence&id=' . $id);
                exit;
            }
    
            $documentFilename = uniqid('absence_', true) . '.pdf';
    
            move_uploaded_file($_FILES['absence_document']['tmp_name'], __DIR__ . '/../../public/assets/documents/' . $documentFilename);
        }
    
        $absence->update($date, $documentFilename, $reasonId, $internId, $id);
    
        header('Location: index.php?page=home');
        exit;
    }

    public function delete(int $id) : void 
    {

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?page=home');
            exit;
        }

        $absence = new Absence();
        $absence->delete($id);

        header('Location: index.php?page=home');
        exit;
    }

}