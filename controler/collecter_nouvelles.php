<?php
require_once("../model/nouvellesDAO_class.php");

$xml = simplexml_load_file($i_url);
$nouvelles_db = new NouvellesDAO();
$nouvelles = $xml->xpath("//item");

foreach ($nouvelles as $nouvelleXML) {
    $titre_nouvelle = $nouvelleXML->title;
    $description_nouvelle = $nouvelleXML->description;

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

function strpos($haystack, $needle)
{
    return $needle !== '' && mb_strpos($haystack, $needle) !== false;
}
