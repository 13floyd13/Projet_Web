<?php
    if (!isset($_SESSION)) {
      session_start();
    }
    require_once("../model/flux_utilisateurDAO_class.php");
    require_once("../model/nouvellesDAO_class.php");

    $login = $_SESSION['login'];
    $flux_utilisateur_db = new Flux_utilisateurDAO();
    $tab_flux = $flux_utilisateur_db->getFlux_utilisateurByLogin($login);
    foreach ($tab_flux as $flux) {
        $i_url = $flux->getFlux();
        // require_once 'collecter_nouvelles.php';
        $xml = simplexml_load_file($i_url);
        $nouvelles_db = new NouvellesDAO();
        $nouvelles = $xml->xpath("//item");

        foreach ($nouvelles as $nouvelleXML) {
            $titre_nouvelle = $nouvelleXML->title;
            $description_nouvelle = $nouvelleXML->description;

            if ($nouvelles_db->isExistNouvelle($titre_nouvelle, $description_nouvelle)) {
                continue;
            }

            if (count($nouvelleXML->children('media', True)) != 0) {
                $url_image = $nouvelleXML->children('media', True)->content->attributes()['url'];
            } else {
                if (isset($nouvelleXML->enclosure)) {
                    $url_image = $nouvelleXML->enclosure->attributes()['url'];
                }
            }

            $img = "../data/images/image";
            $img .= $nouvelles_db->getNombreNouvelles()+1;
            if (strpos($url_image,'.jpg')||strpos($url_image,'.jpeg')||strpos($url_image,'.JPEG')||strpos($url_image,'.JPG'))
                $img .= "jpg";
            else if (strpos($url_image,'.png')||strpos($url_image,'.PNG'))
                $img .= "png";
            else if (strpos($url_image,'.gif')||strpos($url_image,'.GIF'))
                $img .= "gif";
            else
                $img .= "";

            file_put_contents($img, file_get_contents($url_image));
            $nouvelle = new Nouvelle($nouvelles_db->getNombreNouvelles()+1, $nouvelleXML->pubDate, $nouvelleXML->title, $nouvelleXML->description, $nouvelleXML->link, $img, $i_url);
            $nouvelles_db->addNouvelle($nouvelle);
        }
    }


