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
  }
