<!-- Page affichant les sessions disponible pour le sport choisi -->

<div class="informationsSport">
    <!-- Indique le nom du sport -->
    <h2>Prochaine session pour le sport : <?= $this->data['leSport']->GetLibelle(); ?></h2>
    <h3>Veuillez choisir une session :</h3>

    <br />

        <!-- Aucune session trouvé -->
<?php if (empty($this->data['lesSessions'])) { ?>
        <p>Il n'y a pas de prochaine session pour ce sport, veuillez revenir plus tard.</p>
<?php
    } else {
        /* Boucle sur les sessions trouvées en affichant la date et l'heure */
        foreach ($this->data['lesSessions'] as $uneSession) {
?>
            <form action="index.php?page=inscriptionSport" method="post">
                <button type="submit" name="ses_id" value="<?= $uneSession->GetId(); ?>">
                    <?php echo Utils::convertDateToFr($uneSession->GetDate())." à ".$uneSession->GetHeure(); ?>
                </button>
                <input type="hidden" name="ses_date" value="<?= $uneSession->GetDate(); ?>" />
                <input type="hidden" name="ses_heure" value="<?= $uneSession->GetHeure(); ?>" />
                <input type="hidden" name="spo_id" value="<?= $this->data['leSport']->GetId(); ?>">
            </form>
<?php
        }
    }
?>
</div>