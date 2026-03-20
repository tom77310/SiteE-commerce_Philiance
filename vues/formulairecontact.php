<?php
$titre = "Site e-commerce 2022-2023 : Formulaire de contact";
ob_start();
?>

<h1 class="mb-4">Contactez-nous</h1>

<div class="card">
    <div class="card-body">

        <form action="index.php?action=envoyer_contact" method="post">

            <div class="mb-3">
                <label class="form-label">Nom</label>
                <input type="text" name="nom" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Message</label>
                <textarea name="message" class="form-control" rows="5" required></textarea>
            </div>

            <button class="btn btn-primary">Envoyer</button>

        </form>

    </div>
</div>

<?php if (isset($_GET['success'])) { ?>
    <div class="alert alert-success">
        Message envoyé avec succès !
    </div>
<?php } ?>

<?php if (isset($_GET['error'])) { ?>
    <div class="alert alert-danger">
        Erreur lors de l'envoi du message.
    </div>
<?php } ?>

<?php
$contenu = ob_get_clean();
require "vues/template.php";
?>