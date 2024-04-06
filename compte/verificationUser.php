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
include_once '../modeles/Compte.class.php';

// BASE DE DONNÉES
$oDatabase = new Database();
$oBDD = $oDatabase->getConnexion();

// CRÉATION D'UN PRODUIT
$oCompte = new Compte($oBDD);

if(
    isset($_POST['login']) &&
    isset($_POST['password']) 
   
) {

    $oCompte->nom = $_POST['login'];
    $oCompte->password = $_POST['password'];
    if($oCompte->IdEtu != null){
        // create array
        $aCompte = array(
            // Compte
            "login" => $oCompte->login,
            "password" => $oCompte->password,
            
    
        );
    
        // set response code - 200 OK
        http_response_code(200);
    
        // make it json format
        echo json_encode($aCompte);
    }
    // $oCompte->sDateInscription = date("Y-m-d H:i:s");


    if(){
        http_response_code(200);

        echo json_encode(array("message" => " créé"));
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
    echo json_encode(array("message" => "Unable to create Compte. Data is incomplete."));
}
