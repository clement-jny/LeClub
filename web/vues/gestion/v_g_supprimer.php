<!-- Formulaire permettant de supprimer un utilisateur -->
<!-- Ou repartir à l'affichage des utilisateurs si annulation -->

<div class="gestionSupprimer">
    <h3>Êtes vous sûr de supprimer cet utilisateur ?</h3>

    <div>
        <form action="index.php?page=gestionUtilisateurs&gestion=confirmationSupprimer" method="post">
            <input type="submit" value="Supprimer" />
            <input type="hidden" name="uti_mail" value="<?= $_POST['uti_mail']?>" />
        </form>

        <form action="index.php?page=gestionUtilisateurs&gestion=afficher" method="post">
            <input type="submit" value="Annuler" />
        </form>
    </div>
</div>



