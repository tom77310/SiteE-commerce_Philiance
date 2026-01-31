<?php
$titre = "Site e-commerce 2022-2023 : Détail du produit séléctionner (produits femmes)";
ob_start();
?>

<div class="container mt-5">
    <div class="row">

        <div class="col-md-6">
            <img 
                src="assets/img/produits/<?= htmlspecialchars($produit->getImage()) ?>" 
                class="img-fluid"
                alt="<?= htmlspecialchars($produit->getNomProduit()) ?>"
            >
        </div>

        <div class="col-md-6">
            <h2><?= htmlspecialchars($produit->getNomProduit()) ?></h2>
            <p><strong>Type :</strong> <?= htmlspecialchars($produit->getTypeVetement()) ?></p>
            <p><strong>Catégorie :</strong> <?= htmlspecialchars($produit->getCategorieVetement()) ?></p>
            <p><strong>Taille :</strong> <?= htmlspecialchars($produit->getTaille()) ?></p>
            <p><strong>Prix :</strong> <?= htmlspecialchars($produit->getPrix()) ?> €</p>

        <?php
            $sexe = strtolower($produit->getSexe());

            switch ($sexe) {
                case 'femme':
                    $retour = "Produits_Femmes";
                    break;
                case 'homme':
                    $retour = "Produits_Hommes";
                    break;
                case 'enfant':
                    $retour = "Produits_Enfants";
                    break;
                
                default:
                    $retour = "accueil";
                    break;
            }
        ?>
            <a href="index.php?action=<?= $retour ?>" class="btn btn-secondary mt-3">
                Retour aux produits
            </a>
        </div>

    </div>
   <?php if (isset($_SESSION['user'])) : ?>

    <?php if (
        $_SESSION['user']->getRole() === 'USER' ||
        $_SESSION['user']->getRole() === 'ADMIN'
    ) : ?>

        <a href="index.php?action=Produit_Ajout&id=<?= $produit->getId() ?>" class="btn btn-success mt-2">
            Ajouter au panier
        </a>


    <?php endif; ?>

<?php else : ?>

    <a href="index.php?action=utilisateur_connexion" class="btn btn-warning mt-2">
        Connectez-vous ou inscrivez-vous pour ajouter cet article au panier
    </a>

<?php endif; ?>

</div>

<?php
$contenu = ob_get_clean();
require "vues/template.php";
?>
