<!-- Appelle des différents fichiers nécessaire ainsi que la création de la session -->
<?php require_once "utils/Utils.php"; ?>
<?php require_once "controleurs/c_accueil.php"; ?>

<?php require_once "metiers/Utilisateur.php"; ?>
<?php session_start(); ?>
<?php require_once "vues/v_entete.php"; ?>
    <body>
		<div class="conteneur">

			<div class="menu">
				<!-- Appelle le menu -->
				<?php require_once "vues/v_menu.php"; ?>
			</div>

			<div class="contenu">
				<?php
					/* Vérifie si la requête GET page est vide ou non */
					if (!empty($_GET['page'])) {
						$page = $_GET['page'];
					} else {
						$page = "accueil";
					}

					/* Vérifie si la requête GET gestion est vide ou non */
					if (!empty($_GET['gestion'])) {
						$gestion = $_GET['gestion'];
					} else {
						$gestion = "afficher";
					}

					/* Vérifie si la requête GET pagination est vide ou non */
					if (!empty($_GET['pagination'])) {
						$pagination = $_GET['pagination'];
					} else {
						$pagination = 1;
					}

					switch ($page) {
						/* Appelle le controlleur 'accueil' pour afficher la page d'accueil */
						case "accueil":
                            c_accueil::action_afficher();                           
                            break;

						/* Appelle controlleur 'inscriptionConnexion'ppur affifcher la vue inscription et faire l'inscription */
						case "inscription":
							require_once "controleurs/c_inscriptionConnexion.php";
							$controleur = new c_inscriptionConnexion();
							$controleur->action_afficherInscription();
							break;
						case "confirmationInscription":
							require_once "controleurs/c_inscriptionConnexion.php";
							$controleur = new c_inscriptionConnexion();
							$controleur->action_inscription($_POST['uti_nom'], $_POST['uti_prenom'], $_POST['uti_mail'], $_POST['uti_mdp']);
							break;

						/* Appelle controlleur 'inscriptionConnexion'ppur affifcher la vue connexion et faire la connexion */
						case "connexion":
							require_once "controleurs/c_inscriptionConnexion.php";
							$controleur = new c_inscriptionConnexion();
							$controleur->action_afficherConnexion();
							break;
						case "confirmationConnexion":
							require_once "controleurs/c_inscriptionConnexion.php";
							$controleur = new c_inscriptionConnexion();
							$controleur->action_connexion($_POST['uti_mail'], $_POST['uti_mdp']);
							break;

						/* Appelle controlleur 'espaceMembre'ppur affifcher la vue d'espace membre, si un utilisateur est connecté */
						case "espaceMembre":
							if (empty($_SESSION['utilisateur'])) {
								$uti = null;
							} else {
								$uti = $_SESSION['utilisateur']->GetId();
							}

							require_once "controleurs/c_espaceMembre.php";
							$controleur = new c_espaceMembre();
							$controleur->action_afficher($uti);
							break;

						/* Appelle le controlleur 'deconnexion' pour se déconnecter */
						case "deconnexion":
							require_once "controleurs/c_inscriptionConnexion.php";
							$controleur = new c_inscriptionConnexion();
							$controleur->action_afficherDeconnexion();
							break;


						/* Appelle le controlleur 'sport' pour afficher les sports, les sessions de sport, l'inscription à la session
							et faire l'inscriprion */
						case "listeSports":
							require_once "controleurs/c_sport.php";
							$controleur = new c_sport();
							$controleur->action_afficherListeSport();
							break;
						case "informationsSport":
							require_once "controleurs/c_sport.php";
							$controleur = new c_sport(); 
							$controleur->action_afficherInformationsSport($_POST['spo_id']);
							break;
						case "inscriptionSport":
							require_once "controleurs/c_sport.php";
							$controleur = new c_sport(); 
							$controleur->action_afficherInscriptionSport($_POST['spo_id'], $_POST['ses_id'], $_POST['ses_date'], $_POST['ses_heure']);
							break;
						case "confirmationSport":
							require_once "controleurs/c_sport.php";
							$controleur = new c_sport();
							$controleur->action_confirmerInscriptionSport($_POST['his_session'], $_POST['his_utilisateur'], $_POST['placeRes']);
							break;

						/* Appelle le controlleur 'gestionUtilisateurs' et fais des actions en fonctions de '$gestion' */
						case "gestionUtilisateurs":
							require_once "controleurs/c_gestionUtilisateurs.php";
							$controleur = new c_gestionUtilisateurs();

							switch ($gestion) {
								/* Système de pagination pour afficher une partie des utilisateurs */
								case "afficher":
									switch ($pagination) {
										default:
											$controleur->action_afficher($pagination);
											break;
									}
									break;

								/* Affiche la vue d'ajout ou ajoute les informations renseigné */
								case "ajouter":
									$controleur->action_vueAjouter();
									break;
								case "confirmationAjouter":
									$controleur->action_ajouter($_POST['uti_nom'], $_POST['uti_prenom'], $_POST['uti_mail'], $_POST['uti_mdp']);
									break;
									
								/* Affiche la vue de modification et modifie les informations renseigné */
								case "modifier":
									$controleur->action_vueModifier($_POST['uti_mail']);
									break;
								case "confirmationModifier":
									$controleur->action_modifier($_POST['uti_id'], $_POST['uti_nom'], $_POST['uti_prenom'], $_POST['uti_mail'], $_POST['uti_role']);
									break;
								
								/* Affiche la vue de suppression et supprime l'utilisateur correspondant */
								case "supprimer":
									$controleur->action_vueSupprimer();
									break;
								case "confirmationSupprimer":
									$controleur->action_supprimer($_POST['uti_mail']);
									break;

								/* Si page qu'il ne connait pas affiche l'accueil */
								default:
									c_accueil::action_afficher();
									break;
							}
							break;


						/* Si page qu'il ne connait pas affiche l'accueil */
						default:
							c_accueil::action_afficher();
							break;
					}
				?>
			</div>	
		</div>

		<script type="text/javascript" src="utils/javascript/jquery.js"></script>
		<script type="text/javascript" src="utils/javascript/app.js"></script>
    </body>
</html>