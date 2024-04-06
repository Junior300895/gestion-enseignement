<?php

/**
 * Created by PhpStorm.
 * User: Pierrot
 * Date: 2019-02-10
 * Time: 16:50
 */

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../config/Database.class.php';
include_once '../modeles/Compte.class.php';

// get database connection
$oDatabase = new Database();
$oBDD = $oDatabase->getConnexion();

// prepare product object
$oCompte = new Compte($oBDD);
// echo "Ceci est du texte" + $_POST['login'];
if (
    isset($_POST['login']) ||
    isset($_POST['password'])
) {

    $oCompte->login = $_POST['login'];
    $oCompte->mot_de_passe = $_POST['password'];

    // read the details of product to be edited
    $oCompte->verificationUser();

    if ($oCompte->login != null) {
        // create array
        $aCompte = array(
            // Compte
            "login" => $oCompte->login,
            "mot_de_passe" => $oCompte->mot_de_passe,
            "roles" => $oCompte->roles

        );

        // set response code - 200 OK
        http_response_code(200);

        // make it json format
        echo json_encode($aCompte);
    } else {
        // set response code - 400 bad request
        http_response_code(401);

        // tell the user
        echo json_encode(array("message" => "Utilisateur non identifié."));
    }
} else {

    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" => "Login ou mot de passe non renseigné ."));
}
