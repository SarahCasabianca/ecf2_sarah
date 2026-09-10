<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">

                    <h1 class="h4 mb-4">Ajouter un stagiaire</h1>

                    <form action="index.php?page=add-intern-post" method="POST" enctype="multipart/form-data">

                        <div class="mb-3">
                            <label for="intern_name" class="form-label">Prénom du stagiaire</label>
                            <input type="text" class="form-control" id="intern_name" name="intern_name" placeholder="Jean" required>
                        </div>

                        <div class="mb-3">
                            <label for="intern_surname" class="form-label">Nom du stagiaire</label>
                            <input type="text" class="form-control" id="intern_surname" name="intern_surname" placeholder="Dupond" required>
                        </div>

                        <div class="mb-3">
                            <label for="intern_birthdate" class="form-label">Date de naissance du stagiaire</label>
                            <input type="date" class="form-control" id="intern_birthdate" name="intern_birthdate" required>
                        </div>

                        <div class="mb-3">
                            <label for="intern_photo" class="form-label">Photo du stagiaire</label>
                            <input type="file" class="form-control" id="intern_photo" name="intern_photo" accept=".webp, .jpeg, .png">
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