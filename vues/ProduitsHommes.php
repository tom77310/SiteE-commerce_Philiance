<?php
$titre = "Site e-commerce 2022-2023 : Articles Hommes";
ob_start()
?>
<!-- Cartes Bootstraps pour afficher les articles -->
<div class="container mt-4">
    <div class="row">

        <?php foreach ($produitHommes as $p) : ?>
            <div class="col-md-4 mb-4">
                
                <div class="card h-100">
                    <img 
                        src="assets/img/produits/hommes/<?= htmlspecialchars($p->getImage()) ?>" 
                        class="card-img-top" 
                        alt="<?= htmlspecialchars($p->getNomProduit()) ?>"
                    >

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?= htmlspecialchars($p->getNomProduit()) ?></h5>
                        <h5 class="card-title"><?= htmlspecialchars($p->getTaille()) ?></h5>
                        <h5 class="card-title">Prix : <?= htmlspecialchars($p->getPrix()) ?> €</h5>
                        <br>
                        <a href="#" class="btn btn-primary mt-auto">Voir Plus</a>
                    </div>
                </div>

            </div>
        <?php endforeach; ?>

    </div>
</div>



<?php
$contenu = ob_get_clean();
require "vues/template.php";
?>