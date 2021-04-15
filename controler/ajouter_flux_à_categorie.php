<?php
//on récupère le nom du flux par un formulaire et le nom de la catégorie
session_start();
require_once ("../model/flux_utilisateurDAO_class.php");

$nom_flux=$_POST['nom_flux'];
$categorie=$_POST['categorie'];
function ajouter_flux_a_categorie($nom_flux,$categorie)
{
    $flux_utilisateur_db = new Flux_utilisateurDAO();
    $flux_utilisateur = $flux_utilisateur_db->getFlux_utilisateur($nom_flux, $_SESSION["login"]);
    $flux_utilisateur_db->addFlux_utilisateur($flux_utilisateur);
}



