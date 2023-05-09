<!-- Tableau recensant les utilisateurs inscrit au site -->

<div class="gestionUtilisateurs">
    <h1>Tous les utilisateurs inscrit a notre site : <?= $this->data['nbUtilisateurs']; ?> personnes.</h1>
    

    <a class="ajouter" href="index.php?page=gestionUtilisateurs&gestion=ajouter">Ajouter</a>

    <!-- Création d'un tableau -->
    <table class="tableau">
        <tr>
            <th>Id</th>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Mail</th>
            <th>Mdp</th>
            <th>Role</th>
            <th colspan="2">Action</th>
        </tr>

<?php
    /* Bouble sur les utilisateurs de la base */
    foreach($this->data['lesUtilisateurs'] as $unUtilisateur)
    {
        /* Permet de retrouver le rôle de chaque utilisateur et de le stocker dans une variable */
        $uti_role = null;
        foreach ($this->data['lesRoles'] as $unRole) {
            if ($unUtilisateur->GetRole() == $unRole->GetId()) {
                $uti_role = $unUtilisateur->GetRole()." - ".$unRole->GetLibelle();
            }
        }
?>
            <!-- Remplissage cellule du tableau -->
        <tr>
            <td><?= $unUtilisateur->GetId(); ?></td>
            <td><?= $unUtilisateur->GetNom(); ?></td>
            <td><?= $unUtilisateur->GetPrenom(); ?></td>
            <td><?= $unUtilisateur->GetMail(); ?></td>
            <td><?= Utils::hidePassword($unUtilisateur->GetMdp()); ?></td>

            <td>
                <?php
                echo $uti_role;
                ?>
            </td>


            <td>
                <form action="index.php?page=gestionUtilisateurs&gestion=modifier" method="post">
                    <button type="submit" name="uti_mail" value="<?= $unUtilisateur->GetMail(); ?>">Modifier</button>
                </form>
            </td>

            <td>
                <form action="index.php?page=gestionUtilisateurs&gestion=supprimer" method="post">
                    <button type="submit" name="uti_mail" value="<?= $unUtilisateur->GetMail(); ?>">Supprimer</button>
                </form>
            </td>
        </tr>
<?php
    }
?>
    </table>

    <!-- Système de pagination -->
    <?php
        echo '<div class="center">';
            echo '<div class="pagination">';
                
            for ($i=1; $i <= $this->data['nbPages'] ; $i++) { 
                echo "<a href='?page=gestionUtilisateurs&gestion=afficher&pagination=".$i."'>".$i."</a>";
            }
                
            echo '</div>';
        echo '</div>';
    ?>
</div>