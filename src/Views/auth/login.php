<div class="d-flex flex-column min-vh-100">
    <div class="container">

        <h1>Connexion admin</h1>

        <form action="index.php?page=loginpost" method="POST">

            <div class="mb-3">
                <label for="admin_pseudo" class="form-label">Identifiant</label>
                <input type="text"
                    class="form-control"
                    id="admin_pseudo"
                    name="admin_pseudo"
                    required>
            </div>

            <div class="mb-3">
                <label for="admin_password" class="form-label">Mot de passe</label>
                <input type="password"
                    class="form-control"
                    id="admin_password"
                    name="admin_password"
                    required>
            </div>

            <button type="submit" class="btn btn-primary">Se connecter</button>

        </form>

    </div>
</div>