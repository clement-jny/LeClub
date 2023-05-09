<?php
    /* Require le modèle nécessaire */
    require_once "modeles/m_utilisateur.php";

    class c_inscriptionConnexion {
        /* Champs privé nécessaire à la classe */
        private $data;
        private $modeleUtilisateur;

        /* Constructeur de la classe et instanciation les variables */
        public function __construct() {
            $this->data = array();
            $this->modeleUtilisateur = new m_utilisateur();
        }

        /* Affiche le vue d'inscription */
        public function action_afficherInscription() {
            require_once "vues/v_inscription.php";
        }

        /* Vérifie si la fonction 'VerifUtilisateur' retourne null ou non
        * si null -> message d'erreur spécifiant que l'utilisateur est déjà présent
        * si non -> recupère le retour de la fonction 'AjoutUtilisateur' dans $utilisateur
        *   si $utilisateur est null -> m'essage d'erreur
        *   si non -> message de succes pour préciser que l'inscription est effectuée
        * Appelle la vue 'v_message' */
        public function action_inscription($uti_nom, $uti_prenom, $uti_mail, $uti_mdp) {
            if (is_null($this->modeleUtilisateur->VerifUtilisateur($uti_mail, $uti_mdp))) {
                $utilisateur = $this->modeleUtilisateur->AjoutUtilisateur($uti_nom, $uti_prenom, $uti_mail, $uti_mdp);

                if (is_null($utilisateur)) {
                    $this->data['leMessage'] = "L'ajout a échoué pour une raison indéterminé. Redirection à la page d'inscription.";
                    header("Refresh: 2; URL=index.php?page=inscription");
                } else {
                    $this->data['leMessage'] = "Inscription effectué avec succès. Redirection à la page de connexion.";
                    header("Refresh: 2; URL=index.php?page=connexion");
                }
            } else {
                $this->data['leMessage'] = "Inscription impossible, utilisateur déjà présent. Redirection à la page de connexion.";
                header("Refresh: 2; URL=index.php?page=connexion");
            }
            
            require_once "vues/v_message.php";
        }

        /* Affiche le vue de connexion */
        public function action_afficherConnexion() {
            require_once "vues/v_connexion.php";
        }

        /* Vérifie si la fonction 'VerifUtilisateur' retourne null ou non
        * si oui -> message d'erreur spécifiant que l'utilisateur est introuvable
        * si non -> message de succes puis redirection vers la page d'accueil après 2s,
            garde en SESSION l'objet utilisateur que retourne 'GetUtilisateur'
        * Appelle la vue 'v_message' */
        public function action_connexion($uti_mail, $uti_mdp) {
            if(is_null($this->modeleUtilisateur->VerifUtilisateur($uti_mail, $uti_mdp))) {
                $this->data['leMessage'] = "Utilisateur introuvable, veuillez réessayer. Redirection à la page de connexion.";
                header("Refresh: 2; URL=index.php?page=connexion");
            } else {
                $this->data['leMessage'] = "Connexion réussi, vous allez être redirigé vers la page d'accueil.";
                $_SESSION['utilisateur'] = $this->modeleUtilisateur->GetUtilisateur($uti_mail);
                header("Refresh: 2; URL=index.php");
            }

            require_once "vues/v_message.php";
        }

        /* Affiche le vue déconnexion */
        public function action_afficherDeconnexion() {
            require_once "vues/v_deconnexion.php";
        }
    }
?>