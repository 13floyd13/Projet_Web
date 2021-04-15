<link rel="stylesheet" href="../view/design/global.css">
<link rel="stylesheet" href="../view/design/body.css">
<link rel="stylesheet" href="../view/design/nav.css">
<div id="body">
    <title>Main page</title>
    <?php
    require_once("../controler/supprimer_flux_utilisateur.ctrl.php");
    include("../view/nav.view.php");
    include("../controler/selection_nouvelles.ctrl.php");
    ?>
</div>