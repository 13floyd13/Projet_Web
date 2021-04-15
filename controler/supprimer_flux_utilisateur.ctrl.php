<?php

session_start();
require_once "../model/flux_utilisateurDAO_class.php";
require_once "../model/flux_utilisateur_class.php";

if (!isset($_POST['url'])) {
    return ;
}
$url = $_POST['url'];
$login = $_SESSION['login'];
$flux_utilisateurDAO = new Flux_utilisateurDAO();
$flux_utilisateur = new Flux_utilisateur($url, $login);

$flux_utilisateurDAO->removeFlux_utilisateur($flux_utilisateur, $login);
