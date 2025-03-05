<?php

require 'config/db.php';

$nom = htmlspecialchars($_POST['nom']);
$image = htmlspecialchars($_POST['image']);
$description = htmlspecialchars($_POST['description']);
$prix = htmlspecialchars($_POST['prix']);
$stock = htmlspecialchars($_POST['stock']);

if(isset($_POST['nom']) && isset($_POST['image']) && isset($_POST['description']) && isset($_POST['prix']) && isset($_POST['stock'])) {
    $query = $db->prepare('INSERT INTO produit (nom, description, prix, stock, image) VALUES (:nom, :description, :prix, :stock, :image)');
    $query->bindParam(':nom', $nom);
    $query->bindParam(':description', $description);
    $query->bindParam(':prix', $prix);
    $query->bindParam(':stock', $stock);
    $query->bindParam(':image', $image);
    $query->execute();

    header('Location: index.php');
}

?>