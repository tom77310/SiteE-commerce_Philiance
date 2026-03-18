<?php
$titre = "Site e-commerce 2022-2023 : Admin - Liste des Utilisateurs";
ob_start();
?>

<h1 class="mb-4">Gestion des Utilisateurs</h1>
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
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Pseudo</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Rôle</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($utilisateurs as $utilisateur) { ?>
                    <tr>

                        <td><?= $utilisateur->getIdUtilisateurs() ?></td>
                        <td><?= htmlspecialchars($utilisateur->getNom()) ?></td>
                        <td><?= htmlspecialchars($utilisateur->getPrenom()) ?></td>
                        <td><?= htmlspecialchars($utilisateur->getPseudo()) ?></td>
                        <td><?= htmlspecialchars($utilisateur->getEmail()) ?></td>
                        <td><?= htmlspecialchars($utilisateur->getTel()) ?></td>
                        <td>
                            <?php if($utilisateur->getRole() == "ADMIN"){ ?>
                            <span class="badge bg-danger">ADMIN</span>
                            <?php } else { ?>
                            <span class="badge bg-secondary">Utilisateur</span>
                            <?php } ?>
                        </td>
                        <td>
                            <?php if ($utilisateur->getRole() == 'ADMIN') { ?>
                                <a href="index.php?action=Admin_ModifierRoleUtilisateur&id=<?= $utilisateur->getIdUtilisateurs() ?>&role=USER" 
                                    class="btn btn-sm btn-warning">
                                    Retirer Role Admin
                                </a>
                                <?php } else { ?>
                                <a href="index.php?action=Admin_ModifierRoleUtilisateur&id=<?= $utilisateur->getIdUtilisateurs() ?>&role=ADMIN"
                                    class="btn btn-sm btn-success">
                                    Mettre role Admin
                                </a>
                            <?php } ?>                        
                            <a href="index.php?action=Admin_SupprimerUtilisateur&id=<?= $utilisateur->getIdUtilisateurs() ?>" 
                                class="btn btn-sm btn-warning" 
                                onclick="return confirm('Voulez vous vraiment supprimer cet utilisateur ?')">
                                Supprimer
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