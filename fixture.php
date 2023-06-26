<?php
require_once 'vendor/autoload.php'; // Chargement des dépendances du projet
require_once 'include/db.php'; // Inclusion du fichier contenant les informations de connexion à la base de données

use Faker\Factory; // Importation de la classe Factory de la bibliothèque Faker

$faker = Factory::create(); // Initialisation de l'objet Faker pour générer des données factices

// // Paramètres de connexion à la base de données MySQL
// $servername = "localhost:8889";
// $username = "root";
// $password = "root";
// $dbname = "boutique2";

try {
    // Connexion à la base de données avec PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Configuration des options PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Génération et insertion des données factices dans la table Utilisateur
    $stmtUtilisateur = $conn->prepare("INSERT INTO utilisateur (nom, email, mp, isActive, role, avatar) VALUES (:nom, :email, :mp, :isActive, :role, :avatar)");
    for ($i = 0; $i < 10; $i++) {
        $nom = $faker->name; // Génération d'un nom factice
        $email = $faker->email; // Génération d'une adresse e-mail factice
        $mp = $faker->password; // Génération d'un mot de passe factice
        $isActive = $faker->boolean ? 1 : 0; // Génération d'une valeur aléatoire (1 ou 0) pour le champ "isActive"
        $role = $faker->numberBetween($min = 1, $max = 3); // Génération d'un nombre aléatoire entre 1 et 3 pour le champ "role"
        $avatar = $faker->url; // Génération d'une URL factice pour l'avatar

        $stmtUtilisateur->execute(array(
            'nom' => $nom,
            'email' => $email,
            'mp' => $mp,
            'isActive' => $isActive,
            'role' => $role,
            'avatar' => $avatar
        ));
        echo "Données insérées avec succès dans la table Utilisateur.<br>"; // Affichage d'un message de confirmation
    }

    // Génération et insertion des données factices dans la table Liste
    $stmtListe = $conn->prepare("INSERT INTO Liste (nom, description, date, id_Utilisateur) VALUES (:nom, :description, :date, :id_Utilisateur)");
    for ($i = 0; $i < 5; $i++) {
        $nom = $faker->word; // Génération d'un mot factice
        $description = $faker->sentence; // Génération d'une phrase factice
        $date = $faker->date; // Génération d'une date factice
        $id_Utilisateur = $faker->numberBetween($min = 1, $max = 10); // Génération d'un nombre aléatoire entre 1 et 10 pour l'ID de l'utilisateur

        $stmtListe->execute(array(
            'nom' => $nom,
            'description' => $description,
            'date' => $date,
            'id_Utilisateur' => $id_Utilisateur
        ));
        echo "Données insérées avec succès dans la table Liste.<br>"; // Affichage d'un message de confirmation
    }

    // Génération et insertion des données factices dans la table Article
    $stmtArticle = $conn->prepare("INSERT INTO Article (nom, description) VALUES (:nom, :description)");
    for ($i = 0; $i < 20; $i++) {
        $nom = $faker->word; // Génération d'un mot factice
        $description = $faker->sentence; // Génération d'une phrase factice

        $stmtArticle->execute(array(
            'nom' => $nom,
            'description' => $description
        ));
        echo "Données insérées avec succès dans la table Article.<br>"; // Affichage d'un message de confirmation
    }

    // Génération et insertion des données factices dans la table Commentaire
    $stmtCommentaire = $conn->prepare("INSERT INTO Commentaire (description, date, id_Utilisateur, id_Liste) VALUES (:description, :date, :id_Utilisateur, :id_Liste)");
    for ($i = 0; $i < 50; $i++) {
        $description = $faker->sentence; // Génération d'une phrase factice
        $date = $faker->date; // Génération d'une date factice
        $id_Utilisateur = $faker->numberBetween($min = 1, $max = 10); // Génération d'un nombre aléatoire entre 1 et 10 pour l'ID de l'utilisateur
        $id_Liste = $faker->numberBetween($min = 1, $max = 5); // Génération d'un nombre aléatoire entre 1 et 5 pour l'ID de la liste

        $stmtCommentaire->execute(array(
            'description' => $description,
            'date' => $date,
            'id_Utilisateur' => $id_Utilisateur,
            'id_Liste' => $id_Liste
        ));
        echo "Données insérées avec succès dans la table Commentaire.<br>"; // Affichage d'un message de confirmation
    }

    // Génération et insertion des données factices dans la table Liste_has_Article
    $stmtListeHasArticle = $conn->prepare("INSERT INTO Liste_has_Article (id_Liste, id_Article) VALUES (:id_Liste, :id_Article)");
    for ($i = 0; $i < 30; $i++) {
        $id_Article = $faker->numberBetween($min = 1, $max = 20); // Génération d'un nombre aléatoire entre 1 et 20 pour l'ID de l'article
        $id_Liste = $faker->numberBetween($min = 1, $max = 5); // Génération d'un nombre aléatoire entre 1 et 5 pour l'ID de la liste

        $stmtListeHasArticle->execute(array(
            'id_Liste' => $id_Liste,
            'id_Article' => $id_Article
        ));
        echo "Données insérées avec succès dans la table Liste_has_Article.<br>"; // Affichage d'un message de confirmation
    }

    // Fermeture de la connexion à la base de données
    $conn = null;
} catch (PDOException $e) {
    echo "Erreur lors de la connexion à la base de données : " . $e->getMessage();
}
