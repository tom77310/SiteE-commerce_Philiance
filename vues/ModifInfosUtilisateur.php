<?php
$titre = "Site e-commerce 2022-2023: Modifier mes informations Persos";
ob_start();
?>

<h2 class="mb-4">Modifier mes informations</h2>

<form method="post" action="index.php?action=modifier_compte_traitement">
    <div class="mb-3">
        <label class="form-label">Nom</label>
        <input 
            name="nom"
            type="text" 
            class="form-control"
            value="<?= htmlspecialchars($utilisateur->getNom()) ?>"            
        >
    </div>

    <div class="mb-3">
        <label class="form-label">Prénom</label>
        <input 
            type="text" 
            class="form-control"
            value="<?= htmlspecialchars($utilisateur->getPrenom()) ?>"
            name="prenom"
        >
    </div>

    <div class="mb-3">
        <label class="form-label">Pseudo</label>
        <input 
            type="text" 
            class="form-control"
            value="<?= htmlspecialchars($utilisateur->getPseudo()) ?>"
            name="pseudo"
        >
    </div>

    <div class="mb-3">
        <label class="form-label">Email</label>
        <input 
            type="email" 
            class="form-control"
            value="<?= htmlspecialchars($utilisateur->getEmail()) ?>"
            name="email"
        >
    </div>

    <div class="mb-3">
        <label class="form-label">Date de naissance</label>
        <?php
            $date = new DateTime($utilisateur->getDateNaissance());
        ?>
        <input 
            type="text" 
            class="form-control"
            value="<?= $date->format('d/m/Y') ?>"
            name="date_naissance"
        >
    </div>
    <div class="mb-3">
    <label for="tel" class="form-label">Téléphone</label>
    <input
        type="tel"
        class="form-control"
        id="tel"
        name="tel"
        placeholder="06 12 34 56 78"
        value="<?= htmlspecialchars($utilisateur->getTel()) ?>"
        required
    >
</div>
<!-- Champs pour modifier le Mot de passe -->

    <button type="submit" class="btn btn-primary">
        Enregistrer les modifications
    </button>

    <a href="index.php?action=utilisateur_compte" class="btn btn-secondary ms-2">
        Retour
    </a>
</form>

<?php
$contenu = ob_get_clean();
require "vues/template.php";
