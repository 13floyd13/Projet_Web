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
          if ($login!='admin') {
            $login_utilisateur_a_supprimer = $dao->getUtilisateur($login)->getLogin();
            echo '<form action="../controler/supprimer_utilisateur.ctrl.php" method="post">
                    <article>
                      <input type="hidden" id="utilisateur_a_supprimer" name="utilisateur_a_supprimer" value="'.$login_utilisateur_a_supprimer.'">
                      <input class="supprimer" type="submit" value="&times;">
                      <h1>'.$login.'<h1>
                    </article>
                  </form>
                  <hr>';
          }
        }
      ?>
    </div>

  </body>
</html>
