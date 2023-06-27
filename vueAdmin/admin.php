<?php
session_start();
$bdd = new PDO('mysql:host=localhost:8889;dbname=boutique2;', 'root', 'root');

// Vérifie si l'utilisateur est connecté et a le rôle d'administrateur
if (!isset($_SESSION['auth']) || intval($_SESSION['auth']->role) !== 3) {
    header('Location: ../connexion.php');
    exit();
}
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
    <title>Admin</title>
</head>
<body>
    <?php include 'menu.php'; ?>
    <h1 class="text-center mt-5">Bienvenue sur la page Admin</h1>

    <?php 
    $recupUsers = $bdd->query('SELECT * FROM utilisateur');
    while ($user = $recupUsers->fetch()) {
       ?>
      <p style="display:flex; justify-content:center; align-items:center; padding-top: 2em">
        <?=  $user['nom'];?>
        <button><a href="supprimer.php?id=<?= $user['id_Utilisateur'] ?>" style="color:red; text-decoration: none;">Supprimer le membre</a></button>
        <?php if ($user['isActive'] == 1): ?>
            <button><a href="desactiver.php?id=<?= $user['id_Utilisateur'] ?>" style="color:orange; text-decoration: none;">Désactiver</a></button>
        <?php else: ?>
            <button><a href="activer.php?id=<?= $user['id_Utilisateur'] ?>" style="color:green; text-decoration: none;">Activer</a></button>
        <?php endif; ?>
      </p>
    <?php
    }
    ?>
</body>

</html>
