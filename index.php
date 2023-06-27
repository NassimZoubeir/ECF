<?php
session_start();
require_once 'include/db.php';

// Requête pour récupérer toutes les listes contenant des articles
$query = "SELECT l.*, a.nom AS article_nom, a.description AS article_description, u.nom AS utilisateur_nom
          FROM liste l
          LEFT JOIN liste_has_article la ON l.id_Liste = la.id_Liste
          LEFT JOIN article a ON la.id_Article = a.id_Article
          LEFT JOIN utilisateur u ON l.id_Utilisateur = u.id_Utilisateur";

$stmt = $pdo->query($query);
$listes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link rel="stylesheet" href="node_modules/bootstrap-icons/font/bootstrap-icons.css">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="apple-touch-icon" sizes="180x180" href="assets/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="assets/favicon/site.webmanifest">
    <link rel="mask-icon" href="assets/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <title>Accueil</title>
</head>

<body>
<?php require_once 'include/menu.php' ?>
				
<div class="container">
        <h1 class="card-title text-primary text-center m-3">Liste de souhaits</h1>

        <div class="row">
            <?php
            // Affichage des listes et des articles associés
            foreach ($listes as $liste) {
                echo '<div class="col-md-4">';
                echo '<div class="card m-3">';
                echo '<div class="card-body">';
                echo '<h2 class="card-title text-primary">' . $liste['nom'] . ' (par ' . $liste['utilisateur_nom'] . '):</h2>';
                echo '<p class="card-text text-muted">' . $liste['description'] . '</p>';
                
                // Vérifier si la liste contient des articles
                if (!empty($liste['article_nom'])) {
                    echo '<p>Articles :</p>';
                    echo '<ul>';
                    echo '<li>' . $liste['article_nom'] . ' - ' . $liste['article_description'] . '</li>';
                    echo '</ul>';
                } else {
                    echo '<p>Cette liste ne contient aucun article.</p>';
                }
                
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</body>

</html>