<?php
// Import necessaire
require_once "model/produit.php";
require_once "model/commande.php";
require_once "model/detailCommande.php";
require_once "model/avis.php";

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
        $avis = AvoirAvisParProduit($id);
        require_once "vues/detailProduit.php";

    } else {
        header("Location: index.php?action=accueil");
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
    $panier = $_SESSION['panier'];
    $total = 0;

    // Calcul du total du panier
    foreach ($panier as $id => $quantite) {
        $produit = AvoirUnProduitParSonId($id);
        if ($produit) {
            $total += $produit->getPrix()* $quantite;
        }
    }

    // Création de la commande
    $commande = new Commande();
    $commande->setReference("CMD-" . date("Ymd") . "-" . uniqid());
    $commande->setMontant($total);
    $commande->setDate(new DateTime());
    $commande->setIdUtilisateur($_SESSION['user']->getIdUtilisateurs());

    // Enregistrement en BDD
    $idCommande = creationCommande($commande);

    // Sécurité => vérifier que la commande à bien été créer
    if ($idCommande <= 0) {
        echo "Erreur lors de la création de la commande";
        exit();
    }

    // Enregistrement des produits de la commande
    foreach ($panier as $id => $quantite) {
        $produit = AvoirUnProduitParSonId($id);

        if ($produit) {
            $detail = new detailCommande();
            $detail->setIdCommande($idCommande);
            $detail->setIdProduit($id);
            $detail->setQuantite($quantite);
            $detail->setPrixUnitaire($produit->getPrix());

            AjouterDetailCommande($detail);
        }
    }

    // On vide le panier après validation de la commande
    unset($_SESSION['panier']);

    // Redirection vers la page de recap
    header("Location: index.php?action=recap_commande&id=" . $idCommande);
    exit();
}

// Afficher le recap de la commande
function ctlRecapCommande() {
    if (!isset($_GET['id'])) {
        header("Location: index.php?action=accueil");
        exit();
    }
    $idCommande = (int) $_GET['id'];

    $commande = RecupererUneCommandeParId($idCommande);
    $details = RecupererDetailsCommande($idCommande);

    require "vues/recapCommande.php";
}


// Historique de commande
function ctlHistoriqueCommandesUtilisateurs(){
    // On verifie si l'utilisateur est bien connecter
    if (!isset($_SESSION['user'])) { // Si l'utillisateur n'est pas connecté
        header("Location: index.php?action=utilisateur_connexion"); // On le redirige sur la page de connexion
        exit();
    }
    // Si l'utillisateur est connecté : 
    // on récupère l'id de l'utilisateur connecté 
    $idUtilisateur = $_SESSION['user']->getIdUtilisateurs();

    // puis on récupère les commandes de cet utilisateur
    $commandes = RecupererCommandeParUtilisateur($idUtilisateur);

    // et on charge la vue
    require "vues/historiqueCommandes.php";
}
?>