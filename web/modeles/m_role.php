<?php
    /* Require la connexion et métier spécifique */
    require_once "m_generique.php";
    require_once "metiers/Role.php";

    class m_role extends m_generique {

        /* Retourne tout les rôles en base */
        public function GetListe() {
            $resultat = array();
            $this->connexion();

            $req = "SELECT * FROM t_role";
            $res = mysqli_query($this->GetCnx(), $req);
            $ligne = mysqli_fetch_assoc($res);

            while ($ligne) {
                $role = new Role($ligne['rol_id'], $ligne['rol_libelle']);
                $resultat[] = $role;

                $ligne = mysqli_fetch_assoc($res);
            }

            $this->deconnexion();
            return $resultat;
        }
    }
?>