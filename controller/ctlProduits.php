<?php

require "model/produit.php";
// Recuperer tous les produits pour Femmes
function ctlModeFemmes(){
    $produitFemmes = RecupererProduitFemme();
    require "vues/ProduitsFemmes.php";
}
// Recuperer tous les produits pour Hommes
function ctlModeHommes(){
    $produitHommes = RecupererProduitHomme();
    require "vues/ProduitsHommes.php";
}
// Recuperer tous les produits pour Enfants
function ctlModeEnfants(){
    $produitEnfants = RecupererProduitEnfants();
    require "vues/ProduitsEnfants.php";
}

// Detail des produits
function ctlDetailProduit() {
    if (isset($_GET['id'])) {
        $id = (int) $_GET['id'];
        $produit = AvoirUnProduitParSonId($id);

        require "vues/detailProduit.php";
    } else {
        header("loacation: index.php?action=accueil");
    }
}

function ctlAjouterPanier() {
    if (isset($_GET['id'])) {
        $id = (int) $_GET['id'];

        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = [];
        }

        if (isset($_SESSION['panier'][$id])) {
            $_SESSION['panier'][$id]++;
        } else {
            $_SESSION['panier'][$id] = 1;
        }


        header("Location: index.php?action=detail_produit&id=" . $id);
        exit();
    }
}
function ctlAfficherPanier() {
    $panier = $_SESSION['panier'] ?? [];

    $produitsPanier = [];
    $total = 0;

    foreach ($panier as $id => $quantite) {
        $produit = AvoirUnProduitParSonId($id);
        if ($produit) {
            $produitsPanier[] = [
                'produit' => $produit,
                'quantite' => $quantite
            ];
            $total += $produit->getPrix() * $quantite;
        }
    }

    require "vues/panier.php";
}

?>