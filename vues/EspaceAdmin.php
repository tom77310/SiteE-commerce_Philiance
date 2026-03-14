<?php
$titre = "Site e-commerce 2022-2023 : Espace Administrateur";
ob_start();
?>

<h1 class="mb-4">Tableau de bord Administrateur</h1>

<div class="row g-4">

    <!-- Produits -->
    <div class="col-md-4">
        <div class="card border-primary h-100">
            <div class="card-body text-center">
                <h5 class="card-title">Produits</h5>
                <p class="display-6">
                    <?= $nbProduits ?>
                </p>
                <a href="index.php?action=Admin_Produits"
                class="btn btn-outline-primary w-100">
                    Gérer les Produits
                </a>
            </div>
        </div>
    </div>

    <!-- Utiliisateurs -->
    <div class="col-md-4">
        <div class="card border-success h-100">
            <div class="card-body text-center">
                <h5 class="card-title">Utilisateurs</h5>
                <p class="display-6">
                    <?= $nbUtilisateurs ?>
                </p>
                <a href="index.php?action=Admin_ListeUtilisateurs"
                   class="btn btn-outline-success w-100">
                    Gérer les utilisateurs
                </a>
            </div>
        </div>
    </div>
    <!-- Commandes -->
     <div class="col-md-4">
        <div class="card border-warning h-100">
            <div class="card-body text-center">
                <h5 class="card-title">Commandes en cours</h5>
                <p class="display-6">
                    <?= $nbCommandes ?>
                </p>
                <a href="index.php?action=Admin_ListeCommandes"
                class="btn btn-outline-warning w-100">
                    Gérer les Commandes
                </a>
            </div>
        </div>
     </div>
</div>

<div class="card mt-5">
    <div class="card-body">
        <h5 class="card-title">
            Administration rapide
        </h5>
        <p class="card-text">
            Accédez rapidement aux principales actions d'administration du site.
        </p>
        <div class="row g-3">
            <div class="col-md-4">
                <a href="index.php?action=Admin_AjouterProduit"
                   class="btn btn-primary w-100">
                    Ajouter un Produit
                </a>
            </div>
            <div class="col-md-4">
                <a href="index.php?action=Admin_Utilisateurs"
                   class="btn btn-secondary w-100">
                   Voir les utilisateurs
                </a>
            </div>
            <div class="col-md-4">
                <a href="index.php?action=Admin_Commandes"
                class="btn btn-success w-100">
                    Voir les commandes
                </a>
            </div>
        </div>
    </div>
</div>



<?php
$contenu = ob_get_clean();
require "vues/template.php";
?>