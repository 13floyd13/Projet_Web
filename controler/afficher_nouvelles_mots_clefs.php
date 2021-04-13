<?php

// nécessite de passer le $mot_clé

$nouvellesDAO = new NouvellesDAO();
$nouvelles_base = $nouvellesDAO->getNouvelles();

$nouvelles = array();
for($nouvelles_base as $nouvelle) {
    if (!str_contains($nouvelles_base->getDescription(), $mot_cle)) {
        array_push($nouvelles, $nouvelle);
    }
}

require("afficher_nouvelles.ctrl.php");
