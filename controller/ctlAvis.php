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
        header("Location: index.php?action=utilisateur_connexion");
        exit();
    }

    $idUser = $_SESSION['user']->getIdUtilisateurs();
    $idProduit = (int)$_POST['id_produit'];

    // Vérifie si l'utilisateur a déjà laissé un avis sur ce produit
    if (AvisExisteDeja($idUser, $idProduit)) {

        // Redirection si un avis existe déjà
        header("Location: index.php?action=detail_produit&id=" . $idProduit . "&erreur=deja_avis");
        exit();
    }

    // Si aucun avis existe, on ajoute le nouvel avis
    $note = (int)$_POST['note'];
    $commentaire = $_POST['commentaire'];

    AjoutAvis($idUser, $idProduit, $note, $commentaire);

    header("Location: index.php?action=detail_produit&id=" . $idProduit);
    exit();
}

// Modifier un avis
function ctlModifierAvis() {

    // Vérifie qu'un id d'avis est présent
    if (!isset($_GET['id'])) {
        header("Location: index.php");
        exit();
    }

    $idAvis = (int) $_GET['id'];

    // Récupération de l'avis à modifier
    $avis = AvoirAvisParId($idAvis);

    require_once "vues/Utilisateur/modifierAvis.php";
}

// MAJ avis apres modif
function ctlUpdateAvis() {

    // Récupération des nouvelles données
    $idAvis = (int) $_POST['id_avis'];
    $note = (int) $_POST['note'];
    $commentaire = $_POST['commentaire'];
    $idProduit = (int) $_POST['id_produit'];

    // Mise à jour de l'avis
    ModifierAvis($idAvis, $note, $commentaire);

    // Permet de rediriger vers la bonne page après modification
    $retour = $_POST['retour'] ?? '';

    if ($retour == 'mes_avis') {
        header("Location: index.php?action=mes_avis");
    }
    else {
        header("Location: index.php?action=detail_produit&id=" . $idProduit);
    }

    exit();
}

// Supprimer un avis
function ctlSupprimerAvis() {

    // Vérifie qu'un id est présent
    if (!isset($_GET['id'])) {
        header("Location: index.php");
        exit();
    }

    $idAvis = (int) $_GET['id'];
    
    // récupérer l'avis avant suppression
    $avis = AvoirAvisParId($idAvis);

    // Vérifie que l'avis existe
    if (!$avis) {
        header("Location: index.php");
        exit();
    }

    // Vérifie que l'utilisateur est connecté
    if (!isset($_SESSION['user'])) {
        header("Location:index.php");
        exit();
    }

    $idUser = $_SESSION['user']->getIdUtilisateurs();
    $role = strtoupper($_SESSION['user']->getRole());

    // Sécurité : seul l'auteur de l'avis ou un admin peut supprimer l'avis
    if ($idUser != $avis['id_utilisateur'] && $role != 'ADMIN') {
        header("Location: index.php");
        exit();
    }

    $idProduit = $avis['id_produit'];

    // Suppression de l'avis
    SupprimerAvisParId($idAvis);
    
    // Permet de revenir soit sur "Mes avis" soit sur le produit
    $retour = $_GET['retour'] ?? '';

    if ($retour == 'mes_avis') {
        header("Location: index.php?action=mes_avis");
    }
    else {
        header("Location: index.php?action=detail_produit&id=" . $idProduit);
    }

    exit();
}

// Fonction pour la page "Mes avis" des utilisateurs
function ctlMesAvis() {

    // Vérifie que l'utilisateur est connecté
    if (!isset($_SESSION['user'])) {
        header("Location: index.php?action=connexion");
        exit();
    }

    $idUtilisateur = $_SESSION['user']->getIdUtilisateurs();

    // Récupération de tous les avis de l'utilisateur
    $avis = AvoirAvisParUtilisateur($idUtilisateur);

    require_once "vues/Utilisateur/MesAvis.php";
}