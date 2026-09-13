<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">

                    <h1 class="h4 mb-4">Modifier une absence</h1>

                    <form action="index.php?page=edit-absence-post&id=<?= htmlspecialchars($absence['absence_id']) ?>" method="POST" enctype="multipart/form-data">

                        <div class="mb-3">
                            <label for="absence_date" class="form-label">Date de l'absence</label>
                            <input type="date" class="form-control" id="absence_date" name="absence_date"
                                   value="<?= htmlspecialchars($absence['absence_date']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="reason_id" class="form-label">Raison</label>
                            <select name="reason_id" id="reason_id" class="form-select" required>
                                <?php foreach ($reasons as $reason) : ?>
                                    <option value="<?= htmlspecialchars($reason['reason_id']) ?>"
                                        <?= $reason['reason_id'] == $absence['reason_id'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($reason['reason_name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="intern_id" class="form-label">Stagiaire</label>
                            <select name="intern_id" id="intern_id" class="form-select" required>
                                <?php foreach ($interns as $intern) : ?>
                                    <option value="<?= htmlspecialchars($intern['intern_id']) ?>"
                                        <?= $intern['intern_id'] == $absence['intern_id'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($intern['intern_name']) . ' ' . htmlspecialchars($intern['intern_surname']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="absence_document" class="form-label">Justificatif</label>
                            <input type="file" class="form-control" id="absence_document" name="absence_document" accept=".pdf">
                            <?php if (!empty($absence['absence_document'])) : ?>
                                <div class="form-text">Justificatif actuel : <?= htmlspecialchars($absence['absence_document']) ?> (laisser vide pour le conserver)</div>
                            <?php endif; ?>
                        </div>                        

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Envoyer</button>
                            <a class="btn btn-secondary" role="button" href="index.php?page=home">Retour</a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>