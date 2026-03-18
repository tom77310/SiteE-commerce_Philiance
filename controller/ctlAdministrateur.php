<?php
require_once "model/utilisateurs.php";
require_once "model/produit.php";
require_once "model/commande.php";
require_once "model/detailCommande.php";

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

// Traitement de l'enregistrement du produit
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
        $imageNom = uniqid(). "_" .basename($_FILES['image']['name']);

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

// Supprimer un produit
function ctlAdminSupprimerProduit() {
    $id = $_GET['id'];
    SupprimerProduit($id);
    header("Location: index.php?action=Admin_Produits");
}

// Modification d'un produit
function ctlAdminModifierProduit() {
    $id = $_GET['id'];
    $produit = AvoirUnProduitParSonId($id);
    require "vues/ModifierProduitAdmin.php";
}

// Enregistrement de la modification d'un produit
function ctlAdminUpdateProduit(){
    $id = $_POST['id'];

    $nom = $_POST['nom_produit'];
    $taille = $_POST['taille'];
    $sexe = $_POST['sexe'];
    $type = $_POST['type_vetement'];
    $categorie = $_POST['categorie_vetement'];
    $prix = $_POST['prix'];

    $imageNom = $_POST['ancienne_image'];

    $dossier = "assets/img/produits/";

    if ($sexe == "homme") {
        $dossier .= "hommes/";
    }
    elseif ($sexe == "femme") {
        $dossier .= "femmes/";
    }else {
        $dossier .= "enfants/";
    }

    // Si nouvelle image
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        // Alors on supprime l'image actuelle
        if (file_exists($dossier.$imageNom)) {
            unlink($dossier.$imageNom);
        }
        // On lui donne un nouveau nom
        $imageNom = uniqid(). "_" .basename($_FILES['image']['name']);

        move_uploaded_file(
            $_FILES['image']['tmp_name'],
            $dossier.$imageNom
        );
    }

    ModifierProduit($id, $nom, $taille, $sexe, $type, $categorie, $prix, $imageNom );

    header("Location: index.php?action=Admin_Produits");
}

// Utilisateurs
    // Affichage de la liste des utilisateurs du site
    function ctlAdminUtilisateurs() {
        $utilisateurs = TousLesUtilisateurs();
        require "vues/UtilisateursAdmin.php";
    }
    // Supprimer un utilisateur
    function ctlAdminSupprimerUtilisateur() {
        $id_utillisateur = $_GET['id'];
        SupprimerUtilisateurParId($id_utillisateur);
        header("Location: index.php?action=Admin_Utilisateurs");
    }
    // Modifier le role d'un utilisateur
    function ctlAdminModifierRoleUtilisateur() {
        if (isset($_GET['id']) && isset($_GET['role'])) {
            $id = intval($_GET['id']);
            $role = $_GET['role'];

            // Empêcher de modifier son propre rôle
            if ($id == $_SESSION['user']->getIdUtilisateurs()) {
                die("Impossible de modifier votre propre rôle");
            }

            // Sécurité : autoriser seulement certains rôles
            if ($role !== 'ADMIN' && $role !== 'USER') {
                die("Rôle invalide");
            }
            ModifierRoleUtilisateur($id, $role);
        }
        header("Location: index.php?action=Admin_ListeUtilisateurs");
        exit();
    }

// Commandes
    // Affichage de la liste de toutes les commandes du site
    function ctlAdminCommandes() {
        $commandes = ToutesLesCommandes();
        require "vues/ListeCommandesAdmin.php";
    }
    // Supprimer une commande 
    function ctlAdminSupprimerCommande() {
        if (isset($_GET['id'])) {
            $idCommande = intval($_GET['id']);

            // Supprime tous les détails de la commande
            SupprimerDetailsCommande($idCommande);

            // Supprime la commande elle-même
            SupprimerCommandeParId($idCommande);
        }

        // Redirection vers la liste des commandes
        header("Location: index.php?action=Admin_ListeCommandes");
        exit();
    }