<?php
    class Session {
        /* Champs privé identique aux colonnes de la table */
        private $ses_id; 
        private $ses_date;
        private $ses_heure;
        private $ses_sport;

        /* Constructeur de la classe et instanciation les variables */
        public function __construct($id, $date, $heure, $sport) {
            $this->ses_id = $id;
            $this->ses_date = $date;
            $this->ses_heure = $heure;
            $this->ses_sport = $sport;
        }

        /* Fonction publique retournant une variable privée */
        public function GetId() {
            return $this->ses_id;
        }

        public function GetDate() {
            return $this->ses_date;
        }

        public function GetHeure() {
            return $this->ses_heure;
        }

        public function GetSport() {
            return $this->ses_sport;
        }
    }
?>