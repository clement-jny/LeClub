<?php
	$url = explode("/", filter_var($_GET['demande'], FILTER_SANITIZE_URL));

	switch ($url[0]) {
		case 'historiques':
			$historique = new Historique();

			if (!empty($url[1])) {
				//historiques/1 -> histo uti 1
				$historique->getHistoriquesById($url[1]);
			} else {
				//historiques -> tout
				$historique->getHistoriques();
			}
			break;

		case 'roles':
			$role = new Role();

			if (!empty($url[1])) {
				//un role
				$role->getRoleById($url[1]);
			} else {
				//tout
				$role->getRoles();
			}
			break;
		
		case 'sessions':
			$session = new Session();

			if (!empty($url[1])) {
				//une session
				$session->getSessionById($url[1]);
			} else {
				//tout
				$session->getSessions();
			}
			break;

		case 'sports':
			$sport = new Sport();

			if (!empty($url[1])) {
				//un sport
				$sport->getSportById($url[1]);
			} else {
				//tout
				$sport->getSports();
			}
			break;

		case 'utilisateurs':
			$uti = new Utilisateur();

			if (!empty($url[1])) {
				//un utilisateur
				$uti->getUtilisateurById($url[1]);
			} else {           
				//tout         
				$uti->getUtilisateurs();
			}
			break;
		
		default:
			Utils::sendResult(400, "The request is invalid, check the endpoint.");
			break;
	}
?>