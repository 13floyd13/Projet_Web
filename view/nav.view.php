<?php
session_start();
?>


<link rel="stylesheet" href="../view/design/nav.css">
<div id="nav">
  <p>Bonjour <?= $_SESSION['login'] ?></p>
    <?php
    require ("../controler/ajouter_flux.ctrl.php");
    ?>
    <hr>
  <a href="../controler/selection_nouvelles.ctrl.php">Tous les flux</a>
  <a href="#">Non lus</a>
  <a href="#">Favoris</a>
  <a href="#">Catégories</a>
  <ul>
      <?php
        $flux_utilisateurDAO = new Flux_utilisateurDAO();
        $fluxs_utilisateur = $flux_utilisateurDAO->getFlux_utilisateurByLogin($_SESSION['login']);
        foreach ($fluxs_utilisateur as $flux_utilisateur) { ?>
            <li><form action="nav.view.php" method="post">
                    <input type="hidden" id="url" value="<?= $flux_utilisateur->getNom() ?>">
                    <input class="supprimer" type="submit" value="&times;">
                </form>
                <a href="../controler/selection_nouvelles.ctrl.php&flux=<?= $flux_utilisateur->getNom() ?>"><?= $flux_utilisateur->getNom() ?></a>
            </li>
        <?php } ?>
  </ul>
  <a class="account" href="../view/account.view.php">&#128100;</a>
</div>