<?php
$titre = "UrbanStyle: Mentions Légales";
ob_start();
?>

<h1 class="mt-3 mb-4 text-center text-decoration-underline">
    Mentions Légales
</h1>

<p>
    Les présentes mentions légales ont pour objectif d’informer les visiteurs
    sur la nature du site, son éditeur ainsi que les conditions générales
    d’utilisation des informations disponibles.
</p>

<p>
    Ce site e-commerce est un projet fictif réalisé dans un cadre pédagogique
    et de démonstration de compétences en développement web. Il ne possède
    aucune vocation commerciale réelle.
</p>

<h4>1 - Éditeur du site</h4>

<p>
    Thomas LEMAIRE <br>
    Projet personnel de démonstration technique
</p>

<p>
    Ce projet a été développé dans le but de mettre en pratique différentes
    compétences : création d’un site dynamique, architecture MVC, gestion de
    base de données, espace administrateur, commandes et avis clients.
</p>

<h4>2 - Hébergement</h4>

<p>
    Site non hébergé publiquement.
</p>

<p>
    Le projet fonctionne dans un environnement local de développement
    (exemple : WAMP / serveur local), uniquement à des fins de test,
    d’apprentissage ou de présentation.
</p>

<h4>3 - Activité du site</h4>

<p>
    Les produits, prix, commandes, comptes utilisateurs et contenus affichés
    sur le site sont simulés ou fictifs.
</p>

<p>
    Aucune vente réelle, aucun paiement réel et aucune livraison réelle
    ne sont effectués via cette plateforme.
</p>

<h4>4 - Données personnelles</h4>

<p>
    Les éventuelles données enregistrées sur le site le sont uniquement dans le
    cadre du fonctionnement technique du projet.
</p>

<p>
    Aucune exploitation commerciale, cession ou revente des données n’est
    réalisée.
</p>

<h4>5 - Propriété intellectuelle</h4>

<p>
    La structure du site, son code source, son organisation ainsi que ses
    éléments graphiques sont réalisés dans le cadre du projet personnel de
    l’auteur.
</p>

<p>
    Toute reproduction totale ou partielle sans autorisation préalable peut
    être interdite.
</p>

<h4>6 - Responsabilité</h4>

<p>
    L’éditeur ne saurait être tenu responsable d’éventuelles erreurs,
    interruptions, dysfonctionnements ou contenus fictifs présents sur le site.
</p>

<p>
    L’utilisateur reconnaît consulter un projet pédagogique et non une boutique
    en ligne réelle.
</p>

<h4>7 - Contact</h4>

<p>
    Pour toute question concernant ce projet, un formulaire de contact peut
    être mis à disposition sur le site.
</p>

<?php
$contenu = ob_get_clean();
require "vues/template.php";
?>