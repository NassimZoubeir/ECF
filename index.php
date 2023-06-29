<?php
require_once 'include/db.php';

// Requête pour récupérer toutes les listes contenant des articles avec le nom du créateur
$query = "SELECT l.id_Liste, l.nom, l.description, l.date, a.id_Article, a.nom AS article_nom, a.description AS article_description, u.nom AS createur_nom
          FROM liste l
          LEFT JOIN liste_has_article la ON l.id_Liste = la.id_Liste
          LEFT JOIN article a ON la.id_Article = a.id_Article
          LEFT JOIN utilisateur u ON l.id_Utilisateur = u.id_Utilisateur";
$stmt = $pdo->prepare($query);
$stmt->execute();
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
            // Variables pour garder une trace de l'id_Liste en cours
            $currentListId = null;
            $currentListName = null;
            $currentListDescription = null;
            $currentListDate = null;
            $currentCreateurNom = null;

            // Parcourir les résultats et afficher les listes avec les articles
            foreach ($listes as $liste) {
                // Vérifier si c'est une nouvelle liste
                if ($liste['id_Liste'] !== $currentListId) {
                    // Afficher les informations de la liste
                    if ($currentListId !== null) {
                        // Fermer la liste précédente si elle existe
                        echo '</ul>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }

                    // Mise à jour des variables pour la nouvelle liste
                    $currentListId = $liste['id_Liste'];
                    $currentListName = $liste['nom'];
                    $currentListDescription = $liste['description'];
                    $currentListDate = $liste['date'];
                    $currentCreateurNom = $liste['createur_nom'];

                    // Afficher les informations de la nouvelle liste
                    echo '<div class="col-md-4">';
                    echo '<div class="card m-3">';
                    echo '<div class="card-body">';
                    echo '<h2 class="card-title text-primary">' . $currentListName . '</h2>';
                    echo '<p class="card-text text-muted">' . $currentListDescription . '</p>';
                    echo '<p class="card-text text-muted">Créateur : ' . $currentCreateurNom . '</p>';
                    echo '<p class="card-text text-muted">' . $currentListDate . '</p>';
                    echo '<p>Articles :</p>';
                    echo '<ul>';
                }

                // Afficher l'article correspondant
                echo '<li>' . $liste['article_nom'] . ' - ' . $liste['article_description'] . '</li>';
            }

            // Fermer la dernière liste
            if ($currentListId !== null) {
                echo '</ul>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>

</body>

</html>