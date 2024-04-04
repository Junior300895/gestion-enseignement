<?php
/**
 * Created by PhpStorm.
 * User: Pierrot
 * Date: 2019-02-10
 * Time: 16:50
 */

// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/Database.class.php';
include_once '../modeles/Etudiant.class.php';

// get database connection
$oDatabase = new Database();
$oBDD = $oDatabase->getConnexion();

// prepare product object
$oEtudiant = new Etudiant($oBDD);

// set ID property of record to read
$oEtudiant->IdEtu = isset($_GET['IdEtu']) ? $_GET['IdEtu'] : die();

// read the details of product to be edited
$oEtudiant->rechercherUn();

if($oEtudiant->IdEtu != null){
    // create array
    $aEtudiant = array(
        // Etudiant
        "IdEtu" => $oEtudiant->IdEtu,
        "nom" => $oEtudiant->nom,
        "prenom" => $oEtudiant->prenom,
        "AdresseMail" => $oEtudiant->AdresseMail,
        "DateNaissance" => $oEtudiant->DateNaissance,
        "specialisation" => $oEtudiant->specialisation,

    );

    // set response code - 200 OK
    http_response_code(200);

    // make it json format
    echo json_encode($aEtudiant);
}

else{
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user product does not exist
    echo json_encode(array("message" => "Etudiant does not exist."));
}
