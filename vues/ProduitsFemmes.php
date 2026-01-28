<?php
$titre = "Site e-commerce 2022-2023 : Articles Femmes";
ob_start()
?>
<?php
// require "model/produit.php";
?>
<!-- Cartes Bootstraps pour afficher les articles -->
 <?php
 foreach($produitFemmes as $p){
    ?>
<div class="card" style="width: 18rem;">
    <img src="assets/img/produits/femmes/<?= htmlspecialchars($p->getImage()) ?>" class="card-img-top" alt="<?= htmlspecialchars($p->getNomProduit()) ?>">
    <div class="card-body">
        <h5 class="card-title"><?= $p->getNomProduit() ?></h5>
        <p class="card-text"><?= $p->getTypeVetement() ?></p>
        <a href="#" class="btn btn-primary">Voir Plus</a>
    </div>
</div>
<?php
}
?>


<?php
$contenu = ob_get_clean();
require "vues/template.php";
?>