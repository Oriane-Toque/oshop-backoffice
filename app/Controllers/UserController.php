<?php

  namespace App\Controllers;

  use App\Controllers\CoreController;

  class UserController extends CoreController {

    public function login() {

      $this->show('user/log.in');
    }
  }