<?php

// Import necessaire
require_once "model/produit.php";
require_once "model/commande.php";
require_once "model/detailCommande.php";
require_once "model/avis.php";

// Recuperer tous les produits pour Femmes
function ctlModeFemmes(){

    $produitFemmes = RecupererProduitFemme();

    require "vues/Defaut/ProduitsFemmes.php";
}

// Recuperer tous les produits pour Hommes
function ctlModeHommes(){

    $produitHommes = RecupererProduitHomme();

    require "vues/Defaut/ProduitsHommes.php";
}

// Recuperer tous les produits pour Enfants
function ctlModeEnfants(){

    $produitEnfants = RecupererProduitEnfants();

    require "vues/Defaut/ProduitsEnfants.php";
}

// Detail des produits
function ctlDetailProduit() {

    // Vérifie qu'un id produit est présent
    if (isset($_GET['id'])) {

        $id = (int) $_GET['id'];

        // Récupération du produit et de ses avis
        $produit = AvoirUnProduitParSonId($id);
        $avis = AvoirAvisParProduit($id);

        require_once "vues/Defaut/detailProduit.php";

    }
    else {

        // Redirection si aucun id produit n'est fourni
        header("Location: index.php?action=accueil");
    }
}

// Ajouter un produit au panier
function ctlAjouterPanier() {

    if (isset($_GET['id'])) {

        $id = (int) $_GET['id'];

        // Création du panier en session s'il n'existe pas
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = [];
        }

        // Si le produit existe déjà dans le panier, on augmente la quantité
        if (isset($_SESSION['panier'][$id])) {
            $_SESSION['panier'][$id]++;
        }
        else {

            // Sinon on ajoute le produit avec une quantité de 1
            $_SESSION['panier'][$id] = 1;
        }

        header("Location: index.php?action=detail_produit&id=" . $id);
        exit();
    }
}

// Afficher le panier
function ctlAfficherPanier() {

    $panier = $_SESSION['panier'] ?? [];

    $produitsPanier = [];
    $total = 0;

    // Parcours des produits du panier
    foreach ($panier as $id => $quantite) {

        $produit = AvoirUnProduitParSonId($id);

        if ($produit) {

            $produitsPanier[] = [
                'produit' => $produit,
                'quantite' => $quantite
            ];

            // Calcul du total du panier
            $total += $produit->getPrix() * $quantite;
        }
    }

    require "vues/Utilisateur/panier.php";
}

// Modifier quantité dans le panier
function ctlModifierQuantite() {

    if (isset($_POST['id'], $_POST['quantite'])) {

        $id = (int) $_POST['id'];
        $quantite = (int) $_POST['quantite'];

        // Si la quantité est supérieure à 0, on met à jour
        if ($quantite > 0) {
            $_SESSION['panier'][$id] = $quantite;
        }
        else {

            // Sinon on supprime le produit du panier
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

        // Vérifie que le produit existe dans le panier
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
            $total += $produit->getPrix() * $quantite;
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

    // Sécurité => vérifier que la commande a bien été créée
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
    header("Location: index.php?action=Commande_recap&id=" . $idCommande);
    exit();
}

// Afficher le recap de la commande
function ctlRecapCommande() {

    // Vérifie qu'un id de commande est présent
    if (!isset($_GET['id'])) {
        header("Location: index.php?action=accueil");
        exit();
    }

    $idCommande = (int) $_GET['id'];

    // Récupération de la commande et de ses détails
    $commande = RecupererUneCommandeParId($idCommande);
    $details = RecupererDetailsCommande($idCommande);

    require "vues/Utilisateur/recapCommande.php";
}

// Historique de commande
function ctlHistoriqueCommandesUtilisateurs(){

    // On vérifie si l'utilisateur est bien connecté
    if (!isset($_SESSION['user'])) {

        // Si l'utilisateur n'est pas connecté
        header("Location: index.php?action=utilisateur_connexion");

        exit();
    }

    // On récupère l'id de l'utilisateur connecté
    $idUtilisateur = $_SESSION['user']->getIdUtilisateurs();

    // Puis on récupère les commandes de cet utilisateur
    $commandes = RecupererCommandeParUtilisateur($idUtilisateur);

    // Chargement de la vue
    require "vues/Utilisateur/historiqueCommandes.php";
}

// Supprimer une commande dans l'historique utilisateur
function ctlSupprimerCommandeUtilisateur() {

    // Vérifie que l'utilisateur est connecté
    if (!isset($_SESSION['user'])) {
        header("Location: index.php?action=utilisateur_connexion");
        exit();
    }

    // Vérifie qu'un id de commande est fourni
    if (!isset($_GET['id'])) {
        header("Location: index.php?action=Commande_historique_utilisateur");
        exit();
    }

    $idCommande = (int) $_GET['id'];
    $idUtilisateur = $_SESSION['user']->getIdUtilisateurs();

    // Sécurité : vérifier que la commande appartient à l'utilisateur
    $commande = RecupererUneCommandeParId($idCommande);

    if (!$commande || $commande->getIdUtilisateur() != $idUtilisateur) {
        header("Location: index.php?action=Commande_historique_utilisateur");
        exit();
    }

    // Suppression de la commande
    SupprimerCommandeParId($idCommande);

    header("Location: index.php?action=Commande_historique_utilisateur");
    exit();
}

?>