<?php
    session_start();
    require_once("../model/flux_utilisateurDAO_class.php");

    $login = $_SESSION['login'];
    $flux_utilisateur_db = new Flux_utilisateurDAO();
    $tab_flux = $flux_utilisateur_db->getFlux_utilisateurByLogin($login);
    foreach ($tab_flux as $flux) {
        $i_url = $flux->getFlux();
        require_once 'collecter_nouvelles.php';
    }


