<?php

namespace Afpa\Gestion\Controllers;

use Afpa\Gestion\Models\Intern;
use Afpa\Gestion\Models\Absence;

class InternController extends Controller {

    public function home() : void 
    {
        $intern = new Intern();
        $interns = $intern->getAll();

        $this->render('interns/home', ['interns' => $interns]);

    }

    public function index() : void 
    {
        $intern = new Intern();
        $interns = $intern->getAll();

        $absence = new Absence();

        $redIds = array_column($absence->getInternsRed(), 'intern_id');

        $this->render('interns/index', ['interns' => $interns, 'redIds' => $redIds]);
        
    }

    public function create() : void 
    {

        $this->render('interns/create');

    }

    public function store() : void 
    {

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?page=home');
            exit;
        }

        $postData = $_POST;

        if (
            empty($postData['intern_name']) ||
            empty($postData['intern_surname']) ||
            empty($postData['intern_birthdate'])
        ) {
            header('Location: index.php?page=add-intern');
            exit;
        }
        
        $name = $postData['intern_name'];
        $surname = $postData['intern_surname'];
        $birthdate = $postData['intern_birthdate'];
        $intern = new Intern();

        $photoFilename = null;

        if ($_FILES['intern_photo']['error'] !== UPLOAD_ERR_NO_FILE) {

            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $realMimeType = finfo_file($finfo, $_FILES['intern_photo']['tmp_name']);
            finfo_close($finfo);

            $allowedTypes = ['image/webp', 'image/jpeg', 'image/png'];

        if (!in_array($realMimeType, $allowedTypes)) {
            header('Location: index.php?page=add-intern');
            exit;
        }

        $extensions = [
            'image/jpeg' => 'jpg',
            'image/png'  => 'png',
            'image/webp' => 'webp',
        ];
        $extension = $extensions[$realMimeType];

        $photoFilename = uniqid('intern_', true) . '.' . $extension;

        move_uploaded_file($_FILES['intern_photo']['tmp_name'], __DIR__ . '/../../public/assets/img/' . $photoFilename);

        }

        $intern->create($name, $surname, $birthdate, $photoFilename);

        header('Location: index.php?page=home');
        exit;
    
    }

    public function edit(int $id) : void 
    {
        $interns = new Intern();
        $intern = $interns->getById($id);
        
        $this->render('interns/edit', ['intern' => $intern]);
        
    }

    public function update(int $id) : void 
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?page=home');
            exit;
        }
    
        $postData = $_POST;
    
        if (
            empty($postData['intern_name']) ||
            empty($postData['intern_surname']) ||
            empty($postData['intern_birthdate'])
        ) {
            header('Location: index.php?page=edit-intern&id=' . $id);
            exit;
        }
        
        $name = $postData['intern_name'];
        $surname = $postData['intern_surname'];
        $birthdate = $postData['intern_birthdate'];
        $intern = new Intern();
    
        // Récupère les données actuelles, pour connaître la photo déjà enregistrée
        $currentIntern = $intern->getById($id);
        $photoFilename = $currentIntern['intern_photo']; // par défaut : on garde l'ancienne
    
        if ($_FILES['intern_photo']['error'] !== UPLOAD_ERR_NO_FILE) {
    
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $realMimeType = finfo_file($finfo, $_FILES['intern_photo']['tmp_name']);
            finfo_close($finfo);
    
            $allowedTypes = ['image/webp', 'image/jpeg', 'image/png'];
    
            if (!in_array($realMimeType, $allowedTypes)) {
                header('Location: index.php?page=edit-intern&id=' . $id);
                exit;
            }
    
            $extensions = [
                'image/jpeg' => 'jpg',
                'image/png'  => 'png',
                'image/webp' => 'webp',
            ];
            $extension = $extensions[$realMimeType];
    
            $photoFilename = uniqid('intern_', true) . '.' . $extension;
    
            move_uploaded_file($_FILES['intern_photo']['tmp_name'], __DIR__ . '/../../public/assets/img/' . $photoFilename);
        }
    
        $intern->update($name, $surname, $birthdate, $photoFilename, $id);
    
        header('Location: index.php?page=home');
        exit;
    }

    public function delete(int $id) : void 
    {

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?page=home');
            exit;
        }

        try {

            $intern = new Intern();
            $intern->delete($id);

            header('Location: index.php?page=home');
            exit;

        } catch (\PDOException $e) {

            echo "Impossible de supprimer le stagiaire, il reste des absences enregistrées.";

        }

    }

}