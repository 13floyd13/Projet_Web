<?php
require_once("../model/nouvellesDAO_class.php");

$xml = simplexml_load_file($i_url);
$nouvelles_db = new NouvellesDAO();
$nouvelles = $xml->xpath("//item");

foreach ($nouvelles as $nouvelleXML) {
    $titre_flux = $nouvelleXML->title;
    $description_flux = $nouvelleXML->description;
    if (!($nouvelles_db->isExistNouvelle($titre_flux, $description_flux))){

        if (count($nouvelleXML->children('media', True)) != 0) {
            $url_image = $nouvelleXML->children('media', True)->content->attributes()['url'];
        } else {
            if (isset($nouvelleXML->enclosure)) {
                $url_image = $nouvelleXML->enclosure->attributes()['url'];
            }
        }

        $img = "../data/images/image";
        $img .= $nouvelles_db->getNombreNouvelles()+1;
        if (str_contains($url_image,'.jpg')||str_contains($url_image,'.jpeg')||str_contains($url_image,'.JPEG')||str_contains($url_image,'.JPG'))
            $img .= "jpg";
        else if (str_contains($url_image,'.png')||str_contains($url_image,'.PNG'))
            $img .= "png";
        else if (str_contains($url_image,'.gif')||str_contains($url_image,'.GIF'))
            $img .= "gif";
        else
            $img .= "";

        file_put_contents($img, file_get_contents($url_image));
        $nouvelle = new Nouvelle($nouvelles_db->getNombreNouvelles()+1, $nouvelleXML->pubDate, $nouvelleXML->title, $nouvelleXML->description, $nouvelleXML->link, $img, $i_url);
        $nouvelles_db->addNouvelle($nouvelle);
    }
}

function str_contains($haystack, $needle)
{
    return $needle !== '' && mb_strpos($haystack, $needle) !== false;
}
