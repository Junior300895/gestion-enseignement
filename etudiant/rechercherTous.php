<?php
/**
 * Created by PhpStorm.
 * User: Pierrot
 * Date: 2019-02-10
 * Time: 15:26
 */

// HEADERS
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// INCLUSIONS
include_once '../config/Database.class.php';
include_once '../modeles/Etudiant.class.php';

// BASE DE DONNÉES
$oDatabase = new Database();
$oBDD = $oDatabase->getConnexion();

// CRÉATION D'UN Etudiant
$oEtudiant = new Etudiant($oBDD);


// query products
$stmt = $oEtudiant->rechercherTous();
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){

    // products array
    $etudiants_arr = array();
    $etudiants_arr["Etudiants"] = array();

    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $etudiant_item=array(
            "IdEtu" => $IdEtu,
            "nom" => $nom,
            "prenom" => $prenom,
            "AdresseMail" => $AdresseMail,
            "DateNaissance" => $DateNaissance,
            "specialisation" => $specialisation
        );

        array_push($etudiants_arr["Etudiants"], $etudiant_item);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show products data in json format
    echo json_encode($etudiants_arr["Etudiants"]);
}
// no products found will be here
else{
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no products found
    echo json_encode(
        array("message" => "Aucun étudiant trouvé.")
    );
}
