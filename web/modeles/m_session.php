<?php
    /* Require la connexion et métier spécifique */
    require_once "m_generique.php";
    require_once "metiers/Session.php";

    class m_session extends m_generique {

        /* Retourne les sessions par rapport à l'id d'un sport.
        * Compare la date du jour avec la date de session,
        * Si date jour supérieur -> ne pas ajouter la session au tableau
        * Si date jour inférieur -> ajouter la session au tableau */
        public function GetListe($spo_id) {
            $resultat = array();
            $this->connexion();

            /* DATE_FORMAT(ses_date, '%d/%m/%Y') AS */
            $req = "SELECT ses_id, ses_date, ses_heure, ses_sport FROM t_session WHERE ses_sport = '".$spo_id."'";
            $res = mysqli_query($this->GetCnx(), $req);
            $ligne = mysqli_fetch_assoc($res);

            while ($ligne) {
                $session = new Session($ligne['ses_id'], $ligne['ses_date'], $ligne['ses_heure'], $ligne['ses_sport']);

                if (Utils::getDateToday() <= $session->GetDate() and Utils::getTimeToday() < $session->GetHeure()) {
                    $resultat[] = $session;
                }

                $ligne = mysqli_fetch_assoc($res);
            }

            $this->deconnexion();
            return $resultat;
        }

        /* Retroune une liste d'animateurs s'occupant de la session (spécifié par son id) pour le sport (spécifié par son id) */
        public function GetListeAnimateurs($spo_id, $ses_id) {
            $resultat = array();
            $this->connexion();

            $req = "SELECT uti_nom, uti_prenom FROM t_historique
            JOIN t_utilisateur ON t_historique.his_utilisateur = t_utilisateur.uti_id
            JOIN t_session ON t_historique.his_session = t_session.ses_id
            WHERE t_utilisateur.uti_role = 1
            AND t_session.ses_sport = '".$spo_id."'
            AND t_session.ses_id = '".$ses_id."'";
            $res = mysqli_query($this->GetCnx(), $req);
            $ligne = mysqli_fetch_assoc($res);

            if ($ligne) {
                while ($ligne) {
                    $resultat[] = $ligne['uti_nom']." ".$ligne['uti_prenom'];
    
                    $ligne = mysqli_fetch_assoc($res);
                }
            } else {
                $resultat = null;
            }

            $this->deconnexion();
            return $resultat;
        }

        /* Retourne une liste de participants s'étant inscrit à une session (spécifié par son id) pour le sport (spécifié par son id) */
        public function GetListeParticipants($spo_id, $ses_id) {
            $resultat = array();
            $this->connexion();

            $req = "SELECT uti_nom, uti_prenom FROM t_historique
            JOIN t_utilisateur ON t_historique.his_utilisateur = t_utilisateur.uti_id
            JOIN t_session ON t_historique.his_session = t_session.ses_id
            WHERE t_utilisateur.uti_role = 2
            AND t_session.ses_sport = '".$spo_id."'
            AND t_session.ses_id = '".$ses_id."'";
            $res = mysqli_query($this->GetCnx(), $req);
            $ligne = mysqli_fetch_assoc($res);

            if ($ligne) {
                while ($ligne) {
                    $resultat[] = $ligne['uti_nom']." ".$ligne['uti_prenom'];
    
                    $ligne = mysqli_fetch_assoc($res);
                }
            } else {
                $resultat = null;
            }
           
            $this->deconnexion();
            return $resultat;
        }

        /* Retourne le nombre de participants de la session (spécifié par son id) pour le sport (spécifié par son id) */
        public function GetNbParticipants($spo_id, $ses_id) {
            $this->connexion();

            $req = "SELECT COUNT(*) AS nb FROM t_historique
            JOIN t_utilisateur ON t_historique.his_utilisateur = t_utilisateur.uti_id
            JOIN t_session ON t_historique.his_session = t_session.ses_id
            WHERE t_utilisateur.uti_role = 2
            AND t_session.ses_sport = '".$spo_id."'
            AND t_session.ses_id = '".$ses_id."'";
            $res = mysqli_query($this->GetCnx(), $req);
            $ligne = mysqli_fetch_assoc($res);

            if ($ligne['nb'] != 0) {
                $resultat = $ligne;
            } else {
                $resultat = null;
            }

            $this->deconnexion();
            return $resultat;
        }
    }
?>