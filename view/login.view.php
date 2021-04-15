<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login page</title>
    <link rel="stylesheet" href="../view/design/login.css">
  </head>
  <body>
    <div id="container">
      <h1>Actus Capture</h1>
      <form action="../controler/login.ctrl.php" method="post">
        <table>
          <tr>
            <td><label for="l">Identifiant</label></td><td><input id="l" class="input" type="text" name="lg"></td>
          </tr>
          <tr>
            <td><label for="m">Mot de passe</label></td><td><input id="m" class="input" type="password" name="mdp"></td>
          </tr>
        </table>
        <p><input type="submit" value="Se connecter"></p>
      </form>
    </div>

  </body>
</html>
