<div class="d-flex flex-column min-vh-100">
    <div class="container">

        <h1>Liste des absences</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Stagiaire</th>
                    <th>Raison</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($absences as $absence): ?>
                    <tr>
                        <td><?= htmlspecialchars($absence['absence_date']) ?></td>
                        <td><?= htmlspecialchars($absence['intern_name']) . ' ' . htmlspecialchars($absence['intern_surname']) ?></td>
                        <td><?= htmlspecialchars($absence['reason_name']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <a class="btn btn-secondary" role="button" href="index.php?page=home">RETOUR</a>

    </div>
</div>