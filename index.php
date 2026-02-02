<?php
require "model/utilisateurs.php";

session_start(); // emplacement obligatoire 

// Import des controllers
require "controller/ctlUtilisateur.php";
require "controller/ctlProduits.php";
// require "controller/ctlPanier.php";

// Contenu Page d'accueil
function accueil() {
    $titre = "Site e-commerce 2022-2023";

    ob_start();
    ?>

<!-- Texte Page d'accueil HTML -->
<h1 class="text-center mt-5">Bienvenue sur notre E-commerce</h1>

<?php
    $contenu = ob_get_clean();
    require "vues/template.php";
}

// ROUTEUR
if (isset($_GET['action'])) {
    $action = htmlspecialchars($_GET['action']);

    // Controle d'accès 
    // if (!getAccess($action)) {
    //     $action = 'Accès refusé';
    // }

    // Routage suivant l'action demandée

    switch ($action) {
        // Page d'accueil
        case 'accueil':
            accueil();
            break;
        // Sécurité
            // Inscription
            case 'utilisateur_inscription';
                ctlUtilisateurInscription();
                break;
            // Connexion
            case 'utilisateur_connexion';
                ctlUtilisateurConnexion();
                break;
            // Deconnexion
            case 'utilisateur_deconnexion';
                ctlUtilisateurDeconnexion();
                break;
        
        // Produits
            // Produits Femmes
                case 'Produits_Femmes';
                ctlModeFemmes();
                break;
            // Produits Hommes
                case 'Produits_Hommes';
                ctlModeHommes();
                break;
            // Produits Enfants
                case 'Produits_Enfants';
                ctlModeEnfants();
                break;
            // Detail des produits en fonction de l'id
                case 'detail_produit';
                ctlDetailProduit();
                break;
        // Panier
            // Ajout Panier
            case 'Produit_Ajout';
            ctlAjouterPanier();
            break;
            // Affichage Panier
            case 'Panier';
            ctlAfficherPanier();
            break;
            // Modifier quantité panier
            case 'modifier_quantite';
            ctlModifierQuantite();
            break;
            // Supprimer un produit du panier
            case 'supprimer_ligne_panier';
            ctlSupprimerLignePanier();
            break;
            // Vider panier
            case 'vider_panier';
            ctlViderPanier();
            break;
            // Valider panier
            case 'valider_panier';
            ctlValiderPanier();
            break;
        default:
            header("location: index.php?action=accueil");
            break;
    }
} else {
    header("location: index.php?action=accueil");
}
?>