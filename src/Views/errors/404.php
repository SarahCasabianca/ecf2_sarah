<?php

http_response_code(404);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Page non trouvée</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container d-flex flex-column align-items-center justify-content-center text-center" style="min-height: 100vh;">
        <h1 class="display-4">404</h1>
        <p class="text-muted">La page que vous cherchez n'existe pas.</p>
        <a href="index.php?page=home" class="btn btn-primary mt-3">Retour à l'accueil</a>
    </div>
</body>
</html>
