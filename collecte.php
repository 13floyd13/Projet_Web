<?php
require_once("util.php");
require_once("collecteBD.php");

//urls flux
$urls = array(
    "https://www.lemonde.fr/rss/une.xml",
    "https://www.lemonde.fr/sciences/rss_full.xml",
    "https://www.lemonde.fr/sport/rss_full.xml",
    "https://investir.lesechos.fr/RSS/matieres-premieres.xml",
    "https://www.lemonde.fr/campus/rss_full.xml",
    "https://www.francetvinfo.fr/sports.rss",
    "https://www.telerama.fr/rss/television.xml",
    "https://www.lefigaro.fr/rss/figaro_politique.xml",
    "https://www.courrierinternational.com/feed/category/6681/rss.xml",
    "http://rss.allocine.fr/ac/actualites/cine?format=xml",
    "https://www.usine-digitale.fr/informatique/rss",
    "http://radiofrance-podcast.net/podcast09/rss_10212.xml"
);


// sélection d'un flux au hasard
$url = $urls[rand(0, 11)];
echo "<h1>$url</h2>";

//récupération de la totalité du flux
//lire https://www.php.net/manual/fr/function.simplexml-load-file.php
$xml = simplexml_load_file($url);
$titre_flux = $xml->channel->title;
echo "<h1>".$titre_flux."</h1>";

// on récupère les nouvelles du flux
// lire https://www.php.net/manual/fr/simplexmlelement.xpath.php
$nouvelles = $xml->xpath("//item");

//on affiche les nouvelles
foreach ($nouvelles as $nouvelle) {

    $id = getNombreNouvelles($bd);
    $url_image = getURLImage($nouvelle);
    $img = "";
    if ($url_image != "") {
        $img = 'images/image' . $id .'.'.extensionImage($url_image);
        file_put_contents($img, file_get_contents($url_image));
    }
    ?>
    <a href="<?php echo $nouvelle->link; ?>"><?php echo $nouvelle->title; ?></a>
    <p><?php echo date('d/m/Y H:i:s', strtotime($nouvelle->pubDate)); ?></p>
    <p><?php echo $nouvelle->description; ?></p></li>
    <img src="<?=$img?>">

    <?php
    addNouvelle($bd, $titre_flux, $nouvelle);
}
?>