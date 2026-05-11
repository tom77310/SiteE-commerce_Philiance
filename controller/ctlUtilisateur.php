<?php

// Import model
require_once __DIR__ . '/../model/utilisateurs.php';
require_once 'vues/Securite/securite.php';

// Inscription
function ctlUtilisateurInscription() {

    $ret = false;
    $erreurs = [];

    // Vérifie que le formulaire a été envoyé
    if (isset($_POST['email'])) {

        // Validation mot de passe
        $validationMdp = MotDePasseValide($_POST['motdepasse']);

        if (!$validationMdp['valide']) {

            $erreurs = $validationMdp['erreurs'];

            require "vues/Securite/inscription.php";

            return;
        }

        // Création de l'objet utilisateur
        $utilisateur = new Utilisateurs();

        $utilisateur->setNom(htmlspecialchars($_POST['nom']))
                    ->setPrenom(htmlspecialchars($_POST['prenom']))
                    ->setPseudo(htmlspecialchars($_POST['pseudo']))
                    ->setTel(htmlspecialchars($_POST['tel']))
                    ->setDateNaissance(htmlspecialchars($_POST['date_naissance']))
                    ->setEmail(htmlspecialchars($_POST['email']))
                    ->setMotdepasse($_POST['motdepasse'])
                    ->setRole("USER");

        // Enregistrement en base de données
        $ret = AjoutUtilisateur($utilisateur);

        if ($ret) {

            header("Location: index.php?action=utilisateur_connexion");
            exit();

        }
        else {

            $erreurs[] = "Une erreur est survenue lors de l'inscription.";
        }
    }

    require "vues/Securite/inscription.php";
}

// Connexion
function ctlUtilisateurConnexion() {

    $erreurConnexion = "";

    // Vérifie que le formulaire a été envoyé
    if (isset($_POST['email']) && isset($_POST['motdepasse'])) {

        $email = htmlspecialchars($_POST['email']);
        $motdepasse = $_POST['motdepasse'];

        // Recherche de l'utilisateur par email
        $utilisateur = AvoirUtilisateurParSonEmail($email);

        if ($utilisateur) {

            // Vérification du mot de passe
            if ($utilisateur->checkPasswd($motdepasse)) {

                // Connexion de l'utilisateur
                $_SESSION['user'] = $utilisateur;

                header("Location: index.php?action=accueil");
                exit();
            }
        }

        $erreurConnexion = "Email ou mot de passe incorrect.";
    }

    require "vues/Securite/connexion.php";
}

// Deconnexion
function ctlUtilisateurDeconnexion() {

    // Suppression de l'utilisateur de la session
    unset($_SESSION['user']);

    // Suppression du cookie de session
    setcookie('PHPSESSID', '', time()-3600);

    header("location: index.php?action=accueil");
    exit;
}

// Compte Utilisateur
function ctlCompteUtilisateur() {

    // Vérification que l'utilisateur soit bien connecté
    if (!isset($_SESSION['user'])) {

        // Redirection vers la page de connexion
        header("Location: index.php?action=utilisateur_connexion");

        exit();
    }

    $utilisateur = $_SESSION['user'];

    require "vues/Utilisateur/CompteUtilisateur.php";
}

// Information utilisateur
function ctlInfoUtilisateur(){

    // Vérification que l'utilisateur soit connecté
    if (!isset($_SESSION['user'])) {

        // Redirection vers la page de connexion
        header("Location: index.php?action=utilisateur_connexion");

        exit();
    }

    $utilisateur = $_SESSION['user'];

    require "vues/Utilisateur/InfosUtilisateur.php";
}

// Modif Infos Perso
function ctlModifierCompte() {

    // Vérifie que l'utilisateur est connecté
    if (!isset($_SESSION['user'])) {
        header("Location: index.php?action=utilisateur_connexion");
        exit();
    }

    $utilisateur = $_SESSION['user'];

    require "vues/Utilisateur/ModifInfosUtilisateur.php";
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

    // Vérification minimale des champs
    if (
        $nom &&
        $prenom &&
        $pseudo &&
        $tel &&
        $date_naissance &&
        $email
    ) {

        // Mise à jour en base de données
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

// Supprimer le compte
function ctlSupprimerCompte() {

    // Vérifie que l'utilisateur est connecté
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
    $password = $_POST['password'] ?? '';

    // Vérifie que le mot de passe a été renseigné
    if (empty($password)) {
        header("Location: index.php?action=utilisateur_compte");
        exit();
    }

    // Vérification du mot de passe
    if (!password_verify($password, $utilisateur->getMotDePasse())) {
        header("Location: index.php?action=utilisateur_compte");
        exit();
    }

    // Suppression en base de données
    SupprimerUtilisateurParId($utilisateur->getIdUtilisateurs());

    // Destruction de la session
    $_SESSION = [];

    if (ini_get("session.use_cookies")) {

        $params = session_get_cookie_params();

        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }

    session_destroy();

    header("Location: index.php?action=accueil");
    exit();
}

// Traitement modification mot de passe
function ctlModifierMotDePasseTraitement() {

    // =========================
    // 1️⃣ Sécurité : connecté
    // =========================
    if (!isset($_SESSION['user'])) {

        header("Location: index.php?action=utilisateur_connexion");

        exit();
    }

    // =========================
    // 2️⃣ POST uniquement
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

    $erreurs = [];

    // =========================
    // 4️⃣ Vérification champs vides
    // =========================
    if (
        empty($ancien) ||
        empty($nouveau) ||
        empty($confirmation)
    ) {

        $erreurs[] = "Tous les champs sont obligatoires.";
    }

    // =========================
    // 5️⃣ Vérifier ancien mot de passe
    // =========================
    if (!password_verify($ancien, $utilisateur->getMotDePasse())) {

        $erreurs[] = "L'ancien mot de passe est incorrect.";
    }

    // =========================
    // 6️⃣ Vérifier confirmation
    // =========================
    if ($nouveau !== $confirmation) {

        $erreurs[] = "La confirmation du mot de passe est incorrecte.";
    }

    // =========================
    // 7️⃣ Validation sécurité mot de passe
    // =========================
    $validationMdp = MotDePasseValide($nouveau);

    if (!$validationMdp['valide']) {

        $erreurs = array_merge(
            $erreurs,
            $validationMdp['erreurs']
        );
    }

    // =========================
    // 8️⃣ Si erreurs
    // =========================
    if (!empty($erreurs)) {

        require "vues/Utilisateur/modifierMotDePasse.php";

        return;
    }

    // =========================
    // 9️⃣ Hash du nouveau mot de passe
    // =========================
    $nouveauHash = password_hash($nouveau, PASSWORD_DEFAULT);

    // =========================
    // 🔟 Mise à jour BDD
    // =========================
    $ok = modifierMotDePasse(
        $utilisateur->getIdUtilisateurs(),
        $nouveauHash
    );

    // =========================
    // 1️⃣1️⃣ Mise à jour session
    // =========================
    if ($ok) {

        $utilisateur->setMotDePasse($nouveauHash);

        $_SESSION['user'] = $utilisateur;

        header("Location: index.php?action=utilisateur_compte&success=mdp_modifie");

        exit();
    }

    // =========================
    // 1️⃣2️⃣ Erreur BDD
    // =========================
    $erreurs[] = "Une erreur est survenue.";

    require "vues/Utilisateur/modifierMotDePasse.php";
}

// Formulaire modification mot de passe
function ctlModifierMotDePasse() {

    // Vérifie que l'utilisateur est connecté
    if (!isset($_SESSION['user'])) {

        header("Location: index.php?action=utilisateur_connexion");

        exit();
    }

    require "vues/Utilisateur/modifierMotDePasse.php";
}

?>