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
     * Ajout d'un produit.
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

    public function create()
    {
      // je dois récuperer les données dans $_POST
      // 1ere solution : $name = $_POST['name']
      // 2eme solution : $name = filter_input(INPUT_POST, 'name');
      // 3eme solution : $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
      $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
      $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
      $picture = filter_input(INPUT_POST, 'picture', FILTER_SANITIZE_STRING);
      $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
      $rate = filter_input(INPUT_POST, 'rate', FILTER_VALIDATE_INT);
      $status = filter_input(INPUT_POST, 'status', FILTER_VALIDATE_INT);
      $category_id = filter_input(INPUT_POST, 'category', FILTER_VALIDATE_INT);
      //var_dump($_POST['brand']);
      $brand_id = filter_input(INPUT_POST, 'brand', FILTER_VALIDATE_INT);
      $type_id = filter_input(INPUT_POST, 'type', FILTER_VALIDATE_INT);

      // je creer un nouveau Model
      $nouveauProduit = new Product();
      $nouveauProduit->setName($name);
      $nouveauProduit->setDescription($description);
      $nouveauProduit->setPicture($picture);
      $nouveauProduit->setPrice($price);
      $nouveauProduit->setRate($rate);
      $nouveauProduit->setStatus($status);
      $nouveauProduit->setCategoryId($category_id);
      // var_dump($brand_id)
      $nouveauProduit->setBrandId($brand_id);
      $nouveauProduit->setTypeId($type_id);

      // on insere en base de données
      $nouveauProduit->insert();

      // redirige sur le HOME
      // header('Location: /');
      // utilise le routeur, mais utiliser aussi global :'(
      global $router;
      header('Location: ' . $router->generate('product-list'));
    }
  }
