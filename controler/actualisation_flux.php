<?php
    session_start();
    $login = $_SESSION['login'];
    $flux_utilisateur_db = new Flux_utilisateurDAO();
    $tab_flux = $flux_utilisateur_db->getFlux_utilisateurByLogin($login);
    foreach ($tab_flux as $flux) {
        $i_url= $flux_utilisateur_db->getNomFlux_utilisateur($flux,$login)->getFlux();
        require 'collecteNouvelle.php';
    }


