<?php

namespace Afpa\Gestion\Controllers;

use Afpa\Gestion\Models\Absence;

class Controller
{
    protected function render(string $view, array $data = []): void
    {
        extract($data);

        ob_start();
        require __DIR__ . '/../Views/' . $view . '.php';
        $content = ob_get_clean();

        // Données pour la sidebar statistiques, disponibles sur toutes les pages
        $absence = new Absence();
        $rankings = $absence->countAllPerIntern();

        require __DIR__ . '/../Views/layouts/default.php';
    }
}