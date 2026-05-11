<?php
$titre = "UrbanStyle: Utilisateur - Mes informations";
ob_start();

/** @var Utilisateurs $utilisateur */ // Evite l'erreur visuel de VSCode sur les variables
?>

<h1 class="text-center text-decoration-underline mt-3 mb-4">Mes informations personnelles</h1>

<div class="card">
    <div class="card-body">

        <p><strong>Nom :</strong> <?= htmlspecialchars($utilisateur->getNom()) ?></p>
        <p><strong>Prénom :</strong> <?= htmlspecialchars($utilisateur->getPrenom()) ?></p>
        <p><strong>Email :</strong> <?= htmlspecialchars($utilisateur->getEmail()) ?></p>
        <p><strong>Pseudo :</strong> <?= htmlspecialchars($utilisateur->getPseudo()) ?></p>

        <?php if (method_exists($utilisateur, 'getTel')): ?>
            <p><strong>Téléphone :</strong> <?= htmlspecialchars($utilisateur->getTel()) ?></p>
        <?php endif; ?>

        <?php if (method_exists($utilisateur, 'getDateNaissance')): ?>
            <?php
                $date = new DateTime($utilisateur->getDateNaissance());
                $dateFormatee = $date->format('d/m/Y');
            ?>
            <p><strong>Date de naissance :</strong> <?= $dateFormatee ?></p>
        <?php endif; ?>


    </div>
</div>

<div class="mt-4">
    <a href="index.php?action=utilisateur_compte" class="btn btn-secondary">
        ⬅ Retour à mon compte
    </a>
</div>

    
<?php
$contenu = ob_get_clean();
require "vues/template.php";
?>
