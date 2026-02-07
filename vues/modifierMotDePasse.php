<?php
$titre = "Site e-commerce 2022-2023 : Modifier mon mot de passe";
ob_start();
?>

<h2 class="mb-4">Modifier mon mot de passe</h2>

<form method="post" action="index.php?action=modifier_mot_de_passe_traitement">

    <!-- Mot de passe actuel -->
    <div class="mb-3">
        <label class="form-label">Mot de passe actuel</label>
        <input
            type="password"
            class="form-control"
            name="ancien_mot_de_passe"
            required
        >
    </div>

    <!-- Nouveau mot de passe -->
    <div class="mb-3">
        <label class="form-label">Nouveau mot de passe</label>
        <input
            type="password"
            class="form-control"
            name="nouveau_mot_de_passe"
            required
        >
    </div>

    <!-- Confirmation -->
    <div class="mb-3">
        <label class="form-label">Confirmer le nouveau mot de passe</label>
        <input
            type="password"
            class="form-control"
            name="confirmation_mot_de_passe"
            required
        >
    </div>

    <button type="submit" class="btn btn-primary">
        Enregistrer
    </button>

    <a href="index.php?action=espace_utilisateur" class="btn btn-secondary ms-2">
        Annuler
    </a>
</form>

<?php
$contenu = ob_get_clean();
require "vues/template.php";
