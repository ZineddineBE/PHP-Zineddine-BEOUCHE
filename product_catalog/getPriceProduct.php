<?php
include("header.php");
require 'config/db.php';

if(isset($_POST['product'])) {
    // Sécuriser les données entrantes
    $nom = htmlspecialchars($_POST['product']);
}

$sql = "SELECT * FROM produit WHERE nom LIKE :nom";
$stmt = $db->prepare($sql);
$stmt->execute(['nom' => $nom . '%']);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<div class="container mt-5">
    <?php
    if (!$result) {
        echo '<div class="alert alert-danger" role="alert">Produit introuvable</div>';
        ?>
        <div class="mt-3">
            <a href="index.php" class="btn btn-primary">Retour à l\'accueil</a>
        </div>
        <?php
    } else {
        echo "<h3 class='mb-4'>Produits trouvés :</h3>";
        echo "<ul class='list-group'>";
        foreach ($result as $row) {
            echo "<li class='list-group-item d-flex justify-content-between align-items-center'>" . 
                    htmlspecialchars($row['nom']) . 
                    " : <span class='badge bg-success'>" . htmlspecialchars($row['prix']) . "€</span>" . 
                 "</li>";
        }
        echo "</ul>";
    }
    ?>
    <div class="mt-3">
        <a href="index.php" class="btn btn-primary">Retour à l\'accueil</a>
    </div>
</div>

<?php include("footer.php"); ?>
