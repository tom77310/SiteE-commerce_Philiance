<?php
$titre = "Conditions Générales De Vente";
ob_start();
?>

<h1 class="mb-4 text-center text-decoration-underline">
    Conditions Générales de Vente
</h1>

<p>
    Les présentes Conditions Générales de Vente (CGV) encadrent l’utilisation
    du présent site e-commerce fictif, réalisé dans un cadre pédagogique et de
    démonstration de compétences en développement web.
</p>

<p>
    Ce site n’a aucune vocation commerciale réelle. Il s’agit d’un projet
    technique permettant de simuler le fonctionnement d’une boutique en ligne :
    gestion des produits, panier, commandes, utilisateurs et espace
    administrateur.
</p>

<h4>Article 1 - Objet</h4>

<p>
    Les présentes CGV ont pour objectif de définir les modalités d’utilisation
    du site ainsi que les conditions simulées de vente des produits présentés.
</p>

<h4>Article 2 - Produits</h4>

<p>
    Les produits affichés sur le site sont purement fictifs ou utilisés à titre
    d’exemple. Ils ne peuvent faire l’objet d’aucun achat réel ni d’aucune
    livraison effective.
</p>

<p>
    Les descriptions, images, catégories et caractéristiques des produits sont
    affichées dans le seul but de reproduire le fonctionnement d’un véritable
    site e-commerce.
</p>

<h4>Article 3 - Prix</h4>

<p>
    Les prix indiqués sur le site sont affichés à titre informatif uniquement.
    Ils n’ont aucune valeur contractuelle ni commerciale.
</p>

<p>
    Aucun paiement réel n’est demandé, encaissé ou traité via ce projet.
</p>

<h4>Article 4 - Commandes</h4>

<p>
    Les commandes passées sur le site sont simulées à des fins pédagogiques.
    Elles permettent de tester les fonctionnalités techniques du projet :
    validation panier, enregistrement en base de données, historique des
    commandes et gestion administrateur.
</p>

<p>
    Aucune commande ne donne lieu à une obligation de livraison ou de paiement.
</p>

<h4>Article 5 - Livraison</h4>

<p>
    Aucune livraison physique ou numérique n’est effectuée. Les informations de
    livraison éventuellement demandées servent uniquement à la démonstration du
    fonctionnement du site.
</p>

<h4>Article 6 - Responsabilité</h4>

<p>
    L’éditeur de ce projet ne saurait être tenu responsable d’un usage détourné
    du site, d’erreurs de contenu ou d’une mauvaise interprétation des données
    affichées.
</p>

<h4>Article 7 - Données personnelles</h4>

<p>
    Les données éventuellement saisies sur ce site sont utilisées uniquement
    dans un cadre local, de test ou de démonstration. Aucune exploitation
    commerciale n’est réalisée.
</p>

<h4>Article 8 - Droit applicable</h4>

<p>
    Les présentes CGV sont rédigées selon les principes généraux du droit
    français, tout en tenant compte du caractère fictif et non commercial du
    projet.
</p>

<h4>Article 9 - Contact</h4>

<p>
    Pour toute question concernant ce projet pédagogique, vous pouvez utiliser
    la page de contact mise à disposition sur le site.
</p>

<?php
$contenu = ob_get_clean();
require "vues/template.php";
?>