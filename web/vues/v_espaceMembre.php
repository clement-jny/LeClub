<!-- Espace membre de l'utilisateur courant permettant de voir ses sessions participées -->

<div class="espaceMembre">
    <h2>Bienvenue sur votre page <?= $_SESSION['utilisateur']->GetNom()." ".$_SESSION['utilisateur']->GetPrenom(); ?></h2>

    <?php $mot = ($_SESSION['utilisateur']->GetRole() == 1) ? "animée(s)" : "participée(s)" ;?>
    
    <p>Vos sessions <?= $mot; ?> : </p>
    <table class="tableau">
        <tr>
            <th>Session</th>
            <th>Inscrit le</th>
        </tr>

        <?php
        /* Bouble permettant d'afficher les sessions inscrites de l'utilisateur */
        foreach ($this->data['historiqueUtilisateur'] as $uneSession) {
            echo '<tr>';
                echo $uneSession;
            echo '</tr>';   
        }
        ?>

    </table>

    <?php
        if ($_SESSION['utilisateur']->GetRole() == 2) {
            echo '<p>Pour devenir animateur, veuillez nous contacter par mail.</p>';
        }
    ?>
</div>