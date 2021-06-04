<?php

  namespace App\Controllers;

  use App\Controllers\CoreController;
  use App\Models\Product;

  class ProductController extends CoreController
  {

    /**
     * Method to display categories list
     *
     * @return void 
     */
    public function list()
    {

      // Class::method grâce à static qui ne lie plus la méthode à l'instance
      $listModel = Product::findAll();

      $productList['productList'] = $listModel;
      $productList['titrePage'] = 'Liste des produits';


      $this->show('product/list', $productList);
    }

    /**
     * Method to add product and display add product page
     *
     * @return void 
     */
    public function add()
    {

      $this->show('product/add');
    }
}
