<?php
    /* Renseigne chaque information de l'utilisateur sélectionné dans les variables correspondantes */
    $id = $this->data['uti_select']->GetId();
    $nom = $this->data['uti_select']->GetNom();
    $prenom = $this->data['uti_select']->GetPrenom();
    $mail = $this->data['uti_select']->GetMail();
    $mdp = $this->data['uti_select']->GetMdp();
    $role = $this->data['uti_select']->GetRole();
?>

<!-- Formulaire permettant de modifier un utilisateur sélectionné -->

<div class="gestionModifier">
    <form action="index.php?page=gestionUtilisateurs&gestion=confirmationModifier" method="post">
        <input type="hidden" name="uti_id" value="<?= $id; ?>" />

        <h3>Modifier</h3>

        <div class="label-flottant">
            <input type="text" name="uti_nom" id="nom" value="<?= $nom; ?>" placeholder="Nom" required />
            <label for="nom">Nom</label>
        </div>

        <div class="label-flottant">
            <input type="text" name="uti_prenom" id="prenom" value="<?= $prenom; ?>" placeholder="Prénom" required />
            <label for="prenom">Prénom</label>
        </div>

        <div class="label-flottant">
            <input type="email" name="uti_mail" id="mail" value="<?= $mail; ?>" placeholder="Email" required />
            <label for="mail">Email</label>
        </div>

        <div class="label">
            <label for="role">Rôle : </label>

            <select name="uti_role" id="role">
            <?php
                /* Liste déroulante permettant d'afficher chaque rôle */
                foreach($this->data['lesRoles'] as $unRole)
                {
                    if ($role == $unRole->GetId()) {
                        echo "<option value='".$unRole->GetId()."' selected>";
                            echo $unRole->GetId()." - ".$unRole->GetLibelle();
                        echo "</option>";
                    } else {
                        echo "<option value='".$unRole->GetId()."'>";
                            echo $unRole->GetId()." - ".$unRole->GetLibelle();
                        echo "</option>";
                    }
                }
            ?>
            </select>
        </div>
                
        <input type="submit" value="Modifer" />
    </form>
</div>