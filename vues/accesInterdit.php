<?php
$titre = "UrbanStyle : Accès interdit";
ob_start();
?>

<h1 class="text-center bg-danger p-3">ERREUR</h1>

<p>Vous n'avez pas les droits nécessaires pour accéder à cette page</p>

<a href="index.php?action=accueil" class="btn btn-primary">Retour</a>

<?php
$contenu = ob_get_clean();
require "vues/template.php";
?>