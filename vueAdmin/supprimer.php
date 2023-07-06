<?php
session_start(); // Démarrer la session

$bdd = new PDO('mysql:host=localhost:8889;dbname=boutique2', 'root', 'root');
// Connexion à la base de données MySQL avec PDO

if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Vérifier si l'identifiant est défini dans le paramètre GET et s'il n'est pas vide

    $getid = $_GET['id'];
    // Récupérer la valeur de l'identifiant depuis le paramètre GET

    // Supprimer l'utilisateur et ses listes associées
    $supprimerUtilisateur = $bdd->prepare('DELETE utilisateur, liste
                                           FROM utilisateur
                                           LEFT JOIN liste ON utilisateur.id_Utilisateur = liste.id_Utilisateur
                                           WHERE utilisateur.id_Utilisateur = ?');
    $supprimerUtilisateur->execute(array($getid));

    header('Location: admin.php');
    exit();
} else {
    echo "L'identifiant n'a pas été récupéré";
}
