<!-- Bloc menu afficher constemment sur la gauche du site -->

<nav>
	<ul>
		<!-- Envoie vers l'accueil -->
		<a href="index.php"><h1>Le Club.</h1></a>

		<hr />

		<!-- Envoie vers la liste des sports -->
		<form action="index.php" method="get">
			<input type="hidden" name="page" value="listeSports" />
			<input type="submit" value="Afficher tous les sports" />
		</form>

		<hr />

<?php /* Si pas connecté, affiche boutton d'inscription et de connexion */
	if (empty($_SESSION['utilisateur'])) {
?>
		<form action="index.php" method="get">
			<input type="submit" value="Inscription" />
			<input type="hidden" name="page" value="inscription" />
		</form>

		<form action="index.php" method="get">
			<input type="submit" value="Connexion" />	
			<input type="hidden" name="page" value="connexion" />
		</form>
<?php /* Si connexion par l'admin, affiche boutton de gestion des utilisateurs et de déconnexion */
	} elseif ($_SESSION['utilisateur']->GetRole() == 3) {
?>
		<form action="index.php" method="get">
			<input type="submit" value="Gestion utilisateurs" />	
			<input type="hidden" name="page" value="gestionUtilisateurs" />
			<input type="hidden" name="gestion" value="afficher" />
		</form>

		<form action="index.php" method="get">
			<input type="submit" value="Deconnexion" />	
			<input type="hidden" name="page" value="deconnexion" />
		</form>
<?php /* Si connexion par participant/animateur, affiche boutton espace membre et de déconnexion */
	} else {
?>
		<form action="index.php" method="get">
			<input type="submit" value="Espace membre" />	
			<input type="hidden" name="page" value="espaceMembre" />
		</form>

		<form action="index.php" method="get">
			<input type="submit" value="Deconnexion" />	
			<input type="hidden" name="page" value="deconnexion" />
		</form>
<?php
	}
?>
	</ul>
</nav>
