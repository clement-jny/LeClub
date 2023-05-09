<?php
    /* Require les modèles nécessaire */
    require_once "modeles/m_sport.php";
    require_once "modeles/m_session.php";
    require_once "modeles/m_historique.php";

    class c_sport {
        /* Champs privé nécessaire à la classe */
        private $data;
        private $modeleSport;
        private $modeleSession;
        private $modeleHistorique;

        /* Constructeur de la classe et instanciation les variables */
        public function __construct() {
            $this->data = array();
            $this->modeleSport = new m_sport();
            $this->modeleSession = new m_session();
            $this->modeleHistorique = new m_historique();
        }

        /* Affiche tous les sports
        * Injecte le retour de la fonction 'GetListe' dans le tableau data à la clé 'lesSports',
        * appelle la vue 'v_listeSports' */
        public function action_afficherListeSport() {
            $this->data['lesSports'] = $this->modeleSport->GetListe();
            require_once "vues/v_listeSports.php";
        }

        /* Affiche les sessions du sport demandé avec son id 'spo_id'
        * Injecte le retour des fonctions 'GetSport' et 'GetListe' dans le tableau data à la clé 'leSport' et 'lesSessions',
        * appelle la vue 'v_informationsSport' */
        public function action_afficherInformationsSport($spo_id) {
            $this->data['leSport'] = $this->modeleSport->GetSport($spo_id);
            $this->data['lesSessions'] = $this->modeleSession->GetListe($spo_id);
            require_once "vues/v_informationsSport.php";
        }

        /* Affiche les informations pour s'inscrire à la session du sport demandé
        * Injecte le retour de la 'GetSport' dans le tableau data à la clé 'leSport',
        * l'id, la date et l'heure de la session voulu dans 'laSessionId', 'laSessionDate' et 'laSessionHeure'
        *
        * Récupère le retour de 'GetListeAnimateurs', si null -> pas encore d'animateurs ; si non -> recupère les animateurs
        *
        * Récupère le retour de 'GetListeParticipants', si null -> pas encore de participants ; si non -> recupère les participants
        *
        * Récupère le retour de 'GetNbParticipants', si null -> 0 (zèro participant) ; si non -> recupère le nombre de participant
        * appelle la vue 'v_inscriptionSport' */
        public function action_afficherInscriptionSport($spo_id, $ses_id, $ses_date, $ses_heure) {
            $this->data['leSport'] = $this->modeleSport->GetSport($spo_id);
            $this->data['laSessionId'] = $ses_id;
            $this->data['laSessionDate'] = $ses_date;
            $this->data['laSessionHeure'] = $ses_heure;
            
            $lesAnimateurs = $this->modeleSession->GetListeAnimateurs($spo_id, $ses_id);
            if (is_null($lesAnimateurs)) {
                $this->data['lesAnimateurs'] = "Pas encore d'animateur attribué à cette session";
            } else {
                $this->data['lesAnimateurs'] = $lesAnimateurs;
            }

            $lesParticipants = $this->modeleSession->GetListeParticipants($spo_id, $ses_id);
            if (is_null($lesParticipants)) {
                $this->data['lesParticipants'] = "Pas encore de participants inscrits à cette session";
            } else {
                $this->data['lesParticipants'] = $lesParticipants;
            }

            $nbParticipants = $this->modeleSession->GetNbParticipants($spo_id, $ses_id);
            if (is_null($nbParticipants)) {
                $this->data['nbParticipants'] = 0;
            } else {
                $this->data['nbParticipants'] = $nbParticipants;
            }
            
            require_once "vues/v_inscriptionSport.php";
        }

        /* Vérifie si 'placeRes' (place restante) est égal à 0 ou non
        * si oui -> message d'erreur
        * si non -> continue
        *    Vérifie si la fonction 'VerifHistorique' retourne null ou non
        *    si null -> message d'erreur spécifiant que l'utilisateur participe déjà à la session voulu
        *    si non -> recupère le retour de la fonction 'AjoutHistorique' dans $historique
        *       si $historique est null -> m'essage d'erreur
        *       si non -> message de succes pour préciser que l'inscription est effectuée
        * Appelle la vue 'v_message' */
        public function action_confirmerInscriptionSport($his_session, $his_utilisateur, $placeRes) {
            if ($placeRes == 0) {
                $this->data['leMessage'] = "Inscription à la session impossible, il ne reste plus de place.";
            } else {
                if (is_null($this->modeleHistorique->VerifHistorique($his_session, $his_utilisateur))) {
                    $historique = $this->modeleHistorique->AjoutHistorique($his_session, $his_utilisateur);
                    
                    if (is_null($historique)) {
                        $this->data['leMessage'] = "L'inscription a échoué pour une raison indéterminé.";
                    } else {
                        $this->data['leMessage'] = "Inscription bien effectué.";
                    }
                } else {
                    $this->data['leMessage'] = "Inscription déjà faite.";
                }
            }
            
            require_once "vues/v_message.php";
        }
    }
?>