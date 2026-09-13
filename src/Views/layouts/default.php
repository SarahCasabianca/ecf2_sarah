<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title ?? 'Gestion des absences AFPA') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-secondary mb-4">
    <div class="container">
        <a class="navbar-brand" href="index.php?page=home">Gestion Absences AFPA</a>
        <div class="d-flex gap-3">
            <a class="nav-link text-white" href="index.php?page=home">Accueil</a>
            <?php if (isset($_SESSION['is_admin'])) : ?>
                <a class="nav-link text-white" href="index.php?page=interns">Stagiaires</a>
                <a class="nav-link text-white" href="index.php?page=absences">Absences</a>
                <a class="nav-link text-white" href="index.php?page=logout">Déconnexion</a>
            <?php else : ?>
                <a class="nav-link text-white" href="index.php?page=login">Connexion admin</a>
            <?php endif; ?>
        </div>
        <button class="btn btn-outline-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#statsOffcanvas">Statistiques</button>
    </div>
</nav>

<div class="offcanvas offcanvas-end" tabindex="-1" id="statsOffcanvas">
    <div class="offcanvas-header">
        <h5>Statistiques</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <div class="container">
                    
            <h1 class="mb-4">Classement des absences</h1>
                    
            <div class="card">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Stagiaire</th>
                            <th>Nombre d'absences</th>
                            <th>Perte estimée</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rankings as $i => $ranking) : ?>
                            <?php $loss = round($ranking['nb_absences'] * (712 / 21), 2); ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td><?= htmlspecialchars($ranking['intern_name']) ?> <?= htmlspecialchars($ranking['intern_surname']) ?></td>
                                <td><span class="badge bg-secondary"><?= $ranking['nb_absences'] ?></span></td>
                                <td><?= $loss ?> €</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
                        
        </div>
    </div>
</div>

<!-- Contenu de la vue spécifique, capturé par render() dans $content -->
<?= $content ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>