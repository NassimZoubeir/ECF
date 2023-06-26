<?php
session_start();
require_once 'include/db.php';

// Requête pour récupérer tous les articles
$query = "SELECT * FROM `Article`";
$stmt = $pdo->query($query);
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link rel="stylesheet" href="node_modules/bootstrap-icons/font/bootstrap-icons.css">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	<title>Accueil</title>
</head>

<body>
<?php require_once 'include/menu.php' ?>
				
	<div class="container">
        <h1 class="card-title text-primary text-center m-3">Liste des articles</h1>

        <div class="row">
            <?php
            // Affichage des articles
            foreach ($articles as $article) {
                echo '<div class="col-md-4 ">';
                echo '<div class="card m-3">';
                echo '<div class="card-body">';
                echo '<h2 class="card-title text-primary">' . $article['nom'] . ':</h2>';
                echo '<p class="card-text text-muted">' . $article['description'] . '</p>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
    </div>
</body>

</html>