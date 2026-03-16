<?php
$titre = "Site e-commerce 2022-2023: Formulaire Modifier un produit";
ob_start();
?>

<h1 class="mb-4">Modifier le produit sélectionné</h1>

<div class="card">
    <div class="card-body">
        <form action="index.php?action=Admin_UpdateProduit" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $produit->getId() ?>">
            <input type="hidden" name="ancienne_image" value="<?= $produit->getImage() ?>">

            <div class="mb-3">
                <label class="form-label">Image Actuelle</label><br>
                <img src="assets/img/produits/<?= $produit->getSexe() ?>s/<?= $produit->getImage() ?>" 
                        alt="AncienneImage" 
                        class="img-thumbnail"
                        width="120">
            </div>
            <div class="mb-3">
                <label class="form-label">Changer l'image</label>
                <input type="file" 
                        name="image" 
                        class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Nom du produit</label>
                <input type="text" 
                       name="nom_produit" 
                       class="form-control" 
                       value="<?= htmlspecialchars($produit->getNomProduit()) ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Taille du vetement</label>
                <input type="text" 
                name="taille" 
                class="form-control" 
                value="<?= htmlspecialchars($produit->getTaille()) ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Sexe</label>
                <select name="sexe" class="form-select">
                    <option value="homme" <?= $produit->getSexe()=="homme"?'selected':'' ?>>Homme</option>
                    <option value="femme" <?= $produit->getSexe()=="femme"?'selected':'' ?>>Femme</option>
                    <option value="enfant" <?= $produit->getSexe()=="enfant"?'selected':'' ?>>Enfant</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Type de vetement</label>
                <input type="text" 
                       name="type_vetement" 
                       class="form-control" 
                       value="<?= htmlspecialchars($produit->getTypeVetement()) ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Catégorie</label>
                <input type="text"
                        name="categorie_vetement"
                        class="form-control"
                        value="<?= htmlspecialchars($produit->getCategorieVetement()) ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Prix</label>
                <input type="number" 
                        name="prix" 
                        class="form-control"
                        step="0.01"
                        value="<?= $produit->getPrix() ?>"> €
            </div>
            <button class="btn btn-success">
                Enregistrer les modifications
            </button>
            <a href="index.php?action=Admin_Produits" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</div>

<?php
$contenu = ob_get_clean();
require "vues/template.php";
?>