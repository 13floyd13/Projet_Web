<?php
require('../model/utilisateurDAO_class.php');

$dao = new UtilisateurDAO;

$login = $_POST['utilisateur_a_supprimer'];
$utilisateur = $dao->getUtilisateur($login);
$dao->removeUtilisateur($utilisateur);

require('../view/utilisateurs.view.php');
