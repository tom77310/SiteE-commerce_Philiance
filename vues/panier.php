<?php
$titre = "Mon panier";
ob_start();
?>

<div class="container mt-5">
    <h2>Mon panier</h2>

    <?php if (empty($produitsPanier)) : ?>
        <p>Votre panier est vide.</p>
    <?php else : ?>

        <table class="table">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                    <th>Sous-total</th>
                </tr>
            </thead>
            <tbody>

            <?php foreach ($produitsPanier as $item) : 
                $produit = $item['produit'];
                $quantite = $item['quantite'];
                $sousTotal = $produit->getPrix() * $quantite;
            ?>

                <tr>
                    <td><?= htmlspecialchars($produit->getNomProduit()) ?></td>
                    <td><?= $produit->getPrix() ?> €</td>
                    <td><?= $quantite ?></td>
                    <td><?= $sousTotal ?> €</td>
                </tr>

            <?php endforeach; ?>

            </tbody>
        </table>

        <h4>Total : <?= $total ?> €</h4>

    <?php endif; ?>
</div>

<?php
$contenu = ob_get_clean();
require "vues/template.php";
?>
