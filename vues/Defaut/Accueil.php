<?php
$titre = "UrbanStyle : Accueil";
ob_start();

/**
 * @var array $nouveautes
 * @var array $promotions
 * @var array $derniersProduits
 * @var array $avisRecents
 */
?>

<div class="container mt-5">

    <!-- HERO -->
    <div class="hero-section text-white text-center mb-5">
        <h1>Bienvenue sur notre boutique UrbanStyle</h1>
        <p>Découvrez les dernières tendances, promotions et nouveautés</p>
    </div>

    <!-- ========================= -->
    <!-- NOUVEAUTÉS -->
    <!-- ========================= -->
    <h3 class="mb-3">🔥 Nouveautés</h3>

    <div class="row mb-5">

        <?php if (!empty($nouveautes)) : ?>

            <?php foreach ($nouveautes as $p) : ?>


                <div class="col-md-3 mb-3">
                    <div class="card h-100">

                        <img src="assets/img/produits/<?= $p->getSexe() ?>s/<?= $p->getImage() ?>"
                             class="card-img-top"
                             alt="<?= htmlspecialchars($p->getNomProduit()) ?>">

                        <div class="card-body d-flex flex-column">
                            <h6><?= htmlspecialchars($p->getNomProduit()) ?></h6>
                            <p class="fw-bold"><?= $p->getPrix() ?> €</p>

                            <a href="index.php?action=detail_produit&id=<?= $p->getId() ?>"
                               class="btn btn-primary mt-auto">
                                Voir
                            </a>
                        </div>

                    </div>
                </div>

            <?php endforeach; ?>

        <?php else : ?>
            <p class="text-muted">Aucune nouveauté disponible.</p>
        <?php endif; ?>

    </div>

    <!-- ========================= -->
    <!-- PROMOTIONS -->
    <!-- ========================= -->

             <!-- Section promotions a venir en V2 -->

    <!-- ========================= -->
    <!-- AVIS -->
    <!-- ========================= -->
    <h3 class="mb-3">⭐ Avis récents</h3>

    <?php if (!empty($avisRecents)) : ?>

        <div class="row mb-5">

            <?php foreach ($avisRecents as $a) : ?>

                <div class="col-md-4 mb-3">
                    <div class="card h-100">

                        <div class="card-body">

                            <h5><?= htmlspecialchars($a['nom_produit']) ?></h5>
                            <h6><?= htmlspecialchars($a['pseudo']) ?></h6>

                            <p> <?= $a['note'] ?>/5⭐</p>

                            <p><?= nl2br(htmlspecialchars($a['commentaire'])) ?></p>

                            <small class="text-muted">
                                <?= $a['date'] ?>
                            </small>

                        </div>

                    </div>
                </div>

            <?php endforeach; ?>

        </div>

    <?php else : ?>
        <p class="text-muted">Aucun avis récent.</p>
    <?php endif; ?>

    <!-- ========================= -->
    <!-- CATÉGORIES -->
    <!-- ========================= -->
    <h3 class="mb-3">🧭 Explorer les catégories</h3>

    <div class="row text-center mb-5">

        <div class="col-md-4">
            <a href="index.php?action=Produits_Hommes" class="btn btn-dark w-100">
                Homme
            </a>
        </div>

        <div class="col-md-4">
            <a href="index.php?action=Produits_Femmes" class="btn btn-dark w-100">
                Femme
            </a>
        </div>

        <div class="col-md-4">
            <a href="index.php?action=Produits_Enfants" class="btn btn-dark w-100">
                Enfant
            </a>
        </div>

    </div>

</div>

<?php
$contenu = ob_get_clean();
require "vues/template.php";
?>