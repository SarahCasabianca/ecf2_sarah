<div class="d-flex flex-column min-vh-100">
    <div class="container">

        <h1>Modifier une absence</h1>

        <form action="index.php?page=edit-absence-post&id=<?= htmlspecialchars($absence['absence_id']) ?>" method="POST">

            <div class="mb-3">
                <label for="absence_date" class="form-label">Date de l'absence</label>
                <input type="date"
                    class="form-control"
                    id="absence_date"
                    name="absence_date"
                    value="<?= htmlspecialchars($absence['absence_date']) ?>"
                    required>
            </div>

            <select name="reason_id" required>
                <?php foreach ($reasons as $reason): ?>
                    <option value="<?= htmlspecialchars($reason['reason_id']) ?>"
                        <?= $reason['reason_id'] == $absence['reason_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($reason['reason_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <select name="intern_id" required>
                <?php foreach ($interns as $intern): ?>
                    <option value="<?= htmlspecialchars($intern['intern_id']) ?>"
                        <?= $intern['intern_id'] == $absence['intern_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($intern['intern_name']) . ' ' . htmlspecialchars($intern['intern_surname']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit" class="btn btn-primary">Envoyer</button>
            <a class="btn btn-secondary" role="button" href="index.php?page=home">RETOUR</a>

        </form>

    </div>
</div>