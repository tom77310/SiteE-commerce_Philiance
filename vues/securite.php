<?php

function MotDePasseValide(string $motDePasse): array {

    $erreurs = [];

    // Longueur minimum
    if (strlen($motDePasse) < 8) {
        $erreurs[] = "Le mot de passe doit contenir au moins 8 caractères.";
    }

    // Minuscule
    if (!preg_match('/[a-z]/', $motDePasse)) {
        $erreurs[] = "Le mot de passe doit contenir au moins une minuscule.";
    }

    // Majuscule
    if (!preg_match('/[A-Z]/', $motDePasse)) {
        $erreurs[] = "Le mot de passe doit contenir au moins une majuscule.";
    }

    // Chiffre
    if (!preg_match('/[0-9]/', $motDePasse)) {
        $erreurs[] = "Le mot de passe doit contenir au moins un chiffre.";
    }

    return [
        'valide' => empty($erreurs),
        'erreurs' => $erreurs
    ];
}