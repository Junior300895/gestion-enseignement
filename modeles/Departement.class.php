<?php
/**
 * Created by PhpStorm.
 * User: Pierrot
 * Date: 2019-01-27
 * Time: 15:55
 */

class Departement {

    // Connexion BDD et nom_departement de la table
    private $oConnexion;
    private $sNomTable = "departement";

    public $code;
    public $nom_departement;
    public $chef_departement;



    /**
     * Utilisateur constructor.
     * @param $oBDD
     */
    public function __construct($oBDD) {
        $this->oConnexion = $oBDD;
    }

    /**
     * Rechercher tous les departements dans la BDD
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
     * Rechercher un departement dans la BDD
     * @return mixed
     */
    public function rechercherUn() {

        // query to read single record
        $query = "SELECT * FROM " . $this->sNomTable . "
            WHERE code = :code";

        // prepare query statement
        $stmt = $this->oConnexion->prepare($query);

        // bind id of product to be updated
        $stmt->bindParam(":code", $this->code);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->code = $row['code'];
        $this->nom_departement = $row['nom_departement'];
        $this->chef_departement = $row['chef_departement'];

    }

    /**
     * Ajouter un departement dans la BDD
     * @return bool
     */
    public function ajouter() {

        // query to insert record
        $sRequete = "INSERT INTO " . $this->sNomTable . "
            SET nom_departement = :nom_departement,
                chef_departement = :chef_departement,
                AdresseMail = :AdresseMail, 
                DateNaissance = :DateNaissance, 
                specialisation = :specialisation";

        // prepare query
        $stmt = $this->oConnexion->prepare($sRequete);

        // bind values
        $stmt->bindParam(":nom_departement", $this->nom_departement);
        $stmt->bindParam(":chef_departement", $this->chef_departement);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }


    /**
     * Modifier un departement dans la BDD
     * @return bool
     */
    public function modifier() {

        var_dump($this);

        $sRequete = "UPDATE " . $this->sNomTable . "
            SET
                nom_departement = :nom_departement,
                chef_departement = :chef_departement
            WHERE
                code = :code";

        // prepare query statement
        $stmt = $this->oConnexion->prepare($sRequete);

        // bind new values
        $stmt->bindParam(":nom_departement", $this->nom_departement);
        $stmt->bindParam(":chef_departement", $this->chef_departement);

        // execute the query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }


    /**
     * Supprimer un departement dans la BDD
     * @return bool
     */
    public function supprimer() {
        // delete query
        $query = "DELETE FROM " . $this->sNomTable . " WHERE code = :code";

        // prepare query
        $stmt = $this->oConnexion->prepare($query);

        // bind id of record to delete
        $stmt->bindParam(":code", $this->code);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

}
