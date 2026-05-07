<?php
// import des model utilisé
require_once "model/produit.php";

// Afficher la page d'accueil 
    function ctlAccueil() {

        // Recuperer les nouveaux produits
        $nouveautes = RecupererNouveautes(4);

        // Récupérer les produits en promo
        $promo = RecupererProduitsEnPromo(4);
        require "vues/Accueil.php";
    }
?>