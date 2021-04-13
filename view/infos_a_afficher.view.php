<form action="" method="POST">
    <fieldset>
        <legend>Options d'affichage</legend>
        <label for="opt_titre">Titre</label>
        <input type="checkbox" id="opt_titre" name="opt_titre" <?= $opt_titreToCheck ?>>
        <label for="opt_image">Image</label>
        <input type="checkbox" id="opt_image" name="opt_image" <?= $opt_imageToCheck ?>>
        <label for="opt_description">Description</label>
        <input type="checkbox" id="opt_description" name="opt_description" <?= $opt_descriptionToCheck ?>>
        <label for="opt_lien">Lien de l'article</label>
        <input type="checkbox" id="opt_lien" name="opt_lien" <?= $opt_lienToCheck ?>>
    </fieldset>
</form>
<script type="application/javascript" src="../controler/infos_a_afficher.ctrl.js"></script>