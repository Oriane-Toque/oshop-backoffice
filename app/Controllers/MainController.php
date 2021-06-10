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
    $positions = $_POST['emplacement'];

    // dd($positions);

    $homeList = Category::findAllHomePage();

    $homeList[0]->setHomeOrder($positions[0]);
    $homeList[1]->setHomeOrder($positions[1]);
    $homeList[2]->setHomeOrder($positions[2]);
    $homeList[3]->setHomeOrder($positions[3]);
    $homeList[4]->setHomeOrder($positions[4]);
    // dd($homeList);

    // dd($homeList[0]->getId());
    
    $homeList[0]->updateHomeOrder($homeList[0]->getId());
    $homeList[1]->updateHomeOrder($homeList[1]->getId());
    $homeList[2]->updateHomeOrder($homeList[2]->getId());
    $homeList[3]->updateHomeOrder($homeList[3]->getId());
    $homeList[4]->updateHomeOrder($homeList[4]->getId());
    
    global $router;
    header('Location:'.$router->generate('main-home'));
    exit();
  }
}
