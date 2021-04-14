<article>
    <img src="<?= $nouvelle->getImage() ?>" alt="image article">
    <h3><?= $nouvelle->getTitre() ?></h3>
    <p><?= $nouvelle->getDescription() ?></p>
    <?= require_once("../controler/ouvrir_article_dans_onglet.ctrl.php") ?>
</article>