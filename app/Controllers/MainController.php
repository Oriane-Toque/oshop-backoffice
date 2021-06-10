<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\Product;

// Si j'ai besoin du Model Category
// use App\Models\Category;

class MainController extends CoreController
{

  /**
   * Méthode s'occupant de la page d'accueil
   *
   * @return void
   */
  public function home()
  {

    // Class::method grâce à static qui ne lie plus la méthode à l'instance
    $listCategoryModel = Category::findAllHomePage();

    // On récupère tous les produits de la home
    $listProductModel = Product::findAllHomePage();

    /* confort -> ainsi on appelle pas $viewVars mais $categoryList (grâce au extract le nom de notre variable dans notre view sera categoryList) + explicite */
    $homeList['categoryList'] = $listCategoryModel;
    $homeList['productList'] = $listProductModel;
    $homeList['titrePage'] = 'Home';

    $this->show('main/home', $homeList);
  }

  public function update() {
    
    // dd($_POST);
    $position1 = filter_input(INPUT_POST, 'emplacement1', FILTER_VALIDATE_INT);
    $position2 = filter_input(INPUT_POST, 'emplacement2', FILTER_VALIDATE_INT);
    $position3 = filter_input(INPUT_POST, 'emplacement3', FILTER_VALIDATE_INT);
    $position4 = filter_input(INPUT_POST, 'emplacement4', FILTER_VALIDATE_INT);
    $position5 = filter_input(INPUT_POST, 'emplacement5', FILTER_VALIDATE_INT);

    // dd($position1);
  }
}
