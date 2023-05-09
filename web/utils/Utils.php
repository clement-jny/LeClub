<?php
    class Utils {
        
        /* Fonction statique retournant la date et l'heure du jour sous la forme aaaa-mm-jj hh:mm:ss */
        public static function getDateTimeToday() {
            date_default_timezone_set("Europe/Paris");
            return date('Y-m-d H:i:s');
        }

        /* Fonction statique retournant la date du jour sous la forme aaaa-mm-jj */
        public static function getDateToday() {
            date_default_timezone_set("Europe/Paris");
            return date('Y-m-d');
        }

        /* Fonction statique retournant la date passé en paramètre converti au format FR jj/mm/aaaa */
        public static function convertDateToFr($date) {
            date_default_timezone_set("Europe/Paris");
            return date("d/m/Y", strtotime($date));
        }

        /* Fonction cachant le mdp passé en paramètre par des étoiles */
        public static function hidePassword($password) {
            $char = '*';
            $res = "";
            for ($i=0; $i < strlen($password)/10; $i++) { 
                $res .= $char;
            }
            return $res;
        }

        /* Fonction statique retournant l'heure du jour sous la forme heure:minute:seconde */
        public static function getTimeToday() {
            date_default_timezone_set("Europe/Paris");
            return date('H:i:s');
        }
    }
?>