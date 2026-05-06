<?php
$titre = "Site e-commerce 2022-2023 : Connexion";
ob_start()
?>

<div class="container d-flex justify-content-center align-items-center mt-5 mb-5">
    <div class="col-md-5 col-lg-4">

        <div class="card shadow">
            <div class="card-body p-4">

                <h2 class="text-center mb-4">Connexion</h2>

                <form action="#" method="POST">

                    <div class="mb-3">
                        <label for="email" class="form-label">Adresse email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="mb-4">
                        <label for="motdepasse" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="motdepasse" name="motdepasse" required>
                    </div>

                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary">
                            Se connecter
                        </button>
                    </div>

                    <div class="text-center">
                        <small>
                            Pas encore de compte ?
                            <a href="index.php?action=utilisateur_inscription">
                                S'inscrire
                            </a>
                        </small>
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