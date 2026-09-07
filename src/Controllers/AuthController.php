<?php

namespace Afpa\Gestion\Controllers;

class AuthController {

    public function showLoginForm() : void 
    {
        echo "Méthode showLoginForm appelée.";
    }

    public function login() : void 
    {
        echo "Méthode login appelée.";
    }

    public function logout() : void 
    {
        echo "Méthode logout appelée.";
    }

}