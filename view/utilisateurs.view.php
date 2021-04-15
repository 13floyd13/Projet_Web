<?php
require_once('../model/utilisateurDAO_class.php');

$dao = new UtilisateurDAO;
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Utilisateurs Page</title>
    <link rel="stylesheet" href="../view/design/utilisateurs.css">
  </head>
  <body>

    <header>
      <a class="return" href="../view/account.view.php">&#8592;</a>
    </header>

    <div id="container">
      <?php
        $utilisateurs = $dao->getUtilisateurs();
        foreach ($utilisateurs as $value) {
          $login = $value->getLogin();
          echo '<article><a href="#">&times;</a><h1>'.$login.'<h1></article>';
        }
      ?>
    </div>

  </body>
</html>
