<?php

namespace Afpa\Gestion\Controllers;

class AbsenceController {

    public function stats() : void 
    {
        echo "Méthode stats appelée.";
    }

    public function index() : void 
    {
        echo "Méthode index appelée.";
    }

    public function create() : void 
    {
        echo "Méthode create appelée.";
    }

    public function store() : void 
    {
        echo "Méthode store appelée.";
    }

    public function edit(int $id) : void 
    {
        echo "Méthode edit appelée.";
    }

    public function update(int $id) : void 
    {
        echo "Méthode update appelée.";
    }

    public function delete(int $id) : void 
    {
        echo "Méthode delete appelée.";
    }

}