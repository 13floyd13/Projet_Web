<?php
session_start();
$flux_utilisateur_db = new Flux_utilisateurDAO();
$nouvelles_bd = new NouvellesDAO();
if ($nomFlux= htmlentities($_GET['flux']) !== null){
    $flux = $flux_utilisateur_db->getFlux_utilisateur($nomFlux, $_SESSION["login"])->getFlux();
    $nouvelles_bd = new NouvellesDAO();
    $nouvelles = $nouvelles_bd->getNouvellesParFlux($flux);
    require'afficher_nouvelles.ctrl.php';
}else{
    $tab_flux=$flux_utilisateur_db->getFlux_utilisateurByLogin($_SESSION["login"]);
    foreach ($tab_flux as $flux){
        $nouvelles = $nouvelles_bd->getNouvellesParFlux($flux);
        require'afficher_nouvelles.ctrl.php';
    }
}








