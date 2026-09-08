<?php

namespace Afpa\Gestion;

use Afpa\Gestion\Controllers\AuthController;
use Afpa\Gestion\Controllers\InternController;
use Afpa\Gestion\Controllers\AbsenceController;

/**
 * Classe Router - Gestionnaire de routes de l'application
 *
 * Le Router est responsable de :
 * - Analyser l'URL demandée par l'utilisateur
 * - Déterminer quelle action du contrôleur doit être exécutée
 * - Extraire les paramètres de l'URL (comme l'ID d'un article)
 * - Appeler la méthode appropriée du contrôleur
 *
 * Ce système remplace l'ancien système avec des fichiers PHP séparés pour chaque page.
 * Maintenant, tout passe par un point d'entrée unique (index.php) et le Router
 * décide quelle action exécuter.
 *
 * La logique de résolution des routes (resolveRoute) est séparée de l'exécution
 * (dispatch) pour permettre de tester le routing sans instancier les contrôleurs.
 */
class Router
{
    /**
     * Instance du contrôleur d'articles
     */
    private AuthController $authController;

    /**
     * Instance du contrôleur d'authentification
     */
    private InternController $internController;

    /**
     * Instance du contrôleur d'inscription
     */
    private AbsenceController $absenceController;


    /**
     * Constructeur - Initialise les contrôleurs
     */
    public function __construct()
    {
        $this->authController = new AuthController();
        $this->internController = new InternController();
        $this->absenceController = new AbsenceController();
    }

    /**
     * Retourne la liste des pages autorisées par le Router
     *
     * Cette liste sert de whitelist de sécurité : seules les pages listées ici
     * peuvent être accédées. Toute autre valeur de $_GET['page'] sera rejetée
     * avec une erreur 404.
     *
     * Méthode statique pour pouvoir être appelée sans instancier le Router
     * (utile pour les tests unitaires et la validation externe).
     *
     * @return array Liste des identifiants de pages autorisées
     */
    public static function getAllowedPages(): array
    {
        return [
            'home',
            'stats',
            'login',
            'loginpost',
            'logout',
            'interns',
            'add-intern',
            'add-intern-post',
            'edit-intern',
            'edit-intern-post',
            'delete-intern-post',
            'absences',
            'add-absence',
            'add-absence-post',
            'edit-absence',
            'edit-absence-post',
            'delete-absence-post',
        ];
    }

    public static function getProtectedPages(): array
    {

        return [
            'interns',
            'add-intern',
            'add-intern-post',
            'edit-intern',
            'edit-intern-post',
            'delete-intern-post',
            'absences',
            'add-absence',
            'add-absence-post',
            'edit-absence',
            'edit-absence-post',
            'delete-absence-post',
        ];

    }

    /**
     * Résout une route sans l'exécuter
     *
     * Détermine quel contrôleur et quelle action correspondent à une page donnée,
     * SANS appeler le contrôleur. Retourne un tableau descriptif de la route.
     *
     * Cette séparation entre résolution et exécution permet :
     * - De tester la logique de routing sans base de données ni contrôleurs
     * - De vérifier les routes dans d'autres contextes (génération de sitemap, etc.)
     *
     * @param string $page Le nom de la page demandée (ex: 'home', 'articles', 'login')
     * @param array $params Paramètres de la requête (ex: ['id' => '123'])
     * @return array|null Tableau ['controller' => ..., 'action' => ..., 'params' => [...]] ou null si 404
     */
    public static function resolveRoute(string $page, array $params = []): ?array
    {
        // Vérifie d'abord que la page est dans la whitelist
        if (!in_array($page, self::getAllowedPages())) {
            return null;
        }

        // Table de routage : associe chaque page à son contrôleur et son action
        $routes = [
            'home'               => ['controller' => 'intern',  'action' => 'home'],
            'stats'              => ['controller' => 'absence', 'action' => 'stats'],

            'login'              => ['controller' => 'auth',    'action' => 'showLoginForm'],
            'loginpost'          => ['controller' => 'auth',    'action' => 'login'],
            'logout'             => ['controller' => 'auth',    'action' => 'logout'],

            'interns'            => ['controller' => 'intern',  'action' => 'index'],
            'add-intern'         => ['controller' => 'intern',  'action' => 'create'],
            'add-intern-post'    => ['controller' => 'intern',  'action' => 'store'],
            'edit-intern'        => ['controller' => 'intern',  'action' => 'edit'],
            'edit-intern-post'   => ['controller' => 'intern',  'action' => 'update'],
            'delete-intern-post' => ['controller' => 'intern',  'action' => 'delete'],

            'absences'             => ['controller' => 'absence', 'action' => 'index'],
            'add-absence'          => ['controller' => 'absence', 'action' => 'create'],
            'add-absence-post'     => ['controller' => 'absence', 'action' => 'store'],
            'edit-absence'         => ['controller' => 'absence', 'action' => 'edit'],
            'edit-absence-post'    => ['controller' => 'absence', 'action' => 'update'],
            'delete-absence-post'  => ['controller' => 'absence', 'action' => 'delete'],
        ];

        if (!isset($routes[$page])) {
            return null;
        }

        $route = $routes[$page];
        $route['params'] = [];

        // La page 'edit' nécessite un ID valide
        if ($page === 'edit-intern' || $page === 'edit-absence' || $page === 'edit-intern-post' || $page === 'delete-absence-post' || $page === 'delete-intern-post' || $page === 'edit-absence-post') {
            if (isset($params['id']) && is_numeric($params['id'])) {
                $route['params']['id'] = (int) $params['id'];
            } else {
                return null; // Pas d'ID valide = 404
            }
        }

        return $route;
    }

    /**
     * Route la requête vers l'action appropriée
     *
     * Cette méthode analyse les paramètres GET de l'URL pour déterminer
     * quelle page afficher et quelle action exécuter.
     *
     * Utilise resolveRoute() pour déterminer la route, puis exécute
     * l'action correspondante sur le bon contrôleur.
     *
     * Exemples d'URLs gérées :
     * - home.html => page d'accueil
     * - articles/123-titre.html => affichage d'un article
     * - add.html => formulaire d'ajout
     * - addpost.html => traitement du formulaire d'ajout
     * - edit.html?id=123 => formulaire de modification
     * - editpost.html => traitement du formulaire de modification
     * - deletepost.html => traitement de la suppression
     * - login.html => formulaire de connexion
     * - loginpost.html => traitement de la connexion
     * - logout.html => déconnexion
     * - register.html => formulaire d'inscription
     * - registerpost.html => traitement de l'inscription
     * - tests.html => page d'exécution des tests PHPUnit
     */
    public function dispatch(): void
    {
        // Récupère le paramètre 'page' de l'URL (défini par les règles .htaccess)
        $page = $_GET['page'] ?? 'home';

        // Résout la route (quel contrôleur et quelle action)
        $route = self::resolveRoute($page, $_GET);

        // Si la route n'existe pas, affiche une erreur 404
        if ($route === null) {
            $this->notFound();
            return;
        }

        // Nouvelle vérification : la page est-elle protégée, et l'admin est-il connecté ?
        if (in_array($page, self::getProtectedPages()) && !isset($_SESSION['is_admin'])) {
            header('Location: index.php?page=login');
            exit;
        }

        // Mappe les noms de contrôleurs vers les instances
        $controllers = [
            'intern'  => $this->internController,
            'auth'     => $this->authController,
            'absence' => $this->absenceController,
        ];

        // Récupère l'instance du contrôleur et le nom de l'action
        $controller = $controllers[$route['controller']];
        $action = $route['action'];

        // Appelle l'action avec les paramètres (ex: show(123))
        if (!empty($route['params'])) {
            $controller->$action(...array_values($route['params']));
        } else {
            $controller->$action();
        }
    }

    /**
     * Affiche une page d'erreur 404
     *
     * Cette méthode est appelée quand l'utilisateur demande une page
     * qui n'existe pas ou qui n'est pas dans la liste des pages autorisées
     */
    private function notFound(): void
    {
        http_response_code(404);
        require_once __DIR__ . '/Views/errors/404.php';
    }
}