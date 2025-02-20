<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/upload-style.css">
    <title>Uploader une image</title>
    <style>
        
    </style>
</head>
<body>

    <h2>Uploader une image de l'hôtel</h2>

    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="fichier">Sélectionner une image :</label>
        <input type="file" name="fichier" id="fichier">
        <input type="submit" value="Télécharger" name="submit">
    </form>

    <button><a href="form.php">Réserver une chambre</a></button>

    <footer>
        &copy; 2025 Votre Hôtel - Tous droits réservés
    </footer>

</body>
</html>
