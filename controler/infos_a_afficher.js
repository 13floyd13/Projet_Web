document.getElementById("opt_titre").onclick = function() {
    isChecked(this);
}

document.getElementById("opt_image").onclick = function() {
    isChecked(this);
}

document.getElementById("opt_description").onclick = function() {
    isChecked(this);
}

document.getElementById("opt_lien").onclick = function() {
    isChecked(this);
}

function isChecked(checkbox) {
    let valeur;
    valeur = checkbox.checked ? "checked" : "";
    $.post("session_setter.php", {"id_bouton": checkbox.id, "check": valeur});
}