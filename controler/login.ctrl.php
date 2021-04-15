<?php
require_once('../model/utilisateurDAO_class.php');

session_start();

if (isset($_GET['logout']) && $_GET['logout'] === "true") {
    session_unset();
    session_destroy();
    session_start();
}

if (isset($_POST['lg'])) {
  $login = $_POST['lg'];
} else {
  $login = "";
}

if (isset($_POST['mdp'])) {
  $mdp = $_POST['mdp']; //password_hash($_POST['mdp'],PASSWORD_DEFAULT,['cost' =>14]);
} else {
  $mdp = "";
}
$dao = new UtilisateurDAO;

if ($login === "" || $mdp === "" || !$dao->isExistUtilisateur($login)) {
  require('../view/login.view.php');
} else {
  if (strcmp($mdp, $dao->getUtilisateur($login)->getMp())==0) {//(password_verify($dao->getUtilisateur($login)->getMp(),$mdp)) { //(strcmp($mdp, $dao->getUtilisateur($login)->getMp())==0)
    $_SESSION['login'] = $login;
    require("../controler/actualisation_flux.php");
    require('../controler/actus.ctrl.php');
  } else {
    $_GET['erreur_mauvais_mdp'] = "true";
    require('../view/login.view.php');
  }
}
