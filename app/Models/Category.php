<?php

  namespace App\Models;

  use App\Utils\Database;
  use PDO;

  class Category extends CoreModel
  {

    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $subtitle;
    /**
     * @var string
     */
    private $picture;
    /**
     * @var int
     */
    private $home_order;

    /**
     * Get the value of name
     *
     * @return  string
     */
    public function getName()
    {
      return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param  string  $name
     */
    public function setName(string $name)
    {
      $this->name = $name;
    }

    /**
     * Get the value of subtitle
     */
    public function getSubtitle()
    {
      return $this->subtitle;
    }

    /**
     * Set the value of subtitle
     */
    public function setSubtitle($subtitle)
    {
      $this->subtitle = $subtitle;
    }

    /**
     * Get the value of picture
     */
    public function getPicture()
    {
      return $this->picture;
    }

    /**
     * Set the value of picture
     */
    public function setPicture($picture)
    {
      $this->picture = $picture;
    }

    /**
     * Get the value of home_order
     */
    public function getHomeOrder()
    {
      return $this->home_order;
    }

    /**
     * Set the value of home_order
     */
    public function setHomeOrder($home_order)
    {
      $this->home_order = $home_order;
    }

    /**
     * Méthode permettant de récupérer un enregistrement de la table Category en fonction d'un id donné
     * 
     * @param int $categoryId ID de la catégorie
     * @return Category
     */
    public static function find(int $id)
    {
      // se connecter à la BDD
      $pdo = Database::getPDO();

      // écrire notre requête
      $sql = 'SELECT * FROM `category` WHERE `id` =' . $id;

      // exécuter notre requête
      $pdoStatement = $pdo->query($sql);

      // un seul résultat => fetchObject
      $category = $pdoStatement->fetchObject('App\Models\Category');

      // retourner le résultat
      return $category;
    }

    /**
     * Méthode permettant de récupérer tous les enregistrements de la table category
     * 
     * @return Category[]
     */
    public static function findAll()
    {
      $pdo = Database::getPDO();
      $sql = 'SELECT * FROM `category`';
      $pdoStatement = $pdo->query($sql);
      $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Category');

      return $results;
    }

    /**
     * Récupérer les 5 catégories mises en avant sur la home
     * 
     * @return Category[]
     */
    public static function findAllHomePage()
    {
        $pdo = Database::getPDO();
        $sql = '
            SELECT *
            FROM category
            WHERE home_order > 0
            ORDER BY home_order ASC
        ';
        $pdoStatement = $pdo->query($sql);
        $categories = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Category');
        
        return $categories;
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

      /* HELP FROM ADMINER
          INSERT INTO `category` 
          (`name`,
          `subtitle`,
          `picture`,
          `home_order`,
          `created_at`,
          `updated_at`)
          VALUES (
              'JB',
              'JB',
              'JB',
              0, -- valeur par défaut
              now(), -- valeur par défaut
              NULL); -- champs nullable
          */

      // Ecriture de la requête INSERT INTO
      // Comme c'est une requete SENSIBLE, on va la préparer avec des placeholders
      $sql = "INSERT INTO `category` 
          (
          `name`,
          `subtitle`,
          `picture`
          )
          VALUES (
              :name,
              :subtitle,
              :picture
              );
          ";

      // PDO prend connaissance des placeholder
      // et nous donne un PDOStatement pour y affecter les valeurs
      $pdoStatement = $pdo->prepare($sql);

      // On affecte les valeurs à leur placeholder respectifs
      $pdoStatement->bindValue(':name', $this->name, PDO::PARAM_STR);
      $pdoStatement->bindValue(':subtitle', $this->subtitle, PDO::PARAM_STR);
      $pdoStatement->bindValue(':picture', $this->picture, PDO::PARAM_STR);

      // Execution de la requête d'insertion (exec, pas query)
      // $insertedRows = $pdo->exec($sql);

      // On execute la requete, on reçoit VRAI si tout c'est bien passés
      $insertedRow = $pdoStatement->execute();

      // VRAI si la requete a réussi
      return $insertedRow;
    }

    /**
     * Méthode permettant de mettre à jour un enregistrement dans la table category
     * L'objet courant doit contenir l'id, et toutes les données à ajouter : 1 propriété => 1 colonne dans la table
     * 
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
              name = :name,
              subtitle = :subtitle,
              picture = :picture,
              updated_at = NOW()
          WHERE id = :id
      ";

      // PDO prend connaissance des placeholder
      // et nous donne un PDOStatement pour y affecter les valeurs
      $pdoStatement = $pdo->prepare($sql);

      // On affecte les valeurs à leur placeholder respectifs
      $pdoStatement->bindValue(':name', $this->name, PDO::PARAM_STR);
      $pdoStatement->bindValue(':subtitle', $this->subtitle, PDO::PARAM_STR);
      $pdoStatement->bindValue(':picture', $this->picture, PDO::PARAM_STR);
      $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);

      $updatedRows = $pdoStatement->execute();

      // retourne vrai si la requête
      return $updatedRows;
    }

    /**
     * Méthode permettant de supprimer une ligne de la table category
     * 
     * @return bool
     */
    public static function delete(int $id)
    {
      // Récupération de l'objet PDO représentant la connexion à la DB
      $pdo = Database::getPDO();

      // Ecriture de la requête DELETE
      $sql = "
              DELETE FROM category
              WHERE id = :id
          ";
      
      $pdoStatement = $pdo->prepare($sql);
      $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);

      // Execution de la requête de mise à jour (exec, pas query)
      $deleteRow = $pdoStatement->execute();

      return $deleteRow;
    }
  }
