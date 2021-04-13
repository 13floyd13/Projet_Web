<?php
require('../model/utilisateurDAO_class.php');
require('../model/utilisateur_class.php');

if (isset($_POST['lg'])) {
  $login = $_POST['lg'];
}else{
  $login = NULL;
}

if (isset($_POST['mdp'])) {
  $mdp = $_POST['mdp'];
}else{
  $mdp = NULL;
}

if ($login == NULL || $mdp == NULL || !isExistUtilisateur($login)) {
  require('../view/login.view.html');
}else{
  if (strcmp($mdp, getUtilisateur($login)->getMp())==0) {
    require('../view/main.view.php');
  }
}
