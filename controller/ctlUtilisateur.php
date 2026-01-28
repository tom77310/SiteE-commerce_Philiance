<?php
require_once __DIR__ . '/../model/utilisateurs.php';
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

function ctlUtilisateurDeconnexion() {
    unset($_SESSION['user']);
    setcookie('PHPSESSID', '', time()-3600);
    header("location: index.php?action=accueil");
    exit;
}
?>