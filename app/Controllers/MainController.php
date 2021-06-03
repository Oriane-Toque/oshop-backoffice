<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\Product;


// Si j'ai besoin du Model Category
// use App\Models\Category;

class MainController extends CoreController {

    /**
     * Méthode s'occupant de la page d'accueil
     *
     * @return void
     */
    public function home()
    {


        $categoryModel = new Category();
        $allCategories = $categoryModel->findFiveCategories();
        $viewVars['categories'] = $allCategories;


        $productModel = new Product();
        $allProducts = $productModel->findFiveProducts();

        $viewVars['products'] = $allProducts;
        extract($viewVars);

        $this->show('main/home', $viewVars);
    }
}