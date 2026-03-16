<?php
require "model/utilisateurs.php";

session_start(); // emplacement obligatoire 

// Definition du fuseau horraire
date_default_timezone_set('Europe/Paris');

// Import des controllers
require "controller/ctlUtilisateur.php";
require "controller/ctlProduits.php";
require "controller/ctlAdministrateur.php";


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
        // Utilisateur
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
            // Compte Utilisateur
            case 'utilisateur_compte';
                ctlCompteUtilisateur();
                break;
            case 'utilisateur_infos';
                ctlInfoUtilisateur();
                break;
            case 'modifier_compte';
                ctlModifierCompte();
                break;
            case 'modifier_compte_traitement';
                ctlModifierCompteTraitement();
                break;
            case 'supprimer_compte';
                ctlSupprimerCompte();
                break;
            // Mot de passe
            case 'modifier_mot_de_passe':
            ctlModifierMotDePasse();
            break;

            case 'modifier_mot_de_passe_traitement':
                ctlModifierMotDePasseTraitement();
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
        // Commande
            case 'recap_commande';
            ctlRecapCommande();
            break;
            case 'historique_commandes';
            ctlHistoriqueCommandesUtilisateurs();
            break;
        // Administrateur
            // Espace Admin
            case 'Admin_EspaceAdmin';
            ctlEspaceAdmin();
            break;
            // Gestion des produits
                // Liste des Produits
                    case 'Admin_Produits';
                    ctlAdminProduits();
                    break;
                // Ajout d'un produit
                case 'Admin_AjouterProduit';
                ctlAdminAjoutProduit();
                break;
                // Enregistrement Produit avec image
                case 'Admin_EnregistrementProduit';
                ctlAdminEnregistrementProduit();
                break;
                // Modifier un produit
                case 'Admin_ModifierProduit';
                ctlAdminModifierProduit();
                break;
                // Enregistrer Modification Produit
                case 'Admin_UpdateProduit';
                ctlAdminUpdateProduit();
                break;
                // Supprimer Produit
                case 'Admin_SupprimerProduit';
                ctlAdminSupprimerProduit();
                break;
            // Gestion des Utilisateurs
                // Liste des utilisateurs
                case 'Admin_ListeUtilisateurs';
                ctlAdminUtilisateurs();
                break;
            // Gestion des Commandes des utilisateurs
                // Liste des commandes
                case 'Admin_ListeCommandes';
                ctlAdminCommandes();
                break;
        default:
            header("location: index.php?action=accueil");
            break;
    }
} else {
    header("location: index.php?action=accueil");
}
?>