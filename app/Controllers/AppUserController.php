<?php

  namespace App\Controllers;

  use App\Controllers\CoreController;
  use App\Models\AppUser;

class AppUserController extends CoreController {

    public function login() {

      $this->show('user/log.in');
    }

    public function connection() {

      /* Récupération des données du formulaire de connexion */
      $login = filter_input(INPUT_POST, 'email');
      $password = filter_input(INPUT_POST, 'password');

      // dump($login);
      // dump($password);

      if(!empty($login)) {

        $userModel = AppUser::findByEmail($login);
        
        if($userModel->getPassword() === $password) {
          echo '<h1>Connection réussi</h1>';
        } else {
          echo '<h1>Mot de passe incorrect</h1>';
        }
        // dump($userModel);

      } else {
        // dump(false);
        echo '<h1>Email inconnu</h1>';
        return false;
      }

    }
  }