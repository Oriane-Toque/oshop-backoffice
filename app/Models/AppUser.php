<?php

  namespace App\Models;

  use App\Utils\Database;
  use PDO;

  class AppUser extends CoreModel
  {

    /**
     *
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $password;
    /**
     * @var string
     */
    private $firstname;
    /**
     * @var string
     */
    private $lastname;
    /**
     * @var void
     */
    private $role;
    /**
     * @var int
     */
    private $status;

    /**
     * Retourne les données d'un utilisateur
     *
     * @param integer $id id's user
     * @return AppUser
     */
    public static function find(int $id)
    {

      $pdo = Database::getPDO();

      // écrire notre requête
      $sql = 'SELECT * FROM `app_user` WHERE `id` =' . $id;

      // exécuter notre requête
      $pdoStatement = $pdo->query($sql);

      // un seul résultat => fetchObject
      $appUser = $pdoStatement->fetchObject('App\Models\AppUser');

      // retourner le résultat
      return $appUser;
    }

    /**
     * Retourne toutes les données de tous les utilisateurs
     *
     * @return AppUser[]
     */
    public static function findAll()
    {

      $pdo = Database::getPDO();

      $sql = 'SELECT * FROM `app_user`';

      $pdoStatement = $pdo->query($sql);

      $appUsers = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\AppUser');

      return $appUsers;
    }

    public static function findByEmail($email)
    {

      // se connecter à la BDD
      $pdo = Database::getPDO();

      // écrire notre requête
      //? attention aux emojis :email: :D
      $sql = 'SELECT * FROM `app_user` WHERE `email` = :email';

      // exécuter notre requête
      $pdoStatement = $pdo->prepare($sql);

      $pdoStatement->bindValue(':email', $email, PDO::PARAM_STR);
      // $pdoStatement->bindParam(':email', $email, PDO::PARAM_STR);

      // VRAI si la requete c'est bien passé
      $requeteOk = $pdoStatement->execute();

      if ($requeteOk) {
        // un seul résultat => fetchObject
        // Créer moi un objet à partir du résultat de la requete
        // que tu as précedement execute()
        $user = $pdoStatement->fetchObject('App\Models\AppUser');
        // retourner le résultat
        return $user;
      } else {
        return false;
      }
    }

    /**
     * méthode d'insertion en base de données
     * 
     * @return bool
     */
    public function insert()
    {

      // Récupération de l'objet PDO représentant la connexion à la DB
      $pdo = Database::getPDO();

      // Ecriture de la requête INSERT INTO
      // Comme c'est une requete SENSIBLE, on va la préparer avec des placeholders
      $sql = "INSERT INTO `app_user` 
            (
            `email`,
            `password`,
            `firstname`,
            `lastname`,
            `role`,
            `status`
            )
            VALUES (
                :email,
                :password,
                :firstname,
                :lastname,
                :role,
                :status
                );
            ";

      // PDO prend connaissance des placeholder
      // et nous donne un PDOStatement pour y affecter les valeurs
      $pdoStatement = $pdo->prepare($sql);

      // On affecte les valeurs à leur placeholder respectifs
      $pdoStatement->bindValue(':email', $this->email, PDO::PARAM_STR);
      $pdoStatement->bindValue(':password', $this->password, PDO::PARAM_STR);
      $pdoStatement->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
      $pdoStatement->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
      $pdoStatement->bindValue(':role', $this->role, PDO::PARAM_STR);
      $pdoStatement->bindValue(':status', $this->status, PDO::PARAM_INT);

      // On execute la requete, on reçoit VRAI si tout c'est bien passés
      $insertedUser = $pdoStatement->execute();

      // VRAI si la requete a réussi
      return $insertedUser;
    }

    /**
     * Méthode permettant de mettre à jour un enregistrement dans la table app_user
     *
     * @param integer $id id's user
     * @return bool
     */
    public function update(int $id)
    {
      // Récupération de l'objet PDO représentant la connexion à la DB
      $pdo = Database::getPDO();

      // Ecriture de la requête UPDATE
      $sql = "
              UPDATE `category`
              SET
                  email = :email,
                  password = :password,
                  firstname = :firstname,
                  lastname = :lastname,
                  role = :role,
                  status = :status,
                  updated_at = NOW()
              WHERE id = :id
          ";

      // PDO prend connaissance des placeholder
      // et nous donne un PDOStatement pour y affecter les valeurs
      $pdoStatement = $pdo->prepare($sql);

      // On affecte les valeurs à leur placeholder respectifs
      $pdoStatement->bindValue(':email', $this->email, PDO::PARAM_STR);
      $pdoStatement->bindValue(':password', $this->password, PDO::PARAM_STR);
      $pdoStatement->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
      $pdoStatement->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
      $pdoStatement->bindValue(':role', $this->role, PDO::PARAM_STR);
      $pdoStatement->bindValue(':status', $this->status, PDO::PARAM_INT);
      $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);

      $updatedUser = $pdoStatement->execute();

      // retourne vrai si la requête
      return $updatedUser;
    }

    /**
     * Méthode permettant de supprimer un utilisateur
     * 
     * @param integer $id id's user
     * @return bool
     */
    public static function delete(int $id)
    {
      // Récupération de l'objet PDO représentant la connexion à la DB
      $pdo = Database::getPDO();

      // Ecriture de la requête DELETE
      $sql = "
                DELETE FROM app_user
                WHERE id = :id
            ";

      $pdoStatement = $pdo->prepare($sql);

      $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);

      // Execution de la requête de mise à jour (exec, pas query)
      $deleteUser = $pdoStatement->execute();

      return $deleteUser;
    }

    /**
     * Get the value of email
     *
     * @return  string
     */
    public function getEmail()
    {
      return $this->email;
    }

    /**
     * Set the value of email
     *
     * @param  string  $email
     *
     * @return  self
     */
    public function setEmail(string $email)
    {
      $this->email = $email;

      return $this;
    }

    /**
     * Get the value of password
     *
     * @return  string
     */
    public function getPassword()
    {
      return $this->password;
    }

    /**
     * Set the value of password
     *
     * @param  string  $password
     *
     * @return  self
     */
    public function setPassword(string $password)
    {
      $this->password = $password;

      return $this;
    }

    /**
     * Get the value of firstname
     */
    public function getFirstname()
    {
      return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */
    public function setFirstname($firstname)
    {
      $this->firstname = $firstname;

      return $this;
    }

    /**
     * Get the value of lastname
     */
    public function getLastname()
    {
      return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @return  self
     */
    public function setLastname($lastname)
    {
      $this->lastname = $lastname;

      return $this;
    }

    /**
     * Get the value of role
     *
     * @return  void
     */
    public function getRole()
    {
      return $this->role;
    }

    /**
     * Set the value of role
     *
     * @param  void  $role
     *
     * @return  self
     */
    public function setRole($role)
    {
      $this->role = $role;

      return $this;
    }

    /**
     * Get the value of status
     *
     * @return  int
     */
    public function getStatus()
    {
      return $this->status;
    }

    /**
     * Set the value of status
     *
     * @param  int  $status
     *
     * @return  self
     */
    public function setStatus(int $status)
    {
      $this->status = $status;

      return $this;
    }
  }
