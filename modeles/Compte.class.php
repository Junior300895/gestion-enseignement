<?php
/**
 * Created by PhpStorm.
 * User: Pierrot
 * Date: 2019-01-27
 * Time: 15:55
 */

class Compte {

    // Connexion BDD et mot_de_passe de la table
    private $oConnexion;
    private $sNomTable = "compte";

    public $login;
    public $mot_de_passe;
    public $roles;



    /**
     * Utilisateur constructor.
     * @param $oBDD
     */
    public function __construct($oBDD) {
        $this->oConnexion = $oBDD;
    }

    /**
     * Rechercher tous les Comptes dans la BDD
     * @return mixed
     */
    public function rechercherTous() {
        // select all query
        $sRequete = "SELECT * FROM " . $this->sNomTable;

        // prepare query statement
        $stmt = $this->oConnexion->prepare($sRequete);

        // execute query
        $stmt->execute();

        return $stmt;
    }


    /**
     * Rechercher un Compte dans la BDD
     * @return mixed
     */
    public function verificationUser() {

        // query to read single record
        $query = "SELECT * FROM " . $this->sNomTable . "
            WHERE login = :login and mot_de_passe=:password";

        // prepare query statement
        $stmt = $this->oConnexion->prepare($query);

        // bind id of product to be updated
        $stmt->bindParam(":login", $this->login);
        $stmt->bindParam(":password", $this->mot_de_passe);
        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->login = $row['login'];
        $this->mot_de_passe = $row['mot_de_passe'];
        $this->roles = $row['roles'];

    }

    /**
     * Ajouter un Compte dans la BDD
     * @return bool
     */
    public function ajouter() {

        // query to insert record
        $sRequete = "INSERT INTO " . $this->sNomTable . "
            SET login = :login,
                roles = :roles,
                mot_de_passe = :mot_de_passe,  
                ";

        // prepare query
        $stmt = $this->oConnexion->prepare($sRequete);

        // bind values
        $stmt->bindParam(":login", $this->login);
        $stmt->bindParam(":mot_de_passe", $this->mot_de_passe);
        $stmt->bindParam(":roles", $this->roles);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }


    /**
     * Modifier un Compte dans la BDD
     * @return bool
     */
    public function modifier() {

        var_dump($this);

        $sRequete = "UPDATE " . $this->sNomTable . "
            SET
                mot_de_passe = :mot_de_passe,
                roles = :roles
            WHERE
                login = :login";

        // prepare query statement
        $stmt = $this->oConnexion->prepare($sRequete);

        // bind new values
        $stmt->bindParam(":mot_de_passe", $this->mot_de_passe);
        $stmt->bindParam(":roles", $this->roles);

        // execute the query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

   
}
