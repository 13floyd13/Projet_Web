<?php
session_start();
$opt_titreToCheck = toCheck("opt_titreToCheck");
$opt_imageToCheck = toCheck("opt_imageToCheck");
$opt_descriptionToCheck = toCheck("opt_descriptionToCheck");
$opt_lienToCheck = toCheck("opt_lienToCheck");

function toCheck($identifiant) : string {
    if (isset($_SESSION[$identifiant])) {
        return $_SESSION[$identifiant] == "checked" ? "checked" : "";
    }
    return "";
}
require_once("../view/infos_a_afficher.view.php");