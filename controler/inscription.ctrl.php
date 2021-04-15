<?php
require_once('../model/utilisateurDAO_class.php');
if (isset($_POST['lg'])) {
    $login = htmlspecialchars($_POST['lg']);
} else {
    $login = "";
}

if (isset($_POST['mdp'])) {
    $mdp = password_hash($_POST['mdp'],PASSWORD_DEFAULT,['cost' =>14]);//$_POST['mdp'];
} else {
    $mdp = "";
}
if (!ctype_alnum($login)){
    require('../view/login.view.html');
    print "login incorrect";
    var_dump(!ctype_alnum($login));
}
else {
    $dao = new UtilisateurDAO;
    if ($login === "" || $mdp === "" || ($dao->isExistUtilisateur($login))) {
        print ("Erreur à l\'inscription, vous allez être redirigé vers la page connexion");
        require('../view/login.view.html');
    } else {
        $utilisateur = new Utilisateur($login, $mdp);
        $dao->addUtilisateur($utilisateur);
        print ("Inscription réussie, vous allez être redirigé vers la page connexion");
        require_once('../view/login.view.html');
    }
}