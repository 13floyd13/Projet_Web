<?php
require_once("../view/ajouter_flux.view.php");

$i_url = $_POST['i_url'];
$i_nom_flux = $_POST['i_nom_flux'];

if (!isset($i_url) || !isset($i_nom_flux)) {
    return ;
}

$flux_db = new FluxDAO();
$fluxUtilisateur_db = new Flux_utilisateurDAO();

$fluxUtilisateur_url = $fluxUtilisateur_db->getURL($i_nom_flux);
if ($fluxUtilisateur_url) {
    // message d'erreur "Ce flux est déjà dans votre liste"
}

$fluxUtilisateur_nom = $fluxUtilisateur_db->getNom($i_url);
if ($fluxUtilisateur_nom) {
    // message d'erreur "Ce nom est déjà utilisé pour un autre flux"
}

// le flux n'existe pas dans la liste de l'utilisateur

$flux = $flux_db->get($i_url);
if ($flux == null) {
    // on ajoute ce flux dans la table des flux
    $flux_db->addFlux($i_url);
}

// et on ajoute le flux dans flux_tulisateur
$fluxUtilisateur_db->addFlux(); // modifier l'appel de méthode, pas encore définie