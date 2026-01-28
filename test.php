<h1>Page de test</h1>
<?php

// Test des methodes dans le model produit.php
 require_once "model/produit.php"; // Import du model
// Récupère tous les produits 
// $produits = TouslesProduits(); // Récupère tous les produits via la methode TousLesProduits dans le model produit.php
// var_dump($produits); // Permet d'afficher les données

// Récupère 1 produit suivant son id
// $produitParSonId = AvoirUnProduitParSonId(14);
// var_dump($produitParSonId);

// Ajout d'un produit
// $Produit = new Produit();
// $Produit->setNomProduit('Chemise')
//         ->setTaille('Taille XL')
//         ->setSexe('Femme')
//         ->setTypeVetement('Haut')
//         ->setCategorieVetement('Chemise')
//         ->setPrix(15)
//         ->setImage('Chemise.png');
// $ret = AjoutProduit($Produit);
// var_dump($ret);

// Test Recupérer tous les produits avec le sexe = femme
// $produitsFemmes = RecupererProduitFemme();
// var_dump($produitsFemmes);
// Test Recupérer tous les produits avec le sexe = homme
// $produitsHommes = RecupererProduitHomme();
// var_dump($produitsHommes);
// Test Recupérer tous les produits avec le sexe = enfants
$produitsEnfants = RecupererProduitEnfants();
var_dump($produitsEnfants);

// Test utilisateurs
// require_once "model/utilisateurs.php";

// Recupere tous les utilisateurs
// $utilisateurs = TousLesUtilisateurs();
// var_dump($utilisateurs);

// Récupère 1 utilisateur suivant son id
// $utilisateurParSonId = AvoirUtilisateurParSonId(58);
// var_dump($utilisateurParSonId);

// Récupère 1 utilisateur suivant son email
// $utilisateurParSonEmail = AvoirUtilisateurParSonEmail('ilyas5@hotmail.fr');
// var_dump($utilisateurParSonEmail);


// Ajout d'un utilisateur
// $utilisateurs = new Utilisateurs();
// $utilisateurs->setNom('LEMAIRE')
//         ->setPrenom('Thomas')
//         ->setPseudo('tom77')
//         ->setTel('0618272840')
//         ->setDateNaissance('03/02/2002')
//         ->setEmail('lemairetomtom@gmail.com')
//         ->setMotdepasse('abc123')
//         ->setRole('ADMIN');
// $ret = AjoutUtilisateur($utilisateurs);
// if ($ret) {
//         $utilisateurs = TousLesUtilisateurs();
//         var_dump($utilisateurs);
//     }

// var_dump($ret);

// Changer le role de l'utilisateur
// $NouveauRole = ChangerRoleUtilisateur(60, 'USER');
// var_dump($NouveauRole);

// Supprimer un utilisateur par son id
// $UtilisateurSupprimer = SupprimerUtilisateurParId(58);
// if ($UtilisateurSupprimer) {
//     echo "Utilisateur supprimé avec succès";
// } else {
//     echo "Erreur lors de la suppression";
// }

// Modifier tous les champs d'un utilisateurs par son id
// $ModifUtilisateur = modifierUtilisateurComplet(62, 'LEMAIRE', 'Thomas', '0618272840', '03/02/2002', 'lemairetomtom@gmail.com');
// var_dump($ModifUtilisateur);

// Test commandes
// require "model/commande.php";

// Creation commande (doit retourner l'id)
// $Commande = new Commande();
// $Commande->setDate(new DateTime())
//         ->setReference("TEST_REF_1")
//         ->setMontant(20)
//         ->setIdUtilisateur(62);
// $IdCommande = creationCommande($Commande);

// test avis
// Import fichier model avis
// require_once "model/avis.php";

// Recupere tous les avis
// $avis = TousLesAvis();
// var_dump($avis);

// Test ajout avis
// $avis = new Avis();
// $avis->setPseudo('tom77')
//         ->setDateAvis('06/01/2026')
//         ->setIdProduit(8)
//         ->setDescription("Très bon article pour bébé")
//         ->setIdUtilisateur(63);
// $ret = AjoutAvis($avis);
// if ($ret) {
//         $avis = TousLesAvis();
//         var_dump($avis);
//     }
// var_dump($ret);

// Récupère 1 avis par l'id produit
// $AvisParSonId = AvoirAvisParProduit(6);
// var_dump($AvisParSonId);

// Supprimer un avis par son id
// $AvisSupprimer = SupprimerAvisParId(3);
// if ($AvisSupprimer) {
//     echo "Avis supprimé avec succès";
// } else {
//     echo "Erreur lors de la suppression";
// }

// Modifier tous les champs d'un avis par son id
// $ModifAvisComplet = ModifierAvis(4, 'tom77310', 'A l usage, cet article est très bien', '07/01/26');
// var_dump($ModifAvisComplet);
