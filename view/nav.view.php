<?php
session_start();
?>



<div id="nav">
  <p>Bonjour <?= $_SESSION['login'] ?></p>
    <a class="account" href="../controler/actus.ctrl.php?account=page">&#128100;</a>
    <?php
    require ("../controler/ajouter_flux.ctrl.php");
    ?>
    <hr>
  <a href="../controler/actus.ctrl.php">Tous les flux</a>
  <a href="#">Non lus</a>
  <a href="#">Favoris</a>
  <a href="#">Catégories</a>
  <ul>
      <?php
        $flux_utilisateurDAO = new Flux_utilisateurDAO();
        $fluxs_utilisateur = $flux_utilisateurDAO->getFlux_utilisateurByLogin($_SESSION['login']);
        foreach ($fluxs_utilisateur as $flux_utilisateur) { ?>
            <li><form action="../controler/actus.ctrl.php" method="POST">
                    <input type="hidden" id="url" name="url" value="<?= $flux_utilisateur->getFlux() ?>">
                    <input class="supprimer" type="submit" value="&times;">
                </form>
                <a href="../controler/actus.ctrl.php?flux=<?= $flux_utilisateur->getNom() ?>"><?= $flux_utilisateur->getNom() ?></a>
            </li>
        <?php } ?>
  </ul>
</div>