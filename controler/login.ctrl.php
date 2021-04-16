<?php

if (!isset($_SESSION)) {
  session_start();
}

require_once('../model/utilisateurDAO_class.php');

if (isset($_POST["inscription"])){
    require('../view/inscription.view.html');
}else {
    if (isset($_POST['lg'])) {
        $login = $_POST['lg'];
    } else {
        $login = "";
    }
    if (isset($_POST['mdp'])) {
        $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT, ['cost' => 14]); //$_POST['mdp'];
    } else {
        $mdp = "";
    }
    $dao = new UtilisateurDAO;
    if ($login === "" || $mdp === "" || !($dao->isExistUtilisateur($login))) {
        require('../view/login.view.html');
    } else {
        if (password_verify($_POST['mdp'], $dao->getUtilisateur($login)->getMp())) {//(strcmp($mdp, $dao->getUtilisateur($login)->getMp())==0)
            $_SESSION['login'] = $login;
            require("../controler/actualisation_flux.php");
            require('../controler/actus.ctrl.php');
        } else {
            print "salut";
            require('../view/login.view.html');
        }
    }
}
