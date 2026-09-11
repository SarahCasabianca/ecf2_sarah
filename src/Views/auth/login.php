<div class="container d-flex align-items-center justify-content-center" style="min-height: 70vh;">
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">

                <h1 class="h4 mb-4 text-center">Connexion admin</h1>

                <form action="index.php?page=loginpost" method="POST">

                    <div class="mb-3">
                        <label for="admin_pseudo" class="form-label">Identifiant</label>
                        <input type="text" class="form-control" id="admin_pseudo" name="admin_pseudo" required>
                    </div>

                    <div class="mb-3">
                        <label for="admin_password" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="admin_password" name="admin_password" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Se connecter</button>

                </form>

            </div>
        </div>
    </div>
</div>