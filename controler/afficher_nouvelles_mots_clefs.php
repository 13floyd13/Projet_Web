<?php

require_once ("../model/nouvellesDAO_class.php");
// nécessite de passer le $mot_clé

$nouvellesDAO = new NouvellesDAO();
$nouvelles_base = $nouvellesDAO->getNouvelles();

$nouvelles = array();
foreach($nouvelles_base as $nouvelle) {
    if (!strpos($nouvelle->getDescription(), $mot_cle)) {
        array_push($nouvelles, $nouvelle);
    }
}

require_once("afficher_nouvelles.ctrl.php");
