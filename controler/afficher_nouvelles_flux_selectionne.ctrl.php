<?php

// nécessite de passer le $flux

$nouvellesDAO = new NouvellesDAO();
try {
    $nouvelles = $nouvellesDAO->getNouvellesParFlux($flux);
} catch (TypeError $t) {

}
require("afficher_nouvelles.ctrl.php");
