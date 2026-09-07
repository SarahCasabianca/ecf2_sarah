<?php

namespace Afpa\Gestion\Controllers;

use Afpa\Gestion\Models\Intern;

class InternController {

    public function home() : void 
    {
        $intern = new Intern();
        $interns = $intern->getAll();

        require __DIR__ . '/../Views/interns/home.php';
    }

    public function index() : void 
    {
        $intern = new Intern();
        $interns = $intern->getAll();

        require __DIR__ . '/../Views/interns/index.php';
        
    }

    public function create() : void 
    {

        require __DIR__ . '/../Views/interns/create.php';

    }

    public function store() : void 
    {

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
        $intern->create($name, $surname, $birthdate);

        header('Location: index.php?page=home');
        exit;

    }

    public function edit(int $id) : void 
    {
        $interns = new Intern();
        $intern = $interns->getById($id);
        
        require __DIR__ . '/../Views/interns/edit.php';
        
    }

    public function update(int $id) : void 
    {

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
        $intern->update($name, $surname, $birthdate, $id);

        header('Location: index.php?page=home');
        exit;

    }

    public function delete(int $id) : void 
    {
        echo "Méthode delete appelée.";
    }

}