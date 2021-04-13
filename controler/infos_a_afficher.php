<?php
$opt_titreToCheck = isset($_SESSION['opt_titre']) ? "checked" : "";
$opt_imageToCheck = isset($_SESSION['opt_image']) ? "checked" : "";
$opt_descriptionToCheck = isset($_SESSION['opt_description']) ? "checked" : "";
$opt_lienToCheck = isset($_SESSION['opt_lien']) ? "checked" : "";
?>
<form action="" method="POST">
    <label for="opt_titre">Titre</label>
    <input type="checkbox" id="opt_titre" name="opt_titre" <?= $opt_titreToCheck ?>>
    <label for="opt_image">Image</label>
    <input type="checkbox" id="opt_image" name="opt_image" <?= $opt_imageToCheck ?>>
    <label for="opt_description">Description</label>
    <input type="checkbox" id="opt_description" name="opt_description" <?= $opt_descriptionToCheck ?>>
    <label for="opt_lien">Lien de l'article</label>
    <input type="checkbox" id="opt_lien" name="opt_lien" <?= $opt_lienToCheck ?>>
</form>