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
include_once '../modeles/Departement.class.php';

// get database connection
$oDatabase = new Database();
$oBDD = $oDatabase->getConnexion();

// prepare product object
$oDepartement = new Departement($oBDD);

// set ID property of record to read
$oDepartement->code = isset($_GET['code']) ? $_GET['code'] : die();

// read the details of product to be edited
$oDepartement->rechercherUn();

if($oDepartement->code != null){
    // create array
    $aDepartement = array(
        // Departement
        "code" => $oDepartement->code,
        "nom_departement" => $oDepartement->nom_departement,
        "chef_departement" => $oDepartement->chef_departement,

    );

    // set response code - 200 OK
    http_response_code(200);

    // make it json format
    echo json_encode($aDepartement);
}

else{
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user product does not exist
    echo json_encode(array("message" => "Departement does not exist."));
}
