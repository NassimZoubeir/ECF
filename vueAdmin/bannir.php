<?php
session_start();
$bdd = new PDO('mysql:host=localhost:8889;dbname=boutique2', 'root' , 'root');
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $getid = $_GET['id'];
    $recupUser = $bdd->prepare('SELECT * FROM utilisateur WHERE id_Utilisateur = ?');
    $recupUser->execute(array($getid));
    if($recupUser->rowCount() > 0) {

        $bannirUser = $bdd->prepare('DELETE FROM utilisateur WHERE id_Utilisateur = ?');
        $bannirUser->execute(array($getid));

        header('Location: admin.php');
        exit();
    } else {
        echo "Aucun utilisateur n'a été trouvé";
    }
} else {
    echo "L'identifiant n'a pas été récupéré";
}
?>
