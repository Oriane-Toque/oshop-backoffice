<?php

  namespace App\Controllers;

  use App\Controllers\CoreController;
  use App\Models\Brand;

  class BrandController extends CoreController
  {

    /**
     * Method to display brands list
     *
     * @return void 
     */
    public function list()
    {
      $rolesRequis[] = 'catalog-manager';

      $this->checkAuthorization($rolesRequis);
      // Class::method grâce à static qui ne lie plus la méthode à l'instance
      $listModel = Brand::findAll();

      /* confort -> ainsi on appelle pas $viewVars mais $brandList (grâce au extract le nom de notre variable dans notre view sera brandList) + explicite */
      $brandList['brandList'] = $listModel;
      $brandList['titrePage'] = 'Liste des marques';


      $this->show('brand/list', $brandList);
    }

    /**
     * Ajout d'une marque
     *
     * @return void
     */
    public function add()
    {
      $rolesRequis[] = 'catalog-manager';

      $this->checkAuthorization($rolesRequis);
      
      $brandData['titrePage'] = 'Ajouter une marque';

      $this->show('brand/add', $brandData);
    }

    /**
     * Création d'une marque
     * 
     * @return void
     */
    public function create()
    {
      $rolesRequis[] = 'catalog-manager';

      $this->checkAuthorization($rolesRequis);

      $errors = [];

      if (isset($_POST)) {
        $name = filter_input(INPUT_POST, 'name',FILTER_SANITIZE_STRING);
      }

      if(empty($name) || is_numeric($name) || is_numeric($name[0])) {
        $errors['name'] = "Ce n'est pas un nom valide";
      }

      if(!empty($errors)) {
        $this->show('brand/add', $errors);
      } else {

        // je dois créer un nouveau model et lui donner les infos
        $newBrand = new Brand();
        $newBrand->setName($name);

        // je dois inserer mon model en base
        $newBrand->insert();

        global $router;
        header('Location: ' . $router->generate('brand-list'));
        exit();
      }
    }

    /**
     * method data's form
     * 
     * @return void
     */
    public function update(int $routeInfo) {

      $rolesRequis[] = 'catalog-manager';

      $this->checkAuthorization($rolesRequis);

      // je récupère toutes les données de ma marque selon son id contenu dans $routeInfo
      $brandModel = Brand::find($routeInfo);
      // je stocke les information de la marque selectionnait par l'admin
      $brandData['brand'] = $brandModel;
      $brandData['titrePage'] = 'Modifier une marque';

      // dump($brandData);

      $this->show('brand/update', $brandData);
    }

    /**
     * Modifier une marque
     * 
     * @return void
     */
    public function edit(int $routeInfo) {

      $rolesRequis[] = 'catalog-manager';

      $this->checkAuthorization($rolesRequis);

      $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);

      // dump($name);

      $editBrand = Brand::find($routeInfo);
      // modification des propriétés liées à l'instance
      // affectation des données du formulaire
      $editBrand->setName($name);

      $editBrand->update($routeInfo);

      global $router;
      header('Location: ' . $router->generate('brand-update', ['brandId' => $routeInfo]));
      exit();
    }

    /**
     * Method to delete row of brand table
     *
     * @param [type] $routeInfo
     * @return void
     */
    public function delete(int $routeInfo) {

      $rolesRequis[] = 'catalog-manager';

      $this->checkAuthorization($rolesRequis);

      Brand::delete($routeInfo);

      global $router;
      header('Location: ' .$router->generate('brand-list'));
      exit();
    }
  }
