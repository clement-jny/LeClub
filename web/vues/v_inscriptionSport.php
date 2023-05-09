<!-- Page permettant de s'inscrire à une session choisie pour un sport -->

<div class="inscriptionSport">
    <h2>Récapitulatif</h2>
    <br />
    <?php
    //integer
    $mot = ($_SESSION['utilisateur']->GetRole() == 1) ? "Animer" : "Participer";

    $placeMax = intval($this->data['leSport']->GetNbmax());

    if (is_array($this->data['nbParticipants'])) {
        //integer
        $placeOcc = intval($this->data['nbParticipants']['nb']);
    } else {
        //integer
        $placeOcc = $this->data['nbParticipants'];
    }

    $placeRes = $placeMax - $placeOcc;
    ?>

    <p>Sport : <?= $this->data['leSport']->GetLibelle(); ?></p>
    <p>Session du <?= Utils::convertDateToFr($this->data['laSessionDate']); ?> à <?= $this->data['laSessionHeure']; ?></p>
    <br />

    <?php
    if (is_array($this->data['lesAnimateurs'])) {
        echo "<p>Animateur(s) : ".implode(", ", $this->data['lesAnimateurs'])."</p>";
    } else {
        echo "<p>".$this->data['lesAnimateurs']."</p>";
    }

    if (is_array($this->data['lesParticipants'])) {
        echo "<p>Participant(s) : ".implode(", ", $this->data['lesParticipants'])."</p>";
    } else {
        echo "<p>".$this->data['lesParticipants']."</p>";
    }
    ?>

    <br/>
    <p>Places restantes : <?= $placeRes ?></p>
    <br />

    <form action="index.php?page=confirmationSport" method="post">
        <input type="hidden" name="his_utilisateur" value="<?= $_SESSION['utilisateur']->GetId(); ?>" />
        <input type="hidden" name="his_session" value="<?= $this->data['laSessionId']; ?>" />
        <input type="hidden" name="placeRes" value="<?= $placeRes; ?>" />
        <input type="submit" value="<?= $mot; ?>" />
    </form>
</div>