<?php
$titre = "Conditions Générales d'Utilisation";
ob_start();
?>

<h1 class="mb-4 text-center text-decoration-underline">
    Conditions Générales d'Utilisation
</h1>

<p>
    Les présentes Conditions Générales d’Utilisation (CGU) ont pour objet de
    définir les modalités d’accès et d’utilisation du présent site e-commerce
    fictif, développé dans un cadre pédagogique afin de démontrer des
    compétences en développement web.
</p>

<p>
    Ce site n’a aucune finalité commerciale réelle. Il s’agit d’un projet
    technique permettant de simuler le fonctionnement d’une boutique en ligne :
    gestion des utilisateurs, produits, commandes, avis clients et espace
    administrateur.
</p>

<h4>Article 1 - Objet du site</h4>

<p>
    Le site a pour objectif principal la présentation d’un projet de
    développement web. Les fonctionnalités disponibles sont proposées à titre
    démonstratif uniquement.
</p>

<h4>Article 2 - Accès au site</h4>

<p>
    Le site est accessible dans un cadre local, privé, de test ou de
    présentation. L’accès peut être interrompu à tout moment pour maintenance,
    mise à jour ou amélioration technique.
</p>

<p>
    Aucune garantie de disponibilité permanente n’est assurée.
</p>

<h4>Article 3 - Comptes utilisateurs</h4>

<p>
    Certaines fonctionnalités peuvent nécessiter la création d’un compte
    utilisateur (connexion, commandes fictives, avis clients, espace membre).
</p>

<p>
    Les comptes créés sur ce site n’ont aucune valeur contractuelle ni
    commerciale. Ils sont destinés uniquement à illustrer le fonctionnement
    d’un espace utilisateur sécurisé.
</p>

<h4>Article 4 - Utilisation du site</h4>

<p>
    L’utilisateur s’engage à utiliser le site de manière loyale et conforme à
    son objectif pédagogique. Toute tentative de nuisance, de fraude ou
    d’exploitation abusive des fonctionnalités est interdite.
</p>

<h4>Article 5 - Contenus publiés</h4>

<p>
    Les contenus affichés sur le site (textes, produits, images, avis,
    informations diverses) peuvent être fictifs ou utilisés à des fins de test.
</p>

<p>
    L’éditeur se réserve la possibilité de modifier, corriger ou supprimer tout
    contenu jugé inadapté.
</p>

<h4>Article 6 - Responsabilité</h4>

<p>
    Le contenu du site est fictif et fourni à titre d’exemple. Aucune
    responsabilité commerciale, contractuelle ou financière ne saurait être
    engagée.
</p>

<p>
    L’utilisateur reconnaît utiliser le site dans un cadre de démonstration.
</p>

<h4>Article 7 - Données personnelles</h4>

<p>
    Les éventuelles données saisies sur le site sont utilisées uniquement dans
    le cadre du projet. Aucune revente ou exploitation commerciale n’est
    réalisée.
</p>

<p>
    Pour plus d’informations, l’utilisateur peut consulter la politique de
    confidentialité du site.
</p>

<h4>Article 8 - Propriété intellectuelle</h4>

<p>
    La structure, le code source, l’organisation et les éléments graphiques du
    projet demeurent la propriété de leur auteur, sauf mention contraire.
</p>

<h4>Article 9 - Modification des CGU</h4>

<p>
    Les présentes conditions peuvent être modifiées à tout moment afin de faire
    évoluer le projet ou d’améliorer son fonctionnement.
</p>

<h4>Article 10 - Contact</h4>

<p>
    Pour toute question relative à l’utilisation du site, un formulaire de
    contact peut être mis à disposition.
</p>

<?php
$contenu = ob_get_clean();
require "vues/template.php";
?>