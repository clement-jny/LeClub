<!-- Formulaire permettant d'ajouter un utilisateur à la base de données -->

<div class="gestionAjouter">
    <form action="index.php?page=gestionUtilisateurs&gestion=confirmationAjouter" method="post">
        <h3>Ajouter</h3>

        <div class="label-flottant">
            <input type="text" name="uti_nom" id="nom" placeholder="Nom" required />
            <label for="nom">Nom</label>
        </div>

        <div class="label-flottant">
            <input type="text" name="uti_prenom" id="prenom" placeholder="Prénom" required />
            <label for="prenom">Prénom</label>
        </div>

        <div class="label-flottant">
            <input type="email" name="uti_mail" id="mail" placeholder="Email" required />
            <label for="mail">Email</label>
        </div>

        <div class="label-flottant">
            <input type="password" name="uti_mdp" id="mdp" placeholder="Mot de passe" required />
            <label for="mdp">Mot de passe</label>
        </div>

        <input type="submit" value="Ajouter" />
    </form>
</div>