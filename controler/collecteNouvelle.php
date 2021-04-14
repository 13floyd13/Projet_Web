<?php
require("../model/nouvellesDAO_class.php");
$i_url = $_POST['i_url']; // A enlever et à remplacer par un appel à chaque connexion
$xml = simplexml_load_file($i_url);
$nouvelles_db = new NouvellesDAO();
$nouvelles = $xml->xpath("//item");

foreach ($nouvelles as $nouvelle) {
    $titre_flux = $nouvelle->channel->title;
    $description_flux = $nouvelle->channel->description;
    if (!($nouvelles_db->isExistNouvelle($titre_flux,$description_flux))){
        $nouvelles_db->addNouvelle($nouvelle);
    }
}
