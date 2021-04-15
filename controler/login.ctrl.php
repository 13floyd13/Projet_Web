<?php
require_once('../model/utilisateurDAO_class.php');

session_start();

if (isset($_POST['lg'])) {
  $login = $_POST['lg'];
} else {
  $login = "";
}

if (isset($_POST['mdp'])) {
  $mdp = password_hash($_POST['mdp'],PASSWORD_DEFAULT,['cost' =>14]);
} else {
  $mdp = "";
}
$dao = new UtilisateurDAO;

if ($login === "" || $mdp === "" || !$dao->isExistUtilisateur($login)) {
  require('../view/login.view.html');
} else {
  if (password_verify($dao->getUtilisateur($login)->getMp(),$mdp)) { //(strcmp($mdp, $dao->getUtilisateur($login)->getMp())==0)
    $_SESSION['login'] = $login;
    require('../view/account.view.php');
    //require("../controler/actualisation_flux.php");
    //require('../controler/actus.ctrl.php');
  } else {
    require('../view/login.view.html');
  }
}
