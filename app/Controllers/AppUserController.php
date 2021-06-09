<?php

  namespace App\Controllers;

  use App\Controllers\CoreController;
  use App\Models\AppUser;

  class AppUserController extends CoreController
  {

    /**
     * Affichage du formulaire de connexion
     */
    public function login()
    {
      // pour ne pas avoir la navigation
      // mais il va manquer le header :'(
      /*
          require_once __DIR__.'/../views/user/login.tpl.php';
          require_once __DIR__.'/../views/layout/footer.tpl.php';
          */
      $loginData['titrePage'] = 'Connexion';

      // méthode avec la navigation, à revoir
      $this->show('user/login', $loginData);
    }

    /**
     * Connecte l'utilisateur en allant dans la Base de donnée
     * pour vérifier le mot de passe 
     */
    public function connect()
    {
      // récupérer les infos de $_POST
      $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
      //? le mot de passe est en clair !
      $passwordFormulaire = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

      // on va utiliser les outils de PHP : password_hash($passw0rd, PASSWORD_DEFAULT);
      // quand on va vouloir créer un utilisateur , plus tard
      // $passwordFormulaireHash = password_hash($passwordFormulaire, PASSWORD_DEFAULT);

      if (empty($email)) {
        // l'utilisateur n'a pas remplit le formulaire
        // qu'est qu'il essaye de faire ?????
        // TODO le renvoyer sur la page de connexion
        // pas de header()
        $this->show('user/login');
        exit();
      }

      // Aller en base de donnée pour rechercher l'utilisateur par son email
      // BDD => MODEL => SQL
      $retourBdd = AppUser::findByEmail($email);

      if ($retourBdd === false) {
        // la requete qui a eu un problème !
        // TODO le renvoyer sur la page de connexion
        $this->show('user/login');
        exit();
      }

      // Pour ma comprehénsion je "renomme" la variable $retourBdd en $user
      $user = $retourBdd;

      // vérifier le mot de passe entre la base de donnée et les infos de $_POST
      //? le mot de passe est 'hashé'
      $passwordFromBddHash = $user->getPassword();

      // au départ on a comparé les valeurs en clair
      // if ($passwordFormulaire === $passwordFromBdd)

      // PHP nous propose un outils pour valider
      // un mot de passe avec la version hashé de la base
      // sans avoir besoin de le hashé avant
      if (password_verify($passwordFormulaire, $passwordFromBddHash)) {
        // on affiche le message OK
        //? Attention au nommage des propriétés de notre objet User
        //? PDO va nous donner les valeurs de la BDD dans des propriétés du même nom que les colones
        //? attention donc à la casse !
        //dd($user);
        $tableauDeVariable["messageConnexion"] = "Bienvenue " . $user->getFirstname() . " " . $user->getLastname();

        // je mets l'objet utilisateur en session pour l'avoir sur toute mon application
        // et le reconnaitre de page en page.

        $_SESSION['userObject'] = $user;

      } else {
        // on affiche KO
        $tableauDeVariable["messageConnexion"] = "Deuxième essai ??";
      }

      // modifier l'affichage : OK / KO
      // affichage temporaire pour tester la route
      $this->show('user/connect', $tableauDeVariable);
    }

    /**
     * Déconnexion de l'utilisateur
     */
    public function logout()
    {
      // on récupère le router
      global $router;

      // Dans notre application, déconnecter l'utilisateur veut dire supprimer ses données en session
      // Pour supprimer des données (une variable ou la clé d'un array) en PHP, on utilise unset()
      unset($_SESSION['userObject']);

      // une fois déconnecté, on redirige l'utilisateur vers la page de connexion
      // on utilise le routeur pour générer le chemin vers la page de connexion
      $homepageUrl = $router->generate('user-login');
      // un petit coup de header() pour demander au navigateur de faire la redirection
      header('Location: ' . $homepageUrl);
    }

    public function list() {

      $this->checkAuthorization();

      $usersModel = AppUser::findAll();

      $usersList['usersList'] = $usersModel;
      $usersList['titrePage'] = 'Liste Utilisateurs';

      $this->show('user/list', $usersList);
    }

    /**
     * Ajout d'un utilisateur
     *
     * @return void
     */
    public function add()
    {

      $this->checkAuthorization();
      
      $userData['titrePage'] = 'Ajouter un utilisateur';

      $this->show('user/add', $userData);
    }

    /**
     * Traitement de l'ajout + insertion bdd
     *
     * @return void
     */
    public function create()
    {

      $this->checkAuthorization();

      $errors = [];

      if(isset($_POST)) {
        
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
        $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
        $role = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_STRING);
        $status = filter_input(INPUT_POST, 'status', FILTER_VALIDATE_INT);
      }

      if(empty($email) || filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
        $errors['email'] = "Ce n'est pas une adresse mail valide";
      }
      if(!preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!.\?]{8,50}$/',$password)) {
        $errors['password'] = "Ce n'est pas un mot de passe valide";
      }
      if(empty($firstname) || is_numeric($firstname[0])) {
        $errors['firstname'] = "Ce n'est pas un prénom valide";
      }
      if(empty($lastname) || is_numeric($lastname[0])) {
        $errors['lastname'] = "Ce n'est pas un nom valide";
      }
      if(empty($role) || is_numeric($role)) {
        $errors['role'] = "Veuillez renseigner le role";
      }
      if(empty($status) || !is_numeric($status) || $status > 2 || $status < 0) {
        $errors['status'] = "Veuillez renseigner le statut";
      }

      if(!empty($errors)) {
        $this->show('user/add', $errors);
      } else {

        $newUser = new AppUser();

        $newUser->setEmail($email);
        $newUser->setPassword(password_hash($password, PASSWORD_DEFAULT));
        $newUser->setFirstname($firstname);
        $newUser->setLastname($lastname);
        $newUser->setRole($role);
        $newUser->setStatus($status);

        $newUser->insert();

        global $router;
        header('Location:'.$router->generate('user-list'));
        exit();
      }

    }

    public function update(int $routeInfo) {

      $this->checkAuthorization();

      // je récupère toutes les données de ma marque selon son id contenu dans $routeInfo
      $userModel = AppUser::find($routeInfo);
      // je stocke les information de la marque selectionnait par l'admin
      $userData['user'] = $userModel;
      $userData['titrePage'] = 'Modifier un utilisateur';

      $this->show('user/update', $userData);
    }

    public function edit(int $routeInfo) {

      $this->checkAuthorization();

      // dd($_POST);

      $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
      $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
      $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
      $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
      $role = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_STRING);
      $status = filter_input(INPUT_POST, 'status', FILTER_VALIDATE_INT);

      // dump($name);

      $editUser = AppUser::find($routeInfo);

      // modification des propriétés liées à l'instance
      // affectation des données du formulaire
      $editUser->setEmail($email);
      $editUser->setPassword(password_hash($password, PASSWORD_DEFAULT));
      $editUser->setFirstname($firstname);
      $editUser->setLastname($lastname);
      $editUser->setRole($role);
      $editUser->setStatus($status);

      // dd($editUser);

      $editUser->update($routeInfo);

      // dd($editUser);

      global $router;
      header('Location: ' . $router->generate('user-update', ['userId' => $routeInfo]));
      exit();
    }

    public function delete(int $routeInfo) {

      $this->checkAuthorization();

      AppUser::delete($routeInfo);

      global $router;
      header('Location: ' .$router->generate('user-list'));
      exit();
    }
  }
