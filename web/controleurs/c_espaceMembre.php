<?php
    /* Require le modèle nécessaire */
    require_once "modeles/m_historique.php";

    class c_espaceMembre {
        /* Champs privé nécessaire à la classe */
        private $data;
        private $modeleHistorique;

        /* Constructeur de la classe et instanciation les variables */
        public function __construct() {
            $this->data = array();
            $this->modeleHistorique = new m_historique();
        }

        /* Vérifie si 'uti_id' (id utilisateur) passé en paramètre est null,
        * si oui -> un message d'erreur sera affiche dans le vue 'v_message' et l'utilisateur sera reconduit sur la page d'accueil au bout de 2s
        * si non -> accède à l'espace membre avec l'historique des sessions participé pour l'utilisateur connecté */
        public function action_afficher($uti_id) {
            if (is_null($uti_id)) {
                $this->data['leMessage'] = "Aucune connexion détecté, retour à l'accueil.";
                header("Refresh: 2; URL=index.php");
                require_once "vues/v_message.php";
            } else {
                $this->data['historiqueUtilisateur'] = $this->modeleHistorique->GetHistorique($uti_id);
                require_once "vues/v_espaceMembre.php"; 
            }   
        }
    }
?>