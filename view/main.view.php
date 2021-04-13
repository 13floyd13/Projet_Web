<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Main page</title>
    <link rel="stylesheet" href="design/main.css">
    <script>
      function openNav() {
        document.getElementById("mySidenav").style.width = "15%";
      }
      function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
      }
      function openWorld() {
        document.getElementById("world").style.width = "50%";
      }
      function closeWorld() {
        document.getElementById("world").style.width = "0";
      }
      function openTech() {
        document.getElementById("tech").style.width = "50%";
      }
      function closeTech() {
        document.getElementById("tech").style.width = "0";
      }
    </script>
  </head>
  <body>

    <div id="hamburger" onclick="openNav()">
      <div class="menuBar"></div>
      <div class="menuBar"></div>
      <div class="menuBar"></div>
    </div>

    <div id="mySidenav" class="sidenav">
      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
      <p>Bonjour userLogin</p>
        <?php
        require ("../controler/ajouter_flux.ctrl.php");
        ?>
      <a href="#">Tous les flux</a>
      <a href="#">Non lus</a>
      <a href="#">Favoris</a>
      <a href="#">Catégories</a>
      <ul>
        <li><a class="supprimer" href="#">&times;</a><a href="#" onclick="closeNav(), openWorld(), closeTech()">World News</a></li>
        <li><a class="supprimer" href="#">&times;</a><a href="#" onclick="closeNav(), openTech(), closeWorld()">Tech News</a></li>
      </ul>
      <a class="account" href="account.php">&#128100;</a>
    </div>

    <div id="world" class="news">
      <article>
        <img src="" alt="image article 1">
        <h3>Titre article w1</h3>
        <p>Description article 1</p>
        <a href="#">URL article 1</a>
      </article>
      <article>
        <img src="" alt="image article 2">
        <h3>Titre article w2</h3>
        <p>Description article 2</p>
        <a href="#">URL article 2</a>
      </article>
      <article>
        <img src="" alt="image article 3">
        <h3>Titre article w3</h3>
        <p>Description article 3</p>
        <a href="#">URL article 3</a>
      </article>
    </div>

    <div id="tech" class="news">
      <article>
        <img src="" alt="image article 1">
        <h3>Titre article t1</h3>
        <p>Description article 1</p>
        <a href="#">URL article 1</a>
      </article>
      <article>
        <img src="" alt="image article 2">
        <h3>Titre article t2</h3>
        <p>Description article 2</p>
        <a href="#">URL article 2</a>
      </article>
      <article>
        <img src="" alt="image article 3">
        <h3>Titre article t3</h3>
        <p>Description article 3</p>
        <a href="#">URL article 3</a>
      </article>
    </div>

  </body>
</html>
