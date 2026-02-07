<?php
$titre = "Site e-commerce 2022-2023 : Mes informations";
ob_start();
?>

<h1 class="mb-4">Mes informations personnelles</h1>

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

    <form method="post" action="index.php?action=supprimer_compte" class="mt-4" onsubmit="return confirmerSuppression();">
        <!-- Champ mot de passe obligatoire -->
        <div class="mb-3">
            <label for="password" class="form-label text-danger">
                Confirmez votre mot de passe pour supprimer votre compte
            </label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
    
        <!-- Bouton suppression -->
        <button type="submit" class="btn btn-danger">
            Supprimer mon compte
        </button>
    </form>


    <!-- Confirmation JavaScript -->
    <script>
    function confirmerSuppression() {
        return confirm(
            "⚠️ Attention !\n\n" +
            "Cette action est définitive.\n" +
            "Votre compte sera supprimé.\n\n" +
            "Êtes-vous sûr de vouloir continuer ?"
        );
    }
    </script>
<?php
$contenu = ob_get_clean();
require "vues/template.php";
?>
