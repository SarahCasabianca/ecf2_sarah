<div class="container">

    <h1 class="mb-4">Trombinoscope</h1>

    <div class="row g-4">
        <?php foreach ($interns as $intern): ?>
            <div class="col-6 col-md-3">
                <div class="card h-100">
                    <img src="/ecf2_sarah/public/assets/img/<?= htmlspecialchars($intern['intern_photo'] ?? 'placeholder.webp') ?>"
                         class="card-img-top object-fit-cover"
                         style="height: 200px;"
                         alt="Photo de <?= htmlspecialchars($intern['intern_name']) ?>">
                    <div class="card-body text-center p-2">
                        <p class="card-text mb-1">
                            <?= htmlspecialchars($intern['intern_name']) ?> <?= htmlspecialchars($intern['intern_surname']) ?>
                        </p>
                        <p class="card-text small mb-0"><?= htmlspecialchars($intern['intern_birthdate']) ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>
