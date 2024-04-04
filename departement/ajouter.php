<?php
/**
 * Created by PhpStorm.
 * User: Pierrot
 * Date: 2019-02-10
 * Time: 15:52
 */

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/Database.class.php';
include_once '../modeles/Etudiant.class.php';

// BASE DE DONNÉES
$oDatabase = new Database();
$oBDD = $oDatabase->getConnexion();

// CRÉATION D'UN PRODUIT
$oEtudiant = new Etudiant($oBDD);

if(
    isset($_POST['nom']) &&
    isset($_POST['prenom']) &&
    isset($_POST['AdresseMail']) &&
    isset($_POST['DateNaissance']) &&
    isset($_POST['specialisation'])
) {

    $oEtudiant->nom = $_POST['nom'];
    $oEtudiant->prenom = $_POST['prenom'];
    $oEtudiant->AdresseMail = $_POST['AdresseMail'];
    $oEtudiant->DateNaissance = $_POST['DateNaissance'];
    $oEtudiant->specialisation = $_POST['specialisation'];
    // $oEtudiant->sDateInscription = date("Y-m-d H:i:s");


    if($oEtudiant->ajouter()){
        http_response_code(201);

        echo json_encode(array("message" => "Etudiant créé"));
    }
    else{
        http_response_code(503);

        echo json_encode(array("message" => "Impossible de créer l'tudiant!"));
    }

}
else{

    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" => "Unable to create Etudiant. Data is incomplete."));
}
