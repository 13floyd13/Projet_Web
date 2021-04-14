<form action="../controler/ajouter_flux.ctrl.php" method="POST">
    <fieldset>
        <legend>Nouveau flux</legend>
        <label for="i_url">URL</label><br>
        <input type="text" id="i_url" name="i_url" placeholder="URL" maxlength="255" required><br>
        <label for="i_nom_flux">Nom du flux</label><br>
        <input type="text" id="i_nom_flux" name="i_nom_flux" placeholder="Nom" maxlength="80">
        <input type="submit" value="Ajouter">
    </fieldset>
</form>