<?php
$titre = "UrbanStyle: Mon panier";
ob_start();

/**
 * @var float|int $total
 */ // Enleve les erreurs visuel de VSCode sur la variable $total
?>

<div class="container mt-5">

    <h2 class="text-center text-decoration-underline mt-3 mb-4">Mon panier</h2>

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

                /** @var Produit $produit */ // Ameliore l'auto-completion de VSCode
                $produit = $item['produit'];
                $quantite = $item['quantite'];
                $sousTotal = $produit->getPrix() * $quantite;

            ?>

                <tr>
                    <td><?= htmlspecialchars($produit->getNomProduit()) ?></td>

                    <td><?= $produit->getPrix() ?> €</td>

                    <td>
                        <form method="post" action="index.php?action=Panier_modifier_quantite" class="d-flex">
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
                            href="index.php?action=Panier_supprimer_ligne_panier&id=<?= $produit->getId() ?>" 
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

        <a 
            href="index.php?action=Panier_vider_panier" 
            class="btn btn-danger mt-3"
            onclick="return confirm('Êtes-vous sûr de vouloir vider le panier ?');"
        >
            Vider le panier
        </a>

        <a href="index.php?action=Panier_valider_panier&source=panier" class="btn btn-success mt-3 ms-2">
            Valider le panier
        </a>

    <?php endif; ?>

</div>

<?php
$contenu = ob_get_clean();
require "vues/template.php";
?>