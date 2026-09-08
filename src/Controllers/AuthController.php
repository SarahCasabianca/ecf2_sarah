<?php

namespace Afpa\Gestion\Controllers;

use Afpa\Gestion\Models\Admin;

class AuthController {

    public function showLoginForm() : void 
    {
        require __DIR__ . '/../Views/auth/login.php';
    }

    public function login() : void 
    {
        $postData = $_POST;

        $pseudo = $postData['admin_pseudo'];
        $password = $postData['admin_password'];
        $admin = new Admin();
        $adminData = $admin->getByPseudo($pseudo);

        if ($adminData === false || !password_verify($password, $adminData['admin_password_hash']))
        { 

            header('Location: index.php?page=login');
            exit;
        }

        $_SESSION['is_admin'] = true;
        header('Location: index.php?page=home');
        exit;

    }

    public function logout() : void 
    {

        $_SESSION = [];
        session_destroy();

        header('Location: index.php?page=home');
        exit;

    }

}