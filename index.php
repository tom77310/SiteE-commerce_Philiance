<?php
require_once "model/utilisateurs.php";

session_start(); // emplacement obligatoire 

// Definition du fuseau horraire
date_default_timezone_set('Europe/Paris');

// Import des controllers
require_once "controller/ctlUtilisateur.php";
require_once "controller/ctlProduits.php";
require_once "controller/ctlAdministrateur.php";
require_once "controller/ctlEnvoyerContact.php";
require_once "controller/ctlAvis.php";
require_once "controller/ctlFooter.php";
require_once "controller/ctlDefaut.php";
require_once "controller/ctlSecurity.php";


// ROUTEUR
if (isset($_GET['action'])) {
    $action = htmlspecialchars($_GET['action']);

    // Controle d'accès 
    if (!AvoirAcces($action)) {
        ctlAccesInterdit();
        exit;
    }

    // Routage suivant l'action demandée
    switch ($action) {
        // Page d'accueil
        case 'accueil':
            ctlaccueil();
            break;
        // Utilisateur
            // Inscription
            case 'utilisateur_inscription':
                ctlUtilisateurInscription();
                break;
            // Connexion
            case 'utilisateur_connexion':
                ctlUtilisateurConnexion();
                break;
            // Deconnexion
            case 'utilisateur_deconnexion':
                ctlUtilisateurDeconnexion();
                break;
            // Compte Utilisateur
            case 'utilisateur_compte':                
                ctlCompteUtilisateur();                
                break;
            // Infos Utilisateur
            case 'utilisateur_infos':                
                ctlInfoUtilisateur();                
                break;
            // Modifier le compte utilisateur
                case 'utilisateur_modifier_compte':                
                    ctlModifierCompte();                
                    break;
                case 'utilisateur_modifier_compte_traitement':                
                    ctlModifierCompteTraitement();                
                    break;
            // Supprimer le compte
            case 'utilisateur_supprimer_compte':                
                ctlSupprimerCompte();                
                break;
            // Mot de passe
            case 'utilisateur_modifier_mot_de_passe':                
                ctlModifierMotDePasse();            
                break;
                
                case 'utilisateur_modifier_mot_de_passe_traitement':                
                    ctlModifierMotDePasseTraitement();                
                    break;
                    
            // Page "Mes avis"
            case 'utilisateur_mes_avis':                
                ctlMesAvis();                
                break;
            // Afficher le Formulaire de contact
            case 'formulaire_contact':                
            require 'vues/Defaut/formulairecontact.php';            
            break;
            // Envoie du formulaire
            case 'envoyer_contact':                
            ctlEnvoyerContact();            
            break;
        // Produits
            // Produits Femmes
                case 'Produits_Femmes':
                ctlModeFemmes();
                break;
            // Produits Hommes
                case 'Produits_Hommes':
                ctlModeHommes();
                break;
            // Produits Enfants
                case 'Produits_Enfants':
                ctlModeEnfants();
                break;
            // Detail des produits en fonction de l'id
                case 'detail_produit':                    
                ctlDetailProduit();                
                break;
        // Panier
            // Affichage Panier
            case 'Panier':                
            ctlAfficherPanier();            
            break;
            // Ajout Panier
            case 'Panier_ajoutProduit':                
            ctlAjouterPanier();            
            break;
            // Modifier quantité panier
            case 'Panier_modifier_quantite':                
            ctlModifierQuantite();            
            break;
            // Supprimer un produit du panier
            case 'Panier_supprimer_ligne_panier':                
            ctlSupprimerLignePanier();            
            break;
            // Vider panier
            case 'Panier_vider_panier':                
            ctlViderPanier();            
            break;
            // Valider panier
            case 'Panier_valider_panier':                
            ctlValiderPanier();            
            break;
        // Commande
            // Recap de la commande
            case 'Commande_recap':
            ctlRecapCommande();            
            break;
            // Historique de commandes
            case 'Commande_historique_utilisateur':
            ctlHistoriqueCommandesUtilisateurs();            
            break;
            // Supprimer une commande dans l'historique de commande
            case 'utilisateur_supprimer_commande':                    
            ctlSupprimerCommandeUtilisateur();
            break;
        // Administrateur
            // Espace Admin
            case 'Admin_EspaceAdmin':                
            ctlEspaceAdmin();            
            break;
            // Gestion des produits
                // Liste des Produits
                    case 'Admin_Produits':
                    ctlAdminProduits();                    
                    break;
                // Ajout d'un produit
                case 'Admin_AjouterProduit':                    
                ctlAdminAjoutProduit();                
                break;
                // Enregistrement Produit avec image
                case 'Admin_EnregistrementProduit':                    
                ctlAdminEnregistrementProduit();                
                break;
                // Modifier un produit
                case 'Admin_ModifierProduit':                    
                ctlAdminModifierProduit();                
                break;
                // Enregistrer Modification Produit
                case 'Admin_UpdateProduit':                    
                ctlAdminUpdateProduit();                
                break;
                // Supprimer Produit
                case 'Admin_SupprimerProduit':                    
                ctlAdminSupprimerProduit();                
                break;
            // Gestion des Utilisateurs
                // Liste des utilisateurs
                case 'Admin_ListeUtilisateurs':                    
                ctlAdminUtilisateurs();                
                break;
                // Supprimer un utilisateur
                case 'Admin_SupprimerUtilisateur':                    
                    ctlAdminSupprimerUtilisateur();                    
                    break;
                // Modifier Role Utilisateur
                case 'Admin_ModifierRoleUtilisateur':                    
                    ctlAdminModifierRoleUtilisateur();                    
                    break;
            // Gestion des Commandes des utilisateurs
                // Liste des commandes
                case 'Admin_ListeCommandes':                    
                ctlAdminCommandes();                
                break;
                // Supprimer une commande (coter admin)
                case 'Admin_SupprimerCommande':                    
                ctlAdminSupprimerCommande();      
                break;
            // Avis
                // Ajouter un avis
                case 'Avis_Ajout':                    
                    ctlAjouterAvis();                    
                    break;
                // Modifier un avis
                    case 'Avis_modifieravis':                   
                        ctlModifierAvis();                    
                        break;
                    case 'Avis_update':                    
                        ctlUpdateAvis();                    
                        break;
                // Supprimer un avis
                case 'Avis_supprimeravis':                    
                ctlSupprimerAvis();
                break;
            // Footer
                case 'Footer_mentions_legales':
                ctlMentionsLegales();
                break;
                case 'Footer_cgv':
                ctlCGV();
                break;
                case 'Footer_cgu':
                ctlCGU();
                break;
                case 'Footer_confidentialite':
                ctlConfidentialite();
                break;
                case 'Footer_rgpd':
                ctlRGPD();
                break;
                case 'Footer_apropos':
                ctlAPropos();
                break;
        default:
            header("location: index.php?action=accueil");
            break;
    }
} else {
    header("location: index.php?action=accueil");
}
?>