<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Liste des absences</h1>
        <a href="index.php?page=add-absence" class="btn btn-primary">Ajouter une absence</a>
    </div>

    <div class="card shadow-sm">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Date</th>
                    <th>Stagiaire</th>
                    <th>Raison</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($absences as $absence): ?>
                    <tr>
                        <td><?= htmlspecialchars($absence['absence_date']) ?></td>
                        <td><?= htmlspecialchars($absence['intern_name']) . ' ' . htmlspecialchars($absence['intern_surname']) ?></td>
                        <td><?= htmlspecialchars($absence['reason_name']) ?></td>
                        <td class="text-end">
                            <a href="index.php?page=edit-absence&id=<?= $absence['absence_id'] ?>" class="btn btn-sm btn-outline-secondary">Modifier</a>
                            <form action="index.php?page=delete-absence-post&id=<?= $absence['absence_id'] ?>" method="POST" class="d-inline" onsubmit="return confirm('Supprimer cette absence ?');">
                                <button type="submit" class="btn btn-sm btn-outline-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>