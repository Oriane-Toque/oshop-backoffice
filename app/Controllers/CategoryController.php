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

      // dd($_POST);
      /*===========RECUPERATION DES DONNEES DU FORMULAIRE + FILTRES DE NETTOYAGES===========*/
      $nameCategory = filter_input(INPUT_POST, 'nameCategory', FILTER_SANITIZE_STRING);
      $subtitleCategory = filter_input(INPUT_POST, 'subtitleCategory', FILTER_SANITIZE_STRING);
      $pictureCategory = filter_input(INPUT_POST, 'pictureCategory');

      // Instanciation de mon modèle Category
      $newCategoryModel = new Category();

      //=================ATTRIBUTION DES VALEURS DU FORMULAIRE VIA MES SETTERS==============*/
      $newCategoryModel->setName($nameCategory);
      $newCategoryModel->setSubtitle($subtitleCategory);
      $newCategoryModel->setPicture($pictureCategory);
      // dd($newCategoryModel);

      // Appel de ma méthod insert() pour ajouter ma nouvelle catégorie
      $newCategoryModel->insert();

      //===================REORIENTATION VERS LA PAGE category/list=========================*/

      header('Location:list');
      exit();
    }
}
