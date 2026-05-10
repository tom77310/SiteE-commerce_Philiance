<?php
// Quantité panier
$PanierQte = 0;

if (isset($_SESSION['panier'])) {
    $PanierQte = array_sum($_SESSION['panier']);
}

// Connexion / rôle
$isConnected = isset($_SESSION['user']);
$role = $isConnected ? $_SESSION['user']->getRole() : null;
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm py-3">

    <div class="container-fluid px-3">

        <!-- Logo -->
        <a class="navbar-brand p-0 me-4 d-flex align-items-center"
          href="index.php?action=accueil">

            <img src="./assets/Logo/LogoUrbanStyle.png"
                alt="Logo UrbanStyle"
                height="70"
                class="d-inline-block align-middle">

        </a>

        <!-- Responsive -->
        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <!-- Liens gauche -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item mx-2">
                    <a class="nav-link fs-5 fw-semibold"
                       href="index.php?action=accueil">

                        Accueil

                    </a>
                </li>

                <li class="nav-item mx-2">
                    <a class="nav-link fs-5 fw-semibold"
                       href="index.php?action=Produits_Femmes">

                        Mode Femme

                    </a>
                </li>

                <li class="nav-item mx-2">
                    <a class="nav-link fs-5 fw-semibold"
                       href="index.php?action=Produits_Enfants">

                        Mode Enfant

                    </a>
                </li>

                <li class="nav-item mx-2">
                    <a class="nav-link fs-5 fw-semibold"
                       href="index.php?action=Produits_Hommes">

                        Mode Homme

                    </a>
                </li>

                <!-- ADMIN -->
                <?php if ($isConnected && $role === 'ADMIN') : ?>

                    <li class="nav-item mx-2">

                        <a class="nav-link fs-5 fw-semibold text-warning"
                           href="index.php?action=Admin_EspaceAdmin">

                            Espace Admin

                        </a>

                    </li>

                <?php endif; ?>

            </ul>

            <!-- Partie droite -->
            <ul class="navbar-nav align-items-lg-center">

                <!-- USER -->
                <?php if ($isConnected && $role === 'USER') : ?>

                    <li class="nav-item mx-2">

                        <a class="nav-link fs-5 fw-semibold position-relative"
                           href="index.php?action=Panier">

                            Panier

                            <?php if ($PanierQte > 0) : ?>

                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    <?= $PanierQte ?>
                                </span>

                            <?php endif; ?>

                        </a>

                    </li>

                    <li class="nav-item mx-2">

                        <a class="nav-link fs-5 fw-semibold"
                           href="index.php?action=utilisateur_compte">

                            Mon compte

                        </a>

                    </li>

                <?php endif; ?>

                <!-- Déconnexion -->
                <?php if ($isConnected) : ?>

                    <li class="nav-item mx-2">

                        <a class="btn btn-outline-light btn-lg px-4"
                           href="index.php?action=utilisateur_deconnexion">

                            Déconnexion

                        </a>

                    </li>

                <?php endif; ?>

                <!-- Non connecté -->
                <?php if (!$isConnected) : ?>

                    <li class="nav-item mx-2">

                        <a class="btn btn-outline-light btn-lg px-4"
                           href="index.php?action=utilisateur_connexion">

                            Connexion

                        </a>

                    </li>

                    <li class="nav-item mx-2">

                        <a class="btn btn-primary btn-lg px-4"
                           href="index.php?action=utilisateur_inscription">

                            Inscription

                        </a>

                    </li>
                    <button id="themeToggle" class="btn btn-outline-light ms-2">
                      🌙 Mode sombre
                    </button>

                <?php endif; ?>

            </ul>

        </div>

    </div>

</nav>