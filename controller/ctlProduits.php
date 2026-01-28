<?php

require "model/produit.php";
// Recuperer tous les produits pour Femmes
function ctlModeFemmes(){
    $produitFemmes = RecupererProduitFemme();
    require "vues/ProduitsFemmes.php";
}