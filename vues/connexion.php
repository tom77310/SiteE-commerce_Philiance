<?php
$titre = "Site e-commerce 2022-2023 : Connexion";
ob_start()
?>

<form action="#" method="POST">
  <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" id="email" name="email">
  </div>
    <div class="mb-3">
    <label for="motdepasse" class="form-label">Mot de passe</label>
    <input type="password" class="form-control" id="motdepasse" name="motdepasse">
    </div>
  <button type="submit" class="btn btn-primary">Connexion</button>
</form>

<?php
$contenu = ob_get_clean();
require "vues/template.php";
?>