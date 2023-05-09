<!-- Formulaire de connexion visible par tout le monde en cliquant sur le boutton du menu 'connexion' -->

<div class="connexion">
    <!-- Form en POST dirigeant vers index.php?page=confirmationConnexion -->
    <form action="index.php?page=confirmationConnexion" method="post">
        <h3>Connexion</h3>

        <div class="label-flottant">
            <input type="email" name="uti_mail" id="mail" placeholder="Email" required />
            <label for="mail">Email</label>
        </div>

        <div class="label-flottant">
            <input type="password" name="uti_mdp" id="mdp" placeholder="Mot de passe" required />
            <label for="mdp">Mot de passe</label>
        </div>

        <input type="submit" value="Se connecter" />            
    </form>
</div>