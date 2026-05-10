<?php
// import du fichier d'accès
require "acces.php";

// Controle de securité sur les URL
function AvoirAcces(string $action): bool {
    global $ListAcces;

    if (!isset($ListAcces[$action])) {
        return false;
    }

    $roles = $ListAcces[$action];

    if (empty($roles)) {
        return true;
    }

    if (!isset($_SESSION['user'])) {
        return false;
    }

    return in_array($_SESSION['user']->getRole(), $roles);
}

// Page d'accès interdit
function ctlAccesInterdit() {
    require_once "vues/accesInterdit.php"; 
}