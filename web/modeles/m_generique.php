<?php
    class m_generique {
        private $cnx;

        /* Retoure la variable privée cnx */
        public function GetCnx() {
            return $this->cnx;
        }

        /* Instancie une connexion dans la variable cnx */
        public function connexion() {
            $this->cnx = mysqli_connect("localhost", "root", "root", "db_siosport");
            mysqli_set_charset($this->cnx, "utf8");
        }

        /* Ferme de la connexion de cnx */
        public function deconnexion() {
            mysqli_close($this->cnx);
        }
    }
?>