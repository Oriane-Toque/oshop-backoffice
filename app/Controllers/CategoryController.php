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
      $this->show('category/add');
    }
    /**
     * Création d'une catégorie
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
    }
  }
