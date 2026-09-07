<div class="d-flex flex-column min-vh-100">
    <div class="container">

        <h1>Modifier un stagiaire</h1>

        <!-- Formulaire d'ajout (POST vers addpost.html) -->
        <form action="index.php?page=edit-intern-post&id=<?= htmlspecialchars($intern['intern_id']) ?>" method="POST">

            <!-- Champ Intern Name -->
            <div class="mb-3">
                <label for="intern_name" class="form-label">Prénom du stagiaire</label>
                <input type="text"
                    class="form-control"
                    id="intern_name"
                    name="intern_name"
                    placeholder="Jean"
                    value="<?= htmlspecialchars($intern['intern_name']); ?>"
                    required>
            </div>

            <!-- Champ Intern Surname -->
            <div class="mb-3">
                <label for="intern_surname" class="form-label">Nom du stagiaire</label>
                <input type="text"
                    class="form-control"
                    id="intern_surname"
                    name="intern_surname"
                    placeholder="Dupond"
                    value="<?= htmlspecialchars($intern['intern_surname']); ?>"
                    required>
            </div>

            <!-- Champ Intern Birthdate -->
            <div class="mb-3">
                <label for="intern_birthdate" class="form-label">Date de naissance du stagiaire</label>
                <input type="date"
                    class="form-control"
                    id="intern_birthdate"
                    name="intern_birthdate"
                    value="<?= htmlspecialchars($intern['intern_birthdate']); ?>"
                    required></input>
            </div>

            <!-- Boutons de soumission et retour -->
            <button type="submit" class="btn btn-primary">Envoyer</button>
            <a class="btn btn-secondary" role="button" href="index.php?page=home">RETOUR</a>

        </form>

    </div>
</div>