<link rel="stylesheet" href="../view/design/nouvelle.css">
<article class="nouvelle">
    <img src="<?= $nouvelle->getImage() ?>" alt="image article">
    <h3><?= $nouvelle->getTitre() ?></h3>
    <p><?= $nouvelle->getDescription() ?></p>
    <?php
        $lien = $nouvelle->getLien();
        require_once("../controler/ouvrir_article_dans_onglet.ctrl.php");
    ?>
</article>