<!-- Tableau affichant les sports proposé par le site -->

<div class="listeSports">
    <h2>Ici tous les sports auxquelles vous pourrez participé grâce à notre association</h2>
    <h3>Un sport en particulier vous tente ? N'hésitez plus !</h3>

    <br />

    <!-- Création d'un tableau -->
    <table class="tableau">

        <!-- Boucle sur les sports disponible de la base -->
<?php foreach ($this->data['lesSports'] as $unSport) { ?>
        <tr>
                <!-- Nom du sport dans la première cellule -->
            <td><?= $unSport->GetLibelle(); ?></td>

                <!-- Rend accessible à une personne connecté qui n'est pas considéré comme admin de poursuivre -->
        <?php if (isset($_SESSION['utilisateur']) && $_SESSION['utilisateur']->GetRole() != 3){ ?>
            <td>
                <!-- Envoie vers la page permettant d'afficher les sessions disponible par rapport au sport -->
                <form action="index.php?page=informationsSport" method="post">
                    <button type="submit" name="spo_id" value="<?= $unSport->GetId(); ?>">Consulter</button>
                </form>
            </td>
        <?php } ?>

        </tr>
<?php } ?>
    </table>

    <?php /* Si pas connecté, message */
        if (empty($_SESSION['utilisateur'])) {
            echo "<p>Vous n'êtes malheursement pas connecté pour pouvoir s'inscrire à des sessions.</p>";
        }
    ?>
</div>