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
      $category = Category::findAll();

      $this->show('category/list');
    }
  }
