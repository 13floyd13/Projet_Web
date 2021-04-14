<title>Main page</title>
<link rel="stylesheet" href="../view/design/main.css">
<script>
  function openNav() {
    document.getElementById("mySidenav").style.width = "15%";
  }
  function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
  }
  function openWorld() {
    document.getElementById("world").style.width = "50%";
  }
  function closeWorld() {
    document.getElementById("world").style.width = "0";
  }
  function openTech() {
    document.getElementById("tech").style.width = "50%";
  }
  function closeTech() {
    document.getElementById("tech").style.width = "0";
  }
</script>

<div id="hamburger" onclick="openNav()">
  <div class="menuBar"></div>
  <div class="menuBar"></div>
  <div class="menuBar"></div>
</div>

<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <p>Bonjour <?= $_SESSION['login'] ?></p>
    <?php
    require ("../controler/ajouter_flux.ctrl.php");
    ?>
  <a href="#">Tous les flux</a>
  <a href="#">Non lus</a>
  <a href="#">Favoris</a>
  <a href="#">Catégories</a>
  <ul>
      <?php
        $flux_utilisateurDAO = new Flux_utilisateurDAO();
        $fluxs_utilisateur = $flux_utilisateurDAO->getFlux_utilisateurByLogin($_SESSION['login']);
        var_dump($fluxs_utilisateur);
        foreach ($fluxs_utilisateur as $flux_utilisateur) { ?>
            <li><form action="../controler/supprimer_flux_utilisateur.ctrl.php" method="post">
                    <input type="hidden" id="url" value="<?= $flux_utilisateur->getNom() ?>">
                    <input class="supprimer" type="submit" value="&times;">
                </form>
                <a href="#" onclick="closeNav(), openWorld(), closeTech()">World News</a>
            </li>
        <?php } ?>
  </ul>
  <a class="account" href="../view/account.view.php">&#128100;</a>
</div>