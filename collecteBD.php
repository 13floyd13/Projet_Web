<?php

$cheminBd = 'sqlite:newsDB';
try {
    $bd = new PDO($cheminBd);
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}

function getNombreNouvelles($bd) : int {
    $commandeRequete = "SELECT id FROM nouvelles";
    $requete = $bd->prepare($commandeRequete);
    $requete->execute();
    $res = $requete->fetchAll();
    $requete->closeCursor();
    return count($res);
}


function addNouvelle(PDO $bd, $titre_flux, $nouvelle) {
    $url_image = getURLImage($nouvelle);
    $img = "";
    if ($url_image != "")
        $img = 'images/image' . getNombreNouvelles($bd) . '.' . extensionImage($url_image);

    print $img;
    $titre = $bd->quote($nouvelle->title);
    $description = $bd->quote($nouvelle->description);
    $pubDate = strftime("%Y-%m-%d %H:%M:%S", strtotime($nouvelle->pubDate));
    $titre_flux = $bd->quote($titre_flux);
    $commandeRequete = 'INSERT INTO nouvelles(date, titre, description, lien, image, flux) VALUES(\'' . $pubDate . '\', ' . $titre . ', ' . $description . ', \'' . $nouvelle->link . '\', \'' . $img . '\', ' . $titre_flux . ')';
    print $commandeRequete;
    $requete = $bd->prepare($commandeRequete);
    $requete->execute();
    $requete->closeCursor();
}

?>