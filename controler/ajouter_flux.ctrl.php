<?php
require("../model/fluxDAO_class.php");
require("../model/flux_utilisateurDAO_class.php");
require_once("../view/ajouter_flux.view.php");

// $login = $_SESSION['login'];
$login = "admin";   // ********* À ENLEVER

if (!isset($_POST['i_url']) || !isset($_POST['i_nom_flux'])) {
    return ;
}
$i_url = $_POST['i_url'];
$i_nom_flux = $_POST['i_nom_flux'];
$flux_db = new FluxDAO();
$fluxUtilisateur_db = new Flux_utilisateurDAO();
$fluxUtilisateur_url = $fluxUtilisateur_db->getFlux_utilisateur($i_nom_flux, $login);
$fluxUtilisateur_nom = $fluxUtilisateur_db->getNomFlux_utilisateur($i_url, $login);
$flux = $flux_db->getFlux($i_url);

if (!isset($i_url)) {
    return ;
}
if (!isset($i_nom_flux) || (isset($i_nom_flux) && empty($i_nom_flux))) {
    $i_nom_flux = simplexml_load_file($i_url)->channel->title;
}

if ($fluxUtilisateur_url) {
    // message d'erreur "Ce flux est déjà dans votre liste"
}


if ($fluxUtilisateur_nom) {
    // message d'erreur "Ce nom est déjà utilisé pour un autre flux"
}

// le flux n'existe pas dans la liste de l'utilisateur
if ($flux == null) {
    // on ajoute ce flux dans la table des flux
    $flux_db->addFlux($i_url);
}

// et on ajoute le flux dans flux_utilisateur
$fluxUtilisateur = new Flux_utilisateur($flux, $login, $i_nom_flux, "");
$fluxUtilisateur_db->addFlux_utilisateur($fluxUtilisateur); // modifier l'appel de méthode, pas encore définie