<?php
$titre = "Site e-commerce 2022-2023 : Inscription";
ob_start()
?>

<div class="container d-flex justify-content-center align-items-center mt-5 mb-5">
    <div class="col-md-6 col-lg-5">

        <div class="card shadow">
            <div class="card-body p-4">

                <h2 class="text-center mb-4">Créer un compte</h2>
                <?php if (!empty($erreurs)) { ?>

                    <div class="alert alert-danger">

                        <ul class="mb-0">

                            <?php foreach ($erreurs as $erreur) { ?>

                                <li><?= htmlspecialchars($erreur) ?></li>

                            <?php } ?>

                        </ul>

                    </div>

                <?php } ?>

                <form action="#" method="POST">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="prenom" class="form-label">Prénom</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="pseudo" class="form-label">Pseudo</label>
                        <input type="text" class="form-control" id="pseudo" name="pseudo" required>
                    </div>

                    <div class="mb-3">
                        <label for="tel" class="form-label">Téléphone</label>
                        <input type="text" class="form-control" id="tel" name="tel">
                    </div>

                    <div class="mb-3">
                        <label for="date_naissance" class="form-label">Date de naissance</label>
                        <input type="date" class="form-control" id="date_naissance" name="date_naissance">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Adresse email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="mb-4">
                        <label for="motdepasse" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="motdepasse" name="motdepasse" minlength="8" required>
                    </div>
                    <small class="text-muted">
                        Le mot de passe doit contenir au moins :
                        8 caractères, une majuscule, une minuscule et un chiffre.
                    </small>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            S'inscrire
                        </button>
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