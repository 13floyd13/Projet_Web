<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Account page</title>
    <link rel="stylesheet" href="design/account.css">
  </head>
  <body>

    <header>
      <a class="return" href="../view/main.view.php">&#8592;</a></p>
    </header>

    <div id="container">
      <form id="first" action="../controler/modifLogin.php" method="post">
        <article>
          <a class="modif" href="#">(modifier)</a>
          <h1>Votre Identifiant</h1>
          <p>userLogin</p>
        </article>
      </form>
      <form action="../controler/modifMdp.php" method="post">
        <article>
          <a class="modif" href="#">(modifier)</a>
          <h1>Votre mot de passe</h1>
          <p>******(count of caract)</p>
        </article>
      </form>
    </div>

  </body>
</html>