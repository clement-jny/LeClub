<?php
    $url = explode("/", filter_var($_GET['demande'], FILTER_SANITIZE_URL));

    if (empty($url[1])) {
        Utils::sendResult(400, "The request is invalid, id needed.");
    } else {
        switch ($url[0]) {
            case 'historiques':
                $historique = new Historique();

                if (isset($url[2])) {
                    if (!empty($_POST['his_date'])) {
                        if ($historique->updateHistorique($url[1], $url[2], $_POST['his_date'])) {
                            Utils::sendResult(200, "Historique modifié.");
                        } else {
                            Utils::sendResult(500, "Internal server error.");
                        }
                    } else {
                        Utils::sendResult(400, "Empty fields.");
                    }
                } else {
                    Utils::sendResult(400, "The request is invalid, check the url. Another id needed");
                }
                break;
    
            case 'roles':
                $role = new Role();

                if (!empty($_POST['rol_libelle'])) {
                    if ($role->updateRole($url[1], $_POST['rol_libelle'])) {
                        Utils::sendResult(201, "Rôle modifié.");
                    } else {
                        Utils::sendResult(500, "Internal server error.");
                    }
                } else {
                    Utils::sendResult(400, "Empty fields.");
                }
                break;

            case 'sessions':
                $session = new Session();

                if (!empty($_POST['ses_date']) && !empty($_POST['ses_heure']) && !empty($_POST['ses_sport'])) {
                    if ($session->updateSession($url[1], $_POST['ses_date'], $_POST['ses_heure'], $_POST['ses_sport'])) {
                        Utils::sendResult(201, "Session modifiée.");
                    } else {
                        Utils::sendResult(500, "Internal server error.");
                    }
                } else {
                    Utils::sendResult(400, "Empty fields.");
                }
                break;
    
            case 'sports':
                $sport = new Sport();

                if (!empty($_POST['spo_libelle']) && !empty($_POST['spo_nbmax'])) {
					if ($sport->updateSport($url[1], $_POST['spo_libelle'], $_POST['spo_nbmax'])) {
						Utils::sendResult(201, "Sport modifié.");
					} else {
						Utils::sendResult(500, "Internal server error.");
					}
				} else {
					Utils::sendResult(400, "Empty fields.");
				}
                break;

            case 'utilisateurs':
                $utilisateur = new Utilisateur();

                if (!empty($_POST['uti_nom']) && !empty($_POST['uti_prenom']) && !empty($_POST['uti_mail']) && !empty($_POST['uti_role'])) {
                    if ($utilisateur->updateUtilisateur($url[1], $_POST['uti_nom'], $_POST['uti_prenom'], $_POST['uti_mail'], $_POST['uti_role'])) {
                        Utils::sendJSON(200, "Utilisateur modifié.");
                    } else {
                        Utils::sendResult(500, "Internal server error.");
                    }
                } else {
                    Utils::sendResult(400, "Empty fields.");
                }
                break;
            
            default:
                Utils::sendResult(400, "The request is invalid, check the endpoint.");
                break;
        }
    }
?>