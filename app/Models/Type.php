<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

/**
 * Un modèle représente une table (un entité) dans notre base
 * 
 * Un objet issu de cette classe réprésente un enregistrement dans cette table
 */
class Type extends CoreModel {
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
     * Méthode permettant de récupérer un enregistrement de la table Type en fonction d'un id donné
     * 
     * @param int $typeId ID du type
     * @return Type
     */
    public static function find($typeId)
    {
        // se connecter à la BDD
        $pdo = Database::getPDO();

        // écrire notre requête
        $sql = 'SELECT * FROM `type` WHERE `id` =' . $typeId;

        // exécuter notre requête
        $pdoStatement = $pdo->query($sql);

        // un seul résultat => fetchObject
        $type = $pdoStatement->fetchObject('App\Models\Type');

        // retourner le résultat
        return $type;
    }

    /**
     * Méthode permettant de récupérer tous les enregistrements de la table type
     * 
     * @return Type[]
     */
    public static function findAll()
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `type`';
        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Type');
        
        return $results;
    }

    /**
     * Récupérer les 5 types mis en avant dans le footer
     * 
     * @return Type[]
     */
    public static function findAllFooter()
    {
        $pdo = Database::getPDO();
        $sql = '
            SELECT *
            FROM type
            WHERE footer_order > 0
            ORDER BY footer_order ASC
        ';
        $pdoStatement = $pdo->query($sql);
        $types = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Type');
        
        return $types;
    }

    /**
     * Méthode permettant d'ajouter un enregistrement dans la table type
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
              INSERT INTO `type` (name)
              VALUES (:name)
          ";
      
      $pdoStatement = $pdo->prepare($sql);

      $pdoStatement->bindValue(':name', $this->name, PDO::PARAM_STR);

      // Execution de la requête d'insertion (exec, pas query)
      $insertedRows = $pdoStatement->execute();

      return $insertedRows;
    }

    /**
     * Méthode permettant de mettre à jour un enregistrement dans la table type
     * L'objet courant doit contenir l'id, et toutes les données à ajouter : 1 propriété => 1 colonne dans la table
     * 
     * @return bool
     */
    public function update()
    {
      // Récupération de l'objet PDO représentant la connexion à la DB
      $pdo = Database::getPDO();

      // Ecriture de la requête UPDATE
      $sql = "
              UPDATE `type`
              SET
                name = :name,
                footer_order = :footerOrder,
                updated_at = NOW()
              WHERE id = :id
          ";
      
      $pdoStatement = $pdo->prepare($sql);

      $pdoStatement->bindValue(':name', $this->name, PDO::PARAM_STR);
      $pdoStatement->bindValue(':footerOrder', $this->footer_order, PDO::PARAM_INT);
      $pdoStatement->bindValue(':id', $this->id, PDO::PARAM_INT);

      // Execution de la requête de mise à jour (exec, pas query)
      $updatedRows = $pdoStatement->execute();

      return $updatedRows;
    }

    /**
     * Méthode permettant de supprimer une ligne de la table type
     * 
     * @return bool
     */
    public static function delete($id)
    {
      // Récupération de l'objet PDO représentant la connexion à la DB
      $pdo = Database::getPDO();

      // Ecriture de la requête DELETE
      $sql = "
              DELETE FROM type
              WHERE id = :id
          ";
      
      $pdoStatement = $pdo->prepare($sql);
      $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);

      // Execution de la requête de mise à jour (exec, pas query)
      $deleteRow = $pdoStatement->execute();

      return $deleteRow;
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
