<?php
$titre = "Site e-commerce 2022-2023 : Gestion des Produits";
ob_start();
?>

<h1 class="mb-4">Gestion des produits</h1>

<div class="mb-3">
    <a href="index.php?action=Admin_EspaceAdmin" class="btn btn-secondary">
        Retour a l'espace Administrateur
    </a>

    <a href="index.php?action=Admin_AjouterProduit" class="btn btn-primary">
        Ajouter un produit
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Nom</th>
                    <th>Taille</th>
                    <th>Sexe</th>
                    <th>Type</th>
                    <th>Prix</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($produits as $produit){ ?>
                <tr>
                    <td><?= $produit->getId() ?></td>
                    <td>
                        <img src="assets/img/produits/<?= htmlspecialchars($produit->getImage()) ?>"
                             width="60"
                             class="img-thumbnail">
                    </td>

                    <td><?= htmlspecialchars($produit->getNomProduit()) ?></td>

                    <td><?= htmlspecialchars($produit->getTaille()) ?></td>

                    <td><?= htmlspecialchars($produit->getSexe()) ?></td>

                    <td><?= htmlspecialchars($produit->getTypeVetement()) ?></td>

                    <td><?= $produit->getPrix() ?> €</td>

                    <td>
                        <a href="index.php?action=Admin_ModifierProduit&id=<?= $produit->getId() ?>"
                           class="btn btn-sm btn-warning">
                            Modifier
                        </a>
                        <a href="index.php?action=Admin_SupprimerProduit&id=<?= $produit->getId() ?>"
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('Etes vous sûr de vouloir supprimer ce produit?')">
                                Supprimer
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php
$contenu = ob_get_clean();
require "vues/template.php";
?>