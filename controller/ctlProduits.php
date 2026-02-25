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

// Modifier quantité dans le panier
function ctlModifierQuantite() {
    if (isset($_POST['id'], $_POST['quantite'])) {
        $id = (int) $_POST['id'];
        $quantite = (int) $_POST['quantite'];

        if ($quantite > 0) {
            $_SESSION['panier'][$id] = $quantite;
        } else {
            unset($_SESSION['panier'][$id]);
        }
    }
    header("Location: index.php?action=Panier");
    exit();
}
// Supprimer une ligne du panier
function ctlSupprimerLignePanier() {
    if (isset($_GET['id'])) {
        $id = (int) $_GET['id'];

        if (isset($_SESSION['panier'][$id])) {
            unset($_SESSION['panier'][$id]);
        }
    }

    header("Location: index.php?action=Panier");
    exit();
}

// Vider Panier entier
function ctlViderPanier() {
    unset($_SESSION['panier']);

    header("Location: index.php?action=Panier");
    exit();
}

// Valider le panier
function ctlValiderPanier() {
    // On vérifie que le panier existe
    if (!isset($_SESSION['panier']) || empty($_SESSION['panier'])) {
        header("Location: index.php?action=Panier");
        exit();
    }
    // On vérifie si l'utilisateur est connecté
    if (!isset($_SESSION['user'])) {
        header("Location: index.php?action=utilisateur_connexion");
        exit();
    }
}


?>