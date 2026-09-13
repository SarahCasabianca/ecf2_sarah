<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Gestion des stagiaires</h1>
        <a href="index.php?page=add-intern" class="btn btn-primary">Ajouter un stagiaire</a>
    </div>

    <div class="row g-4">
        <?php foreach ($interns as $intern) : ?>
            <?php $isRed = in_array($intern['intern_id'], $redIds); ?>
            <div class="col-6 col-md-3">
                <div class="card h-100 <?= $isRed ? 'border-danger border-2' : '' ?>">
                    <img src="/ecf2_sarah/public/assets/img/<?= htmlspecialchars($intern['intern_photo'] ?? 'placeholder.webp') ?>"
                         class="card-img-top object-fit-cover"
                         style="height: 200px;"
                         alt="Photo de <?= htmlspecialchars($intern['intern_name']) ?>">
                    <div class="card-body text-center p-2">
                        <p class="card-text mb-1 <?= $isRed ? 'text-danger fw-bold' : '' ?>">
                            <?= htmlspecialchars($intern['intern_name']) ?> <?= htmlspecialchars($intern['intern_surname']) ?>
                        </p>
                        <p class="card-text small mb-2"><?= htmlspecialchars($intern['intern_birthdate']) ?></p>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="index.php?page=edit-intern&id=<?= $intern['intern_id'] ?>" class="btn btn-sm btn-outline-secondary">Modifier</a>
                            <form action="index.php?page=delete-intern-post&id=<?= $intern['intern_id'] ?>" method="POST" onsubmit="return confirm('Supprimer ce stagiaire ?');">
                                <button type="submit" class="btn btn-sm btn-outline-danger">Supprimer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>