<?php
session_start();
require_once('../model/utilisateurDAO_class.php');

$dao = new UtilisateurDAO;
$etoile = "";
$mdp = $dao->getUtilisateur($_SESSION['login'])->getMp();

for ($i=0; $i < strlen($mdp); $i++) {
  $etoile = $etoile.'*';
}

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
      <form id="first" action="../controler/modifier_login.ctrl.php" method="post">
        <article>
          <input class="modif" type="submit" value="(modifier)">
          <h1>Votre Identifiant</h1>
          <p><?= $_SESSION['login'] ?></p>
        </article>
      </form>
      <form action="../controler/modifier_mp.ctrl.php" method="post">
        <article>
          <input class="modif" type="submit" value="(modifier)">
          <h1>Votre mot de passe</h1>
          <p><?= $etoile ?></p>
        </article>
      </form>
    </div>

  </body>
</html>
