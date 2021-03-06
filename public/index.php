<?php

//? POINT D'ENTRÉE UNIQUE : 
//? FrontController

// inclusion des dépendances via Composer
// autoload.php permet de charger d'un coup toutes les dépendances installées avec composer
// mais aussi d'activer le chargement automatique des classes (convention PSR-4)
require_once '../vendor/autoload.php';

// on démarre la session pour permettre la connexion utilisteur

session_start();


//?=========================================================
//?======================= ROUTAGE =========================

// création de l'objet router
// Cet objet va gérer les routes pour nous, et surtout il va 
$router = new AltoRouter();

// le répertoire (après le nom de domaine) dans lequel on travaille est celui-ci
// Mais on pourrait travailler sans sous-répertoire
// Si il y a un sous-répertoire
if (array_key_exists('BASE_URI', $_SERVER)) {
    // Alors on définit le basePath d'AltoRouter
    $router->setBasePath($_SERVER['BASE_URI']);
    // ainsi, nos routes correspondront à l'URL, après la suite de sous-répertoire
}
// sinon
else {
    // On donne une valeur par défaut à $_SERVER['BASE_URI'] car c'est utilisé dans le CoreController
    $_SERVER['BASE_URI'] = '/';
}

//? On doit déclarer toutes les "routes" à AltoRouter, afin qu'il puisse nous donner LA "route" correspondante à l'URL courante
//? On appelle cela "mapper" les routes
// 1. méthode HTTP : GET ou POST (pour résumer)
// 2. La route : la portion d'URL après le basePath
// 3. Target/Cible : informations contenant
//      - le nom de la méthode à utiliser pour répondre à cette route
//      - le nom du controller contenant la méthode
// 4. Le nom de la route : pour identifier la route, on va suivre une convention
//      - "NomDuController-NomDeLaMéthode"
//      - ainsi pour la route /, méthode "home" du MainController => "main-home"

//?=========================================================
//?=========================================================
//?======================= MAPPAGE =========================
//?=========================================================
//?=========================================================

//?=========================================================
//?====================== ROUTES HOME ======================

$router->map(
    'GET',
    '/',
    '\App\Controllers\MainController::home',
    'main-home'
);

//?=========================================================
//?================ ROUTES HOME MANAGER ====================

$router->map(
    'GET',
    '/homemanager/update',
    '\App\Controllers\HomeManagerController::update',
    'home-manager-update'
);

$router->map(
    'POST',
    '/homemanager/update',
    '\App\Controllers\HomeManagerController::edit',
    'home-manager-modify'
);

//?=========================================================
//?================= ALL ROUTES CATEGORY ===================

//? ROUTE VERS LA LISTE DES CATEGORIES
$router->map(
    'GET',
    '/category/list',
    '\App\Controllers\CategoryController::list',
    'category-list'
);

//? ROUTE VERS LE FORMULAIRE D'AJOUT CATEGORIE
$router->map(
    'GET',
    '/category/add',
    '\App\Controllers\CategoryController::add',
    'category-add'
);

//? AJOUT CATEGORY
$router->map(
    'POST',
    '/category/add',
    '\App\Controllers\CategoryController::create',
    'category-create'
);

//? ROUTE MENANT AU FORMULAIRE DE MODIFICATIONS DE CATEGORIE
$router->map(
    'GET',
    '/category/update/[i:categoryId]',
    '\App\Controllers\CategoryController::update',
    'category-update'
);

//? ROUTE GERANT LES MODIFICATIONS ENVOYÉES PAR LE FORMULAIRE CATEGORY
$router->map(
    'POST',
    '/category/update/[i:categoryId]',
    '\App\Controllers\CategoryController::edit',
    'category-edit'
);

//? ROUTE POUR LA SUPPRESSION D'UNE CATEGORIE
$router->map(
    'GET',
    '/category/delete/[i:categoryId]',
    '\App\Controllers\CategoryController::delete',
    'category-delete'
);


//?=========================================================
//?================= ALL ROUTES PRODUCTS ===================

//? ROUTE VERS LA LISTE DES PRODUITS
$router->map(
    'GET',
    '/product/list',
    '\App\Controllers\ProductController::list',
    'product-list'
);

//? ROUTE VERS LE FORMULAIRE D'AJOUT PRODUIT
$router->map(
    'GET',
    '/product/add',
    '\App\Controllers\ProductController::add',
    'product-add'
);

//? AJOUT PRODUIT
$router->map(
    'POST',
    '/product/add',
    '\App\Controllers\ProductController::create',
    'product-create'
);

//? ROUTE MENANT AU FORMULAIRE DE MODIFICATIONS DE PRODUIT
$router->map(
    'GET',
    '/product/update/[i:productId]',
    '\App\Controllers\ProductController::update',
    'product-update'
);

//? ROUTE GERANT LES MODIFICATIONS ENVOYÉES PAR LE FORMULAIRE PRODUIT
$router->map(
    'POST',
    '/product/update/[i:productId]',
    '\App\Controllers\ProductController::edit',
    'product-edit'
);

//? ROUTE POUR LA SUPPRESSION D'UN PRODUIT
$router->map(
    'GET',
    '/product/delete/[i:productId]',
    '\App\Controllers\ProductController::delete',
    'product-delete'
);


//?=========================================================
//?=================== ALL ROUTES BRANDS ===================

//? ROUTE VERS LA LISTE DES MARQUES
$router->map(
    'GET',
    '/brand/list',
    '\App\Controllers\BrandController::list',
    'brand-list'
);

//? ROUTE VERS LE FORMULAIRE D'AJOUT MARQUE
$router->map(
    'GET',
    '/brand/add',
    '\App\Controllers\BrandController::add',
    'brand-add'
);

//? AJOUT TYPE
$router->map(
    'POST',
    '/brand/add',
    '\App\Controllers\BrandController::create',
    'brand-create'
);

//? ROUTE MENANT AU FORMULAIRE DE MODIFICATIONS DE MARQUE
$router->map(
    'GET',
    '/brand/update/[i:brandId]',
    '\App\Controllers\BrandController::update',
    'brand-update'
);

//? ROUTE GERANT LES MODIFICATIONS ENVOYÉES PAR LE FORMULAIRE MARQUE
$router->map(
    'POST',
    '/brand/update/[i:brandId]',
    '\App\Controllers\BrandController::edit',
    'brand-edit'
);

//? ROUTE POUR LA SUPPRESSION D'UNE MARQUE
$router->map(
    'GET',
    '/brand/delete/[i:brandId]',
    '\App\Controllers\BrandController::delete',
    'brand-delete'
);


//?=========================================================
//?=================== ALL ROUTES TYPES ====================

//? ROUTE VERS LA LISTE DES TYPES
$router->map(
    'GET',
    '/type/list',
    '\App\Controllers\TypeController::list',
    'type-list'
);

//? ROUTE VERS LE FORMULAIRE D'AJOUT TYPE
$router->map(
    'GET',
    '/type/add',
    '\App\Controllers\TypeController::add',
    'type-add'
);

//? AJOUT TYPE
$router->map(
    'POST',
    '/type/add',
    '\App\Controllers\TypeController::create',
    'type-create'
);

//? ROUTE MENANT AU FORMULAIRE DE MODIFICATIONS DE TYPE
$router->map(
    'GET',
    '/type/update/[i:typeId]',
    '\App\Controllers\TypeController::update',
    'type-update'
);

//? ROUTE GERANT LES MODIFICATIONS ENVOYÉES PAR LE FORMULAIRE TYPE
$router->map(
    'POST',
    '/type/update/[i:typeId]',
    '\App\Controllers\TypeController::edit',
    'type-edit'
);

//? ROUTE POUR LA SUPPRESSION D'UN TYPE
$router->map(
    'GET',
    '/type/delete/[i:typeId]',
    '\App\Controllers\TypeController::delete',
    'type-delete'
);


//?=========================================================
//?=================== ALL ROUTES USER =====================

//? ROUTE FORMULAIRE DE CONNEXION
$router->map(
    'GET',
    '/user/login',
    '\App\Controllers\AppUserController::login',
    'user-login'
);

//? ROUTE TRAITEMENT DU FORMULAIRE DE CONNEXION
$router->map(
    'POST',
    '/user/login',
    '\App\Controllers\AppUserController::connect',
    'user-connect'
);

//? ROUTE DECONNEXION UTILISATEUR
$router->map(
    'GET',
    '/user/logout',
    '\App\Controllers\AppUserController::logout',
    'user-logout'
);

//?========================================================
//?================ ALL ROUTES SUPERADMIN =================

//? ROUTE LISTE DES UTILISATEURS
$router->map(
    'GET',
    '/user/list', 
    '\App\Controllers\AppUserController::list',
    'user-list'
);

//? ROUTE VERS LE FORMULAIRE D'AJOUT DES UTILISATEURS
$router->map(
    'GET',
    '/user/add',
    '\App\Controllers\AppUserController::add',
    'user-add'
);

//? ROUTE TRAITEMENT DU FORMULAIRE D'AJOUT UTILISATEURS
$router->map(
    'POST',
    '/user/add',
    '\App\Controllers\AppUserController::create',
    'user-create'
);

//? ROUTE FORMULAIRE DE MODIFICATIONS UTILISATEURS
$router->map(
    'GET',
    '/user/update/[i:userId]',
    '\App\Controllers\AppUserController::update',
    'user-update'
);

//? ROUTE TRAITEMENT DU FORMULAIRE DE MODIFICATIONS UTILISATEURS
$router->map(
    'POST',
    '/user/update/[i:userId]',
    '\App\Controllers\AppUserController::edit',
    'user-edit'
);

//? ROUTE POUR SUPPRIMER UN UTILISATEUR
$router->map(
    'GET',
    '/user/delete/[i:userId]',
    '\App\Controllers\AppUserController::delete',
    'user-delete'
);

//?=========================================================
//?======================= DISPATCH ========================

// On demande à AltoRouter de trouver une route qui correspond à l'URL courante
$match = $router->match();

// Ensuite, pour dispatcher le code dans la bonne méthode, du bon Controller
// On délègue à une librairie externe : https://packagist.org/packages/benoclock/alto-dispatcher
// 1er argument : la variable $match retournée par AltoRouter
// 2e argument : le "target" (controller & méthode) pour afficher la page 404
$dispatcher = new Dispatcher($match, '\App\Controllers\ErrorController::err404');
// Une fois le "dispatcher" configuré, on lance le dispatch qui va exécuter la méthode du controller
$dispatcher->dispatch();
