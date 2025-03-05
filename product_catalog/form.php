<?php
include 'header.php';
?>

<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow p-4">
                <h2 class="text-center mb-4">Ajouter un nouveau produit</h2>
                
                <form method="post" action="addProduct.php">
                    <div class="mb-3">
                        <label class="form-label">Nom</label>
                        <input type="text" name="nom" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Image</label>
                        <input type="text" name="image" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <input type="text" name="description" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Prix (€)</label>
                        <input type="number" name="prix" step="0.01" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Stock</label>
                        <input type="number" name="stock" class="form-control" required>
                    </div>

                    <div class="text-center">
                        <button class="btn btn-success" type="submit">Ajouter</button>
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

