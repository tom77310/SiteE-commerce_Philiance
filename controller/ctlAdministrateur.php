<?php
require_once "model/utilisateurs.php";
require_once "model/produit.php";
require_once "model/commande.php";

// Espace Admin
function ctlEspaceAdmin() {

    $produits = TouslesProduits();
    $utilisateurs = TousLesUtilisateurs();
    
    $nbProduits = count($produits);
    $nbUtilisateurs = count($utilisateurs);
    $nbCommandes = NbCommandes();

    require "vues/EspaceAdmin.php";
}

// Page Gestion des produits
function ctlAdminProduits(){
    $produits = TouslesProduits();
    require "vues/ProduitsAdmin.php";
}

// Formulaire d'ajout de produits
function ctlAdminAjoutProduit(){
    require "vues/AjouterProduitAdmin.php";
}

// Gestion de l'ajout de l'image dans le formulaire ajout produit
function ctlAdminEnregistrementProduit(){
    $nom = $_POST['nom_produit'];
    $taille = $_POST['taille'];
    $sexe = $_POST['sexe'];
    $type = $_POST['type_vetement'];
    $categorie = $_POST['categorie_vetement'];
    $prix = $_POST['prix'];

    $imageNom = "";

    // Choix du dossier selon le sexe 
    $dossier = "assets/img/produits/";

    if ($sexe == "homme") {
        $dossier .= "hommes/";
    }
    elseif ($sexe == "femme") {
        $dossier .= "femmes/";
    }
    elseif ($sexe == "enfant") {
        $dossier .= "enfants/";
    }

    // Upload Image

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        
        // Renommer les images pour éviter les doublons
        $imageNom = basename($_FILES['image']['name']);

        move_uploaded_file(
            $_FILES['image']['tmp_name'],
            $dossier . $imageNom
        );
    }

    // création objet produit

    $produit = new Produit();

    $produit->setNomProduit($nom);
    $produit->setTaille($taille);
    $produit->setSexe($sexe);
    $produit->setTypeVetement($type);
    $produit->setCategorieVetement($categorie);
    $produit->setPrix($prix);
    $produit->setImage($imageNom);

    // Insertion BDD

    AjoutProduit($produit);

    // Redirection
    header("Location: index.php?action=Admin_Produits");
}

// Utilisateurs
    // Affichage de la liste des utilisateurs du site
    function ctlAdminUtilisateurs() {
        $utilisateurs = TousLesUtilisateurs();
        require "vues/UtilisateursAdmin.php";
    }

// Commandes
    // Affichage de la liste de toutes les commandes du site
    function ctlAdminCommandes() {
        $commandes = ToutesLesCommandes();
        require "vues/ListeCommandesAdmin.php";
    }