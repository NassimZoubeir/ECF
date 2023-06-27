<?php
require '../include/function.php';
require '../include/db.php';
logged_only();

// Vérifier si l'identifiant de la liste est passé en paramètre
if (!isset($_GET['id'])) {
    // Rediriger vers la page profil si l'identifiant de la liste est manquant
    header('Location: profil.php');
    exit();
}

// Récupérer l'identifiant de la liste
$id_Liste = $_GET['id'];

// Vérifier si la liste existe pour l'utilisateur connecté
$id_Utilisateur = $_SESSION['auth']->id_Utilisateur;
$query = "SELECT * FROM liste WHERE id_Liste = ? AND id_Utilisateur = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$id_Liste, $id_Utilisateur]);
$liste = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$liste) {
    // Rediriger vers la page profil si la liste n'appartient pas à l'utilisateur
    header('Location: profil.php');
    exit();
}

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $titre = $_POST['titre'];
    $description = $_POST['description'];

    // Mettre à jour les informations de la liste dans la base de données
    $query = "UPDATE liste SET nom = ?, description = ? WHERE id_Liste = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$titre, $description, $id_Liste]);

    // Rediriger vers la page profil après la modification de la liste
    header('Location: profil.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Modifier une liste</title>
</head>
<body>
    <?php include 'menu.php'?>

    <div class="container mt-5">
        <h2>Modifier une liste de souhaits</h2>
        <form action="modifier_liste.php?id=<?= $id_Liste ?>" method="post">
            <div class="mb-3">
                <label for="titre">Titre :</label>
                <input type="text" name="titre" id="titre" value="<?= $liste['nom'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="description">Description :</label>
                <textarea name="description" id="description" rows="3" required><?= $liste['description'] ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
    </div>
</body>
</html>
