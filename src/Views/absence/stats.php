<div class="container">

    <h1 class="mb-4">Classement des absences</h1>

    <div class="card">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Stagiaire</th>
                    <th>Nombre d'absences</th>
                    <th>Perte estimée</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rankings as $i => $ranking): ?>
                    <?php $loss = round($ranking['nb_absences'] * (712 / 21), 2); ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= htmlspecialchars($ranking['intern_name']) ?> <?= htmlspecialchars($ranking['intern_surname']) ?></td>
                        <td><span class="badge bg-secondary"><?= $ranking['nb_absences'] ?></span></td>
                        <td><?= $loss ?> €</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>