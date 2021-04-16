<link rel="stylesheet" href="../view/design/global.css">
<link rel="stylesheet" href="../view/design/body.css">
<link rel="stylesheet" href="../view/design/nav.css">
<div id="body">
    <title>Main page</title>
    <?php
    if (isset($_POST['i_url']) && !empty($_POST['i_url'])) {
        require_once("../controler/ajouter_flux.ctrl.php");
    }
    if (isset($_POST['url_a_supprimer']) && !empty($_POST['url_a_supprimer'])) {
        require_once("../controler/supprimer_flux_utilisateur.ctrl.php");
    }
    if (isset($_GET['account']) && $_GET['account'] === "page") {
        require_once ("../controler/account.ctrl.php");
    } else if (isset($_GET['actualiser']) && $_GET['actualiser'] === "true") {
        require_once("../controler/actualisation_flux.php");
        require_once("../view/nav.view.php");
        include("../controler/selection_nouvelles.ctrl.php");
    } else {
        require_once("../view/nav.view.php");
        require_once("../controler/selection_nouvelles.ctrl.php");
    }
    ?>
</div>
