<?php

  namespace App\Controllers;

  use App\Controllers\CoreController;
  use App\Models\Product;
  use App\Models\Brand;
  use App\Models\Category;
  use App\Models\Type;

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
     * Method to display add product page
     *
     * @return void 
     */
    public function add()
    {

      $brandModel = Brand::findAll();
      $categoryModel = Category::findAll();
      $typeModel = Type::findAll();

      $listAllModel['brandList'] = $brandModel;
      $listAllModel['categoryList'] = $categoryModel;
      $listAllModel['typeList'] = $typeModel;
      $listAllModel['titrePage'] = 'Ajouter un produit';

      $this->show('product/add', $listAllModel);
    }

    /**
     * Method to add product
     *
     * @return void 
     */
    public function create()
    {

      // dd($_POST);
      /*===========RECUPERATION DES DONNEES DU FORMULAIRE + FILTRES DE NETTOYAGES===========*/
      $nameProduct = filter_input(INPUT_POST, 'nameProduct', FILTER_SANITIZE_STRING);
      $descriptionProduct = filter_input(INPUT_POST, 'descriptionProduct', FILTER_SANITIZE_STRING);
      $pictureProduct = filter_input(INPUT_POST, 'pictureProduct', FILTER_SANITIZE_STRING);
      $priceProduct = filter_input(INPUT_POST, 'priceProduct', FILTER_VALIDATE_FLOAT);
      $rateProduct = filter_input(INPUT_POST, 'rateProduct', FILTER_VALIDATE_INT, ["options" => ["min_range" => 0, "max_range" => 5]]);
      $brandProduct = filter_input(INPUT_POST, 'brandProduct', FILTER_VALIDATE_INT);
      $categoryProduct = filter_input(INPUT_POST, 'categoryProduct', FILTER_VALIDATE_INT);
      $typeProduct = filter_input(INPUT_POST, 'typeProduct', FILTER_VALIDATE_INT);

      // Instanciation de mon modèle Product
      $newProductModel = new Product();

      //=================ATTRIBUTION DES VALEURS DU FORMULAIRE VIA MES SETTERS==============*/
      $newProductModel->setName($nameProduct);
      $newProductModel->setDescription($descriptionProduct);
      $newProductModel->setPicture($pictureProduct);
      $newProductModel->setPrice($priceProduct);
      $newProductModel->setRate($rateProduct);
      $newProductModel->setBrandId($brandProduct);
      $newProductModel->setCategoryId($categoryProduct);
      $newProductModel->setTypeId($typeProduct);
      // dd($newProductModel);

      // Appel de ma méthod insert() pour ajouter mon nouveau produit
      $newProductModel->insert();

      //===================REORIENTATION VERS LA PAGE product/list=========================*/

      header('Location:list');
      exit();
    }   
}
