<?php
if(!isset($_SESSION)){
    session_start();
}
?>



<div id="nav">
  <p>Bonjour <?= $_SESSION['login'] ?></p>
    <div id="barre_raccourcis">
        <a class="raccourcis" href="../controler/actus.ctrl.php?account=page">&#128100;</a>
        <a class="raccourcis" href="../controler/login.ctrl.php?logout=true">&#9211;</a>
    </div>

    <?php
    require("../controler/ajouter_flux.ctrl.php");

    if (isset($erreur_nom_flux) && $erreur_nom_flux == true) {
        print "<p class='erreur'>Ce nom est déjà utilisé par un autre flux</p>";
    } else if (isset($erreur_url_flux) && $erreur_url_flux == true) {
        print "<p class='erreur'>Ce flux est déjà dans votre liste</p>";
    }
    ?>
    <hr>
  <a href="../controler/actus.ctrl.php">Tous les flux</a>
  <a href="#">Non lus</a>
  <a href="#">Favoris</a>
  <a href="#">Catégories</a>
  <ul>
      <?php
      require_once ("../controler/actualisation_flux.php");
        $flux_utilisateurDAO = new Flux_utilisateurDAO();
        $fluxs_utilisateur = $flux_utilisateurDAO->getFlux_utilisateurByLogin($_SESSION['login']);
        foreach ($fluxs_utilisateur as $flux_utilisateur) { ?>
            <li><form action="../controler/actus.ctrl.php" method="POST">
                    <input type="hidden" id="url_a_supprimer" name="url_a_supprimer" value="<?= $flux_utilisateur->getFlux() ?>">
                    <input class="supprimer" type="submit" value="&times;">
                </form>
                <a href="../controler/actus.ctrl.php?flux=<?= $flux_utilisateur->getNom() ?>"><?= $flux_utilisateur->getNom() ?></a>
            </li>
        <?php } ?>
  </ul>
</div>