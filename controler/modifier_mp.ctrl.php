<?php
session_start();

require_once('../model/utilisateurDAO_class.php');


if (isset($_POST['old_mp'])) {
  $old_mp = $_POST['old_mp'];
}else{
  $old_mp = "";
}

if (isset($_POST['new_mp'])) {
  $new_mp = $_POST['new_mp'];
}else{
  $new_mp = "";
}

$dao = new UtilisateurDAO;

$login = $_SESSION['login'];
$mdp = $dao->getUtilisateur($login)->getMp();

if ($old_mp === "" || $new_mp === "" || strcmp($mdp, $old_mp)!=0) {
  require('../view/account_mp_change.view.html');
}else{
  $utilisateur_a_update = $dao->getUtilisateur($login);
  $dao->updateUtilisateur($utilisateur_a_update, $new_mp);
  require('../view/account.view.php');
}
