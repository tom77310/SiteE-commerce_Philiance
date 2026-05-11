<?php
// import des model utilisé
require_once "model/produit.php";

// Afficher la page d'accueil 
    function ctlAccueil() {

        // Recuperer les nouveaux produits
        $nouveautes = RecupererNouveautes(4);

        // Recuperer les avis récents des utilisateurs sur les produits
        $avisRecents = RecupererAvisRecents();
        require "vues/Defaut/Accueil.php";
    }
?>