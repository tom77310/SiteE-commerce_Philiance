<?php
$titre = "Site e-commerce 2022-2023: Modifier mes informations Persos";
ob_start();

/** @var Utilisateurs $utilisateur */ // Evite l'erreur visuel de VSCode sur les variables
?>

<div class="container mt-5">
    <div class="col-md-8 mx-auto">

        <div class="card shadow">
            <div class="card-body p-4">

                <h2 class="mb-4 text-center">Modifier mes informations</h2>

                <form method="post" action="index.php?action=modifier_compte_traitement">

                    <div class="mb-3">
                        <label class="form-label">Nom</label>
                        <input 
                            name="nom"
                            type="text" 
                            class="form-control"
                            value="<?= htmlspecialchars($utilisateur->getNom()) ?>"            
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Prénom</label>
                        <input 
                            type="text" 
                            class="form-control"
                            value="<?= htmlspecialchars($utilisateur->getPrenom()) ?>"
                            name="prenom"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Pseudo</label>
                        <input 
                            type="text" 
                            class="form-control"
                            value="<?= htmlspecialchars($utilisateur->getPseudo()) ?>"
                            name="pseudo"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input 
                            type="email" 
                            class="form-control"
                            value="<?= htmlspecialchars($utilisateur->getEmail()) ?>"
                            name="email"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Date de naissance</label>
                        <?php
                            $date = new DateTime($utilisateur->getDateNaissance());
                        ?>
                        <input 
                            type="date" 
                            class="form-control"
                            name="date_naissance"
                            value="<?= $date->format('Y-m-d') ?>"
                        >
                    </div>

                    <div class="mb-3">
                        <label for="tel" class="form-label">Téléphone</label>
                        <input
                            type="tel"
                            class="form-control"
                            id="tel"
                            name="tel"
                            placeholder="06 12 34 56 78"
                            value="<?= htmlspecialchars($utilisateur->getTel()) ?>"
                            required
                        >
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <button type="submit" class="btn btn-primary">
                            Enregistrer les modifications
                        </button>

                        <a href="index.php?action=utilisateur_compte" class="btn btn-secondary">
                            Retour
                        </a>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>

<?php
$contenu = ob_get_clean();
require "vues/template.php";
?>