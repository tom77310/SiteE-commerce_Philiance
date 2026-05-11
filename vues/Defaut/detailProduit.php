<?php
$titre = "UrbanStyle : Détail du produit séléctionner";
ob_start();

/** @var Produit $produit */ // Evite l'erreur visuel de VSCode sur les variables
?>

<div class="container mt-5">
    <div class="row">

        <div class="col-md-6">
            <img 
                src="assets/img/produits/<?= $produit->getSexe()?>s/<?= $produit->getImage() ?>"  
                class="img-fluid"
                alt="<?= htmlspecialchars($produit->getNomProduit()) ?>"
            >
        </div>

        <div class="col-md-6">
            <h2 class="text-decoration-underline"><?= htmlspecialchars($produit->getNomProduit()) ?></h2>
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

            <!-- BOUTON PANIER -->
            <?php if (isset($_SESSION['user'])) : ?>

                <?php if (strtoupper($_SESSION['user']->getRole()) === 'USER') : ?>
                    <a href="index.php?action=Panier_ajoutProduit&id=<?= $produit->getId() ?>" class="btn btn-success mt-2">
                        Ajouter au panier
                    </a>
                <?php endif; ?>

            <?php else : ?>

                <a href="index.php?action=utilisateur_connexion" class="btn btn-warning mt-2">
                    Connectez-vous ou inscrivez-vous pour ajouter cet article au panier
                </a>

            <?php endif; ?>

        </div>
    </div>

    <h3 class="mt-5">Avis des clients</h3>

    <?php if (empty($avis)) { ?>

        <p>Aucun avis pour ce produit.</p>

    <?php } else { ?>

        <?php foreach ($avis as $a) { ?>

            <div class="card mb-3">
                <div class="card-body">

                    <h5><?= htmlspecialchars($a['pseudo']) ?></h5>

                    <p>⭐ <?= $a['note'] ?>/5 </p>

                    <p><?= nl2br(htmlspecialchars($a['commentaire'])) ?></p>

                    <small class="text-muted">
                        <?= $a['date'] ?>
                    </small>

                    <?php
                    if (isset($_SESSION['user'])) {
                        $isOwner = $_SESSION['user']->getIdUtilisateurs() == $a['id_utilisateur'];
                        $isAdmin = strtoupper($_SESSION['user']->getRole()) == 'ADMIN';
                    ?>

                        <?php if ($isOwner || $isAdmin) { ?>
                            <div class="mt-3">

                                <?php if ($isOwner) { ?>
                                    <a href="index.php?action=Avis_modifieravis&id=<?= $a['id_avis'] ?>"
                                       class="btn btn-sm btn-warning">
                                        Modifier mon avis
                                    </a>
                                <?php } ?>

                                <a href="index.php?action=Avis_supprimeravis&id=<?= $a['id_avis'] ?>"
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Voulez-vous vraiment supprimer cet avis ?')">
                                    Supprimer l'avis
                                </a>

                            </div>
                        <?php } ?>

                    <?php } ?>

                </div>
            </div>

        <?php } ?>
    <?php } ?>

    <?php
        $dejaAvis = false;

        if (isset($_SESSION['user'])) {
            $dejaAvis = AvisExisteDeja($_SESSION['user']->getIdUtilisateurs(), $produit->getId());
        }
    ?>

    <?php if (isset($_SESSION['user']) && !$dejaAvis) { ?>

        <h4 class="mt-4">Ajouter un avis</h4>

        <form action="index.php?action=Avis_Ajout" method="post">

            <input type="hidden" name="id_produit" value="<?= $produit->getId() ?>">

            <div class="mb-3">
                <label class="form-label">Note</label>
                <select name="note" class="form-select" required>
                    <option value="">Choisir</option>
                    <option value="1">1 ⭐</option>
                    <option value="2">2 ⭐</option>
                    <option value="3">3 ⭐</option>
                    <option value="4">4 ⭐</option>
                    <option value="5">5 ⭐</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Commentaire</label>
                <textarea name="commentaire" class="form-control" required></textarea>
            </div>

            <button class="btn btn-primary">Envoyer</button>
        </form>

    <?php } ?>

</div>

<?php
$contenu = ob_get_clean();
require "vues/template.php";
?>