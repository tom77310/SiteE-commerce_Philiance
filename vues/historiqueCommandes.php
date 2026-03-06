<?php
$titre = "Site e-commerce 2022-2023 : Historique de commandes";
ob_start();
?>

<div class="container mt-5">
    <h2>Mes commandes</h2>

    <?php if (empty($commandes)) : ?>
        <p>Vous n'avez encore passé aucune commande.</p>

    <?php else : ?>

        <table class="table">
            <thead>
                <tr>
                    <th>Référence</th>
                    <th>Montant</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($commandes as $commande) : ?>
                    <tr>
                        <td><?= htmlspecialchars($commande->getReference()) ?></td>
                        <td><?= $commande->getMontant() ?> €</td>
                        <td><?= $commande->getDate()->format("d/m/Y H:i") ?></td>
                        <td><a href="index.php?action=recap_commande&id=<?= $commande->getIdCommande() ?>" class= "btn btn-sm btn-primary"> Voir</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif ?>

</div>

<?php
$contenu = ob_get_clean();
require "vues/template.php";
?>