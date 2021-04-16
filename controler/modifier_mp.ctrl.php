<?php
session_start();

require_once('../model/utilisateurDAO_class.php');


if (isset($_POST['old_mp'])) {
  $old_mp = $_POST['old_mp'];
}else{
  $old_mp = "";
}

if (isset($_POST['new_mp'])) {
  $new_mp = password_hash($_POST['new_mp'], PASSWORD_DEFAULT, ['cost' => 14]);
}else{
  $new_mp = "";
}

if (isset($_POST['confirm_mp'])) {
  $confirm_mp = password_hash($_POST['confirm_mp'], PASSWORD_DEFAULT, ['cost' => 14]);
}else{
  $confirm_mp = "";
}

$dao = new UtilisateurDAO;

$login = $_SESSION['login'];
$mdp = $dao->getUtilisateur($login)->getMp();

if ($old_mp === "" || $new_mp === "" || $confirm_mp === "" || !password_verify($old_mp, $mdp) || !password_verify($_POST['new_mp'],$new_mp)) {
  require('../view/account_mp_change.view.html');
}else{
  $utilisateur_a_update = $dao->getUtilisateur($login);
  $dao->updateUtilisateur($utilisateur_a_update, $new_mp);
  require('../view/account.view.php');
}
