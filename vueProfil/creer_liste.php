<?php
session_start();
require_once '../include/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    
    // Obtenir la date actuelle au format YYYY-MM-DD
    $date = date('Y-m-d');
    
    // Requête d'insertion dans la base de données
    $query = "INSERT INTO Liste (nom, description, date, id_Utilisateur) 
              VALUES (:nom, :description, :date, :id_Utilisateur)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':nom', $titre);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':id_Utilisateur', $_SESSION['auth']->id_Utilisateur);
    
    // Exécution de la requête
    $stmt->execute();
    
    // Redirection vers la page de profil après la création de la liste
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
    <title>Créer une liste</title>
</head>
<body>
    <?php include 'menu.php'?>

    <div class="container mt-5">
        <h2>Créer une nouvelle liste de souhaits</h2>
        <form action="creer_liste.php" method="post">
            <div class="mb-3">
                <label for="titre">Titre :</label>
                <input type="text" name="titre" id="titre" required>
            </div>
            <div class="mb-3">
                <label for="description">Description :</label>
                <textarea name="description" id="description" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Créer</button>
        </form>
    </div>
</body>
</html>
