<?php

require "model/produit.php";
// Recuperer tous les produits pour Femmes
function ctlModeFemmes(){
    $produitFemmes = RecupererProduitFemme();
    require "vues/ProduitsFemmes.php";
}
// Recuperer tous les produits pour Hommes
function ctlModeHommes(){
    $produitHommes = RecupererProduitHomme();
    require "vues/ProduitsHommes.php";
}
// Recuperer tous les produits pour Enfants
function ctlModeEnfants(){
    $produitEnfants = RecupererProduitEnfants();
    require "vues/ProduitsEnfants.php";
}