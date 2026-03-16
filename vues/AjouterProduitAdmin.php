<?php
$titre = "Site e-commerce 2022-2023 : Administrateur - Ajouter un produit";
ob_start();
?>

<h1 class="mb-4">Ajouter un produit</h1>

<div class="card">
    <div class="card-body">
        <form action="index.php?action=Admin_EnregistrementProduit" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Nom du produit</label>
                <input type="text" name="nom_produit" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Taille</label>
                <input type="text" name="taille" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Sexe</label>
                <select name="sexe" class="form-control">
                    <option value="homme">Homme</option>
                    <option value="femme">Femme</option>
                    <option value="enfant">Enfant</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Type de vêtement</label>
                <input type="text" name="type_vetement" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Catégorie</label>
                <input type="text" name="categorie_vetement" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Prix</label>
                <input type="number" step="0.01" name="prix" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Image du produit</label>
                <input type="file" name="image" class="form-control" accept="img/produits/*" required>
            </div>
            <button class="btn btn-success">
                Ajouter le produit
            </button>
            <a href="index.php?action=Admin_Produits" class="btn btn-secondary">
                Annuler
            </a>
        </form>
    </div>
</div>


<?php
$contenu = ob_get_clean();
require "vues/template.php";
?>