<?php

  namespace App\Controllers;

  use App\Controllers\CoreController;

  class AppUserController extends CoreController {

    public function login() {

      $this->show('user/log.in');
    }

    public function connection() {

      /* Récupération des données du formulaire de connexion */
      $login = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
      $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

      // dump($login);
      // dump($password);

    }
  }