<?php
$titre = "Site e-commerce 2022-2023 : Mon panier";
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
                    <th>Action</th>
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
                   <td>
                        <form method="post" action="index.php?action=modifier_quantite" class="d-flex">
                            <input type="hidden" name="id" value="<?= $produit->getId() ?>">
                            <input 
                                type="number" 
                                name="quantite" 
                                value="<?= $quantite ?>" 
                                min="1" 
                                class="form-control form-control-sm me-2"
                                style="width: 70px;"
                            >
                            <button class="btn btn-sm btn-primary">OK</button>
                        </form>
                </td>

                    <td><?= $sousTotal ?> €</td>
                    <td>
                        <a 
                            href="index.php?action=supprimer_ligne_panier&id=<?= $produit->getId() ?>" 
                            class="btn btn-sm btn-danger"
                            onclick="return confirm('Supprimer ce produit du panier ?');"
                        >
                            Supprimer
                        </a>
                    </td>
                </tr>

            <?php endforeach; ?>

            </tbody>
        </table>

        <h4>Total : <?= $total ?> €</h4>

    <?php endif; ?>
    <?php if (!empty($produitsPanier)) : ?>
    <a 
        href="index.php?action=vider_panier" 
        class="btn btn-danger mt-3"
        onclick="return confirm('Êtes-vous sûr de vouloir vider le panier ?');"
    >
        Vider le panier
    </a>
<?php endif; ?>
<?php if (!empty($produitsPanier)) : ?>
    <a 
        href="index.php?action=valider_panier" 
        class="btn btn-success mt-3 ms-2"
    >
        Valider le panier
    </a>
<?php endif; ?>

</div>

<?php
$contenu = ob_get_clean();
require "vues/template.php";
?>
