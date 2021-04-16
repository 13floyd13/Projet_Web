<?php
require_once("../model/fluxDAO_class.php");
require_once("../model/flux_utilisateurDAO_class.php");

if (!isset($_SESSION)) {
  session_start();
}

if (!isset($_POST['i_url'])) {
    require_once("../view/ajouter_flux.view.php");
    return ;
}

$i_url = $_POST['i_url'];
$i_nom_flux = $_POST['i_nom_flux'];
$flux_db = new FluxDAO();
$fluxUtilisateur_db = new Flux_utilisateurDAO();

if (!isset($i_nom_flux) || (isset($i_nom_flux) && empty($i_nom_flux))) {
    $i_nom_flux = (string) simplexml_load_file($i_url)->channel->title;
}

// ce flux n'est pas dans flux_utilisateur
if ($fluxUtilisateur_db->isExistFlux_utilisateur($_SESSION['login'], $i_nom_flux)) {
    // message d'erreur : "Ce nom est déjà dans votre liste"
    $erreur_nom_flux = true;
    require_once("../controler/actus.ctrl.php");
};

$fluxUtilisateur = new Flux_utilisateur($i_url, $_SESSION['login'], $i_nom_flux, "");
if ($fluxUtilisateur_db->addFlux_utilisateur($fluxUtilisateur) == false) {
    // message d'erreur : "Ce flux est déjà dans votre liste"
    $erreur_url_flux = true;
    require_once("../controler/actus.ctrl.php");
}

$flux = new Flux($i_url);
$flux_db->addFlux($flux);
unset($_POST);
require_once ("actualisation_flux.php");
require_once("../controler/actus.ctrl.php");
