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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--  définit le jeu de caractères utilisé dans la page comme UTF-8, ce qui permet de prendre en charge une large gamme de caractères spéciaux et internationaux. -->

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- spécifie la version du mode de compatibilité d'Internet Explorer utilisée par le navigateur. Dans ce cas, "IE=edge" indique d'utiliser la dernière version disponible. -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- définit la vue de la page pour les appareils mobiles. Elle indique que la largeur de la page doit correspondre à la largeur de l'appareil et que l'échelle initiale doit être définie à 1.0, assurant ainsi une mise en page adaptative sur les différents appareils. -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Link de la feuille de style de BootStrap -->

    <!-- lien spécifique au Favicon suivant le support de diffusion utilisé --> 
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="../assets/favicon/site.webmanifest">
    <link rel="mask-icon" href="../assets/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <!-- fin Favicon -->
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

    <?php include 'menu.php'?>
    
    <h1 class="text-center mt-4  p-3 border border-5 bg-light">Bonjour <?= $_SESSION['auth']->nom;?>, bienvenue sur ta page profil !</h1>    
     <?php if ($_SESSION['auth']->avatar): ?>
        <img src="../assets/images/<?= $_SESSION['auth']->avatar ?>" alt="Avatar" class="avatar">
    <?php endif; ?> 

    <div class="container mt-5">
        <h2 class="text-center">Mes listes de souhaits</h2>
        <?php if (count($listes) > 0): ?>
            <ul>
                <?php foreach ($listes as $liste): ?>
                    <li>
                        <strong><?= $liste['nom'] ?></strong> - <?= $liste['description'] ?>
                        <a href="ajouter_article.php?id_Liste=<?= $liste['id_Liste'] ?>">Ajouter un article</a>
                        <a href="modifier_liste.php?id=<?= $liste['id_Liste'] ?>">Modifier</a>
                        <a href="supprimer_liste.php?id=<?= $liste['id_Liste'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette liste ?')">Supprimer</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p class="text-center">Aucune liste de souhaits pour le moment.</p>
        <?php endif; ?>

        <h2>Créer une nouvelle liste de souhaits</h2>
        <form action="creer_liste.php" method="post">
            <div class="mb-3">
                <label for="titre" class="form-label">Titre :</label>
                <input type="text" name="titre" id="titre" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description :</label>
                <textarea name="description" id="description" rows="3" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Créer</button>
        </form>
 
</body>
</html>