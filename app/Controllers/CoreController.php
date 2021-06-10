<?php

namespace App\Controllers;

class CoreController
{
    /**
     * Méthode de construction appelé lors du new
     */
    public function __construct()
    {
        // TODO $router ...
        // FAIRE DANS INDEX : $dispatcher->setControllersArguments($router, $_SERVER['BASE_URI'], $match);
        // + APPEL

        // avant on faisait des ACE mais pas pratique
        // TODO ACL
        // tableau contenant les permissions
        // permissions accordées en fonction des zones d'accès
        // ces zones d'accès sont les identifiants uniques de nos routes
        global $match;

        $acl = [
            'main-home' => [],
            'user-logout' => [],
            'category-list' => [],
            'category-add' => [],
            'category-create' => [],
            'category-update' => [],
            'category-edit' => [],
            'category-delete' => [],
            'type-list' => [],
            'type-add' => [],
            'type-create' => [],
            'type-update' => [],
            'type-edit' => [],
            'type-delete' => [],
            'brand-list' => [],
            'brand-add' => [],
            'brand-create' => [],
            'brand-update' => [],
            'brand-edit' => [],
            'brand-delete' => [],
            'product-list' => [],
            'product-add' => [],
            'product-create' => [],
            'product-update' => [],
            'product-edit' => [],
            'product-delete' => [],
            'user-list' => ['admin'],
            'user-add' => ['admin'],
            'user-create' => ['admin'],
            'user-update' => ['admin'],
            'user-edit' => ['admin'],
            'user-delete' => ['admin'],
        ];

        $zoneAcces = $match['name'];
        // dump($zoneAcces);

        // je vérifie l'existence de la clé récupéré via $match dans $acl
        if(array_key_exists($zoneAcces, $acl)){
            // je récupère le tableau des roles autorisés
            $authorizedRoles = $acl[$zoneAcces];
            // et je vérifie les autorisations
            $this->checkAuthorization($authorizedRoles);
        }
    }
    /**
     * Méthode permettant d'afficher du code HTML en se basant sur les views
     *
     * @param string $viewName Nom du fichier de vue
     * @param array $viewVars Tableau des données à transmettre aux vues
     * @return void
     */

    protected function show(string $viewName, $viewVars = [])
    {
        // On globalise $router car on ne sait pas faire mieux pour l'instant
        global $router;

        // Comme $viewVars est déclarée comme paramètre de la méthode show()
        // les vues y ont accès
        // ici une valeur dont on a besoin sur TOUTES les vues
        // donc on la définit dans show()
        $viewVars['currentPage'] = $viewName;

        // définir l'url absolue pour nos assets
        $viewVars['assetsBaseUri'] = $_SERVER['BASE_URI'] . 'assets/';
        // définir l'url absolue pour la racine du site
        // /!\ != racine projet, ici on parle du répertoire public/
        $viewVars['baseUri'] = $_SERVER['BASE_URI'];

        // On veut désormais accéder aux données de $viewVars, mais sans accéder au tableau
        // La fonction extract permet de créer une variable pour chaque élément du tableau passé en argument
        extract($viewVars);
        // => la variable $currentPage existe désormais, et sa valeur est $viewName
        // => la variable $assetsBaseUri existe désormais, et sa valeur est $_SERVER['BASE_URI'] . '/assets/'
        // => la variable $baseUri existe désormais, et sa valeur est $_SERVER['BASE_URI']
        // => il en va de même pour chaque élément du tableau

        // $viewVars est disponible dans chaque fichier de vue
        require_once __DIR__ . '/../views/layout/header.tpl.php';
        require_once __DIR__ . '/../views/' . $viewName . '.tpl.php';
        require_once __DIR__ . '/../views/layout/footer.tpl.php';
    }

    /**
     * Méthode de vérification des droits d'entrée 
     */
    protected function checkAuthorization($roles = [])
    {
        global $router;

        // $roles[] = 'admin';

        if (isset($_SESSION['userObject'])) {

            // dd($_SESSION);

            // je récupère l'objet User
            $currentUser = $_SESSION['userObject'];
            // dd($currentUser);

            // je récupère le role du User
            $roleUser = $currentUser->getRole();
            // dump($roleUser);

            // maintenant il me faut vérifier si le role du user correspond à la liste des roles que va recevoir ma méthode en paramètre
            if(in_array($roleUser, $roles) || empty($roles)) {
                // il a le droit d'accès
                return true;
            } else {
                // sinon il n'a pas le droit d'accès
                // error 403 : accès interdit
                http_response_code(403);
                // je donne ma vue vers la page 403
                $this->show('error/err403');
                exit();
            }
        } else {
            // il sort d'où ce coco ??
            // l'utilisateur n'est pas connecté
            header('Location:'.$router->generate('user-login'));
            exit();
        }
    }

    /**
     * Vérifie si la personne est connecté
     *
     * @return boolean
     */
    public static function isConnected() {

        if(isset($_SESSION['userObject'])) {
            return true;
        } else {
            return false;
        }
    }
}
