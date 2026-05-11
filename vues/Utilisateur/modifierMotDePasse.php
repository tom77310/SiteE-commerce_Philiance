<?php
$titre = "UrbanStyle : Utilisateur - Modifier mon mot de passe";
ob_start();
?>

<h2 class="text-center text-decoration-underline mt-3 mb-4">Modifier mon mot de passe</h2>

    <?php if (!empty($erreurs)) { ?>

        <div class="alert alert-danger">

            <ul class="mb-0">

                <?php foreach ($erreurs as $erreur) { ?>

                    <li><?= htmlspecialchars($erreur) ?></li>

                <?php } ?>

            </ul>

        </div>

    <?php } ?>

<form method="post" action="index.php?action=utilisateur_modifier_mot_de_passe_traitement">

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

    <a href="index.php?action=utilisateur_compte" class="btn btn-secondary ms-2">
        Annuler
    </a>
</form>

<?php
$contenu = ob_get_clean();
require "vues/template.php";
?>