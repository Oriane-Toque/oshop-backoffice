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

  /**
   * Vérifie qu'il n'y a pas de doublons dans un tableau
   * Transforme les valeurs du tableau en clé
   * Pour compter un tableau il faut que toutes les clés soient uniques
   * Donc si une valeur est identique a une autre ca renvoie false
   * Si aucun doublon ca renvoie true !
   *
   * @param [type] $positions
   * @return boolean
   */
  protected function hasDupes(array $positions) {
    
    return count($positions) === count(array_flip($positions));
  }
}
