<?php
session_start();

require_once('../model/utilisateurDAO_class.php');


if (isset($_POST['oi'])) {
  $oi = $_POST['oi'];
}else{
  $oi = "";
}

if (isset($_POST['ni'])) {
  $ni = $_POST['ni'];
}else{
  $ni = "";
}

$monlogin = $_SESSION['login'];

$dao = new UtilisateurDAO;

if ($oi === "" || $ni === "" || !$dao->isExistUtilisateur($oi) || strcmp($monlogin, $oi)!=0 || $dao->isExistUtilisateur($ni)) {
  require('../view/account_log_change.html');
}else{
  $dao->getUtilisateur($oi)->setLogin($ni);
  require('../view/account.view.php');
}
