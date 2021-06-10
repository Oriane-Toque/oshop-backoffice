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
     * Ajout d'un produit
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
     * Ajoute le nouveau produit à la BDD
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
      $newProduct = new Product();
      $newProduct->setName($name);
      $newProduct->setDescription($description);
      $newProduct->setPicture($picture);
      $newProduct->setPrice($price);
      $newProduct->setRate($rate);
      $newProduct->setStatus($status);
      $newProduct->setCategoryId($category_id);
      // var_dump($brand_id)
      $newProduct->setBrandId($brand_id);
      $newProduct->setTypeId($type_id);

      // on insere en base de données
      $newProduct->insert();

      // redirige sur le HOME
      // header('Location: /');
      // utilise le routeur, mais utiliser aussi global :'(
      global $router;
      header('Location: ' . $router->generate('product-list'));
    }

    public function update(int $routeInfo)
    {

      // récupération des données du produit sélectionné
      $productModel = Product::find($routeInfo);

      // pour la dynamisation des selects
      // liste des marques, catégories et types
      $brandModel = Brand::findAll();
      $categoryModel = Category::findAll();
      $typeModel = Type::findAll();

      // stockage de nos données dans un tableau dont les clés seront nos variables
      $productData['product'] = $productModel;
      $productData['brandList'] = $brandModel;
      $productData['categoryList'] = $categoryModel;
      $productData['typeList'] = $typeModel;
      $productData['titrePage'] = 'Modifier un produit';

      // dump($productData);

      $this->show('product/update', $productData);
    }

    public function edit(int $routeInfo)
    {      

      // récupération des valeurs du formulaire
      $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
      $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
      $picture = filter_input(INPUT_POST, 'picture', FILTER_VALIDATE_URL);
      $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
      $rate = filter_input(INPUT_POST, 'rate', FILTER_VALIDATE_INT);
      $status = filter_input(INPUT_POST, 'status', FILTER_VALIDATE_INT);
      $category_id = filter_input(INPUT_POST, 'category', FILTER_VALIDATE_INT);
      $brand_id = filter_input(INPUT_POST, 'brand', FILTER_VALIDATE_INT);
      $type_id = filter_input(INPUT_POST, 'type', FILTER_VALIDATE_INT);

      // instanciation de notre model Product
      $editProduct = Product::find($routeInfo);
      // modification des propriétés de l'instanciation
      $editProduct->setName($name);
      $editProduct->setDescription($description);
      $editProduct->setPicture($picture);
      $editProduct->setPrice($price);
      $editProduct->setRate($rate);
      $editProduct->setStatus($status);
      $editProduct->setCategoryId($category_id);
      $editProduct->setBrandId($brand_id);
      $editProduct->setTypeId($type_id);

      $editProduct->update($routeInfo);

      global $router;
      header('Location: ' .$router->generate('product-update', ['productId' => $routeInfo]));
      exit();
    }

    /**
     * Method to delete row of product table
     *
     * @param [type] $routeInfo
     * @return void
     */
    public function delete(int $routeInfo) {

      Product::delete($routeInfo);

      global $router;
      header('Location: ' .$router->generate('product-list'));
      exit();
    }
  }
