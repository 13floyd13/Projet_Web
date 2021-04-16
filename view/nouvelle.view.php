<article class="nouvelle">
    <img src="<?= $nouvelle->getImage() ?>" alt="">
    <?php
    if (!isset($_SESSION)) {
      session_start();
    }

    $lien = $nouvelle->getLien();
    $message = "<h3>" . $nouvelle->getTitre() . "</h3>";
    require("../controler/ouvrir_article_dans_onglet.ctrl.php");

    require_once("../model/flux_utilisateurDAO_class.php");
    $flux_utilisateurDAO = new Flux_utilisateurDAO();
    $nom_flux_utilisateur = "";
    try {
        $nom_flux_utilisateur = $flux_utilisateurDAO->getNomFlux_utilisateur($nouvelle->getFlux(), $_SESSION['login'])->getNom();
    } catch (TypeError $t) {}
    ?>
    <p class="dateAuteur"><?= strftime("%d-%m-%Y %H:%M", strtotime($nouvelle->getDate())) ?>
        &#8729; <?= $nom_flux_utilisateur ?></p>
    <p class="description"><?= $nouvelle->getDescription() ?></p>
    <?php
        $lien = $nouvelle->getLien();
        $message = "Lien vers l'article";
        require("../controler/ouvrir_article_dans_onglet.ctrl.php");
    ?>
</article>
