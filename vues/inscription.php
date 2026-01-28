<?php
$titre = "Site e-commerce 2022-2023 : Inscription";
ob_start()
?>
<h1 class="text-center">Inscription</h1>
<form action="#" method="POST">
    <div class="mb-3">
    <label for="nom" class="form-label">Nom</label>
    <input type="text" class="form-control" id="nom" name="nom">
    </div>
    <div class="mb-3">
    <label for="prenom" class="form-label">Prenom</label>
    <input type="text" class="form-control" id="prenom" name="prenom">
    </div>
    <div class="mb-3">
    <label for="pseudo" class="form-label">Pseudo</label>
    <input type="text" class="form-control" id="pseudo" name="pseudo">
    </div>
    <div class="mb-3">
    <label for="tel" class="form-label">Telephone</label>
    <input type="text" class="form-control" id="tel" name="tel">
    </div>
    <div class="mb-3">
    <label for="date_naissance" class="form-label">Date de Naissance</label>
    <input type="date" class="form-control" id="date_naissance" name="date_naissance">
    </div>
    <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" id="email" name="email">
    </div>
    <div class="mb-3">
    <label for="motdepasse" class="form-label">Mot de passe</label>
    <input type="password" class="form-control" id="motdepasse" name="motdepasse">
    </div>
    <button type="submit" class="btn btn-primary">S'inscrire</button>
</form>

<?php
$contenu = ob_get_clean();
require "vues/template.php";
?>