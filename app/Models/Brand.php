<?php

  namespace App\Models;

  use App\Utils\Database;
  use PDO;

  /**
   * Un modèle représente une table (un entité) dans notre base
   * 
   * Un objet issu de cette classe réprésente un enregistrement dans cette table
   */
  class Brand extends CoreModel
  {
    // Les propriétés représentent les champs
    // Attention il faut que les propriétés aient le même nom (précisément) que les colonnes de la table

    /**
     * @var string
     */
    private $name;
    /**
     * @var int
     */
    private $footer_order;

    /**
     * Méthode permettant de récupérer un enregistrement de la table Brand en fonction d'un id donné
     * 
     * @param int $brandId ID de la marque
     * @return Brand
     */
    public static function find($brandId)
    {
      // se connecter à la BDD
      $pdo = Database::getPDO();

      // écrire notre requête
      $sql = '
              SELECT *
              FROM brand
              WHERE id = ' . $brandId;

      // exécuter notre requête
      $pdoStatement = $pdo->query($sql);

      // un seul résultat => fetchObject
      $brand = $pdoStatement->fetchObject('App\Models\Brand');

      // retourner le résultat
      return $brand;
    }

    /**
     * Méthode permettant de récupérer tous les enregistrements de la table brand
     * 
     * @return Brand[]
     */
    public static function findAll()
    {
      $pdo = Database::getPDO();
      $sql = 'SELECT * FROM `brand`';
      $pdoStatement = $pdo->query($sql);
      $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Brand');

      return $results;
    }

    /**
     * Récupérer les 5 marques mises en avant dans le footer
     * 
     * @return Brand[]
     */
    public static function findAllFooter()
    {
      $pdo = Database::getPDO();
      $sql = '
              SELECT *
              FROM brand
              WHERE footer_order > 0
              ORDER BY footer_order ASC
          ';
      $pdoStatement = $pdo->query($sql);
      $brands = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Brand');

      return $brands;
    }

    /**
     * Méthode permettant d'ajouter un enregistrement dans la table brand
     * L'objet courant doit contenir toutes les données à ajouter : 1 propriété => 1 colonne dans la table
     * 
     * @return bool
     */
    public function insert()
    {
      // Récupération de l'objet PDO représentant la connexion à la DB
      $pdo = Database::getPDO();

      // Ecriture de la requête INSERT INTO
      $sql = "
              INSERT INTO `brand` (name)
              VALUES (:name)
          ";
      
      $pdoStatement = $pdo->prepare($sql);

      $pdoStatement->bindValue(':name', $this->name, PDO::PARAM_STR);

      // Execution de la requête d'insertion (exec, pas query)
      $insertedRows = $pdoStatement->execute();

      return $insertedRows;
    }

    /**
     * Méthode permettant de mettre à jour un enregistrement dans la table brand
     * L'objet courant doit contenir l'id, et toutes les données à ajouter : 1 propriété => 1 colonne dans la table
     * 
     * @return bool
     */
    public function update($id)
    {
      // Récupération de l'objet PDO représentant la connexion à la DB
      $pdo = Database::getPDO();

      // Ecriture de la requête UPDATE
      $sql = "
              UPDATE `brand`
              SET
                  name = :name,
                  updated_at = NOW()
              WHERE id = :id
          ";
      
      $pdoStatement = $pdo->prepare($sql);

      $pdoStatement->bindValue(':name', $this->name, PDO::PARAM_STR);
      $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);

      // Execution de la requête de mise à jour (exec, pas query)
      $updatedRows = $pdoStatement->execute();

      return $updatedRows;
    }

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
     * Get the value of footer_order
     *
     * @return  int
     */
    public function getFooterOrder()
    {
      return $this->footer_order;
    }

    /**
     * Set the value of footer_order
     *
     * @param  int  $footer_order
     */
    public function setFooterOrder(int $footer_order)
    {
      $this->footer_order = $footer_order;
    }
  }
