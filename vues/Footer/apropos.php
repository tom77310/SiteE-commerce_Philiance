<?php
$titre = "UrbanStyle: À propos";
ob_start();
?>

<h1 class="mt-3 mb-4 text-center text-decoration-underline">
    À propos
</h1>

<p>
    Ce site e-commerce fictif a été développé par Thomas Lemaire dans le cadre
    d’un apprentissage du développement web et de la mise en pratique de
    différentes compétences techniques.
</p>

<p>
    Il s’agit d’un projet personnel ayant pour objectif de reproduire le
    fonctionnement d’une véritable boutique en ligne tout en respectant une
    architecture propre et organisée.
</p>

<h4>1 - Présentation du projet</h4>

<p>
    Le site a été conçu comme un exercice complet permettant de travailler sur
    la création d’une application web dynamique avec gestion des utilisateurs,
    catalogue produits, panier, commandes et espace administrateur.
</p>

<p>
    Ce projet n’a aucune vocation commerciale réelle. Il est utilisé à des fins
    pédagogiques, d’entraînement et de démonstration de compétences.
</p>

<h4>2 - Technologies utilisées</h4>

<ul>
    <li>PHP</li>
    <li>Architecture MVC</li>
    <li>MySQL</li>
    <li>Bootstrap</li>
    <li>HTML / CSS</li>
    <li>JavaScript</li>
</ul>

<h4>3 - Fonctionnalités développées</h4>

<p>
    Le projet intègre progressivement plusieurs fonctionnalités proches d’un
    vrai site e-commerce :
</p>

<ul>
    <li>Inscription et connexion utilisateur</li>
    <li>Gestion des rôles utilisateur / administrateur</li>
    <li>Catalogue produits</li>
    <li>Ajout au panier</li>
    <li>Validation de commandes fictives</li>
    <li>Historique des commandes</li>
    <li>Système d’avis clients</li>
    <li>Espace administrateur</li>
    <li>Formulaire de contact</li>
</ul>

<h4>4 - Objectif pédagogique</h4>

<p>
    L’objectif principal est de mettre en pratique les notions essentielles du
    développement web backend et frontend :
</p>

<ul>
    <li>Structuration d’un projet MVC</li>
    <li>Manipulation de base de données</li>
    <li>Création de CRUD complets</li>
    <li>Sécurisation des formulaires</li>
    <li>Gestion des sessions utilisateurs</li>
    <li>Organisation du code</li>
</ul>

<h4>5 - Évolution du projet</h4>

<p>
    Ce site continue d’évoluer régulièrement avec l’ajout de nouvelles
    fonctionnalités, améliorations visuelles et optimisations techniques.
</p>

<h4>6 - Auteur</h4>

<p>
    Thomas Lemaire
</p>

<p>
    Projet personnel destiné à renforcer les compétences en développement web
    et à constituer un support de présentation professionnel.
</p>

<?php
$contenu = ob_get_clean();
require "vues/template.php";
?>