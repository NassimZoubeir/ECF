<?php
require_once 'include/db.php';
require_once 'ajouter_commentaire.php';

// Requête pour récupérer toutes les listes contenant des articles avec le nom du créateur
$query = "SELECT l.id_Liste, l.nom, l.description, l.date, a.id_Article, a.nom AS article_nom, a.description AS article_description, u.id_Utilisateur, u.nom AS createur_nom, u.avatar, c.description AS commentaire
          FROM liste l
          LEFT JOIN liste_has_article la ON l.id_Liste = la.id_Liste
          LEFT JOIN article a ON la.id_Article = a.id_Article
          LEFT JOIN utilisateur u ON l.id_Utilisateur = u.id_Utilisateur
          LEFT JOIN commentaire c ON l.id_Liste = c.id_Liste";
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
    <style>
        .comment {
            display: flex;
            align-items: center;
        }

        .comment-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .comment-author {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <?php require_once 'include/menu.php' ?>

    <div class="container">
        <h1 class="card-title text-primary text-center m-3">Liste de souhaits</h1>

        <?php
        // Afficher l'alerte d'erreur s'il y en a une
        if (isset($_SESSION['erreur'])) {
            echo '<div class="alert alert-danger">' . $_SESSION['erreur'] . '</div>';
            unset($_SESSION['erreur']);
        }

        // Afficher l'alerte de succès s'il y en a une
        if (isset($_SESSION['succes'])) {
            echo '<div class="alert alert-success">' . $_SESSION['succes'] . '</div>';
            unset($_SESSION['succes']);
        }
        ?>

        <div class="row">
            <?php
            // Variables pour garder une trace de l'id_Liste en cours
            $currentListId = null;
            $currentListName = null;
            $currentListDescription = null;
            $currentListDate = null;
            $currentCreateurNom = null;
            $currentListComments = array();

            // Parcourir les résultats et afficher les listes avec les articles
            foreach ($listes as $liste) {
                // Vérifier si c'est une nouvelle liste
                if ($liste['id_Liste'] !== $currentListId) {
                    // Afficher les informations de la liste
                    if ($currentListId !== null) {
                        // Fermer la liste précédente si elle existe
                        echo '</ul>';

                        // Afficher les commentaires pour cette liste spécifique
                        if (!empty($currentListComments)) {
                            echo '<div class="card m-3">';
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title">Commentaires :</h5>';
                            foreach ($currentListComments[$currentListId] as $comment) {
                                echo '<div class="comment">';
                                echo '<img class="comment-avatar" src="assets/images/' . $comment['avatar'] . '" alt="Avatar">';
                                echo '<div>';
                                echo '<p class="comment-author">' . $comment['auteur'] . '</p>';
                                echo '<p class="card-text">' . $comment['description'] . '</p>';
                                echo '</div>';
                                echo '</div>';
                            
                            }
                            echo '</div>';
                            echo '</div>';
                        }

                        // Afficher le formulaire de commentaire pour cette liste spécifique
                        echo '<form action="ajouter_commentaire.php" method="POST">';
                        echo '<input type="hidden" name="id_liste" value="' . $currentListId . '">';
                        echo '<div class="mb-3">';
                        echo '<label for="commentaire">Ajouter un commentaire :</label>';
                        echo '<textarea class="form-control" name="commentaire" id="commentaire" rows="3" required></textarea>';
                        echo '</div>';
                        echo '<button type="submit" class="btn btn-primary">Ajouter un commentaire</button>';
                        echo '</form>';

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

                    // Réinitialiser les commentaires de la nouvelle liste
                    $currentListComments[$currentListId] = array();

                    // Afficher la nouvelle liste
                    echo '<div class="col-md-4">';
                    echo '<div class="card m-3">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $currentListName . '</h5>';
                    echo '<p class="card-text">' . $currentListDescription . '</p>';
                    echo '<p class="card-text">Crée le : ' . $currentListDate . '</p>';
                    echo '<p class="card-text">Créateur : ' . $currentCreateurNom . '</p>';
                    echo '<h6 class="card-subtitle mb-2 text-muted">Articles :</h6>';
                    echo '<ul class="list-group">';
                }

                // Afficher les informations de l'article
                echo '<li class="list-group-item">' . $liste['article_nom'] . '</li>';

                // Vérifier s'il y a des commentaires pour cet article
                if (!empty($liste['commentaire'])) {
                    // Ajouter le commentaire à la liste correspondante
                    $currentListComments[$currentListId][] = array(
                        'avatar' => $liste['avatar'],
                        'auteur' => $liste['createur_nom'],
                        'description' => $liste['commentaire']
                    );
                }
            }

            // Fermer la dernière liste
            if ($currentListId !== null) {
                echo '</ul>';

                // Afficher les commentaires pour la dernière liste
                if (!empty($currentListComments)) {
                    echo '<div class="card m-3">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">Commentaires :</h5>';
                    foreach ($currentListComments[$currentListId] as $comment) {
                        echo '<div class="comment">';
                        echo '<img class="comment-avatar" src="assets/images/' . $comment['avatar'] . '" alt="Avatar">';
                        echo '<div>';
                        echo '<p class="comment-author">' . $comment['auteur'] . '</p>';
                        echo '<p class="card-text">' . $comment['description'] . '</p>';
                        echo '</div>';
                        echo '</div>';
                    }
                    
                    echo '</div>';
                    echo '</div>';
                }

                // Afficher le formulaire de commentaire pour la dernière liste
                echo '<form action="ajouter_commentaire.php" method="POST">';
                echo '<input type="hidden" name="id_liste" value="' . $currentListId . '">';
                echo '<div class="mb-3">';
                echo '<label for="commentaire">Ajouter un commentaire :</label>';
                echo '<textarea class="form-control" name="commentaire" id="commentaire" rows="3" required></textarea>';
                echo '</div>';
                echo '<button type="submit" class="btn btn-primary">Ajouter un commentaire</button>';
                echo '</form>';

                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</body>

</html>
