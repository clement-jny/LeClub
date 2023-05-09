<?php
    /* Require la connexion et métier spécifique */
    require_once "m_generique.php";
    require_once "metiers/Sport.php";

    class m_sport extends m_generique {

        /* Retourne tout les sports en base */
        public function GetListe() {
            $resultat = array();
            $this->connexion();

            $req = "SELECT * FROM t_sport";
            $res = mysqli_query($this->GetCnx(), $req);
            $ligne = mysqli_fetch_assoc($res);

            while ($ligne) {
                $sport = new Sport($ligne['spo_id'], $ligne['spo_libelle'], $ligne['spo_nbmax']);
                $resultat[] = $sport;

                $ligne = mysqli_fetch_assoc($res);
            }

            $this->deconnexion();
            return $resultat;
        }

        /* Retourne un sport en particulier grâce à son id */
        public function GetSport($spo_id) {
            $this->connexion();

            $req = "SELECT * FROM t_sport WHERE spo_id = '".$spo_id."'";
            $res = mysqli_query($this->GetCnx(), $req);
            $ligne = mysqli_fetch_assoc($res);

            if ($ligne) {
                $resultat = new Sport($ligne['spo_id'], $ligne['spo_libelle'], $ligne['spo_nbmax']);
            } else {
                $resultat = null;
            }

            $this->deconnexion();
            return $resultat;
        }
    }
?>