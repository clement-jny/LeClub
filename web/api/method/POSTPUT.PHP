<?php
    $url = explode("/", filter_var($_GET['demande'], FILTER_SANITIZE_URL));

    switch ($url[0]) {
        case 'historiques':
            $historique = new Historique();

            if (!empty($url[1])) {
                if (!empty($url[2])) {
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
                    Utils::sendResult(400, "Another id needed.");
                }
            } else {
                if (!empty($_POST['his_session']) && !empty($_POST['his_utilisateur']) && !empty($_POST['his_date'])) {
					if ($historique->setHistorique($_POST['his_session'], $_POST['his_utilisateur'], $_POST['his_date'])) {
						Utils::sendResult(201, "Historique créé.");
					} else {
						Utils::sendResult(500, "Internal server error.");
					}
				} else {
					Utils::sendResult(400, "Empty fields.");
				}
            }
            break;

        case 'roles':
            $role = new Role();

            if (!empty($url[1])) {
                if (!empty($_POST['rol_libelle'])) {
                    if ($role->updateRole($url[1], $_POST['rol_libelle'])) {
                        Utils::sendResult(200, "Rôle modifié.");
                    } else {
                        Utils::sendResult(500, "Internal server error.");
                    }
                } else {
                    Utils::sendResult(400, "Empty fields.");
                }
            } else {
                if (!empty($_POST['rol_libelle'])) {
					if ($role->setRole($_POST['rol_libelle'])) {
						Utils::sendResult(201, "Rôle créé.");
					} else {
						Utils::sendResult(500, "Internal server error.");
					}
				} else {
					Utils::sendResult(400, "Empty fields.");
				}
            }
            break;

        case 'sessions':
            $session = new Session();

            if (!empty($url[1])) {
                if (!empty($_POST['ses_date']) && !empty($_POST['ses_heure']) && !empty($_POST['ses_sport'])) {
                    if ($session->updateSession($url[1], $_POST['ses_date'], $_POST['ses_heure'], $_POST['ses_sport'])) {
                        Utils::sendResult(200, "Session modifiée.");
                    } else {
                        Utils::sendResult(500, "Internal server error.");
                    }
                } else {
                    Utils::sendResult(400, "Empty fields.");
                }
            } else {
                if (!empty($_POST['ses_date']) && !empty($_POST['ses_heure']) && !empty($_POST['ses_sport'])) {
					if ($session->setSession($_POST['ses_date'], $_POST['ses_heure'], $_POST['ses_sport'])) {
						Utils::sendResult(201, "Session créée.");
					} else {
						Utils::sendResult(500, "Internal server error.");
					}
				} else {
					Utils::sendResult(400, "Empty fields.");
				}
            }
            break;

        case 'sports':
            $sport = new Sport();

            if (!empty($url[1])) {
                if (!empty($_POST['spo_libelle']) && !empty($_POST['spo_nbmax'])) {
					if ($sport->updateSport($url[1], $_POST['spo_libelle'], $_POST['spo_nbmax'])) {
						Utils::sendResult(200, "Sport modifié.");
					} else {
						Utils::sendResult(500, "Internal server error.");
					}
				} else {
					Utils::sendResult(400, "Empty fields.");
				}
            } else {
                if (!empty($_POST['spo_libelle']) && !empty($_POST['spo_nbmax'])) {
					if ($sport->setSport($_POST['spo_libelle'], $_POST['spo_nbmax'])) {
						Utils::sendResult(201, "Sport créé.");
					} else {
						Utils::sendResult(500, "Internal server error.");
					}
				} else {
					Utils::sendResult(400, "Empty fields.");
				}
            }
            break;

        case 'utilisateurs':
            $utilisateur = new Utilisateur();

            if (!empty($url[1])) {
                if (!empty($_POST['uti_nom']) && !empty($_POST['uti_prenom']) && !empty($_POST['uti_mail']) && !empty($_POST['uti_role'])) {
                    if ($utilisateur->updateUtilisateur($url[1], $_POST['uti_nom'], $_POST['uti_prenom'], $_POST['uti_mail'], $_POST['uti_role'])) {
                        Utils::sendResult(200, "Utilisateur modifié.");
                    } else {
                        Utils::sendResult(500, "Internal server error.");
                    }
                } else {
                    Utils::sendResult(400, "Empty fields.");
                }
            } else {
                if (!empty($_POST['uti_nom']) && !empty($_POST['uti_prenom']) && !empty($_POST['uti_mail']) && !empty($_POST['uti_mdp'])) {
					if ($utilisateur->setUtilisateur($_POST['uti_nom'], $_POST['uti_prenom'], $_POST['uti_mail'], $_POST['uti_mdp'])) {
						Utils::sendResult(201, "Utilisateur créé.");
					} else {
						Utils::sendResult(500, "Internal server error.");
					}
				} else {
					Utils::sendResult(400, "Empty fields.");
				}
            }
            break;

        default:
        Utils::sendResult(400, "The request is invalid, check the endpoint.");
            break;
    }
?>