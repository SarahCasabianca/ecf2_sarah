
<div class="trombinoscope">

    <?php foreach ($interns as $intern): ?>

        <div class="carte-stagiaire">
            
            <img src="/ecf2_sarah/public/assets/img/<?= htmlspecialchars($intern['intern_photo'] ?? 'placeholder.webp') ?>" alt="Photo de <?= htmlspecialchars($intern['intern_name']) ?>">

            <p><?= htmlspecialchars($intern['intern_name']) ?></p>
            <p><?= htmlspecialchars($intern['intern_surname']) ?></p>
            <p><?= htmlspecialchars($intern['intern_birthdate']) ?></p>

        </div>

    <?php endforeach; ?>

</div>