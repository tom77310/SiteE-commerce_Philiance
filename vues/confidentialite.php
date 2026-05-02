<?php
$titre = "Politique de confidentialité";
ob_start();
?>

<h1 class="mb-4 text-center text-decoration-underline">
    Politique de confidentialité
</h1>

<p>
    La présente politique de confidentialité a pour objectif d’informer les
    utilisateurs sur la collecte, l’utilisation et la gestion des données
    éventuellement enregistrées sur ce site.
</p>

<p>
    Ce site est un projet fictif réalisé dans un cadre pédagogique et de
    démonstration de compétences en développement web. Il n’a aucune vocation
    commerciale réelle.
</p>

<h4>1 - Données collectées</h4>

<p>
    Dans le cadre du fonctionnement du site, certaines données peuvent être
    saisies volontairement par l’utilisateur, notamment :
</p>

<ul>
    <li>Nom</li>
    <li>Prénom</li>
    <li>Pseudo</li>
    <li>Adresse email</li>
    <li>Mot de passe chiffré</li>
    <li>Informations liées au compte utilisateur</li>
</ul>

<p>
    Des données fictives peuvent également être utilisées à des fins de test.
</p>

<h4>2 - Finalité de la collecte</h4>

<p>
    Les données enregistrées servent uniquement au bon fonctionnement technique
    du projet, notamment pour :
</p>

<ul>
    <li>Créer un compte utilisateur</li>
    <li>Permettre la connexion</li>
    <li>Gérer les commandes fictives</li>
    <li>Déposer des avis produits</li>
    <li>Tester les fonctionnalités du site</li>
</ul>

<h4>3 - Utilisation des données</h4>

<p>
    Les informations collectées sont utilisées uniquement à des fins de
    démonstration technique, de test ou de présentation du projet.
</p>

<p>
    Aucune exploitation commerciale n’est réalisée.
</p>

<h4>4 - Conservation des données</h4>

<p>
    Les données sont conservées uniquement dans l’environnement local de
    développement ou dans la base de données du projet tant que celui-ci est
    utilisé à des fins pédagogiques.
</p>

<p>
    Elles peuvent être supprimées, réinitialisées ou modifiées à tout moment.
</p>

<h4>5 - Sécurité</h4>

<p>
    Les mesures techniques mises en place dans le cadre du projet visent à
    sécuriser les accès au site et aux comptes utilisateurs.
</p>

<p>
    Les mots de passe sont stockés de manière chiffrée lorsque cela est prévu
    par le développement du projet.
</p>

<h4>6 - Partage des données</h4>

<p>
    Aucune donnée personnelle n’est vendue, louée, cédée ou transmise à des
    tiers.
</p>

<p>
    Le site n’utilise aucune régie publicitaire ni service commercial externe.
</p>

<h4>7 - Droits des utilisateurs</h4>

<p>
    Conformément aux principes du RGPD, tout utilisateur peut demander :
</p>

<ul>
    <li>L’accès à ses données</li>
    <li>La rectification de ses informations</li>
    <li>La suppression de son compte</li>
    <li>La suppression de ses données</li>
</ul>

<p>
    Dans le cadre de ce projet fictif, ces demandes sont simulées ou gérées
    directement via les fonctionnalités du site.
</p>

<h4>8 - Cookies</h4>

<p>
    Le site peut utiliser des cookies techniques ou des variables de session
    nécessaires au fonctionnement de la connexion utilisateur.
</p>

<p>
    Aucun cookie publicitaire ou de traçage commercial n’est utilisé.
</p>

<h4>9 - Contact</h4>

<p>
    Pour toute question concernant la confidentialité ou le traitement des
    données, un formulaire de contact peut être mis à disposition sur le site.
</p>

<?php
$contenu = ob_get_clean();
require "vues/template.php";
?>