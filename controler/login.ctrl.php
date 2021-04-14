<?php
require('../model/utilisateurDAO_class.php');

session_start();

if (isset($_POST['lg'])) {
  $login = $_POST['lg'];
} else {
  $login = "";
}

if (isset($_POST['mdp'])) {
  $mdp = $_POST['mdp'];
} else {
  $mdp = "";
}
$dao = new UtilisateurDAO;

if ($login === "" || $mdp === "" || !$dao->isExistUtilisateur($login)) {
  require('../view/login.view.html');
} else {
  if (strcmp($mdp, $dao->getUtilisateur($login)->getMp())==0) {
    $_SESSION['login'] = $login;
    require('../view/nav.view.php');
  } else {
    require('../view/login.view.html');
  }
}
