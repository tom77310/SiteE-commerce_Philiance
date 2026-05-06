<?php
$titre = "Site e-commerce 2022-2023 : Récapitulatif de votre commande";
ob_start();
?>

<?php
$commande = RecupererUneCommandeParId($idCommande);
// if (!$commande) {
//     echo "Commande introuvable.";
//     return;
// }
?>

<div class="container mt-5">
    <h2>Commande Comfirmée</h2>
    <p><strong>Réference :</strong> <?= $commande->getReference(); ?> </p>
    <p><strong>Date :</strong> <?= $commande->getDate()->format('d/m/Y H:i'); ?> </p>

    <table class="table mt-4">
        <thead>
            <tr>
                <th>Produit</th>
                <th>Prix</th>
                <th>quantité</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>

        <?php 
        foreach ($details as $detail) :
                $produit = AvoirUnProduitParSonId($detail->getIdProduit());
                $totalLigne = $detail->getPrixUnitaire() * $detail->getQuantite();
        ?>
        <tr>
            <td><?= htmlspecialchars($produit->getNomProduit()) ?></td>
            <td><?= $detail->getPrixUnitaire() ?> €</td>
            <td><?= $detail->getQuantite() ?></td>
            <td><?= $totalLigne ?> €</td>
        </tr>

        <?php endforeach ?>

        </tbody>
    </table>

    <h4>Total Payé : <?= $commande->getMontant(); ?> €</h4>

    <?php
        $redirect = "index.php?action=accueil";

        if (isset($_SESSION['user'])) {
            $role = strtoupper($_SESSION['user']->getRole());

            if ($role === 'ADMIN') {
                $redirect = "index.php?action=Admin_ListeCommandes";
            } elseif (isset($_GET['source']) && $_GET['source'] === 'panier') {
                $redirect = "index.php?action=utilisateur_compte";
            } else {
                $redirect = "index.php?action=historique_commandes";
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