<?php
//dans la nav, mettre un titre catégorie avec un bouton à coté pour ajouter une catégorie (+)
//insérer un formulaire dans ce nav pour récupérer un nom de catégorie.
if(!isset($_SESSION)){
    session_start();
}
require_once ("../model/flux_utilisateurDAO_class.php");
require_once ("../model/flux_utilisateur_class.php");
$categorie=$_POST['categorie'];
$o_categorie=new Flux_utilisateur("",$_SESSION["login"],"",$categorie);
$categorie_db= new Flux_utilisateurDAO();
$categorie_db->addFlux_utilisateur($o_categorie);


