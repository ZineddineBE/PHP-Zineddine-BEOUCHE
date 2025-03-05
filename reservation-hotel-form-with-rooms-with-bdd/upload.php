<?php
// Répertoire où le fichier sera téléchargé
$repertoireCible = "uploads/";

// Nom du fichier téléchargé
$nomFichier = basename($_FILES["fichier"]["name"]);

// Chemin complet du fichier téléchargé
$cheminCible = $repertoireCible . $nomFichier;

// Vérifier si le fichier est une image (optionnel, selon vos besoins)
$typeFichier = strtolower(pathinfo($cheminCible, PATHINFO_EXTENSION));

// Tableau des extensions autorisées (optionnel)
$extensionsAutorisees = ["jpg", "jpeg", "png", "webp", "gif", "pdf", "txt"];

// Vérifier l'extension du fichier
if (in_array($typeFichier, $extensionsAutorisees)) {
    // Tentative de déplacement du fichier téléchargé vers le répertoire cible
    if (move_uploaded_file($_FILES["fichier"]["tmp_name"], $cheminCible)) {
        echo "Le fichier " . htmlspecialchars($nomFichier) . " a été téléchargé avec succès.";
    } else {
        echo "Désolé, une erreur s'est produite lors du téléchargement de votre fichier.";
    }
} else {
    echo "Désolé, seuls les fichiers JPG, JPEG, PNG, WEBP GIF, PDF et TXT sont autorisés.";
}
?>
