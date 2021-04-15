<article class="nouvelle">
    <img src="<?= $nouvelle->getImage() ?>" alt="image article">
    <?php
    $lien = $nouvelle->getLien();
    $message = "<h3>" . $nouvelle->getTitre() . "</h3>";
    require_once("../controler/ouvrir_article_dans_onglet.ctrl.php");
    ?>
    <p><?= $nouvelle->getDescription() ?></p>
    <?php
        $lien = $nouvelle->getLien();
        $message = "Lien vers l'article";
        require_once("../controler/ouvrir_article_dans_onglet.ctrl.php");
    ?>
</article>