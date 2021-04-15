<?php
// on récupère la catégorie à supprimer
session_start();
require ('ajouter_flux_à_categorie.php');
require_once ("../model/flux_utilisateurDAO_class.php");
// on récup tous les flux de la catégories et soit on les met dans une catégorie par défaut soit on supprime les flux
$nom_categorie=$_POST['nom_categorie'];
$flux_utilisateur_db= new Flux_utilisateurDAO();
$fluxs= $flux_utilisateur_db->getFlux_utilisateurByCategories();
foreach ($fluxs as $flux){
    $nom_flux=$flux_utilisateur_db->getNomFlux_utilisateur($flux,$_SESSION["login"]);
    ajouter_flux_a_categorie($nom_flux,"");
    $suppression=$flux_utilisateur_db->removeFlux_utilisateurByFlux($flux,$_SESSION["login"]);q
}
