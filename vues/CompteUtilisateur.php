<?php
$titre = "Site e-commerce 2022-2023 : Mon compte";
ob_start();
?>

<h1 class="mb-4">Mon espace utilisateur</h1>

<div class="card mb-4">
    <div class="card-body">
        <h5 class="card-title">
            Bonjour <?= htmlspecialchars($utilisateur->getPrenom()) ?>
        </h5>
        <p class="card-text">
            Email : <?= htmlspecialchars($utilisateur->getEmail()) ?>
        </p>
    </div>
</div>

<div class="row g-3">

    <div class="col-md-6">
        <a href="index.php?action=utilisateur_infos" class="btn btn-outline-primary w-100">
            👤 Voir mes informations
        </a>
    </div>

    <div class="col-md-6">
        <a href="index.php?action=modifier_compte" class="btn btn-outline-secondary w-100">
            ✏️ Modifier mes informations
        </a>
    </div>

    <div class="col-md-6">
        <a href="#" class="btn btn-outline-danger w-100">
            🗑️ Supprimer mon compte
        </a>
    </div>

    <div class="col-md-6">
        <a href="#" class="btn btn-outline-success w-100">
            📦 Historique des commandes
        </a>
    </div>

</div>

<?php
$contenu = ob_get_clean();
require "vues/template.php";
?>
