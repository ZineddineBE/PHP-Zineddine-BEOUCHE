<?php
include("header.php");
require 'config/db.php';

$rows = $db->prepare('SELECT * FROM produit');
$rows->execute();
$produits = $rows->fetchAll();


?>
    <body>

        <div class="container mt-5">
            <h1 class="text-center mb-4">Boutique en ligne</h1>

            <div class="d-flex justify-content-end mb-3">
                <a href="form.php" class="btn btn-success"><i class="fa-solid fa-plus pe-2"></i>Ajouter un produit</a>
            </div>

            <div class="d-flex justify-content-end mb-3">
                <a href="orders.php" class="btn btn-primary"><i class="fa-solid fa-eye pe-2"></i>Afficher les commandes</a>
            </div>

            <table class="table table-striped table-bordered table-hover text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Id</th>
                        <th>Image</th>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Prix (€)</th>
                        <th>Stock</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php if ($produits) { ?>
                    <?php foreach ($produits as $produit) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($produit['id_produit']); ?></td>
                            <td><img src="<?php echo $produit['image']?>" alt="Image de <?php echo htmlspecialchars($produit['nom']); ?>" width="80"></td>d
                            <td><?php echo htmlspecialchars($produit['nom']); ?></td>
                            <td><?php echo htmlspecialchars($produit['description']); ?></td>
                            <td><?php echo htmlspecialchars($produit['prix']); ?> €</td>
                            <td><?php echo htmlspecialchars($produit['stock']); ?></td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a class='btn btn-warning btn-sm' href="editProduct.php?id=<?= htmlspecialchars($produit['id_produit']) ?>">
                                        <i class='fa-solid fa-pen'></i> Modifier
                                    </a>
                                    <a class="btn btn-danger btn-sm" href="deleteProduct.php?id=<?= htmlspecialchars($produit['id_produit']) ?>" 
                                       onclick="return confirmDeletion(<?= htmlspecialchars($produit['id_produit']) ?>, event);">
                                        <i class="fa-solid fa-trash"></i> Supprimer
                                    </a>
                                    <a class='btn btn-outline-primary btn-sm' href="addOrder.php?id=<?= htmlspecialchars($produit['id_produit']) ?>">
                                        <i class="fa-solid fa-cart-plus"></i> Commander
                                    </a>
                                </div>
                            </td>

                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr><td colspan="6" class="text-center text-danger">Aucun produit trouvé.</td></tr>
                <?php } ?>
                </tbody>
            </table>
                
            <div class="card p-4 mt-4">
                <h5>Rechercher le prix d’un produit</h5>
                <form action="getPriceProduct.php" method="post" class="d-flex">
                    <input type="text" id="product" name="product" class="form-control me-2" placeholder="Nom du produit" required>
                    <button type="submit" class="btn btn-primary">Rechercher</button>
                </form>
            </div>
        </div>
                
        <?php include("footer.php"); ?>
    </body>
</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function confirmDeletion(id, event) {
    event.preventDefault(); // Empêche la redirection immédiate

    if (confirm("Voulez-vous vraiment supprimer ce produit ?")) {
        window.location.href = "deleteProduct.php?id=" + id; // Redirige si confirmé
    }
}
</script>
