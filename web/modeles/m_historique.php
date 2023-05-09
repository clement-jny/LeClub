<?php
    /* Require la connexion et métier spécifique */
    require_once "m_generique.php";
    require_once "metiers/Historique.php";

    class m_historique extends m_generique {

        /* Retourne deux cases de tableaux,
        * une spécifiant le libelle de sport ainsi que sa date de session
        * l'autre représentant la date d'inscription pour ce même sport.
        * C'est l'historique des sessions de l'utilisateurs définie par 'his_utilisateur' (id utilisateur) */
        public function GetHistorique($his_utilisateur) {
            $resultat = array();
            $this->connexion();

            /* DATE_FORMAT(ses_date, '%d/%m/%Y') AS , DATE_FORMAT(his_date, '%d/%m/%Y') AS */
            $req = "SELECT spo_libelle, ses_date, his_date FROM t_sport
            JOIN t_session ON t_session.ses_sport = t_sport.spo_id
            JOIN t_historique ON t_historique.his_session = t_session.ses_id
            JOIN t_utilisateur ON t_utilisateur.uti_id = t_historique.his_utilisateur
            WHERE t_utilisateur.uti_id = '".$his_utilisateur."'";
            $res = mysqli_query($this->GetCnx(), $req);
            $ligne = mysqli_fetch_assoc($res);

            while ($ligne) {
                $historique = "<td>".$ligne['spo_libelle']." - ".Utils::convertDateToFr($ligne['ses_date'])."</td><td>".Utils::convertDateToFr($ligne['his_date'])."</td>";
                $resultat[] = $historique;

                $ligne = mysqli_fetch_assoc($res);
            }

            $this->deconnexion();
            return $resultat;
        }

        /* Sélectionne tout de t_historique en détaillant 'his_session' (id de session) et 'his_utilisateur' (id utilisateur) pour vérifier si enregistrement,
        * si oui -> retourne un objet de la classe Historique avec tout ses paramètres
        * si non -> retourne null */
        public function VerifHistorique($his_session, $his_utilisateur) {
            $this->connexion();

            $req = "SELECT * FROM t_historique WHERE his_session='".$his_session."' AND his_utilisateur='".$his_utilisateur."'";
            $res = mysqli_query($this->GetCnx(), $req);
            $ligne = mysqli_fetch_assoc($res);

            if ($ligne) {
                $resultat = new Historique($ligne['his_session'], $ligne['his_utilisateur'], $ligne['his_date']);
            } else {
                $resultat = null;
            }

            $this->deconnexion();
            return $resultat;
        }

        /* Créer un objet de la classe Historique avec les paramètres définie et 'his_date' qui recupère la date et l'heure du jour.
        * Envoie la requête au serveur,
        * Si pas ok (problème) -> retourne null,
        * Si ok -> retourne l'objet de classe */
        public function AjoutHistorique($his_session, $his_utilisateur) {
            $this->connexion();

            $his_date = Utils::getDateTimeToday();

            $historique = new Historique($his_session, $his_utilisateur, $his_date);
            $req = "INSERT INTO t_historique VALUES ('".$his_session."', '".$his_utilisateur."', '".$his_date."')";
            $ok = mysqli_query($this->GetCnx(), $req);

            if (!$ok) {
                $historique = null;
            }

            $this->deconnexion();
            return $historique;
        }
    }
?>