<link rel="stylesheet" href="../view/design/global.css">
<link rel="stylesheet" href="../view/design/body.css">
<link rel="stylesheet" href="../view/design/nav.css">
<div id="body">
    <title>Main page</title>
    <?php
    if (isset($_POST['i_url']) && !empty($_POST['i_url'])) {
        print "1";
        require_once("../controler/ajouter_flux.ctrl.php");
    }
    if (isset($_POST['url_a_supprimer']) && !empty($_POST['url_a_supprimer'])) {
        print "2";
        require_once("../controler/supprimer_flux_utilisateur.ctrl.php");
    }
    if (isset($_GET['account']) && $_GET['account'] === "page") {
        print "3";
        require_once ("../controler/account.ctrl.php");
    } else if (isset($erreur_nom_flux) && $erreur_nom_flux == true) {
        print "4";
        include("../view/nav.view.php");
        include("../controler/selection_nouvelles.ctrl.php");
    } else if (isset($erreur_url_flux) && $erreur_url_flux == true) {
        print "5";
        require_once("../view/nav.view.php");
        include("../controler/selection_nouvelles.ctrl.php");
    } else {
        print "6";
        require_once("../view/nav.view.php");
        require_once("../controler/selection_nouvelles.ctrl.php");
    }
    ?>
</div>