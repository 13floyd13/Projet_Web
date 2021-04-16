<?php
if(!isset($_SESSION)){
    session_start();
}

if(isset($_POST['Mot'])) {
    $keyword=$_POST['Mot'];
    require_once("../model/flux_utilisateurDAO_class.php");
    require_once("../model/nouvellesDAO_class.php");
    $flux_utilisateur_db = new Flux_utilisateurDAO();
    $nouvelles_bd = new NouvellesDAO();
    $tab_flux = $flux_utilisateur_db->getFlux_utilisateurByLogin($_SESSION["login"]);
    $nouvelles= array();
    foreach ($tab_flux as $flux) {
        try {
            $nouvelles_du_flux= $nouvelles_bd->getNouvellesBySearch($flux->getFlux(),$keyword);

            foreach ($nouvelles_du_flux as $nouvelle) {
                array_push($nouvelles, $nouvelle);
            }
        } catch (TypeError $t) {
            require("404.php");
        }
    }

    usort($nouvelles, "triParDate");
    require 'afficher_nouvelles.ctrl.php';
}

function triParDate($a, $b) {
    return strtotime($b->getDate()) - strtotime($a->getDate());
}
