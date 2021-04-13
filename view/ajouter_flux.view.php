<form action="../controler/ajouter_flux.ctrl.php" method="POST">
    <fieldset>
        <legend>Nouveau flux</legend>
        <label for="i_url">URL</label>
        <input type="text" id="i_url" name="i_url" placeholder="URL" maxlength="255" required>
        <label for="i_nom_flux">Nom du flux</label>
        <input type="text" id="i_nom_flux" name="i_nom_flux" placeholder="Nom" maxlength="80">
        <input type="submit" value="Ajouter">
    </fieldset>
</form>