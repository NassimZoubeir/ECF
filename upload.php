<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Vérifier si le fichier est une image réelle ou une fausse image
if (isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if ($check !== false) {
    echo "Le fichier est une image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "Le fichier n'est pas une image.";
    $uploadOk = 0;
  }
}

// Vérifier la taille du fichier
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Désolé, votre fichier est trop volumineux.";
  $uploadOk = 0;
}

// Autoriser uniquement certains formats de fichiers
$allowedExtensions = array("jpg", "jpeg", "png", "gif");
if (!in_array($imageFileType, $allowedExtensions)) {
  echo "Désolé, seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.";
  $uploadOk = 0;
}

// Vérifier si $uploadOk est défini à 0 par une erreur
if ($uploadOk == 0) {
  echo "Désolé, votre fichier n'a pas été téléchargé.";
// Si tout va bien, essayer de télécharger le fichier
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "Le fichier ". htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " a été téléchargé.";
  } else {
    echo "Une erreur s'est produite lors du téléchargement de votre fichier.";
  }
}
?>
