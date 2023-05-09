<?php
    class Role {
        /* Champs privé identique aux colonnes de la table */
        private $rol_id;
        private $rol_libelle;

        /* Constructeur de la classe et instanciation les variables */
        public function __construct($id, $libelle) {
            $this->rol_id = $id;
            $this->rol_libelle = $libelle;
        }

        /* Fonction publique retournant une variable privée */
        public function GetId() {
            return $this->rol_id;
        }

        public function GetLibelle() {
            return $this->rol_libelle;
        }
    }
?>