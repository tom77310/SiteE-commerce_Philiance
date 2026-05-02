<?php
$titre = "RGPD";
ob_start();
?>

<h1 class="mb-4 text-center text-decoration-underline">
    Respect des droits RGPD
</h1>

<p>
    Le présent site applique les principes généraux du Règlement Général sur la
    Protection des Données (RGPD) dans le cadre de son fonctionnement
    pédagogique et fictif.
</p>

<p>
    Ce projet a été conçu afin de simuler la gestion d’un site e-commerce tout
    en sensibilisant à la protection des données personnelles des utilisateurs.
</p>

<h4>1 - Données concernées</h4>

<p>
    Les données pouvant être enregistrées sur le site concernent notamment :
</p>

<ul>
    <li>Nom</li>
    <li>Prénom</li>
    <li>Pseudo</li>
    <li>Adresse email</li>
    <li>Informations du compte utilisateur</li>
    <li>Historique des commandes fictives</li>
    <li>Avis laissés sur les produits</li>
</ul>

<h4>2 - Droit d’accès</h4>

<p>
    Chaque utilisateur dispose d’un droit d’accès aux données le concernant.
</p>

<p>
    Il peut consulter les informations liées à son compte via son espace
    personnel lorsque cette fonctionnalité est disponible.
</p>

<h4>3 - Droit de rectification</h4>

<p>
    L’utilisateur peut demander la modification ou la mise à jour de ses
    informations personnelles si celles-ci sont inexactes ou incomplètes.
</p>

<p>
    Certaines modifications peuvent être réalisées directement depuis
    l’espace utilisateur.
</p>

<h4>4 - Droit à la suppression</h4>

<p>
    L’utilisateur peut demander la suppression de son compte ainsi que des
    données associées.
</p>

<p>
    Dans le cadre de ce projet fictif, cette suppression peut être simulée via
    les fonctionnalités du site ou réalisée manuellement dans la base de
    données de test.
</p>

<h4>5 - Droit à la limitation</h4>

<p>
    L’utilisateur peut demander la limitation temporaire du traitement de ses
    données lorsque cela est applicable dans le cadre du projet.
</p>

<h4>6 - Droit d’opposition</h4>

<p>
    Aucun traitement commercial ou publicitaire n’étant effectué, le droit
    d’opposition reste théorique mais reconnu dans les principes appliqués.
</p>

<h4>7 - Sécurité des données</h4>

<p>
    Les données sont stockées dans un environnement local ou de test sécurisé,
    sans diffusion publique.
</p>

<p>
    Les accès utilisateurs sont protégés selon les mécanismes développés dans
    le projet (authentification, sessions, mots de passe chiffrés si prévus).
</p>

<h4>8 - Durée de conservation</h4>

<p>
    Les données sont conservées uniquement le temps nécessaire à la
    démonstration technique ou au fonctionnement pédagogique du projet.
</p>

<p>
    Elles peuvent être supprimées, réinitialisées ou remplacées à tout moment.
</p>

<h4>9 - Contact</h4>

<p>
    Pour toute question relative à la protection des données personnelles, un
    formulaire de contact peut être mis à disposition sur le site.
</p>

<h4>10 - Nature fictive du projet</h4>

<p>
    Ce site n’étant pas exploité commercialement ni hébergé publiquement, les
    présentes dispositions ont principalement une vocation pédagogique et
    illustrative.
</p>

<?php
$contenu = ob_get_clean();
require "vues/template.php";
?>