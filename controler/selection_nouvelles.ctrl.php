<?php
session_start();
$nomFlux= htmlentities($_GET['flux']);
$flux_utilisateur_db = new Flux_utilisateurDAO();
$flux = $flux_utilisateur_db->getFlux_utilisateur($nomFlux,$_SESSION["login"])->getFlux();
$nouvelles_bd= new NouvellesDAO();
$nouvelles=$nouvelles_bd->getNouvellesParFlux($flux);
require'afficher_nouvelles.ctrl.php';





