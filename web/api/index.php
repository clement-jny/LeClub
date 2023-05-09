<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once "config/Utils.php";
require_once "config/Database.php";

require_once "models/Historique.php";
require_once "models/Role.php";
require_once "models/Session.php";
require_once "models/Sport.php";
require_once "models/Utilisateur.php";


/* REDIRECTION */
//localhost/index.php?demande='endPoint' ==> localhost/'endPoint'

/* END POINTS */
//POST => Ajouter
//GET => Récupérer
//PUT => Modifier
//DELETE => Supprimer

try {
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        header("Access-Control-Allow-Methods: GET");

        if (!empty($_GET['demande'])) {
           
            require_once "method/GET.php";

        } else {
            /* Si demande est vide */
            throw new Exception ("Data recovery problem, check the url.", 400);
        }

    } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {

        header("Access-Control-Allow-Methods: POST");

        if (!empty($_GET['demande'])) {

            require_once "method/POSTPUT.php";

        } else {
            throw new Exception ("Data recovery problem, check the url.", 400);
        }

    } elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') {

        header("Access-Control-Allow-Methods: DELETE");

        if (!empty($_GET['demande'])) {
            
            require_once "method/DELETE.php";

        } else {
            throw new Exception ("Data recovery problem, check the url.", 400);
        }

    } else {
        /* Si méthode autre que GET, POST, PUT, DELETE */
        Utils::sendResult(405, "The chosen method is not allowed, please try again.");
    }
} catch (Exception $e) {
    /* Problème avec bdd */
    Utils::sendResult($e->getCode(), $e->getMessage());
}
?>