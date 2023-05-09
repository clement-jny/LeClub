<?php
    class Database {
        private $_pdo = null;

        public function connexion() {
            try {
                return $this->_pdo = new PDO('mysql:host=localhost;dbname=db_siosport;charset=utf8', 'root', 'root');
            } catch (\Throwable $th) {
                throw $th;
            }
        }
    }
?>