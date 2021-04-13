<?php

  $imgs = array();
  array_push($imgs,'<img src="images/image01.jpg" alt="image 1">', '<img src="images/image02.jpeg" alt="image 2">');

  function affiche_images() : string{
    global $imgs;
    echo "<table>\n";
    foreach ($imgs as $value) {
      echo '      <td>'.$value.'</td>'."\n";
    }
    return "    </table>\n";
  }

?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>images</title>
  </head>
  <body>

    <h1>Voici les images</h1>
    <?= affiche_images() ?>

  </body>
</html>
