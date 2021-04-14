<?php
require("../model/nouvellesDAO_class.php");
require("../model/flux_class.php");

$xml = simplexml_load_file($i_url);
$nouvelles_db = new NouvellesDAO();
$nouvelles = $xml->xpath("//item");

foreach ($nouvelles as $nouvelle) {
    $titre_flux = $nouvelle->title;
    $description_flux = $nouvelle->description;
    if (!($nouvelles_db->isExistNouvelle($titre_flux, $description_flux))){
        $nouvelles_db->addNouvelle($nouvelle, new Flux($i_url));
    }
}
