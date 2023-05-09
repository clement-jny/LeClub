<?php
    class c_accueil {
        
        /* Fonction statique appelant la vue accueil */
        public static function action_afficher() {
            require_once "vues/v_accueil.php";
        }
    }
?>