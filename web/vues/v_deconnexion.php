<!-- Permet la deconnexion de l'utilisateur courant en cliquant sur le boutton 'deconnexion' -->

<?php
    session_unset();
    session_destroy();
    header('Refresh: 2; URL=index.php');
?>
<p>Vous êtes correctement déconnecter, vous allez être redirigé vers la page d'accueil.</p>