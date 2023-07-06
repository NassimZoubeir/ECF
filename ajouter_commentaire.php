<?php
require_once 'include/db.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $idListe = $_POST['id_liste'];
    $commentaire = $_POST['commentaire'];
    $date = date('Y-m-d');

    // Vérifier si l'utilisateur est connecté et récupérer ses informations
    $idUtilisateur = isset($_SESSION['auth']) ? $_SESSION['auth']->id_Utilisateur : null;

    // Vérifier si $idUtilisateur est nul et afficher un message d'erreur si nécessaire
    if ($idUtilisateur === null) {
        $_SESSION['erreur'] = 'Vous devez être connecté pour ajouter un commentaire.';
    } else {
        // Insérer le commentaire dans la base de données
        $query = "INSERT INTO commentaire (description, date, id_Utilisateur, id_Liste) VALUES (:description, :date, :idUtilisateur, :idListe)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':description', $commentaire);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':idUtilisateur', $idUtilisateur);
        $stmt->bindParam(':idListe', $idListe);
        $stmt->execute();

        $_SESSION['succes'] = 'Commentaire ajouté avec succès.';
    }

    // Rediriger vers la page d'accueil
    header('Location: index.php');
    exit();
}

