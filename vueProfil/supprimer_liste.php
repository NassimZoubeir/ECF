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

// Vérifier si le formulaire de confirmation a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Supprimer la liste de souhaits de la base de données
    $query = "DELETE FROM liste WHERE id_Liste = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id_Liste]);

    // Rediriger vers la page profil après la suppression de la liste
    header('Location: profil.php');
    exit();
}
// Mettre à jour la contrainte de clé étrangère pour la suppression en cascade
$query = "ALTER TABLE commentaire DROP FOREIGN KEY fk_Commentaire_Liste1";
$stmt = $pdo->prepare($query);
$stmt->execute();

$query = "ALTER TABLE commentaire ADD CONSTRAINT fk_Commentaire_Liste1 FOREIGN KEY (id_Liste) REFERENCES liste (id_Liste) ON DELETE CASCADE";
$stmt = $pdo->prepare($query);
$stmt->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Supprimer une liste</title>
</head>
<body>
    <?php include 'menu.php'?>

    <div class="container mt-5">
        <h2>Supprimer une liste de souhaits</h2>
        <p>Êtes-vous sûr de vouloir supprimer cette liste ? Cette action est irréversible.</p>
        <form action="supprimer_liste.php?id=<?= $id_Liste ?>" method="post">
            <button type="submit" class="btn btn-danger">Supprimer</button>
        </form>
    </div>
</body>
</html>
