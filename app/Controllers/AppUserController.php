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
      // méthode avec la navigation, à revoir
      $this->show('user/login');
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
     * Ajout d'une marque
     *
     * @return void
     */
    public function add()
    {

      $this->checkAuthorization();
      
      $userData['titrePage'] = 'Ajouter un utilisateur';

      $this->show('user/add', $userData);
    }
  }
