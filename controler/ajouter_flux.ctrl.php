<?php
require("../model/fluxDAO_class.php");
require("../model/flux_utilisateurDAO_class.php");
require_once("../view/ajouter_flux.view.php");

session_start();

$login = $_SESSION['login'];

if (!isset($_POST['i_url']) || !isset($_POST['i_nom_flux'])) {
    return ;
}
$i_url = $_POST['i_url'];
$i_nom_flux = $_POST['i_nom_flux'];
$flux_db = new FluxDAO();
$fluxUtilisateur_db = new Flux_utilisateurDAO();

if (!isset($i_url)) {
    return ;
}
if (!isset($i_nom_flux) || (isset($i_nom_flux) && empty($i_nom_flux))) {
    $i_nom_flux = (string) simplexml_load_file($i_url)->channel->title;
}

var_dump($i_nom_flux);
var_dump($login);



// ce flux n'est pas dans flux_utilisateur
if ($fluxUtilisateur_db->isExistFlux_utilisateur($login, $i_nom_flux)) {
    // message d'erreur : "Ce nom est déjà dans votre liste"
}

try {
    $fluxUtilisateur_db->getNomFlux_utilisateur($i_url, $login);
} catch (TypeError $t) {
    $fluxUtilisateur = new Flux_utilisateur($i_url, $login, $i_nom_flux, "");
    $fluxUtilisateur_db->addFlux_utilisateur($fluxUtilisateur);
}

try {
    $flux_db->getFlux($i_url);
    // plante si existe déjà dans la liste des flux
} catch (TypeError $t) {
    $flux = new Flux($i_url);
    $flux_db->addFlux($flux);
}

