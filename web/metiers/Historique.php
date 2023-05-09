<?php
    class Historique {
        /* Champs privé identique aux colonnes de la table */
        private $his_session;
        private $his_utilisateur;
        private $his_date;

        /* Constructeur de la classe et instanciation les variables */
        public function __construct($session, $utilisateur, $date) {
            $this->his_session = $session;
            $this->his_utilisateur = $utilisateur;
            $this->his_date = $date;
        }

        /* Fonction publique retournant une variable privée */
        public function GetSession() {
            return $this->his_session;
        }    
        
        public function GetUtilisateur() {
            return $this->his_utilisateur;
        }

        public function GetDate() {
            return $this->his_date;
        }
    }
?>