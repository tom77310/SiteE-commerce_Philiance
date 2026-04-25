<?php
// Import necessaire
require_once "model/produit.php";
require_once "model/commande.php";
require_once "model/detailCommande.php";
require_once "model/avis.php";
require_once "model/utilisateurs.php";

// Ajouter un avis
function ctlAjouterAvis() {
    // Vérifier la connexion
    if (!isset($_SESSION['user'])) {
        header("Location: index.php?action=connexion");
        exit();
    }
    $idUser = $_SESSION['user']->getIdUtilisateurs();
    $idProduit = (int)$_POST['id_produit'];
    if (AvisExisteDeja($idUser, $idProduit)) { // Si un avis existe deja pour ce produit pour cet utilisateur
        // Redirection si deja un avis existe pour le produit pour cet utilisateur
        header("Location: index.php?action=detail_produit&id=" . $idProduit . "&erreur=deja_avis");
        exit();
    }
    // Si un avis n'existe pas deja, on ajoute l'avis de façon normal
    $note = (int)$_POST['note'];
    $commentaire = $_POST['commentaire'];

    AjoutAvis($idUser, $idProduit, $note, $commentaire);

    header("Location: index.php?action=detail_produit&id=" . $idProduit);
    exit();
}
// Modifier un avis
function ctlModifierAvis() {
    if (!isset($_GET['id'])) {
        header("Location: index.php");
        exit();
    }
    $idAvis = (int) $_GET['id'];
    $avis = AvoirAvisParId($idAvis);
    require_once "vues/modifierAvis.php";
}
// MAJ avis apres modif
function ctlUpdateAvis() {
    $idAvis = (int) $_POST['id_avis'];
    $note = (int) $_POST['note'];
    $commentaire = $_POST['commentaire'];
    $idProduit = (int) $_POST['id_produit'];

    ModifierAvis($idAvis, $note, $commentaire);

    $retour = $_POST['retour'] ?? '';
    if ($retour == 'mes_avis') {
        header("Location: index.php?action=mes_avis");
    }else{
        header("Location: index.php?action=detail_produit&id=" . $idProduit);
    }
    exit();
}

// Supprimer un avis
function ctlSupprimerAvis() {
    if (!isset($_GET['id'])) {
        header("Location: index.php");
        exit();
    }
    $idAvis = (int) $_GET['id'];
    
    // récupérer l'avis avant suppression
    $avis = AvoirAvisParId($idAvis);

    if (!$avis) {
        header("Location: index.php");
        exit();
    }

    // Sécurité : seul l'auteur de l'avis, peut le supprimer
    if (!isset($_SESSION['user'])) {
        header("Location:index.php");
        exit();
    }
    $idUser = $_SESSION['user']->getIdUtilisateurs();
    $role = $_SESSION['user']->getRole();

    if ($idUser != $avis['id_utilsiateur'] && $role != 'admin') {
       header("Location: index.php");
       exit();
    }

    $idProduit = $avis['id_produit'];
    SupprimerAvisParId($idAvis);
    
    $retour = $_GET['retour'] ?? '';

    if ($retour == 'mes_avis') {
        header("Location: index.php?action=mes_avis");
    } else {
        header("Location: index.php?action=detail_produit&id=" . $idProduit);
    }
    exit();
}
// fonction pour la page "mes avis" des utilisateurs
function ctlMesAvis() {
    if (!isset($_SESSION['user'])) {
        header("Location: index.php?action=connexion");
        exit();
    }
    $idUtilisateur = $_SESSION['user']->getIdUtilisateurs();
    $avis = AvoirAvisParUtilisateur($idUtilisateur);
    require_once "vues/MesAvis.php";
}