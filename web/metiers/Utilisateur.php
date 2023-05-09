<?php
    class Utilisateur {
        /* Champs privé identique aux colonnes de la table */
        private $uti_id;
        private $uti_nom;
        private $uti_prenom;
        private $uti_mail;
        private $uti_mdp;
        private $uti_role;

        /* Constructeur de la classe et instanciation les variables */
        public function __construct($id, $nom, $prenom, $mail, $mdp, $role) {
            $this->uti_id = $id;
            $this->uti_nom = $nom;
            $this->uti_prenom = $prenom;
            $this->uti_mail = $mail;
            $this->uti_mdp = $mdp;
            $this->uti_role = $role;
        }

        /* Fonction publique retournant une variable privée */
        public function GetId() {
            return $this->uti_id;
        }

        public function GetNom() {
            return $this->uti_nom;
        }

        public function GetPrenom() {
            return $this->uti_prenom;
        }
        
        public function GetMail() {
            return $this->uti_mail;
        }

        public function GetMdp() {
            return $this->uti_mdp;
        }

        public function GetRole() {
            return $this->uti_role;
        }
    }
?>