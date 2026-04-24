<?php
// Import necessaire
require_once "model/produit.php";
require_once "model/commande.php";
require_once "model/detailCommande.php";
require_once "model/avis.php";
require_once "model/utilisateurs.php";

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