<form action="" method="post">
    <input type="text" name="mdp" placeholder="mdp" />
    <input type="submit" value="Convertir" name="convertir" />
</form>

<?php
    if (isset($_POST['convertir'])) {
        $mdp = $_POST['mdp'];

        $mpdHash = password_hash($mdp, PASSWORD_BCRYPT);

        echo $mpdHash;
    }
?>


<form action="" method="post">
    <input type="text" name="mdp2" placeholder="mdp" />
    <input type="text" name="hash" placeholder="hash" />
    <input type="submit" value="Vérifier" name="verifier" />
</form>

<?php
    if (isset($_POST['verifier'])) {
        $mdp = $_POST['mdp2'];

        //$mpdHash = password_hash($mdp, PASSWORD_BCRYPT);

        if (password_verify($mdp, $_POST['hash'])) {
            echo 'password identique';
        } else {
            echo 'password pas identique';
        }

    }

?>

