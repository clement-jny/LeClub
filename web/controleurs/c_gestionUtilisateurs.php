<?php
    /* Require le modèle nécessaire */
    require_once "modeles/m_utilisateur.php";
    require_once "modeles/m_role.php";

    class c_gestionUtilisateurs {
        /* Champs privé nécessaire à la classe */
        private $data;
        private $modeleUtilisateur;
        private $modeleRole;

        private $nbElementsPage = 10;

        /* Constructeur de la classe et instanciation les variables */
        public function __construct() {
            $this->data = array();
            $this->modeleUtilisateur = new m_utilisateur();
            $this->modeleRole = new m_role();
        }

        /* Affiche tous les utilisateurs de présent en base dans le vue 'v_gestionUtilisateurs'
        * 'lesUtilisateurs' contients tous les utilisateurs
        * 'lesRoles' contients tous les rôles */
        public function action_afficher($pagination) {
            $nbPages = ceil($this->modeleUtilisateur->GetNbUtilisateur()/$this->nbElementsPage);
            $offset = ($pagination - 1)*$this->nbElementsPage; 

            $this->data['lesUtilisateurs'] = $this->modeleUtilisateur->GetListe($offset, $this->nbElementsPage);
            $this->data['lesRoles'] = $this->modeleRole->GetListe();
            $this->data['nbUtilisateurs'] = $this->modeleUtilisateur->GetNbUtilisateur();
            $this->data['nbPages'] = $nbPages;

            require_once "vues/v_gestionUtilisateurs.php";
        }


        /* Affiche la vue d'ajout utilisateur */
        public function action_vueAjouter() {
            require_once "vues/gestion/v_g_ajouter.php";
        }

        /* Vérifie si la fonction 'VerifUtilisateur' retourne null ou non
        * si null -> message d'erreur spécifiant que l'utilisateur est déjà présent
        * si non -> recupère le retour de la fonction 'AjoutUtilisateur' dans $utilisateur
        *   si $utilisateur est null -> m'essage d'erreur
        *   si non -> message de succes pour préciser que l'inscription est effectuée
        * Appelle la vue 'v_message' et redirige sur la gestion des utilisateurs après 2s */
        public function action_ajouter($uti_nom, $uti_prenom, $uti_mail, $uti_mdp) {
            if (is_null($this->modeleUtilisateur->VerifUtilisateur($uti_mail, $uti_mdp))) {
                $utilisateur = $this->modeleUtilisateur->AjoutUtilisateur($uti_nom, $uti_prenom, $uti_mail, $uti_mdp);

                if (is_null($utilisateur)) {
                    $this->data['leMessage'] = "L'ajout a échoué pour une raison indéterminé.";
                } else {
                    $this->data['leMessage'] = "L'utilisateur '".$utilisateur->GetNom()." ".$utilisateur->GetPrenom()."' à bien été ajouté en base. Redirection sur la gestion des utilisateurs";
                    header("Refresh: 2; URL=index.php?page=gestionUtilisateurs&gestion=afficher");
                }
            } else {
                $this->data['leMessage'] = "Inscription impossible, utilisateur déjà en base.";
            }

            require_once "vues/v_message.php";
        }


        /* Affiche la vue de modification d'utilisateur.
        * La clé 'uti_select' du tableau contient l'utilisateur sélectionné, récupéré au-préalable avec toutes ses informations
        * La clé 'lesRoles' contient tous les rôles de la base */
        public function action_vueModifier($uti_mail) {
            $this->data['uti_select'] = $this->modeleUtilisateur->GetUtilisateur($uti_mail);
            $this->data['lesRoles'] = $this->modeleRole->GetListe();
            require_once "vues/gestion/v_g_modifier.php";
        }

        /* Récupère le retour de 'ModifierUtilisateur',
        * si true -> message de succes
        * si false -> message d'erreur 
        * Appelle vue 'v_message' et redirige sur la gestion des utilisateurs après 2s */
        public function action_modifier($uti_id, $uti_nom, $uti_prenom, $uti_mdp, $uti_role) {

            $modifier = $this->modeleUtilisateur->ModifierUtilisateur($uti_id, $uti_nom, $uti_prenom, $uti_mdp, $uti_role);
            if ($modifier) {
                $this->data['leMessage'] = "Utilisateur modifier avec succès. Redirection sur la gestion des utilisateurs";
                header("Refresh: 2; URL=index.php?page=gestionUtilisateurs&gestion=afficher");
            }else{
                $this->data['leMessage'] = "Modification échoué pour une raison inderterminé";
            }
            require_once "vues/v_message.php";
        }


        /* Affiche la vue de suppression d'utilisateur */
        public function action_vueSupprimer() {
            require_once "vues/gestion/v_g_supprimer.php";
        }

        /* Récupère le retour de 'SupprimerUtilisateur',
        * si true -> message de succes
        * si false -> message d'erreur 
        * Appelle vue 'v_message' et redirige sur la gestion des utilisateurs après 2s */
        public function action_supprimer($uti_mail) {
            $supprimer = $this->modeleUtilisateur->SupprimerUtilisateur($uti_mail);

            if ($supprimer) {
                $this->data['leMessage'] = "Utilisateur supprimé avec succès. Redirection sur la gestion des utilisateurs";
                header("Refresh: 2; URL=index.php?page=gestionUtilisateurs&gestion=afficher");
            }else
            {
                $this->data['leMessage'] = "La suppression a échoué pour une raison indéterminé";
            }
            require_once "vues/v_message.php";
        }
    }
?>