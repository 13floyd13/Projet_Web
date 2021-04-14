<link rel="stylesheet" href="../view/design/global.css">
<link rel="stylesheet" href="../view/design/actus.css">
<div id="actus">
    <title>Main page</title>
    <?php
    include("nav.view.php");
    $flux = "https://www.lemonde.fr/rss/une.xml";
    include("../controler/afficher_nouvelles_flux_selectionne.ctrl.php");
    ?>
</div>