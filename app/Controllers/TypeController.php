<?php

  namespace App\Controllers;

  use App\Controllers\CoreController;
  use App\Models\Type;

  class TypeController extends CoreController
  {

    /**
     * Method to display types list
     *
     * @return void 
     */
    public function list()
    {

      // Class::method grâce à static qui ne lie plus la méthode à l'instance
      $listModel = Type::findAll();

      /* confort -> ainsi on appelle pas $viewVars mais $typeList (grâce au extract le nom de notre variable dans notre view sera typeList) + explicite */
      $typeList['typeList'] = $listModel;
      $typeList['titrePage'] = 'Liste des types';


      $this->show('type/list', $typeList);
    }

    /**
     * Ajout d'une type
     *
     * @return void
     */
    public function add()
    {

      $typeData['titrePage'] = 'Ajouter une type';

      $this->show('type/add', $typeData);
    }

    /**
     * Création d'une type
     * 
     * @return void
     */
    public function create()
    {

      $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);

      // je dois créer un nouveau model et lui donner les infos
      $newType = new Type();
      $newType->setName($name);

      // je dois inserer mon model en base
      $newType->insert();

      global $router;
      header('Location: ' . $router->generate('type-list'));
      exit();
    }

    /**
     * method data's form
     * 
     * @return void
     */
    public function update($routeInfo) {

      // je récupère toutes les données de ma type selon son id contenu dans $routeInfo
      $typeModel = Type::find($routeInfo);
      // je stocke les information de la type selectionnait par l'admin
      $typeData['type'] = $typeModel;
      $typeData['titrePage'] = 'Modifier une type';

      // dump($typeData);

      $this->show('type/update', $typeData);
    }

    /**
     * Modifier une type
     * 
     * @return void
     */
    public function edit($routeInfo) {

      $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);

      // dump($name);

      $editType = new Type();
      // modification des propriétés liées à l'instance
      // affectation des données du formulaire
      $editType->setName($name);

      $editType->update($routeInfo);

      global $router;
      header('Location: ' . $router->generate('type-update', ['typeId' => $routeInfo]));
      exit();
    }

    /**
     * Method to delete row of type table
     *
     * @param [type] $routeInfo
     * @return void
     */
    public function delete($routeInfo) {

      Type::delete($routeInfo);

      global $router;
      header('Location: ' .$router->generate('type-list'));
      exit();
    }
  }
