<?php
if(!isset($_SESSION)){
    session_start();
}
require_once ("../model/flux_utilisateurDAO_class.php");

$flux_utilisateurs_db= new Flux_utilisateurDAO();

$categories=$flux_utilisateurs_db->getCategories();
//le mettre dans le html du nav