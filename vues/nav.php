<?php
// Quantité panier
$PanierQte = 0;
if (isset($_SESSION['panier'])) {
    $PanierQte = array_sum($_SESSION['panier']);
}

// var_dump($_SESSION);
// die;

// Connexion / rôle
$isConnected = isset($_SESSION['user']);
$role = $isConnected ? $_SESSION['user']->getRole() : null;
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">

    <!-- Logo -->
    <a class="navbar-brand" href="index.php?action=accueil">
      <img src="../img/logo2.png" alt="Logo du site" class="logo">
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <!-- Liens visibles par TOUS -->
        <li class="nav-item"><a class="nav-link" href="index.php?action=accueil">Accueil</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php?action=Produits_Femmes">Mode Femme</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php?action=Produits_Enfants">Mode Enfant</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php?action=Produits_Hommes">Mode Homme</a></li>

        <!-- ADMIN uniquement -->
        <?php if ($isConnected && $role === 'ADMIN') : ?>
          <li class="nav-item"><a class="nav-link" href="index.php?action=admin_utilisateurs">Utilisateurs</a></li>
          <li class="nav-item"><a class="nav-link" href="index.php?action=admin_produits">Produits</a></li>
        <?php endif; ?>

        <!-- USER uniquement -->
        <?php if ($isConnected && $role === 'USER') : ?>
          <li class="nav-item position-relative">
            <a class="nav-link" href="index.php?action=panier">
              Panier
              <?php if ($PanierQte > 0) : ?>
                <span class="badge bg-danger"><?= $PanierQte ?></span>
              <?php endif; ?>
            </a>
          </li>
        <?php endif; ?>

        <!-- Déconnexion : USER + ADMIN -->
        <?php if ($isConnected) : ?>
          <li class="nav-item">
            <a class="nav-link" href="index.php?action=utilisateur_deconnexion">Déconnexion</a>
          </li>
        <?php endif; ?>

        <!-- Non connecté -->
        <?php if (!$isConnected) : ?>
          <li class="nav-item"><a class="nav-link" href="index.php?action=utilisateur_inscription">Inscription</a></li>
          <li class="nav-item"><a class="nav-link" href="index.php?action=utilisateur_connexion">Connexion</a></li>
        <?php endif; ?>

      </ul>
    </div>
  </div>
</nav>
