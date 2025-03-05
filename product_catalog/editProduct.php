<?php

require 'config/db.php';

if (!isset($_GET["id"]) || empty($_GET["id"])) {
    die("ID du produit manquant.");
}

$id = htmlspecialchars($_GET["id"]);

$produit = $db->prepare('SELECT * FROM produit WHERE id_produit = :id');
$produit->bindParam(':id', $id);
$produit->execute();


if (!$produit) {
    die("Produit introuvable.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = htmlspecialchars($_POST['nom']);
    $description = htmlspecialchars($_POST['description']);
    $prix = htmlspecialchars($_POST['prix']);
    $stock = htmlspecialchars($_POST['stock']);

    $query = $db->prepare('UPDATE produit SET nom = :nom, description = :description, prix = :prix, stock = :stock WHERE id_produit = :id');
    $query->bindParam(':nom', $nom);
    $query->bindParam(':description', $description);
    $query->bindParam(':prix', $prix);
    $query->bindParam(':stock', $stock);
    $query->bindParam(':id', $id);
    $query->execute();
    header('Location: index.php');
    exit;
}

include 'header.php';
?>

<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow p-4">
                <h2 class="text-center mb-4">Modifier le produit</h2>
                
                <form method="post" action="editProduct.php?id=<?= $id ?>">
                    <div class="mb-3">
                        <label class="form-label">Nom</label>
                        <input type="text" name="nom" class="form-control" value="<?= htmlspecialchars($produit['nom']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <input type="text" name="description" class="form-control" value="<?= htmlspecialchars($produit['description']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Prix (€)</label>
                        <input type="number" name="prix" step="0.01" class="form-control" value="<?= htmlspecialchars($produit['prix']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Stock</label>
                        <input type="number" name="stock" class="form-control" value="<?= htmlspecialchars($produit['stock']) ?>" required>
                    </div>

                    <div class="text-center">
                        <button class="btn btn-warning" type="submit">Modifier</button>
                        <a href="index.php" class="btn btn-secondary ms-2">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php include("footer.php"); ?>
</body>
</html>
