<?php
$titre = "Site e-commerce 2022-2023 : Gestion des Commandes";
ob_start();
?>

<h1 class="mb-4">Gestion des commandes </h1>

<div class="mb-3">
    <a href="index.php?action=Admin_EspaceAdmin" class="btn btn-secondary">
        Retour
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Référence</th>
                    <th>Utilisateur</th>
                    <th>Montant</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($commandes as $commande){ ?>
                    <tr>
                        <td><?= $commande['id_commande'] ?></td>
                        <td><?= htmlspecialchars($commande['reference']) ?></td>
                        <td>
                            <?= htmlspecialchars($commande['nom']) ?>
                            <?= htmlspecialchars($commande['prenom']) ?>
                            <br>
                            <small class="text-muted">
                                (<?= htmlspecialchars($commande['pseudo']) ?>)
                            </small>
                        </td>
                        <td><?= number_format($commande['montant'],2) ?>€</td>
                        <td><?= date("d/m/Y H:i", strtotime($commande['date'])) ?></td>
                        <td>
                            <a href="index.php?action=recap_commande&id=<?= $commande['id_commande'] ?>" class="btn btn-sm btn-primary">
                                Voir
                            </a>
                            <a href="index.php?action=Admin_SupprimerCommande&id=<?= $commande['id_commande'] ?>" class="btn btn-sm btn-danger"
                            onclick="return confirm('Etes-vous sûr de vouloir supprimer cette commande ?')">
                                Suprimer
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>


<?php
$contenu = ob_get_clean();
require "vues/template.php";
?>