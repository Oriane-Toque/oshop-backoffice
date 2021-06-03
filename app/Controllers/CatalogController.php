<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\Product;

class CatalogController extends CoreController {

    /**
     * Méthode s'occupant de la page d'accueil
     *
     * @return void
     */
    public function categories()
    {

        $categoryModel = new Category();
        $allCategories = $categoryModel->findAll();

        $viewVars['categories'] = $allCategories;
        extract($viewVars);



        $this->show('category/categories', $viewVars);
    }

    public function categoryAdd()
    {

        $this->show('category/category_add');
    }

    public function products()
    {
        $productModel = new Product();
        $allProducts = $productModel->findAll();

        $viewVars['products'] = $allProducts;
        extract($viewVars);

        $this->show('product/products', $viewVars);
    }

    public function productAdd()
    {
        $this->show('product/product_add');
    }

}