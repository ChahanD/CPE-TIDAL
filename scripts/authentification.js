// Vérification si le mot de passe entré dans le champ "Mot de passe" est le même que celui entré dans le champ "Confirmer le mot de passe"

document.getElementById('accordion-body login-form').addEventListener('submit', function(event) {
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;

    if (!username || !password) {
        alert('Veuillez remplir tous les champs.');
        event.preventDefault();
    }
});


// Il vérifie si tous les champs du formulaire (nom d'utilisateur, mot de passe et confirmer le mot de passe) ont été remplis. Si un ou plusieurs champs sont vides, 
// il affiche un message d'alerte disant "Veuillez remplir tous les champs." et arrête le processus d'envoi du formulaire.
// Si tous les champs sont remplis, il vérifie ensuite si le mot de passe et la confirmation du mot de passe sont identiques. Si ce n'est pas le cas, il affiche un message 
// d'alerte disant "Les mots de passe ne correspondent pas." et arrête également le processus d'envoi du formulaire.

document.getElementById('accordion-body register-form').addEventListener('submit', function(event) {
    var newUsername = document.getElementById('new-username').value;
    var newPassword = document.getElementById('new-password').value;
    var confirmPassword = document.getElementById('confirm-password').value;

    if (!newUsername || !newPassword || !confirmPassword) {
        alert('Veuillez remplir tous les champs.');
        event.preventDefault();
    } else if (newPassword !== confirmPassword) {
        alert('Les mots de passe ne correspondent pas.');
        event.preventDefault();
    }
});