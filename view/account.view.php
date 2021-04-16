<?php
session_start();

?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Account page</title>
    <link rel="stylesheet" href="../view/design/account.css">
  </head>
  <body>

    <header>
      <a class="return" href="../controler/actus.ctrl.php">&#8592;</a>
    </header>

    <div id="container">
      <form action="../controler/modifier_login.ctrl.php" method="post">
        <article>
          <!--<input class="modif" type="submit" value="(modifier)">-->
          <h1>Votre Identifiant</h1>
          <p><?= $_SESSION['login'] ?></p>
        </article>
      </form>
      <form action="../controler/modifier_mp.ctrl.php" method="post">
        <article>
          <input class="modif" type="submit" value="(modifier)">
          <h1>Votre mot de passe</h1>
          <p>**********</p>
        </article>
      </form>
      <?php
        if ($_SESSION['login']=='admin') {
          echo "<article><a id='group' href='../controler/afficher_utilisateurs.ctrl.php'>&#128101;</a><h1>Consultez les utilisateurs : <h1>";
        }
      ?>
    </div>

  </body>
</html>
