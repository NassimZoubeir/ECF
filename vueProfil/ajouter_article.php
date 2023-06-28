<?php
require '../include/db.php';

// Vérifier si l'ID de la liste est passé dans l'URL
if (isset($_GET['id_Liste'])) {
    $id_Liste = $_GET['id_Liste'];

    // Récupérer les articles de la liste
    $query = "SELECT article.id_Article, article.nom, article.description FROM article INNER JOIN liste_has_article ON article.id_Article = liste_has_article.id_Article WHERE liste_has_article.id_Liste = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id_Liste]);
    $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Afficher un message d'erreur si l'ID de la liste n'est pas fourni
    $messageErreur = "ID de la liste non fourni.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom_article = $_POST['nom_article'];
    $description_article = $_POST['description_article'];

    // Insérer l'article dans la base de données
    $query = "INSERT INTO article (id_Article, nom, description) VALUES (NULL, ?, ?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$nom_article, $description_article]);

    // Vérifier si l'insertion de l'article a réussi
    if ($stmt->rowCount() > 0) {
        // Récupérer l'ID de l'article nouvellement créé
        $id_article = $pdo->lastInsertId();

        // Récupérer l'ID de l'utilisateur à partir de la session
        $id_Utilisateur = $_SESSION['auth']->id_Utilisateur;

        // Insérer l'article dans la liste de souhaits de l'utilisateur
        $query = "INSERT INTO liste_has_article (id_Liste, id_Article) VALUES (?, ?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id_Liste, $id_article]);

        // Rediriger l'utilisateur vers la page de profil
        header("Location: profil.php");
        exit();
    } else {
        // Afficher un message d'erreur si l'insertion de l'article a échoué
        $messageErreur = "Erreur lors de la création de l'article.";
    }
}
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
    <title>Ajouter un article</title>
</head>
<body>

    <h1>Ajouter un article</h1>

    <form action="ajouter_article.php?id_Liste=<?= $_GET['id_Liste'] ?>" method="post">
        <div class="mb-3">
            <label for="nom_article" class="form-label">Nom de l'article :</label>
            <input type="text" name="nom_article" id="nom_article" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="description_article" class="form-label">Description de l'article :</label>
            <textarea name="description_article" id="description_article" rows="3" class="form-control" required></textarea>
        </div>
        <input type="hidden" name="id_Liste" value="<?= $_GET['id_Liste'] ?>">
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>



</body>
</html>

