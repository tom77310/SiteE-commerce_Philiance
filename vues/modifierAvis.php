<?php
$titre = "Site e-commerce 2022-2023 : Administrateur - Modifier un avis";
ob_start();
?>


<h1>Modifier mon avis</h1>

<form action="index.php?action=update_avis" method="post">
    <input type="hidden" name="id_avis" value="<?= $avis['id_avis'] ?>">
    <input type="hidden" name="id_produit" value="<?= $avis['id_produit'] ?>">
    <input type="hidden" name="retour" value="<?= $_GET['retour'] ?? '' ?>">

    <div class="mb-3">
        <label>Note</label>
        <select name="note" class="form-select">
            <?php for ($i = 1; $i <= 5; $i++) { ?>
                <option value="<?= $i ?>" <?= $avis['note'] == $i ? 'selected' : '' ?>>
                    <?= $i ?> ⭐
                </option>
            <?php } ?>
        </select>
    </div>
    <div class="mb-3">
        <label> Commentaire </label>
        <textarea name="commentaire" class="form-control"><?= htmlspecialchars($avis['commentaire']) ?></textarea>
    </div>
    <button class="btn btn-success">Modifier l'avis</button>
    <button href="index.php?action=detail_produit&id=<?= $avis['id_produit'] ?>" class="btn btn-secondary">Annuler</button>
</form>


<?php
$contenu = ob_get_clean();
require "vues/template.php";
?>