<?php

// import du fichier d'accès
require "acces.php";

// Controle de securité sur les URL
function AvoirAcces(string $action): bool {

    global $ListAcces;

    // Vérifie que l'action existe dans la liste des accès
    if (!isset($ListAcces[$action])) {
        return false;
    }

    $roles = $ListAcces[$action];

    // Si aucun rôle n'est défini, l'accès est public
    if (empty($roles)) {
        return true;
    }

    // Vérifie qu'un utilisateur est connecté
    if (!isset($_SESSION['user'])) {
        return false;
    }

    // Vérifie que le rôle de l'utilisateur est autorisé
    return in_array($_SESSION['user']->getRole(), $roles);
}

// Page d'accès interdit
function ctlAccesInterdit() {

    require_once "vues/Securite/accesInterdit.php"; 
}