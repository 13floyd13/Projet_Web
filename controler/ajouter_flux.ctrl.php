<?php
require_once("../view/ajouter_flux.view.php");

$i_url = $_POST['i_url'];
$i_nom_flux = $_POST['i_nom_flux'];

if (!isset($i_url) || !isset($i_nom_flux)) {
    return ;
}

/* appel du DAO pour :
 * - vérifier que ce flux n'existe pas déjà
 * - créer un nouveau flux
 *
 */