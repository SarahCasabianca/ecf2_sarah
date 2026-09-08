<div class="d-flex flex-column min-vh-100">
    <div class="container">

        <h1>Ajouter une absence</h1>

        <!-- Formulaire d'ajout (POST vers addpost.html) -->
        <form action="index.php?page=add-absence-post" method="POST">

            <!-- Champ Intern Birthdate -->
            <div class="mb-3">
                <label for="intern_birthdate" class="form-label">Date de l'absence</label>
                <input type="date"
                    class="form-control"
                    id="absence_date"
                    name="absence_date"
                    required></input>
            </div>

            <select name="reason_id" required>
                <?php foreach ($reasons as $reason): ?>
                    <option value="<?= htmlspecialchars($reason['reason_id']) ?>">
                    <?= htmlspecialchars($reason['reason_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <select name="intern_id" required>
                <?php foreach ($interns as $intern): ?>
                    <option value="<?= htmlspecialchars($intern['intern_id']) ?>">
                    <?= htmlspecialchars($intern['intern_name']) . ' ' . htmlspecialchars($intern['intern_surname']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <!-- Boutons de soumission et retour -->
            <button type="submit" class="btn btn-primary">Envoyer</button>
            <a class="btn btn-secondary" role="button" href="index.php?page=home">RETOUR</a>

        </form>

    </div>
</div>