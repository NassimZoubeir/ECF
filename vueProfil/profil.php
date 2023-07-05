<?php
require '../include/function.php';
require '../include/db.php';
logged_only();

// Récupération des listes de souhaits de l'utilisateur
$id_Utilisateur = $_SESSION['auth']->id_Utilisateur;
$query = "SELECT * FROM liste WHERE id_Utilisateur = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$id_Utilisateur]);
$listes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Récupération des articles pour chaque liste
foreach ($listes as &$liste) {
    $id_Liste = $liste['id_Liste'];
    $query = "SELECT article.* FROM article INNER JOIN liste_has_article ON article.id_Article = liste_has_article.id_Article WHERE liste_has_article.id_Liste = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id_Liste]);
    $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $liste['articles'] = $articles;
}
unset($liste);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="../assets/favicon/site.webmanifest">
    <link rel="mask-icon" href="../assets/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <style>
        .avatar {
            display: block;
            margin: 0 auto;
            margin-top: 1em;
            width: 150px;
            height: 150px;
        }
    </style>

<title>Profil</title>
</head>
<body>
    <?php include 'menu.php' ?>
    <!-- Inclure le fichier "menu.php" -->

    <h1 class="text-center mt-4  p-3 border border-5 bg-light">Bonjour <?= $_SESSION['auth']->nom; ?>, bienvenue sur ta page profil !</h1>
    <!-- Afficher un titre de bienvenue avec le nom de l'utilisateur actuellement authentifié -->

    <?php if ($_SESSION['auth']->avatar) : ?>
        <img src="../assets/images/<?= $_SESSION['auth']->avatar ?>" alt="Avatar" class="avatar">
    <?php endif; ?>
    <!-- Afficher l'avatar de l'utilisateur s'il en a un -->

    <div class="container mt-5">
        <h2 class="text-center">Mes listes de souhaits</h2> <br>
        <!-- Afficher le titre des listes de souhaits de l'utilisateur -->

        <?php if (count($listes) > 0) : ?>
            <ul>
                <?php foreach ($listes as $liste) : ?>
                    <li>
                        <strong><?= $liste['nom'] ?></strong> - <?= $liste['description'] ?>
                        <!-- Afficher le nom et la description de la liste -->

                        <div class="btn-group">
                            <a href="ajouter_article.php?id_Liste=<?= $liste['id_Liste'] ?>" class="btn btn-primary">Ajouter un article</a>
                            <!-- Lien pour ajouter un article à la liste -->

                            <a href="modifier_liste.php?id=<?= $liste['id_Liste'] ?>" class="btn btn-secondary">Modifier la liste</a>
                            <!-- Lien pour modifier la liste -->

                            <a href="supprimer_liste.php?id=<?= $liste['id_Liste'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette liste ?')" class="btn btn-danger">Supprimer la liste</a>
                            <!-- Lien pour supprimer la liste avec une confirmation JavaScript -->
                        </div>
                    </li>
                    <br>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <p class="text-center">Aucune liste de souhaits pour le moment.</p>
        <?php endif; ?>
        <!-- Afficher les listes de souhaits de l'utilisateur ou un message indiquant qu'il n'en a pas -->

        <?php if (count($listes) > 0) : ?>
            <?php foreach ($listes as $liste) : ?>
                <?php if (count($liste['articles']) > 0) : ?>
                    <h3><?= $liste['nom'] ?></h3>
                    <!-- Afficher le nom de la liste -->

                    <ul>
                        <?php foreach ($liste['articles'] as $article) : ?>
                            <li><?= $article['nom'] ?></li>
                            <!-- Afficher le nom de chaque article dans la liste -->
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else : ?>
            <p class="text-center">Aucun article pour le moment.</p>
        <?php endif; ?>
        <!-- Afficher les articles de chaque liste de souhaits de l'utilisateur ou un message indiquant qu'il n'y en a pas -->

        <h2>Créer une nouvelle liste de souhaits</h2>
        <!-- Titre pour créer une nouvelle liste de souhaits -->

        <form action="creer_liste.php" method="post">
            <div class="mb-3">
                <label for="titre" class="form-label">Titre :</label>
                <input type="text" name="titre" id="titre" class="form-control" required>
            </div>
            <!-- Champ pour entrer le titre de la nouvelle liste de souhaits -->

            <div class="mb-3">
                <label for="description" class="form-label">Description :</label>
                <textarea name="description" id="description" rows="3" class="form-control" required></textarea>
            </div>
            <!-- Champ pour entrer la description de la nouvelle liste de souhaits -->

            <button type="submit" class="btn btn-primary">Créer</button>
            <!-- Bouton pour soumettre le formulaire de création de liste -->
        </form>
    </div>
</body>
</html>
