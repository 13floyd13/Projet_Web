
<?php
session_start();
require_once "../model/flux_utilisateurDAO_class.php";
require_once "../model/nouvellesDAO_class.php";
require_once "../controler/actualisation_flux.php";

$flux_utilisateur_db = new Flux_utilisateurDAO();
$nouvelles_bd = new NouvellesDAO();
$nouvelles = array();
if (isset($_GET['flux']) && !empty($_GET['flux'])){
    $nomFlux= htmlentities($_GET['flux']);
    try {
        $flux = $flux_utilisateur_db->getFlux_utilisateur($nomFlux, $_SESSION["login"])->getFlux();
        $nouvelles = $nouvelles_bd->getNouvellesParFlux($flux);
    } catch (TypeError $t) {
        require ("404.php");
    }
} else {
    $tab_flux = $flux_utilisateur_db->getFlux_utilisateurByLogin($_SESSION["login"]);
    foreach ($tab_flux as $flux){
        try {
            $nouvelles_du_flux = $nouvelles_bd->getNouvellesParFlux($flux->getFlux());
            foreach($nouvelles_du_flux  as $nouvelle) {
                array_push($nouvelles, $nouvelle);
            }
        } catch (TypeError $t) {
            require ("404.php");
        }
    }
}
require'afficher_nouvelles.ctrl.php';