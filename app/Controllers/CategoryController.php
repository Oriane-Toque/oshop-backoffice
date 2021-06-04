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
     * Method to display add category page
     *
     * @return void 
     */
    public function add()
    {

      $this->show('category/add');
    }

    /**
     * Method to add category
     *
     * @return void 
     */
    public function create()
    {

      // je réflechis
      // de quoi j'ai besoin ??
      //TODO dd($_POST);
      $newCategory = new Category();
      $newCategory->setName($_POST["nameCategory"]);

      // j'ai besoin des infos qui sont dans $_POST
      // j'ai besoin du model pour inserer en base
      // j'insère en base
      // normalement j'affiche quelquechose  ??? lecture CDC
      // CDC dit rediriger vers la liste avec header()

    }
}
