<?php
$titre = "UrbanStyle: Récapitulatif de votre commande";
ob_start();

/**
 * @var int $idCommande
 * @var array $details
 * @var Commande $commande
 */ // Enlève l'erreur visuel de VSCode des variables
?>

<?php
$commande = RecupererUneCommandeParId($idCommande);
?>

<div class="container mt-5">

    <h2 class="text-center text-decoration-underline mt-3 mb-4">Commande Confirmée</h2>

    <p><strong>Référence :</strong> <?= $commande->getReference(); ?> </p>

    <p><strong>Date :</strong> <?= $commande->getDate()->format('d/m/Y H:i'); ?> </p>

    <table class="table mt-4">
        <thead>
            <tr>
                <th>Produit</th>
                <th>Prix</th>
                <th>Quantité</th>
                <th>Total</th>
            </tr>
        </thead>

        <tbody>

        <?php foreach ($details as $detail) : ?>

            <?php
            /** @var object $detail */
            $produit = AvoirUnProduitParSonId($detail->getIdProduit());
            $totalLigne = $detail->getPrixUnitaire() * $detail->getQuantite();
            ?>

            <tr>
                <td><?= htmlspecialchars($produit->getNomProduit()) ?></td>
                <td><?= $detail->getPrixUnitaire() ?> €</td>
                <td><?= $detail->getQuantite() ?></td>
                <td><?= $totalLigne ?> €</td>
            </tr>

        <?php endforeach; ?>

        </tbody>
    </table>

    <h4>Total payé : <?= $commande->getMontant(); ?> €</h4>

    <?php
        $redirect = "index.php?action=accueil";

        if (isset($_SESSION['user'])) {
            $role = strtoupper($_SESSION['user']->getRole());

            if ($role === 'ADMIN') {
                $redirect = "index.php?action=Admin_ListeCommandes";

            } elseif (isset($_GET['source']) && $_GET['source'] === 'panier') {
                $redirect = "index.php?action=utilisateur_compte";

            } else {
                $redirect = "index.php?action=Commande_historique_utilisateur";
            }
        }
    ?>

    <a href="<?= $redirect ?>" class="btn btn-primary mt-3">
        Retour
    </a>

</div>

<?php
$contenu = ob_get_clean();
require "vues/template.php";
?>