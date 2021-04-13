<?php

try {
    $bd = new PDO('sqlite:../data/newsDB');
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}

function getNombreNouvelles($bd) : int {
    $requete = $bd->prepare("SELECT id FROM nouvelles");
    $requete->execute();
    $res = $requete->fetchAll();
    $requete->closeCursor();
    return count($res);
}

function existsNouvelle($bd, $titre, $description) : bool {
    $titre = $bd->quote($titre);
    $description = $bd->quote($description);
    $commandeRequete = "SELECT id FROM nouvelles WHERE description = $description AND titre = $titre";
    $requete = $bd->prepare($commandeRequete);
    if ($requete) {
        $requete->execute();
    }
    $res = $requete->fetchAll();
    $requete->closeCursor();
    return count($res) > 0;
}

function addNouvelle(PDO $bd, $titre_flux, $nouvelle) {
    if (existsNouvelle($bd, $nouvelle->title, $nouvelle->description)) {
        return ;
    }

    $url_image = getURLImage($nouvelle);
    $img = "";
    if ($url_image != "")
        $img = '../data/images/image' . getNombreNouvelles($bd) . '.' . extensionImage($url_image);

    $titre = $bd->quote($nouvelle->title);
    $description = $bd->quote($nouvelle->description);
    $pubDate = strftime("%Y-%m-%d %H:%M:%S", strtotime($nouvelle->pubDate));
    $titre_flux = $bd->quote($titre_flux);

    $commandeRequete = 'INSERT INTO nouvelles(date, titre, description, lien, image, flux) VALUES(\'' . $pubDate . '\', ' . $titre . ', ' . $description . ', \'' . $nouvelle->link . '\', \'' . $img . '\', ' . $titre_flux . ')';
    $requete = $bd->prepare($commandeRequete);
    if ($requete) {
        $requete->execute();
    }
    $requete->closeCursor();
}
