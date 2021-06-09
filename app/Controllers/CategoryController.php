<?php

  namespace App\Controllers;

  use App\Controllers\CoreController;
  use App\Models\Category;

  class CategoryController extends CoreController
  {

    /**
     * Method to display categories list
     *
     * @return void 
     */
    public function list()
    {

      // on définit les roles qui ont le droit d'
      $rolesRequis[] = 'catalog-manager';
      // $rolesRequis[] = 'admin';
      // pas besoin de tester le retour de la fonction
      // car elle vire les gens si c'est pas bon.
      $this->checkAuthorization($rolesRequis);

      // ancienne manière
      // $categoryModel = new Category();
      // $categoryModel->find(1);

      // Class::method grâce à static qui ne lie plus la méthode à l'instance
      $listModel = Category::findAll();

      /* confort -> ainsi on appelle pas $viewVars mais $categoryList (grâce au extract le nom de notre variable dans notre view sera categoryList) + explicite */
      $categoryList['categoryList'] = $listModel;
      $categoryList['titrePage'] = 'Liste des catégories';


      $this->show('category/list', $categoryList);
    }

    /**
     * Ajout d'une catégorie.
     *
     * @return void
     */
    public function add()
    {

      $categoryData['titrePage'] = 'Ajouter une catégorie';

      $this->show('category/add', $categoryData);
    }

    /**
     * Create category
     * 
     * @return void
     */
    public function create()
    {

      // je dois récuperer les données dans $_POST
      // 1ere solution : $name = $_POST['name']
      // 2eme solution : $name = filter_input(INPUT_POST, 'name');
      // 3eme solution : $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
      $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
      $subtitle = filter_input(INPUT_POST, 'subtitle', FILTER_SANITIZE_STRING);
      $picture = filter_input(INPUT_POST, 'picture', FILTER_SANITIZE_URL);

      // je dois créer un nouveau model et lui donner les infos
      $newCategory = new Category();
      $newCategory->setName($name);
      $newCategory->setSubtitle($subtitle);
      $newCategory->setPicture($picture);

      // je dois inserer mon model en base
      $newCategory->insert();

      //dd($_POST);
      // redirige sur le HOME
      // header('Location: /');
      // utilise le routeur, mais utiliser aussi global :'(
      global $router;
      header('Location: ' . $router->generate('category-list'));
      exit();
    }

    /**
     * Display edit's form
     * 
     * @return void
     * @param int (identifiant de la catégorie)
     */
    public function update(int $routeInfo) {

      // je récupère toutes les données de ma catégorie selon son id contenu dans $routeInfo
      $categoryModel = Category::find($routeInfo);
      // je stocke les information de la catégorie selectionnait par l'admin
      $categoryData['category'] = $categoryModel;
      $categoryData['titrePage'] = 'Modifier une catégorie';

      // dump($categoryData);

      $this->show('category/update', $categoryData);
    }

    /**
     * Edit category
     * 
     * @return void
     * @param int (identifiant de la catégorie)
     */
    public function edit(int $routeInfo) {

      $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
      $subtitle = filter_input(INPUT_POST, 'subtitle', FILTER_SANITIZE_STRING);
      $picture = filter_input(INPUT_POST, 'picture', FILTER_VALIDATE_URL);

      // dump($name);

      // je récupère les dernières infos à jour
      $editCategory = Category::find($routeInfo);
      // modification des propriétés liées à l'instance
      // affectation des données du formulaire
      $editCategory->setName($name);
      $editCategory->setSubtitle($subtitle);
      $editCategory->setPicture($picture);

      $editCategory->update($routeInfo);

      global $router;
      header('Location: ' . $router->generate('category-update', ['categoryId' => $routeInfo]));
      exit();
    }

    /**
     * Method to delete a category
     *
     * @param int (identifiant de la catégorie)
     * @return void
     */
    public function delete(int $routeInfo) {

      Category::delete($routeInfo);

      global $router;
      header('Location: ' .$router->generate('category-list'));
      exit();
    }
  }
