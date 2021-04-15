<?php

if (isset($_POST['lg'])) {
    $login = $_POST['lg'];

} else {
    $login = "";
}
if (isset($_POST['mdp'])) {
    $mdp = password_hash($_POST['mdp'],PASSWORD_DEFAULT,['cost' =>14]);//$_POST['mdp'];
} else {
    $mdp = "";
}
$dao = new UtilisateurDAO;
if ($login === "" || $mdp === "" || !($dao->isExistUtilisateur($login))) {
    print ("Erreur à l\'inscription, vous allez être redirigé vers la page connexion");
    sleep(10);
    require('../view/login.view.html');
}else{
    $utilisateur= new Utilisateur($login,$mdp);
    $dao->addUtilisateur($utilisateur);
    print ("Inscription réussie, vous allez être redirigé vers la page connexion");
    sleep(10);
    require('../view/login.view.html');
}