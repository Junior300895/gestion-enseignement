<?php
/**
 * Created by PhpStorm.
 * User: PO
 * Date: 2019-02-11
 * Time: 11:41
 */

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../config/Database.class.php';
include_once '../modeles/Etudiant.class.php';

// get database connection
$oDatabase = new Database();
$oBDD = $oDatabase->getConnexion();

// prepare product object
$oEtudiant = new Etudiant($oBDD);

// set ID property of product to be edited
$oEtudiant->IdEtu = $_POST['IdEtu'];

// set product property values
$oEtudiant->nom = $_POST['nom'];
$oEtudiant->prenom = $_POST['prenom'];
$oEtudiant->AdresseMail = $_POST['AdresseMail'];
$oEtudiant->DateNaissance = $_POST['DateNaissance'];
$oEtudiant->specialisation = $_POST['specialisation'];

// update the product
if($oEtudiant->modifier()){

    // set response code - 200 ok
    http_response_code(200);

    // tell the user
    echo json_encode(array("message" => "Le Etudiant est mit à jour."));
}

// if unable to update the product, tell the user
else{

    // set response code - 503 service unavailable
    http_response_code(503);

    // tell the user
    echo json_encode(array("message" => "Impossible de modifier cet étudiant"));
}
