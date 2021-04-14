<?php
require('../model/utilisateurDAO_class.php');
//start_session();

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

$dao = new UtilisateurDAO;

if ($login == NULL || $mdp == NULL || !$dao->isExistUtilisateur($login)) {
  require('../view/login.view.html');
}else{
  if (strcmp($mdp, getUtilisateur($login)->getMp())==0) {
    require('../view/main.view.php');
  }else{
    // $_SESSION['']
    require('../view/login.view.html');
  }
}
