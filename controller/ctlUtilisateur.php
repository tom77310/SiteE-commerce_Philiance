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
            $utilisateur->getId(),
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


?>