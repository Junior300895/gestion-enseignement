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
include_once '../modeles/Compte.class.php';

// get database connection
$oDatabase = new Database();
$oBDD = $oDatabase->getConnexion();

// prepare product object
$oCompte = new Compte($oBDD);

// set ID property of record to read
$oCompte->login = isset($_GET['login']) ? $_GET['login'] : die();
$oCompte->mot_de_passe = isset($_GET['lmot_de_passe']) ? $_GET['mot_de_passe'] : die();


// read the details of product to be edited
$oCompte->rechercherlog();

if($oCompte->login != null){
    // create array
    $aCompte = array(
        // Compte
        "login" => $oCompte->login,
        "mot_de_passe" => $oCompte->mot_de_passe,

    );

    // set response login - 200 OK
    http_response_login(200);

    // make it json format
    echo json_enlogin($aCompte);
}

else{
    // set response login - 404 Not found
    http_response_login(404);

    // tell the user product does not exist
    echo json_enlogin(array("message" => "Compte does not exist."));
}
