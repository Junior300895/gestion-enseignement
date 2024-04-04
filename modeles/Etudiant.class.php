<?php
/**
 * Created by PhpStorm.
 * User: Pierrot
 * Date: 2019-01-27
 * Time: 15:55
 */

class Etudiant {

    // Connexion BDD et nom de la table
    private $oConnexion;
    private $sNomTable = "etudiant";

    public $IdEtu;
    public $nom;
    public $prenom;
    public $AdresseMail;
    public $DateNaissance;
    public $specialisation;


    /**
     * Utilisateur constructor.
     * @param $oBDD
     */
    public function __construct($oBDD) {
        $this->oConnexion = $oBDD;
    }

    /**
     * Rechercher tous les utilisateurs dans la BDD
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
     * Rechercher un utilisateur dans la BDD
     * @return mixed
     */
    public function rechercherUn() {

        // query to read single record
        $query = "SELECT * FROM " . $this->sNomTable . "
            WHERE IdEtu = :IdEtu";

        // prepare query statement
        $stmt = $this->oConnexion->prepare($query);

        // bind id of product to be updated
        $stmt->bindParam(":IdEtu", $this->IdEtu);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->IdEtu = $row['IdEtu'];
        $this->nom = $row['nom'];
        $this->prenom = $row['prenom'];
        $this->AdresseMail = $row['AdresseMail'];
        $this->DateNaissance = $row['DateNaissance'];
        $this->specialisation = $row['specialisation'];
    }

    /**
     * Ajouter un utilisateur dans la BDD
     * @return bool
     */
    public function ajouter() {

        // query to insert record
        $sRequete = "INSERT INTO " . $this->sNomTable . "
            SET nom = :nom,
                prenom = :prenom,
                AdresseMail = :AdresseMail, 
                DateNaissance = :DateNaissance, 
                specialisation = :specialisation";

        // prepare query
        $stmt = $this->oConnexion->prepare($sRequete);

        // bind values
        $stmt->bindParam(":nom", $this->nom);
        $stmt->bindParam(":prenom", $this->prenom);
        $stmt->bindParam(":AdresseMail", $this->AdresseMail);
        $stmt->bindParam(":DateNaissance", $this->DateNaissance);
        $stmt->bindParam(":specialisation", $this->specialisation);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }


    /**
     * Modifier un utilisateur dans la BDD
     * @return bool
     */
    public function modifier() {

        var_dump($this);

        $sRequete = "UPDATE " . $this->sNomTable . "
            SET
                nom = :nom, 
                sMotDePasse = :sMotDePasse, 
                prenom = :prenom,
                AdresseMail = :AdresseMail, 
                DateNaissance = :DateNaissance,
                specialisation = :specialisation
            WHERE
                IdEtu = :IdEtu";

        // prepare query statement
        $stmt = $this->oConnexion->prepare($sRequete);

        // bind new values
        $stmt->bindParam(":nom", $this->nom);
        $stmt->bindParam(":prenom", $this->prenom);
        $stmt->bindParam(":AdresseMail", $this->AdresseMail);
        $stmt->bindParam(":DateNaissance", $this->DateNaissance);
        $stmt->bindParam(":specialisation", $this->specialisation);

        // execute the query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }


    /**
     * Supprimer un utilisateur dans la BDD
     * @return bool
     */
    public function supprimer() {
        // delete query
        $query = "DELETE FROM " . $this->sNomTable . " WHERE IdEtu = :IdEtu";

        // prepare query
        $stmt = $this->oConnexion->prepare($query);

        // bind id of record to delete
        $stmt->bindParam(":IdEtu", $this->IdEtu);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

}
