<?php
// Import model
require_once __DIR__ . '/../model/utilisateurs.php';

// Inscription
function ctlUtilisateurInscription() {
    $ret = false;
    if(isset($_POST['email'])){
        $utilisateur = new Utilisateurs();

        $utilisateur->setNom(htmlspecialchars($_POST['nom']))
                    ->setPrenom(htmlspecialchars($_POST['prenom']))
                    ->setPseudo(htmlspecialchars($_POST['pseudo'])) 
                    ->setTel(htmlspecialchars($_POST['tel'])) 
                    ->setDateNaissance(htmlspecialchars($_POST['date_naissance'])) 
                    ->setEmail(htmlspecialchars($_POST['email'])) 
                    ->setMotdepasse($_POST['motdepasse']) 
                    ->setRole("USER"); // Role par defaut
        $ret = AjoutUtilisateur($utilisateur);
        header("location: index.php?action=connexion");
        exit;
    }
    require "vues/inscription.php";
}
// Connexion
function ctlUtilisateurConnexion() {
    if (isset($_POST['email']) && isset($_POST['motdepasse'])){
        $email = htmlspecialchars($_POST['email']);
        $motdepasse = $_POST['motdepasse'];

        $utilisateur = AvoirUtilisateurParSonEmail($email);
        if($utilisateur){
            if($utilisateur->checkPasswd($motdepasse)){
                $_SESSION['user'] = $utilisateur;
            }
        }
        header("location: index.php?action=accueil");
        exit; // Toujours le mettre apres location, sinon php continue d'executer le fichier
    }
    require "vues/connexion.php";
}
// Deconnexion
function ctlUtilisateurDeconnexion() {
    unset($_SESSION['user']);
    setcookie('PHPSESSID', '', time()-3600);
    header("location: index.php?action=accueil");
    exit;
}

// Compte Utilisateur
function ctlCompteUtilisateur() {
    // Vérification que l'utilisateur soit bien connecté
    if (!isset($_SESSION['user'])) { // Si l'utilisateur n'as pas le role "utilisateur"
        header("Location: index.php?action=utilisateur_connexion"); // redirection vers la page de connexion
        exit();
    }
    $utilisateur = $_SESSION['user'];

    require "vues/CompteUtilisateur.php";
}

//Information utilisateur
function ctlInfoUtilisateur(){
    // Verification du role utilisateur
    if (!isset($_SESSION['user'])) { // Si l'utilisateur n'as pas le role "utilisateur"
        header("Location: index.php?action=utilisateur_connexion"); // redirection vers la page de connexion
        exit();
    }
    $utilisateur = $_SESSION['user'];

    require "vues/InfosUtilisateur.php";
}

// Modif Infos Perso
function ctlModifierCompte() {
    if (!isset($_SESSION['user'])) {
        header("Location: index.php?action=utilisateur_connexion");
        exit();
    }

    $utilisateur = $_SESSION['user'];
    require "vues/ModifInfosUtilisateur.php";
}

// Traitement modif infos utilisateurs
function ctlModifierCompteTraitement() {

    // Sécurité : utilisateur connecté
    if (!isset($_SESSION['user'])) {
        header("Location: index.php?action=utilisateur_connexion");
        exit();
    }

    // Sécurité : POST uniquement
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header("Location: index.php?action=utilisateur_compte");
        exit();
    }

    $utilisateur = $_SESSION['user'];

    // Récupération des données
    $nom = trim($_POST['nom'] ?? '');
    $prenom = trim($_POST['prenom'] ?? '');
    $pseudo = trim($_POST['pseudo'] ?? '');
    $tel = trim($_POST['tel'] ?? '');
    $date_naissance = $_POST['date_naissance'] ?? '';
    $email = trim($_POST['email'] ?? '');

    // Vérification minimale
    if (
        $nom && $prenom && $pseudo && $tel && $date_naissance && $email
    ) {

        $ok = modifierUtilisateurComplet(
            $utilisateur->getIdUtilisateurs(),
            $nom,
            $prenom,
            $pseudo,
            $tel,
            $date_naissance,
            $email
        );

        if ($ok) {
            // Mise à jour de la session
            $utilisateur->setNom($nom);
            $utilisateur->setPrenom($prenom);
            $utilisateur->setPseudo($pseudo);
            $utilisateur->setTel($tel);
            $utilisateur->setDateNaissance($date_naissance);
            $utilisateur->setEmail($email);

            $_SESSION['user'] = $utilisateur;
        }
    }

    // Retour espace utilisateur
    header("Location: index.php?action=utilisateur_compte");
    exit();
}

// Suppression de compte utilisateur avec verif mot de passe
function ctlSupprimerCompte() {

    // =========================
    // 1️⃣ Sécurité : utilisateur connecté
    // =========================
    if (!isset($_SESSION['user'])) {
        header("Location: index.php?action=utilisateur_connexion");
        exit();
    }

    // =========================
    // 2️⃣ Sécurité : POST uniquement
    // =========================
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header("Location: index.php?action=utilisateur_compte");
        exit();
    }

    // =========================
    // 3️⃣ Récupération utilisateur + mot de passe
    // =========================
    $utilisateur = $_SESSION['user'];
    $password = $_POST['password'] ?? '';

    // Si le champ est vide → refus
    if (empty($password)) {
        header("Location: index.php?action=utilisateur_compte");
        exit();
    }

    // =========================
    // 4️⃣ Vérification du mot de passe
    // =========================
    // getMotDePasse() doit retourner le hash stocké en base
    if (!password_verify($password, $utilisateur->getMotDePasse())) {
        // Mot de passe incorrect → retour sans suppression
        header("Location: index.php?action=utilisateur_compte");
        exit();
    }

    // =========================
    // 5️⃣ Suppression du compte
    // =========================
    $ok = SupprimerUtilisateurParId($utilisateur->getIdUtilisateurs());

    // =========================
    // 6️⃣ Déconnexion propre
    // =========================
    if ($ok) {
        session_unset();
        session_destroy();
    }

    // =========================
    // 7️⃣ Redirection finale
    // =========================
    header("Location: index.php?action=accueil");
    exit();
}

// Traitement modif mot de passe
function ctlModifierMotDePasseTraitement() {

    // =========================
    // 1️⃣ Sécurité : connecté
    // =========================
    if (!isset($_SESSION['user'])) {
        header("Location: index.php?action=utilisateur_connexion");
        exit();
    }

    // =========================
    // 2️⃣ Sécurité : POST uniquement
    // =========================
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header("Location: index.php?action=utilisateur_compte");
        exit();
    }

    $utilisateur = $_SESSION['user'];

    // =========================
    // 3️⃣ Récupération des champs
    // =========================
    $ancien = $_POST['ancien_mot_de_passe'] ?? '';
    $nouveau = $_POST['nouveau_mot_de_passe'] ?? '';
    $confirmation = $_POST['confirmation_mot_de_passe'] ?? '';

    // =========================
    // 4️⃣ Vérifications
    // =========================
    if (
        empty($ancien) ||
        empty($nouveau) ||
        empty($confirmation)
    ) {
        header("Location: index.php?action=modifier_mot_de_passe");
        exit();
    }

    // Vérifier l’ancien mot de passe
    if (!password_verify($ancien, $utilisateur->getMotDePasse())) {
        header("Location: index.php?action=modifier_mot_de_passe");
        exit();
    }

    // Vérifier la confirmation
    if ($nouveau !== $confirmation) {
        header("Location: index.php?action=modifier_mot_de_passe");
        exit();
    }

    // =========================
    // 5️⃣ Hash du nouveau mot de passe
    // =========================
    $nouveauHash = password_hash($nouveau, PASSWORD_DEFAULT);

    // =========================
    // 6️⃣ Mise à jour en base
    // =========================
    $ok = modifierMotDePasse(
        $utilisateur->getIdUtilisateurs(),
        $nouveauHash
    );

    // =========================
    // 7️⃣ Mise à jour session
    // =========================
    if ($ok) {
        $utilisateur->setMotDePasse($nouveauHash);
        $_SESSION['user'] = $utilisateur;
    }

    // =========================
    // 8️⃣ Redirection finale
    // =========================
    header("Location: index.php?action=utilisateur_compte");
    exit();
}


function ctlModifierMotDePasse() {
    if (!isset($_SESSION['user'])) {
        header("Location: index.php?action=utilisateur_connexion");
        exit();
    }

    require "vues/modifierMotDePasse.php";
}

?>