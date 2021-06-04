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
    $listCategoryModel = Category::findAllHomepage();

    /* confort -> ainsi on appelle pas $viewVars mais $categoryList (grâce au extract le nom de notre variable dans notre view sera categoryList) + explicite */
    $homeList['categoryList'] = $listCategoryModel;
    $homeList['titrePage'] = 'Home';

    $this->show('main/home', $homeList);
  }
}
