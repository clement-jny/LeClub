<?php
    class Sport {
        /* Champs privé identique aux colonnes de la table */
        private $spo_id;
        private $spo_libelle;
        private $spo_nbmax;

        /* Constructeur de la classe et instanciation les variables */
        public function __construct($id, $libelle, $nbmax) {
            $this->spo_id = $id;
            $this->spo_libelle = $libelle;
            $this->spo_nbmax = $nbmax;
        }

        /* Fonction publique retournant une variable privée */
        public function GetId() {
            return $this->spo_id;
        }

        public function GetLibelle() {
            return $this->spo_libelle;
        }

        public function GetNbMax() {
            return $this->spo_nbmax;
        }
    }
?>