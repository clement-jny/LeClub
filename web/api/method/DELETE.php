<?php
    $url = explode("/", filter_var($_GET['demande'], FILTER_SANITIZE_URL));

    if (empty($url[1])) {
        Utils::sendResult(400, "The request is invalid, id needed.");
    } else {
        switch ($url[0]) {
            case 'historiques':
                $historique = new Historique();

                if (isset($url[2])) {
                    if ($historique->deleteHistorique($url[1], $url[2])) {
                        Utils::sendResult(200, "Historique supprimé.");
                    } else {
                        Utils::sendResult(500, "Internal server error.");
                    }
                } else {
                    Utils::sendResult(400, "The request is invalid, check the url.");
                }
                break;
    
            case 'roles':
                $role = new Role();

                if ($role->deleteRole($url[1])) {
                    Utils::sendResult(200, "Rôle supprimé.");
                } else {
                    Utils::sendResult(500, "Internal server error.");
                }
                break;
    
            case 'sessions':
                $session = new Session();

                if ($session->deleteSession($url[1])) {
                    Utils::sendResult(200, "Session supprimée.");
                } else {
                    Utils::sendResult(500, "Internal server error.");
                }
                break;
    
            case 'sports':
                $sport = new Sport();

                if ($sport->deleteSport($url[1])) {
                    Utils::sendResult(200, "Sport supprimé.");
                } else {
                    Utils::sendResult(500, "Internal server error.");
                }
                break;
            
            case 'utilisateurs':
                $utilisateur = new Utilisateur();

                if ($utilisateur->deleteUtilisateur($url[1])) {
                    Utils::sendResult(200, "Utilisateur supprimé.");
                } else {
                    Utils::sendResult(500, "Internal server error.");
                }
                break;
            
            default:
                Utils::sendResult(400, "The request is invalid, check the endpoint.");
                break;
        }
    }
?>