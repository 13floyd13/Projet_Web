<?php

// nécessite de passer le $flux

$nouvellesDAO = new NouvellesDAO();
$nouvelles = $nouvellesDAO->getNouvellesParFlux($flux);

require("afficher_nouvelles.ctrl.php");
