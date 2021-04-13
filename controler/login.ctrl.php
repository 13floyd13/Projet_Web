<?php

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

if ($login == NULL || $mdp == NULL) {
  require('../view/login.view.html');
}else{
  require('../view/main.view.php');
}
