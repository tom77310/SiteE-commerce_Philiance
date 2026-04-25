<?php
$titre = "Site e-commerce 2022-2023 : Utilisateur - Mes Avis";
ob_start();
?>

<h1 class="mb-4 text-center text-decoration-underline">Mes Avis</h1>

<div class="mb-3">
    <a href="index.php?action=utilisateur_compte" class="btn btn-secondary">
        Retour à mon compte
    </a>
</div>
<div class="card border-0 shadow-none">
    <div class="card-body p-0">
        <?php if (empty($avis)) { ?>
            Vous n'avez laissé aucun avis
        <?php } else { ?>
            <table class="table-striped table-hover table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th class="p-3">Nom du produit</th>
                        <th class="p-3">Note attribuée</th>
                        <th class="p-3">Commentaire</th>
                        <th class="p-3">Accès au produit</th>
                        <th class="p-3">Modifier le commentaire</th>
                        <th class="p-3">Supprimer le commentaire</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($avis as $a) { ?>
                        <tr>
                            <td class="p-3"><?= htmlspecialchars($a['nom_produit']) ?></td>
                            <td class="p-3"><?= $a['note'] ?>/5 ⭐</td>
                            <td class="p-3"><?= htmlspecialchars($a['commentaire']) ?></td>
                            <td class="p-3">
                                <a href="index.php?action=detail_produit&id=<?= $a['id_produit']?>" 
                                    class="btn btn-sm btn-primary">
                                    Voir le produit
                                </a>
                            </td>
                            <td class="p-3">
                                <a href="index.php?action=modifier_avis&id=<?= $a['id_avis'] ?>&retour=mes_avis"
                                    class="btn btn-sm btn-warning">
                                    Modifier l'avis
                                </a>
                            </td>
                            <td class="p-3">
                                <a href="index.php?action=supprimer_avis&id=<?= $a['id_avis'] ?>&retour=mes_avis"
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Voulez vous vraiment supprimer votre avis ?')">
                                    Supprimer l'avis
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } ?>
    </div>
</div>


<?php
$contenu = ob_get_clean();
require "vues/template.php";
?>