<?php

$url = $_COOKIE['url'];
$flux_utilisateurDAO = new Flux_utilisateurDAO();
$flux = new Flux($url);

$flux_utilisateurDAO->removeFlux_utilisateur($flux);