<?php
    /* Require la connexion et métier spécifique */
    require_once "m_generique.php";
    require_once "metiers/Utilisateur.php";

    class m_utilisateur extends m_generique {

        /* Retourne tout les utilisateurs en base */
        public function GetListe($offset, $nbElementsPage) {
            $resultat = array();
            $this->connexion();

            $req = "SELECT * FROM t_utilisateur LIMIT ".$offset.", ".$nbElementsPage."";
            $res = mysqli_query($this->GetCnx(), $req);
            $ligne = mysqli_fetch_assoc($res);

            while ($ligne) {
                $utilisateur = new Utilisateur($ligne['uti_id'], $ligne['uti_nom'], $ligne['uti_prenom'], $ligne['uti_mail'], $ligne['uti_mdp'], $ligne['uti_role']);
                $resultat[] = $utilisateur;

                $ligne = mysqli_fetch_assoc($res);
            }

            $this->deconnexion();
            return $resultat;
        }

        /*  */
        public function GetNbUtilisateur() {
            $this->connexion();

            $req = "SELECT COUNT(*) AS 'nb' FROM t_utilisateur";
            $res = mysqli_query($this->GetCnx(), $req);
            $ligne = mysqli_fetch_assoc($res);

            if ($ligne) {
                $resultat = $ligne['nb'];
            } else {
                $resultat = null;
            }

            $this->deconnexion();
            return $resultat;
        }

        /* Sélectionne toutes les information d'un utilisateur en particulier gràce à 'uti_mail' (mail utilisateur),
        * si enregistrement présent en base -> créer un objet utilisateur et le retourn
        * si non -> retourne null */
        public function GetUtilisateur($uti_mail) {
            $this->connexion();

            $req = "SELECT * FROM t_utilisateur WHERE uti_mail='".$uti_mail."'";
            $res = mysqli_query($this->GetCnx(), $req);
            $ligne = mysqli_fetch_assoc($res);

            if ($ligne) {
                $resultat = new Utilisateur($ligne['uti_id'], $ligne['uti_nom'], $ligne['uti_prenom'], $ligne['uti_mail'], $ligne['uti_mdp'], $ligne['uti_role']);
            } else {
                $resultat = null;
            }

            $this->deconnexion();
            return $resultat;
        }

        /* Sélectionne tout de t_utilisateur en détaillant 'uti_mail' (mail utilisateur) et 'uti_mdp' (mdp utilisateur) pour vérifier si enregistrement,
        * si oui -> retourne un objet de la classe Utilisateur avec tout ses paramètres
        * si non -> retourne null */
        public function VerifUtilisateur($uti_mail, $uti_mdp) {
            $this->connexion();

            $mail = mysqli_real_escape_string($this->GetCnx(), $uti_mail);
            $mdp = mysqli_real_escape_string($this->GetCnx(), $uti_mdp);

            $req = "SELECT * FROM t_utilisateur WHERE uti_mail='".$uti_mail."'";
            $res = mysqli_query($this->GetCnx(), $req);
            $ligne = mysqli_fetch_assoc($res);

            if ($ligne) {
                if (password_verify($mdp, $ligne['uti_mdp'])) {
                    $resultat = new Utilisateur($ligne['uti_id'], $ligne['uti_nom'], $ligne['uti_prenom'], $ligne['uti_mail'], $ligne['uti_mdp'], $ligne['uti_role']);
                } else {
                    $resultat = null;
                }
            } else {
                $resultat = null;
            }

            $this->deconnexion();
            return $resultat;
        }

        /* Échappe tout les variables et créer un objet de class Utilisateur avec par défaut 'uti_id' -> 0 (pas important) et 'uti_role' -> 2 (2 = participant (par défaut pour chaque inscrit)).
        * Envoie la requête au serveur,
        * Si pas ok (problème d'ajout) -> retourne null,
        * Si ok -> retourne l'objet de classe */
        public function AjoutUtilisateur($uti_nom, $uti_prenom, $uti_mail, $uti_mdp) {
            $this->connexion();

            $nom = mysqli_real_escape_string($this->GetCnx(), $uti_nom);
            $prenom = mysqli_real_escape_string($this->GetCnx(), $uti_prenom);
            $mail = mysqli_real_escape_string($this->GetCnx(), $uti_mail);
            $mdp = mysqli_real_escape_string($this->GetCnx(), $uti_mdp);

            $mdpHash = password_hash($mdp, PASSWORD_BCRYPT);

            $utilisateur = new Utilisateur(0, $nom, $prenom, $mail, $mdpHash, 2);

            $req = "INSERT INTO t_utilisateur (uti_nom, uti_prenom, uti_mail, uti_mdp) VALUES ('".$nom."', '".$prenom."', '".$mail."', '".$mdpHash."')";
            $ok = mysqli_query($this->GetCnx(), $req);

            if (!$ok) {
                $utilisateur = null;
            }

            $this->deconnexion();
            return $utilisateur;
        }
        
        /* Requête permettant de modifier toutes les informations de l'utilisateur reconnaissable par 'uti_id' (id utilisateur).
        * Envoie la requête au serveur,
        * Si pas ok (problème de modification) -> retourne false,
        * Si ok -> retourne true */
        public function ModifierUtilisateur($uti_id, $uti_nom, $uti_prenom, $uti_mail, $uti_role) {
            $this->connexion();

            $req = "UPDATE t_utilisateur SET
            uti_nom='".$uti_nom."',
            uti_prenom='".$uti_prenom."',
            uti_mail='".$uti_mail."',
            uti_role=".$uti_role."
            WHERE uti_id=".$uti_id."";
            
            $ok = mysqli_query($this->GetCnx(), $req);

            if (!$ok) {
                $modifie = false;
            } else {
                $modifie = true;
            }

            $this->deconnexion();
            return $modifie;
        }

        /* Requête permettant de supprimer un utilisateur reconnaissable par 'uti_mail' (mail utilisateur).
        * Envoie la requête au serveur,
        * Si pas ok (problème de suppression) -> retourne false,
        * Si ok -> retourne true */
        public function SupprimerUtilisateur($uti_mail) {
            $this->connexion();

            $req = "DELETE FROM t_utilisateur WHERE uti_mail = '".$uti_mail."'";
            $ok = mysqli_query($this->GetCnx(), $req);

            if (!$ok) {
                $succes = false;       
            } else {
                $succes = true;
            }

            $this->deconnexion();
            return $succes;
        }
    }
?>